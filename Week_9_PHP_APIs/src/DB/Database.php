<?php
namespace WFDWeb;

use mysqli;

class Database extends mysqli
{
	private string $servername;
	private string $username;
	private string $password; // TODO set to get from env vars at some point
	private string $dbName;

	private mysqli $connection;

	public function __construct(string $server = 'localhost', string $user = 'ecc', string $pass = '', string $db = 'ecc_demo')
	{
		$this->servername = $server;
		$this->username = $user;
		$this->password = $pass;
		$this->dbName = $db;

		$this->connection = $this->getConnection();
	}

	public function getConnection(): mysqli
	{
		// Create connection
		$this->connection = $this->connection ?? new mysqli($this->servername, $this->username, $this->password, $this->dbName);

		// Check connection
		if ($this->connection->connect_error) {
			throw new \Exception("Connection failed: " . $this->connection->connect_error);
		}

		return $this->connection;
	}

	public function closeConnection()
	{
		$this->connection->close();
	}
}
