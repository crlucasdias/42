<?php

if(!isset($_GET['value']))
{
	echo json_encode(array("error" => true));
	return;
}

$file = "list.csv";
$value = $_GET['value'];
$id = uniqid();

$str = (strlen(file_get_contents($file)) > 0 ? PHP_EOL . "id:$id;$value" : "id:$id;$value");
if(file_put_contents($file, $str, FILE_APPEND))
	echo json_encode(array("id" => $id, "value" => $value));
else
	echo json_encode(array("error" => true));