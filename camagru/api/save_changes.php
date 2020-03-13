<?php
	include_once("session.php");
	include_once("config/database.php");
	include_once("Users.php");

	$data = $_POST['data'];
	if(!isset($data))
	{
		echo json_encode(array("error" => "Something went wrong"));
		return;
	}
	$data = json_decode($data);
	$conn = new Database($DB_DSN, $DB_USER, $DB_PASSWORD);
	$user = new User($conn->conn);
	$user->updateInfo($user->getToUpdateInfo($data));
?>