<?php
	include("../ex03/ft_split.php");

	function messySort($a1, $a2)
	{
		$size_a = strlen($a1);
		$size_b = strlen($a2);

		if($size_a > $size_b)
			$tam = $size_b;
		else
			$tam = $size_a;
		for($i = 0; $i < $tam; $i++)
		{
			if(!ctype_alpha($a1[$i]) && ctype_alpha($a2[$i]))
				return (1);
			else if(ctype_alpha($a1[$i]) && !ctype_alpha($a2[$i]))
				return (-1);
			else if(ctype_alpha($a1[$i]) && ctype_alpha($a2[$i]))
			{
				$cmp = strcasecmp($a1[$i], $a2[$i]);
				if($cmp > 0)
					return (1);
				else if($cmp < 0)
					return (-1);
			}
			else if(is_numeric($a1[$i]) && is_numeric($a2[$i]))
			{
				if($a1[$i] > $a2[$i])
					return (1);
				else if($a1[$i] < $a2[$i])
					return(-1);
			}
			else if(is_numeric($a1[$i]) && !is_numeric($a2[$i]))
				return(1);
			else if(!is_numeric($a1[$i]) && is_numeric($a2[$i]))
				return(-1);
			else
			{
				$cmp = strcmp($a1[$i], $a2[$i]);
				if($cmp > 0)
					return (1);
				else if($cmp < 0)
					return (-1);
			}
		}
		return (0);
	}


	if($argc > 1)
	{
		$evt = array();
		$str = array();
		$nbr = array();
		$ascii = array();

		for($i = 1; $i < count($argv); $i++)
			array_push($evt, ft_split($argv[$i]));
		$evt = array_reduce($evt, 'array_merge', array());
	
		
		for($i = 0; $i < count($evt); $i++)
		{
			if(ctype_alpha($evt[$i][0]))
				array_push($str, $evt[$i]);
			else if(is_numeric($evt[$i][0]))
				array_push($nbr, $evt[$i]);
			else
				array_push($ascii, $evt[$i]);
		}
	//	var_dump("### Pre sort ###");
	//	var_dump($str);
	//	var_dump($nbr);
	//	var_dump($ascii);
		usort($str, "messySort");
		usort($nbr, "messySort");
		usort($ascii, "messySort");
	//	var_dump("### Pos Sort ###");
	//	var_dump($str);
	//	var_dump($nbr);
	//	var_dump($ascii);
		$result = array_merge($str, $nbr, $ascii);
		for($i = 0; $i < count($result); $i++)
			echo $result[$i] . "\n";
	}
?>