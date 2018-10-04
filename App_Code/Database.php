<?php
session_start();
class Database{
/**
* Connect to the mysql database.
*/
	private $conn;
	public function Database(){
		/*
		$dbhost = 'localhost';
		$dbuser = 'votingdb';
		$dbpass = 'votingdb!@#';
		$dbname = 'votingdb';
				*/
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'voting';

		$this->conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname) or die("Connection Error");
	}

	public function GetConn(){
		return $this->conn;
	}
}
class UserLogged{
	private $directory = "logout.php";

	public function UserLogged($value='')
	{
		$this->directory = $value . $this->directory;
	}

	public function IsLogged(){
		$pass = 0;
		if(isset($_SESSION['uid'])){
			if($_SESSION['uid'] != ""){
				$pass++;
			}
		}
		if ($pass < 1) {
			header('Location: '.$directory);
			exit;
		}
	}
}
?>
