<?php

function ft_is_sort($arr)
{
	$sorted = array_values($arr);
	sort($sorted);
	if($arr === $sorted)
		return (1);
	else
		return (0);
}
