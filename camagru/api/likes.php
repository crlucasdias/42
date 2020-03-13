<?php
include_once("config/database.php");
include_once("HandleDb.php");

if(!isset($_POST['type']) || !isset($_POST['post_id']))
{
	echo json_encode(array("error" => "thats not valid"));
	return;
}

if(!isset($_SESSION['user']))
{
	echo json_encode(array("error" => "only logged users can interact."));
	return;
}

$type = $_POST['type'];
$post_id = $_POST['post_id'];

$conn = new Database($DB_DSN, $DB_USER, $DB_PASSWORD);
$handleDb = new HandleDb($conn->conn);

$sql = "UPDATE post SET $type = $type + 1 WHERE id = $post_id";
$result = $handleDb->updateData($sql);

if(!$result)
	echo json_encode(array("error" => "Theres a error"));
else
	echo json_encode(array("ok" => true));
