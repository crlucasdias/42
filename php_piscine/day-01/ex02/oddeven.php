<?php

$stdin = fopen('php://stdin', 'r');

while(1)
{
	echo "Enter a number: ";
	$n = trim(fgets($stdin));	
	if(!is_numeric($n))
		echo "'$n' is not a number\n";
	else if($n % 2 == 0)
		echo "The number $n is even\n";
	else
		echo "The number $n is odd\n";
}