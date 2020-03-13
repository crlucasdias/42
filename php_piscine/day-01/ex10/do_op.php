<?php


if($argc != 4)
	echo "Incorrect Parameters";
else
{
	$nbr1 = floatval($argv[1]);
	$nbr2 = floatval($argv[3]);
	$op = trim(preg_replace("/\s+/", " ", $argv[2]));
	if($op == "+")
		echo $nbr1 + $nbr2;
	else if($op == "-")
		echo $nbr1 - $nbr2;
	else if($op == "*")
		echo $nbr1 * $nbr2;
	else if($op == "/")
		echo $nbr1 / $nbr2;
	else if($op == "%")
		echo $nbr1 % $nbr2;
}