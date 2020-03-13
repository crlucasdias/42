<?php

class Tyrion extends Lannister {

	public function sleepWith($person)
	{
		if($person instanceof Sansa)
			echo "Let's do this." . PHP_EOL;
		else
			echo "Not even if I'm drunk !" . PHP_EOL;	
	}
}

?>