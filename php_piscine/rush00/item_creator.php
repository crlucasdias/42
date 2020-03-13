<?php

$items[] = array('id' => 0, 'item'=>'thing1', 'price'=>10, 'cat1'=>'', 'cat2'=>'', 'cat3'=>'yes');
$items[] = array('id' => 1, 'item'=>'thing2', 'price'=>10, 'cat1'=>'yes', 'cat2'=>'yes', 'cat3'=>'');
$items[] = array('id' => 2, 'item'=>'thing3', 'price'=>10, 'cat1'=>'yes', 'cat2'=>'yes', 'cat3'=>'yes');
$items[] = array('id' => 3, 'item'=>'thing4', 'price'=>10, 'cat1'=>'', 'cat2'=>'yes', 'cat3'=>'yes');

if(!file_exists('./private'))
	mkdir('./private');
file_put_contents('./private/items', serialize($items));

header("Location: http://localhost:". $_SERVER['SERVER_PORT'] . "/index.php");
die();
?>