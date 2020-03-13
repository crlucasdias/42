<?php
include_once("config/database.php");
include_once("HandleDb.php");
include_once ("gallery.php");

if(!isset($_SESSION['user']))
{
	echo json_encode(array("error" => "user not logged in"));
	return;
}

else if(!isset($_POST['post_id']))
{
	echo json_encode(array("error" => "Sorry, error occur"));
	return;
}

$conn = new Database($DB_DSN, $DB_USER, $DB_PASSWORD);
$handleDb = new HandleDb($conn->conn);

$post = checkUserIdPost($handleDb, $_POST['post_id']);

if($_SESSION['user']['id'] === $post['user_id'])
{
	$post_id = $_POST['post_id'];
	$sql = "DELETE FROM post WHERE id = $post_id";
	$result = $handleDb->deleteData($sql);
	if(!$result)
		echo json_encode(array("error" => "Theres a error"));
	else
		echo json_encode(array("ok" => true));

}
else
	echo json_encode(array("error" => "Sorry, error occur"));