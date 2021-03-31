<?php

namespace WFDWeb;

use WFDWeb\Group;

class Student
{
	private int $id;
	private string $firstName;
	private string $lastName;
	private string $email;
	private string $repositoryURL;
	private int $groupID;

	private Database $db;

	public function __construct(string $fname = '', string $lname = '', string $email = '', string $repoURL = '', int $groupID = null)
	{
		$this->firstName = $fname;
		$this->lastName = $lname;
		$this->email = $email;
		$this->repositoryURL = $repoURL;
		$this->groupID = $groupID;
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
		$dbCon = $this->db->connection ?? new Database();

		$f = $dbCon->real_escape_string($this->firstName);
		$l = $dbCon->real_escape_string($this->lastName);
		$e = $dbCon->real_escape_string($this->email);
		$r = $dbCon->real_escape_string(urlencode($this->repositoryURL));

		$sql = "INSERT INTO `Students` (lastName, firstName, email, repositoryURL, groupID) VALUES ('$f', '$l', '$e', '$r', $this->groupID)";

		// false on fail true on success
		$result = $dbCon->query($sql);
		if (!$result) {
			echo $dbCon->error . ', error number: ' . $dbCon->errno;
			$dbCon->close();
			return false;
		}
		$dbCon->close();
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

		$dbCon->close();

		return $retArray;
	}

	/**
	 * listStudentsByGroup lists all students in an array
	 *
	 * @return array
	 */
	public static function listStudentsByGroup(\Group $group): array
	{
		$dbCon = new Database();

		$sql = 'SELECT * FROM `Students` WHERE `Students`.`groupID`= ' . $group->getID() . ' ORDER BY firstName ASC';
		$students = $dbCon->query($sql);
		if (!$students) {
			echo 'Error retrieving groups: ' . $dbCon->error . ', (' . $dbCon->errno . ')';
		}

		$retArray = array();
		while ($student = $students->fetch_object(\Student::class)) {
			$retArray[] = $student;
		}

		$dbCon->close();

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
}
