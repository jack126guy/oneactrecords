<?php
require_once('config_db.php');
class OAR_SQL {
	private $mysqliconn;
	private $tblprfx;
	function __construct($hostname, $username, $password, $tableprefix, $charset) {
		$this->mysqliconn = new mysqli($hostname, $username, $password);
		$this->mysqliconn->set_charset($charset);
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
		if(mysqli_connect_error()) {
			return mysqli_connect_error();
		} else {
			return $this->mysqliconn->error;
		}
	}
	function get_table_prefix() {
		return $this->tblprfx;
	}
	function real_escape_string($string) {
		return $this->mysqliconn->real_escape_string($string);
	}
}
$oar_sql = new OAR_SQL($oar_config['db_host'], $oar_config['db_user'], $oar_config['db_pass'], $oar_config['db_tableprefix'], $oar_config['db_charset']);
$oar_sql->select_db($oar_config['db_db']);
?>
