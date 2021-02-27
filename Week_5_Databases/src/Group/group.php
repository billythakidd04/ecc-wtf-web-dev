<?php
class Group{

	protected $nID;
	protected $nGroupNum;
	protected $sRepoURL;

	private static $db;

	private static function getDBConn(){
		// connect to db
		self::$db = self::$db ?? dbConn();
	}

	/**
	 * createGroup functions
	 *
	 * @return boolean
	 */
	function createGroup(array $group): bool
	{
		// check if we have the info we need
		if (empty($group['number']) || empty($group['repositoryURL'])) {
			// log error
			echo 'Number AND Repository URL cannot be blank';
			throw new Exception('Number AND Repository URL cannot be blank');
		}

		// escape our values so we don't get hacked
		$num = self::$db->real_escape_string($group['number']);
		$repositoryURL = self::$db->real_escape_string($group['repositoryURL']);

		$sql = "INSERT INTO GROUPS (groupNumber, repositoryURL)
	VALUES ($num, '$repositoryURL')";

		// false on fail true on success
		return self::$db->query($sql);
	}

	/**
	 * 
	 */
	public function listGroups():array {
		$groups = array();
		$sql = 'SELECT * FROM groups';
		$groups = $this->db->query($sql);
		return $groups;
	}
}
