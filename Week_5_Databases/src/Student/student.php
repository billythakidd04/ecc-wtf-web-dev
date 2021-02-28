<?php
class Student
{
	public $nID;
	public $sLastName;
	public $sFirstName;
	public $sEmail;
	public $sRepoURL;
	public $nGroupID;

	private static $db;

	private static function getDBConn()
	{
		// connect to db
		self::$db = self::$db ?? dbConn();
	}

	/**
	 * Undocumented function
	 *
	 * @return boolean
	 */
	public function createStudent(): bool
	{
		self::getDBConn();

		$sql = "INSERT INTO `Students` (lastName, firstName, email, repositoryURL, groupID) VALUES ('$this->sLastName', '$this->sFirstName', '$this->sEmail', '$this->sRepoURL', '$this->nGroupID')";

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
	public static function listStudents():mysqli_result
	{
		self::getDBConn();

		$sql = 'SELECT * FROM `Students`';
		$students = self::$db->query($sql);
		if (!$students) {
			echo 'Error retrieving groups: '.self::$db->error.', ('.self::$db->errno.')';
		}
		return $students;
	}
}
