<?php
require_once("src/DB/db_connect.php");

class Student
{
	private $id;
	public $firstName;
	public $lastName;
	public $email;
	public $repositoryURL;
	public $groupID;

	private static $db;

	private static function getDBConn()
	{
		// connect to db
		self::$db = self::$db ?? dbConn();
	}

	public function getID(){
		return $this->id;
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

		$sql = "INSERT INTO `Students` (lastName, firstName, email, repositoryURL, groupID) VALUES ('$f', '$l', '$e', '$r', $this->groupID)";

		// false on fail true on success
		$result = self::$db->query($sql);
		if (!$result) {
			echo self::$db->error . ', error number: ' . self::$db->errno;
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
	public static function listStudentsByGroup(int $groupID):array
	{
		self::getDBConn();

		$sql = 'SELECT * FROM `Students` WHERE `Students`.`groupID`= '.$groupID.' ORDER BY firstName ASC';
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
