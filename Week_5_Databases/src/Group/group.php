<?php
class Group
{

	public $nID;
	public $nGroupNum;
	public $sRepoURL;

	private static $db;

	private static function getDBConn()
	{
		// connect to db
		self::$db = self::$db ?? dbConn();
	}

	/**
	 * createGroup functions
	 *
	 * @return boolean
	 */
	function createGroup(): bool
	{
		self::getDBConn();
		// check if we have the info we need
		if (empty($this->nGroupNum) || empty($this->sRepoURL)) {
			// log error
			echo 'Number AND Repository URL cannot be blank';
			throw new Exception('Number AND Repository URL cannot be blank');
		}

		// escape our values so we don't get hacked
		$num = self::$db->real_escape_string($this->nGroupNum);
		$repositoryURL = self::$db->real_escape_string($this->sRepoURL);

		$sql = "INSERT INTO `Groups` (groupNumber, repositoryURL)
	VALUES ($num, '$repositoryURL')
	ORDER BY groupNumber ASC";

		// echo "<br/>$sql<br/>";

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
	 * listGroups returns an array of all groups
	 *
	 * @return array|bool
	 */
	public static function listGroups():mysqli_result
	{
		self::getDBConn();

		$sql = 'SELECT * FROM `Groups`';
		$groups = self::$db->query($sql);
		if (!$groups) {
			echo 'Error retrieving groups: '.self::$db->error.', ('.self::$db->errno.')';
		}
		return $groups;
	}
}
