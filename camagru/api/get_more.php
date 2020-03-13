<?php
include_once("config/database.php");
include_once("gallery.php");

if(!isset($_POST['count']))
	return;
$result = getAllUsers($handleDb, $_POST['count']);
if($result)
{
	echo json_encode(array("ok" => true));
	printImages_half($result, $handleDb);
}
