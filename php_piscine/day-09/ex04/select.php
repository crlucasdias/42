<?php

$content = file_get_contents("list.csv");

if(!$content)
{
	echo json_encode(array("error" => true));
	return;
}

$content = explode("\n", $content);
$elements = array();
foreach($content as $key => $c)
{
	$current = explode(";", $c, 2);
	if(isset($current[1]))
	{
		$elements[$key]["id"] = str_replace("id:","", $current[0]);
		$elements[$key]["value"] = $current[1];
	}
}

if(count($elements) > 0)
	echo json_encode($elements);
else
	echo json_encode(array("error" => true));
?>