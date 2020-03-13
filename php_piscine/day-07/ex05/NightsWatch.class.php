<?php

class NightsWatch {
	public $army;

	public function recruit($fighter)
	{
		$current = get_class($fighter);
		if($current)
		{
			$this->army[$current] = $fighter;
			if(method_exists($fighter, "fight"))
				$this->army[$current]->fight = true;
			else
				$this->army[$current]->fight = false;
		}
	}

	public function fight()
	{
		foreach($this->army as $fighter)
		{
			if($fighter->fight == true)
				$fighter->fight();
		}
	}
}

?>