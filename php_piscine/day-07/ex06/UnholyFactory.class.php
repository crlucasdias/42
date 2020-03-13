<?php

class UnholyFactory {
	public $army;

	private function showMessage($msg)
	{
		echo $msg . PHP_EOL;
	}

	public function absorb($fighter)
	{
		if(!isset($fighter->fighter_type))
			$this->showMessage("(Factory can't absorb this, it's not a fighter)");
		else if(!$this->isAlreayAbsorbed($fighter))
		{
			if(!$fighter->fighter_type)
				return;
			$name = get_class($fighter);
			$this->army[$name] = $fighter;
			$this->army[$name]->fighter_type = $fighter->fighter_type;
			$this->showMessage("(Factory absorbed a fighter of type {$fighter->fighter_type})");
		}
		else
			$this->showMessage("(Factory already absorbed a fighter of type {$fighter->fighter_type})");

	}

	public function isAlreayAbsorbed ($currentFighter)
	{
		if(!empty($this->army))
		{
			foreach($this->army as $key => $fighter)
			{
				if($currentFighter->fighter_type == $this->army[$key]->fighter_type)
					return(1);
			}
		}
		return(0);
	}

	public function fabricate($f_type)
	{

		if(!empty($this->army))
		{
			foreach($this->army as $key => $fighter)
			{
				if($fighter->fighter_type == $f_type)
				{
					$this->showMessage("(Factory fabricates a fighter of type {$f_type})");
					return $fighter;
				}
			}
		}
		$this->showMessage("(Factory hasn't absorbed any fighter of type {$f_type})");
		return false;
	}
}

?>