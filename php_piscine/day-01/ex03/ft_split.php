<?php

	function ft_split($str)
	{
		$str = trim($str);
		$str = explode(" ",preg_replace("/\s+/", " ", $str));
		sort($str);

		return $str;
	}
?>