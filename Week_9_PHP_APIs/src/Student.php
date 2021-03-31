<?php

namespace WFDWeb;

require __DIR__ . '/../vendor/autoload.php';

use JsonSerializable;
use WFDWeb\Group;

class Student implements JsonSerializable
{
	private int $id;
	private string $firstName;
	private string $lastName;
	private string $email;
	private string $repositoryURL;
	private int $groupID;

	private Database $db;

	public function __construct()
	{
		$this->db = $this->db ?? new Database();
	}

	public function getGroup(): Group
	{
		$group = Group::findGroupByID($this->groupID);
		return $group;
	}

	public function getGroupID(): int
	{
		$group = $this->getGroup();
		return $group->getID();
	}

	public function setGroupID(int $id)
	{
		$this->groupID = $id;
	}

	/**
	 * Undocumented function
	 *
	 * @return boolean
	 */
	public function saveToDB(): bool
	{
		$dbCon = $this->db->getConnection() ?? new Database();

		$f = $dbCon->real_escape_string($this->firstName);
		$l = $dbCon->real_escape_string($this->lastName);
		$e = $dbCon->real_escape_string($this->email);
		$r = $dbCon->real_escape_string(urlencode($this->repositoryURL));

		$sql = "INSERT INTO `Students` (firstName, lastName, email, repositoryURL, groupID) VALUES ('$f', '$l', '$e', '$r', $this->groupID)";

		// false on fail true on success
		$result = $dbCon->query($sql);
		if (!$result) {
			echo $dbCon->error . ', error number: ' . $dbCon->errno;

			return false;
		}

		return true;
	}

	/**
	 * Find Student by Last Name
	 * @var string $lastName
	 *
	 * @return Student
	 */
	public function findStudentByLastName($lastName): Student
	{
		$dbCon = $this->db->connection ?? new Database();

		$sql = "Select count(id), id from students where lastName=\'$lastName\'";

		return $dbCon->query($sql);
	}

	/**
	 * listStudents lists all students in an array
	 *
	 * @return array
	 */
	public static function listStudents(): array
	{
		$dbCon = new Database();

		$sql = 'SELECT * FROM `Students` ORDER BY firstName ASC';
		$students = $dbCon->query($sql);
		if (!$students) {
			echo 'Error retrieving students: ' . $dbCon->error . ', (' . $dbCon->errno . ')';
		}

		$retArray = array();
		while ($student = $students->fetch_object(\Student::class)) {
			$retArray[] = $student;
		}

		return $retArray;
	}

	/**
	 * listStudentsByGroup lists all students in an array
	 *
	 * @return array
	 */
	public static function listStudentsByGroup(Group $group): array
	{
		$db = new Database();
		$dbCon = $db->getConnection();

		$sql = 'SELECT * FROM `Students` WHERE `Students`.`groupID`= ' . $group->getID() . ' ORDER BY firstName ASC';
		$students = $dbCon->query($sql);
		if (!$students) {
			echo 'Error retrieving groups: ' . $dbCon->error . ', (' . $dbCon->errno . ')';
		}

		$retArray = array();
		while ($student = $students->fetch_object(Student::class)) {
			$retArray[] = $student;
		}

		return $retArray;
	}

	public function getID(): int
	{
		return $this->id;
	}

	public function getFirstName(): string
	{
		return $this->firstName ?? '';
	}

	public function setFirstName(string $name)
	{
		$this->firstName = $name;
	}

	public function getLastName(): string
	{
		return $this->lastName ?? '';
	}

	public function setLastName(string $name)
	{
		$this->lastName = $name;
	}

	public function getRepositoryURL(): string
	{
		return $this->repositoryURL ?? '';
	}

	public function setRepositoryURL(string $URL)
	{
		$this->repositoryURL = $URL;
	}

	public function getEmail(): string
	{
		return $this->email ?? '';
	}

	public function setEmail(string $email)
	{
		$this->email = $email;
	}

	public function jsonSerialize()
	{
		return [
			'id' => $this->getID(),
			'first_name' => $this->getFirstName(),
			'last_name' => $this->getLastName(),
			'email' => $this->getEmail(),
			'repo_url' => $this->getRepositoryURL(),
			'group_number' => $this->getGroup()->getID(),
		];
	}
}
