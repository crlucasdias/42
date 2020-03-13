<?php

if(!isset($_GET['id']))
{
	echo json_encode(array("error" => true));
	return;
}

$id = $_GET['id'];

$content = file_get_contents("list.csv");
$str_to_find = "id:" . $id;
if(strpos($content, $str_to_find) !== false)
{
	$counter = 0;
	$newCsv = "";
	$content = explode(PHP_EOL, $content);
	foreach($content as $key => $c)
	{
		if(strpos($c, $str_to_find) === false)
		{
			if($counter > 0)
				$c = PHP_EOL . $c;
			$newCsv .= $c;
			$counter++;
		}
	}
	if(file_put_contents("list.csv", $newCsv) === false);
		echo json_encode(array("error" => false));
}
else
	echo json_encode(array("error" => true));
?>