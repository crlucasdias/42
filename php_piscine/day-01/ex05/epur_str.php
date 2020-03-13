<?php

	if($argc > 1)
	{
		$str = $argv[1];
		$str = preg_replace("/\s+/", " ", $str);
		echo trim($str);
	}

?>