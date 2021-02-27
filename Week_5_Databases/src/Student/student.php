<?php
class Student
{
	protected $nID;
	protected $sLastName;
	protected $sFirstName;
	protected $sEmail;
	protected $sRepoURL;
	protected $nGroupID;

	private $this->db;

	/**
	 * Undocumented function
	 *
	 * @return boolean
	 */
	public function createStudent(): bool
	{
		// check if we have the info we need
		if (empty($group['number']) || empty($group['repositoryURL'])) {
			// log error
			echo 'Number AND Repository URL cannot be blank';
			throw new Exception('Number AND Repository URL cannot be blank');
		}

		// connect to db
		$this->db = $this->db ?? dbConn();
		// escape our values so we don't get hacked
		$num = $this->db->real_escape_string($group['number']);
		$repositoryURL = $this->db->real_escape_string($group['repositoryURL']);

		$sql = "INSERT INTO GROUPS (groupNumber, repositoryURL)
	VALUES ($num, '$repositoryURL')";

		return $this->db->query($sql);
	}

	/**
	 * find Student
	 *
	 * @return Student
	 */
	public function findStudent(): Student{
		$sql = "Select * from students where id=$this->id";
		return $this;
	}

	/**
	 * Find Student by Last Name
	 * @var string $lastName
	 *
	 * @return Student|bool
	 */
	public function findStudentByLastName($lastName): mixed{
		$sql = "Select count(id), id from students where lastName=\'$lastName\'";
		$result = $this->db->query($sql);

		return $this;
	}

	/**
	 * Delete Student
	 *
	 * @return void
	 */
	public function deleteStudent(){}
}
