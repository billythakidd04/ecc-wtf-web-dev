<?php

namespace WFDWeb;

require __DIR__ . '/../vendor/autoload.php';

use JsonSerializable;
use WFDWeb\Database;

class Group implements JsonSerializable
{
	private $id;
	private $groupNumber;
	private $repositoryURL;

	private Database $db;

	public function __construct()
	{
		$this->db = $this->db ?? new Database();
	}

	/**
	 * saveToDB saves the group object in the db and returns the new id
	 *
	 * @return boolean
	 */
	public function saveToDB(): int
	{
		$dbCon = $this->db->getConnection();
		// check if we have the info we need
		if (empty($this->groupNumber) || empty($this->repositoryURL)) {
			// log error
			echo 'Number AND Repository URL cannot be blank';
			throw new \Exception('Number AND Repository URL cannot be blank');
		}

		// escape our values so we don't get hacked
		$num = $dbCon->real_escape_string($this->groupNumber);
		$repositoryURL = $dbCon->real_escape_string(urlencode($this->repositoryURL));

		// check for duplicate
		$check = $this->findGroupByNumber();
		if ($check) {
			return $check->getID();
		}

		$sql = "INSERT INTO `Groups` (groupNumber, repositoryURL) VALUES ($num, '$repositoryURL')";
		// false on fail true on success
		$result = $dbCon->query($sql);

		if (!$result) {
			echo $dbCon->error . ', error number: ' . $dbCon->errno;
			return false;
		}

		$newID = $dbCon->insert_id;
		return $newID;
	}

	/**
	 * listGroups returns an array of all groups
	 *
	 * @return array|bool
	 */
	public static function listGroups(): array
	{
		$db = new Database();
		$dbCon = $db->getConnection();

		$sql = 'SELECT * FROM `Groups` ORDER BY groupNumber ASC';
		$groups = $dbCon->query($sql);

		if (!$groups) {
			echo 'Error retrieving groups: ' . $dbCon->error . ', (' . $dbCon->errno . ')';
		}

		$retArray = array();
		while ($row = $groups->fetch_assoc()) {
			$group = new Group();
			$group->id = $row['id'];
			$group->groupNumber = $row['groupNumber'];
			$group->repositoryURL = $row['repositoryURL'];
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
		$dbCon = $this->db->getConnection();
		$sql = "SELECT COUNT(*) AS count FROM Students WHERE groupID = $this->id";
		$count = $dbCon->query($sql);

		if ($count !== false) {
			return $count->fetch_array(\MYSQLI_ASSOC)['count'];
		}

		return 0;
	}

	public static function findGroupByID($id): Group
	{
		$db = new Database();
		$dbCon = $db->getConnection();
		$sql = "SELECT * FROM `Groups` WHERE id = $id";
		$group = $dbCon->query($sql);

		if (!$group) {
			if ($dbCon->error) {
				throw new \Exception($dbCon->error);
			}
			return $group;
		}

		$row = $group->fetch_assoc();
		$retGroup = new Group();
		$retGroup->id = $row['id'];
		$retGroup->groupNumber = $row['groupNumber'];
		$retGroup->repositoryURL = $row['repositoryURL'];

		return $retGroup;
	}

	public function findGroupByNumber()
	{
		$dbCon = $this->db->getConnection();
		$sql = "SELECT * FROM `Groups` WHERE groupNumber = " . $dbCon->real_escape_string($this->getGroupNumber());
		$group = $dbCon->query($sql);

		if (!$group) {
			if ($dbCon->error) {
				throw new \Exception($dbCon->error);
			}
			return $group;
		}

		$row = $group->fetch_assoc();
		$retGroup = new Group();
		$retGroup->id = $row['id'];
		$retGroup->groupNumber = $row['groupNumber'];
		$retGroup->repositoryURL = $row['repositoryURL'];

		return $retGroup;
	}

	public function __set($name, $value)
	{
		// cannot change an id that's already set
		if ($name === 'id' && $this->id !== null) {
			throw new \InvalidArgumentException("id of group object cannot be modified");
		}

		// TODO log changes
		// otherwise, go for it
		$this->$name = $value;
	}

	public function getID(): int
	{
		return $this->id;
	}

	public function getGroupNumber(): int
	{
		return $this->groupNumber ?? 0;
	}

	public function getRepositoryURL(): string
	{
		return urldecode($this->repositoryURL) ?? '';
	}

	public function jsonSerialize()
	{
		return [
			'id' => $this->getID(),
			'group_number' => $this->getGroupNumber(),
			'repo_url' => $this->getRepositoryURL(),
		];
	}
}
