<?php
class Goblin extends Character{
	protected $name = "Goblin";
	protected $hpMax = 20;
	protected $armor = 1;
	
	function atak($cel) {
		$cel->obrona($this->baseDamage);
	}


	
}



?>