<?php
	include("../ex03/ft_split.php");
	if($argc > 1)
	{
		$str = array();
		for($i = 1; $i < count($argv); $i++)
			array_push($str, ft_split($argv[$i]));
		$str = array_reduce($str, 'array_merge', array());
		sort($str, SORT_NATURAL);
		for($i = 0; $i < count($str); $i++)
			echo $str[$i] . "\n";
	}
?>