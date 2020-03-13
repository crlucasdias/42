<?php
include_once(dirname(__DIR__, 1) . "/session.php");

class Database {
	public $conn;

	public function __construct($host, $username, $password, $db_name = "camagru")
	{
		$dsn= "mysql:host=$host;";
		if($db_name)
			$dsn .= "dbname=$db_name";
		try {
			$this->conn = new PDO($dsn, "$username", "$password");
			//if($this->conn){
			 	//echo "Connected to the database successfully!";
			//}
		}
		catch (PDOException $e){
		 echo $e->getMessage();
		}
	}
}


/*try{
		 // create a PDO connection with the configuration data
		 $this->$pdo = new PDO($dsn, "$username", "$password");
			if($this->$pdo){
			 	echo "Connected to the database successfully!";
			}
		}
		catch (PDOException $e){
		 echo $e->getMessage();
		}
		*/