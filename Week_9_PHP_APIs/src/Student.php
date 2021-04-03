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
		$group = new Group;
		$group = $group->findGroupByID($this->groupID);
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
	 * Find Student by Name searches first AND last name
	 * @var string $name
	 *
	 * @return Student|array|false
	 */
	public static function findStudentByName($name)
	{
		$db = new Database();
		$dbCon = $db->getConnection();

		$name = $dbCon->real_escape_string($name);

		$sql = "SELECT * FROM `Students` WHERE lastName='$name' OR firstname='$name'";

		$result = $dbCon->query($sql);

		$retArray = array();
		if ($result) {
			while ($student = $result->fetch_object(Student::class)) {
				$retArray[] = $student;
			}
			if (count($retArray) == 1) {
				return $retArray[0];
			}
			return $retArray;
		}
		return false;
	}

	/**
	 * Find Student by Last Name
	 * @var string $lastName
	 *
	 * @return Student
	 */
	public static function findStudentByLastName($lastName): Student
	{
		$db = new Database();
		$dbCon = $db->getConnection();

		$lastName = $db->real_escape_string($lastName);

		$sql = "SELECT * FROM `Students` WHERE lastName='$lastName'";

		$result = $dbCon->query($sql);

		if ($result) {
			while ($student = $result->fetch_object(Student::class)) {
				$retArray[] = $student;
			}
			if (count($retArray == 1)) {
				return $retArray[0];
			}
			return $retArray;
		}
		return false;
	}

	/**
	 * Find Student by ID
	 * @var int $id
	 *
	 * @return Student
	 */
	public static function findStudentByID($id): Student
	{
		$db = new Database();
		$dbCon = $db->getConnection();

		$sql = "SELECT * FROM `Students` WHERE id=$id";

		$result = $dbCon->query($sql);
		if ($result) {
			return $result->fetch_object(self::class);
		}
		return false;
	}

	/**
	 * listStudents lists all students in an array
	 *
	 * @return array
	 */
	public static function listStudents(): array
	{
		$db = new Database();
		$dbCon = $db->getConnection();

		$sql = 'SELECT * FROM `Students` ORDER BY firstName ASC';

		$students = $dbCon->query($sql);
		if (!$students) {
			echo 'Error retrieving students: ' . $dbCon->error . ', (' . $dbCon->errno . ')';
		}

		$retArray = array();
		while ($student = $students->fetch_object(Student::class)) {
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
		return $this->id ?? 0;
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
			'repo_url' => urldecode($this->getRepositoryURL()),
			'group_number' => $this->getGroup()->getGroupNumber(),
		];
	}
}
