<?php
require_once("src/DB/db_connect.php");

class Group
{
	private $id;
	private $groupNumber;
	private $repositoryURL;

	private static $db;

	private static function getDBConn()
	{
		// connect to db
		self::$db = self::$db ?? dbConn();
	}

	public function getID(): int
	{
		return $this->id;
	}

	public function getGroupNumber(): int
	{
		return $this->groupNumber ?? 0;
	}

	public function setGroupNumber(int $number)
	{
		$this->groupNumber = $number;
	}

	public function getRepositoryURL(): string
	{
		return $this->repositoryURL ?? '';
	}

	public function setRepositoryURL(string $URL)
	{
		$this->repositoryURL = $URL;
	}

	/**
	 * createGroup functions
	 *
	 * @return boolean
	 */
	function createGroup(): int
	{
		self::getDBConn();
		// check if we have the info we need
		if (empty($this->groupNumber) || empty($this->repositoryURL)) {
			// log error
			echo 'Number AND Repository URL cannot be blank';
			throw new Exception('Number AND Repository URL cannot be blank');
		}

		// escape our values so we don't get hacked
		$num = self::$db->real_escape_string($this->groupNumber);
		$repositoryURL = self::$db->real_escape_string(urlencode($this->repositoryURL));

		$sql = "INSERT INTO `Groups` (groupNumber, repositoryURL) VALUES ($num, '$repositoryURL')";

		// echo $sql;

		// false on fail true on success
		$result = self::$db->query($sql);
		if (!$result) {
			// check if simple duplication
			if (self::$db->errno === 1062) {
				$group = self::findGroupByNumber($num);
			} else {
				echo self::$db->error . ', error number: ' . self::$db->errno;
				self::$db->close();
				return 0;
			}
			return $group->getID();
		}
		$newID = self::$db->insert_id;
		self::$db->close();
		return $newID;
	}

	/**
	 * listGroups returns an array of all groups
	 *
	 * @return array|bool
	 */
	public static function listGroups(): array
	{
		self::getDBConn();

		$sql = 'SELECT * FROM `Groups` ORDER BY groupNumber ASC';
		$groups = self::$db->query($sql);
		if (!$groups) {
			echo 'Error retrieving groups: ' . self::$db->error . ', (' . self::$db->errno . ')';
		}

		$retArray = array();
		while ($group = $groups->fetch_object(\Group::class)) {
			$retArray[] = $group;
		}

		return $retArray;
	}

	/**
	 * Count of group members
	 *
	 * @return integer
	 */
	public function countMembers(): int
	{
		$sql = "select count(*) as count from Students where groupID = $this->id";
		$count = self::$db->query($sql);
		if ($count !== false) {
			return $count->fetch_array(\MYSQLI_ASSOC)['count'];
		}
		return 0;
	}

	public static function findGroupByID(int $id): Group
	{
		$sql = "SELECT * FROM `Groups` WHERE id = $id";
		$group = self::$db->query($sql);
		echo $sql;
		if (!$group) {
			throw new Exception(self::$db->error);
		}
		$returnGroup = $group->fetch_object(\Group::class);
		if(!$returnGroup){
			throw new Exception("No Group found with id: $id");
		}
		return $returnGroup;
	}

	public static function findGroupByNumber(int $num): Group
	{
		$sql = "SELECT * FROM `Groups` WHERE groupNumber = $num";
		$group = self::$db->query($sql);
		echo $sql;
		if (!$group) {
			throw new Exception(self::$db->error);
		}
		$returnGroup = $group->fetch_object(\Group::class);
		if(!$returnGroup){
			throw new Exception("No Group found with number: $num");
		}
		return $returnGroup;
	}
}
