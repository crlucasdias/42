<?php


function do_op($nbr1, $op, $nbr2)
{
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

function create_op($str)
{
	$opers = array("+","-","*","/","%");
	$oper = array();
	$counter = 0;

	for($i = 0; $i < count($opers); $i++)
	{
		$pos = strpos($str, $opers[$i]);
		if($pos !== false)
		{
			$oper[$counter]["op_pos"] = $pos;
			$oper[$counter]["op"] = $opers[$i];
			$counter++;
		}
	}
	if(count($oper) > 1 || count($oper) == 0)
		displayError("Syntax Error");
	else
	{
		$nbr1 = substr($str, 0, $oper[0]["op_pos"]);
		$nbr2 = substr($str, $oper[0]["op_pos"] + 1);
		if(!is_numeric($nbr1) || !is_numeric($nbr2))
			displayError("Syntax Error");
		else
			do_op(floatval($nbr1), $oper[0]["op"], floatval($nbr2));
	}
}

function displayError($str)
{
	echo $str;
	exit();
}

if($argc != 2)
	displayError("Incorrect Parameters");

create_op(trim(preg_replace("/\s+/", "", $argv[1])));