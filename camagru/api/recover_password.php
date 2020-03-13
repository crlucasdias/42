<?php

include_once("config/database.php");
include_once("HandleDb.php");

$conn = new Database($DB_DSN, $DB_USER, $DB_PASSWORD);
$handleDb = new HandleDb($conn->conn);

if(isset($_POST['token']) && isset($_POST['password']))
{
	$token = $_POST['token'];
	$password = $_POST['password'];
	$password = md5($password);
	$sql = "SELECT * from user WHERE token = '" . $token . "'";
	$result = $handleDb->selectData($sql)[0];
	if($result)
	{
		$newToken = bin2hex(random_bytes(64));
		$sql = "UPDATE user SET password = '" . $password . "', token = '" . $newToken . "' WHERE token = '" . $token . "'";
		$result = $handleDb->updateData($sql);
		if($result)
			echo json_encode(array("ok" => "true"));
		else
			echo json_encode(array("error" => "Something went wrong"));
	}
	else
	{
		echo json_encode(array("error" => "Something went wrong"));
	}
}