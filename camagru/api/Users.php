<?php
include_once("HandleDb.php");

class User {

	public $pdo;
	private $handleDb;

	public function __construct($pdo)
	{
		$this->pdo = $pdo;
		$this->handleDb = new HandleDb($pdo);
	}
	
	public function getToUpdateInfo($data)
	{
		$toUpdate = array();
		if(isset($data->password))
		{
			$newPassword = md5($data->password);
			$oldPassword = md5($data->currentPassword);
		}	
		if($_SESSION['user']['name'] != $data->name)
			$toUpdate['name'] = $data->name;
		if($_SESSION['user']['email'] != $data->email) {
			$result = $this->handleDb->selectData("SELECT * from user WHERE email = '" . $data->email . "'");
			if(!$result)
				$toUpdate['email'] = $data->email;
		}
		if($_SESSION['user']['notifications'] != $data->notifications)
		{
			if($data->notifications)
				$toUpdate['notifications'] = 1;
			else
				$toUpdate['notifications'] = 0;
		}
		if(isset($oldPassword) && $_SESSION['user']['password'] == $oldPassword)
			$toUpdate['password'] = $newPassword;
		return ($toUpdate);
	}

	public function updateInfo($data)
	{
		$sql = "UPDATE user SET";
		$toSet = "";
		if(!empty($data))
		{
			foreach ($data as $key => $value) {
				$toSet.= " $key = '" . $value . "' ,";
			}
			$sql .= rtrim($toSet,',');
			$sql .= "WHERE id = " . $_SESSION['user']['id'];
			$result = $this->handleDb->updateData($sql);
			if(!$result)
				echo json_encode(array("error" => "Theres a error"));
			else {
				$this->userToSession();
				echo json_encode(array("ok" => true));
			}
		}
		else
		{
			echo json_encode(array("error" => "no changes was made"));
		}
	}

	private function userToSession()
	{
		$sql = "SELECT * from user WHERE id = " . $_SESSION['user']['id'];
		$result = $this->handleDb->selectData($sql);
		unset($_SESSION['user']);
		if(isset($result))
			$_SESSION['user'] = $result[0];
	}
}

