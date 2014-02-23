<?php
class MySQL {

	private $hostname;
	private $username;
	private $password;
	private $dbname;	
	private $mysqli;

	public function __construct($_hostname, $_username, $_password, $_dbname, $_isUTF8) {
		$this->mysqli = new mysqli($_hostname, $_username, $_password, $_dbname);
		if ($this->mysqli->connect_errno) {
			die($this->mysqli->connect_error);
		}
		$this->hostname = $_hostname;
		$this->username = $_username;
		$this->password = $_password;
		$this->dbname = $_dbname;
		if( $_isUTF8 ) $this->mysqli->query('set names utf8');
	}

	public function __destruct() { $this->mysqli->close(); }

	public function query($que) { return $this->mysqli->query($que); }
	public function fetch($result) { return $result->fetch_array(MYSQLI_ASSOC); }
	public function free($result) { $result->free(); }
	public function getInsertID() { return $this->mysqli->insert_id; }
}
?>