<?php
require_once("src/DB/db_connect.php");

class Student
{
	private $id;
	private $firstName;
	private $lastName;
	private $email;
	private $repositoryURL;
	private $groupID;

	private static $db;

	private static function getDBConn()
	{
		// connect to db
		self::$db = self::$db ?? dbConn();
	}

	public function getID():int{
		return $this->id;
	}

	public function getFirstName():string {
		return $this->firstName ?? '';
	}

	public function setFirstName(string $name) {
		$this->firstName = $name;
	}

	public function getLastName():string {
		return $this->lastName ?? '';
	}

	public function setLastName(string $name) {
		$this->lastName = $name;
	}

	public function getRepositoryURL():string {
		return $this->repositoryURL ?? '';
	}

	public function setRepositoryURL(string $URL) {
		$this->repositoryURL = $URL;
	}

	public function getEmail():string {
		return $this->email ?? '';
	}

	public function setEmail(string $email) {
		$this->email = $email;
	}

	public function getGroup():Group {
		$group = \Group::findGroupByID($this->groupID);
		return $group;
	}

	public function getGroupID():int {
		$group = $this->getGroup();
		return $group->getID();
	}

	public function setGroupID(int $id) {
		$this->groupID = $id;
	}

	/**
	 * Undocumented function
	 *
	 * @return boolean
	 */
	public function createStudent(): bool
	{
		self::getDBConn();

		$f = self::$db->real_escape_string($this->firstName);
		$l = self::$db->real_escape_string($this->lastName);
		$e = self::$db->real_escape_string($this->email);
		$r = self::$db->real_escape_string(urlencode($this->repositoryURL));

		$sql = "INSERT INTO `Students` (firstName, lastName, email, repositoryURL, groupID) VALUES ('$f', '$l', '$e', '$r', $this->groupID)";

		// false on fail true on success
		$result = self::$db->query($sql);
		if (!$result) {
			echo self::$db->error . ', error number: ' . self::$db->errno;
			var_dump($sql);
			self::$db->close();
			return false;
		}
		self::$db->close();
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
		self::getDBConn();

		$sql = "Select count(id), id from students where lastName=\'$lastName\'";

		return self::$db->query($sql);
	}

	/**
	 * listStudents lists all students in an array
	 *
	 * @return array
	 */
	public static function listStudents():array
	{
		self::getDBConn();

		$sql = 'SELECT * FROM `Students` ORDER BY firstName ASC';
		$students = self::$db->query($sql);
		if (!$students) {
			echo 'Error retrieving students: '.self::$db->error.', ('.self::$db->errno.')';
		}

		$retArray = array();
		while($student = $students->fetch_object(\Student::class)){
			$retArray[] = $student;
		}

		return $retArray;
	}

	/**
	 * listStudentsByGroup lists all students in an array
	 *
	 * @return array
	 */
	public static function listStudentsByGroup(\Group $group):array
	{
		self::getDBConn();

		$sql = 'SELECT * FROM `Students` WHERE `Students`.`groupID`= '.$group->getID().' ORDER BY firstName ASC';
		$students = self::$db->query($sql);
		if (!$students) {
			echo 'Error retrieving groups: '.self::$db->error.', ('.self::$db->errno.')';
		}

		$retArray = array();
		while($student = $students->fetch_object(\Student::class)){
			$retArray[] = $student;
		}

		return $retArray;
	}
}
