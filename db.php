<?php
require_once('config_db.php');
class SQL {
	private $mysqliconn;
	private $tblprfx;
	function __construct($hostname, $username, $password, $tableprefix) {
		$this->mysqliconn = new mysqli($hostname, $username, $password);
		$this->mysqliconn->set_charset('utf8mb4');
		date_default_timezone_set('UTC');
		$this->tblprfx = $tableprefix;
	}
	function select_db($dbname) {
		$this->mysqliconn->select_db($dbname);
	}
	function query($qstring) {
		return $this->mysqliconn->query($qstring);
	}
	function num_rows($result) {
		return $result->num_rows;
	}
	function fetch_assoc($result) {
		return $result->fetch_assoc();
	}
	function error() {
		return $this->mysqliconn->error;
	}
	function get_table_prefix() {
		return $this->tblprfx;
	}
	function real_escape_string($string) {
		return $this->mysqliconn->real_escape_string($string); 
	}
}
$sql = new SQL($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_tableprefix']);
$sql->select_db($config['db_db']);
?>
