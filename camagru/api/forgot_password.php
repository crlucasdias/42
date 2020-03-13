<?php

include_once("config/database.php");
include_once("HandleDb.php");
include_once("Email.php");

$conn = new Database($DB_DSN, $DB_USER, $DB_PASSWORD);
$handleDb = new HandleDb($conn->conn);

if(isset($_POST['email']))
{
	$email = $_POST['email'];
	$sql = "SELECT token, email from user WHERE email = '" . $email . "'";
	$result = $handleDb->selectData($sql)[0];
	if($result)
	{
		$email = new Email();
		if($email->forgotPassword($result['email'], $result['token']))
			echo json_encode(array("ok" =>true));
		else
			echo json_encode(array("error" => "Something went wrong"));
	}
	else
		echo json_encode(array("error" => "Email not found"));
}
else
	echo json_encode(array("error" => "Something went wrong"));