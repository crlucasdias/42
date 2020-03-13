<?php

if($argc > 1)
{
	$str = trim(preg_replace("/\s+/", " ", $argv[1]));
	$pos = strpos($str, " ");
	if(!$pos)
		echo $str;
	else
	{
		$firstWord = substr($str, 0, $pos);
		$str = str_replace($firstWord . " ", "", $str);
		$str = $str . " " . $firstWord;
		echo $str . "\n";
	}		
}