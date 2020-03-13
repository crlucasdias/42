<?php

class Lannister {

	protected $brother;

	public function __construct()
	{
		$this->brother = get_class($this);
	}
}

?>