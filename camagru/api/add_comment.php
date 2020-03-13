<?php

include_once("config/database.php");
include_once("HandleDb.php");
include_once("Email.php");

if(!isset($_POST['post_id']) || !isset($_POST['comment']))
{
	echo json_encode(array("error" => "thats not valid"));
	return;
}

if(!isset($_SESSION['user']))
{
	echo json_encode(array("error" => "only logged users can post"));
	return;
}

$post_id = $_POST['post_id'];
$comment = $_POST['comment'];
$data = array("post_id" => $post_id, "comment" => $comment, "user_id" => $_SESSION['user']['id']);

$conn = new Database($DB_DSN, $DB_USER, $DB_PASSWORD);
$handleDb = new HandleDb($conn->conn);

$result = $handleDb->insertData("comment", array("post_id", "comment", "user_id"), $data);
if($result === 1)
{
	$email = new Email();
	$sql = "SELECT user.email, user.notifications FROM user INNER JOIN post ON post.user_id = user.id WHERE post.id = $post_id";
	$user_email = $handleDb->selectData($sql)[0];
	if($user_email['notifications'] == 1)
		$email->newComment($user_email['email']);
	echo json_encode(array("ok" => true, "author" => $_SESSION['user']['name']));
}
else
	echo json_encode(array("error" => "something went wrong"));
