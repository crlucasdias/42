<?php

	$counter = 1;
	$tam = count($argv);
	while($counter < $tam)
	{
		echo $argv[$counter] . "\n";
		$counter++;
	}

?>