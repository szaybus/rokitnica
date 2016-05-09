<?php
class Hero extends Character {
	protected $name = "Bohater";
	protected $level = 1;
	protected $sila = 3;
	protected $exp = 0;
	
	function __construct() {
		$this->sila = 3 + $this->level;
	}
	
	function atak($cel) {
		$damage = $this->baseDamage + rand(-5, 5) + $this->sila;
		if(rand(1,20) > 18) $damage *= 2; //implementacja crita
		
		$cel->obrona($damage);
		if(!$cel->jestZywy()) $this->gainExp(150);
		
	}
	function gainExp($exp) {
		$this->exp += $exp;
		if($this->exp >= 200) {
			$this->exp -= 200;
			$this->level++;
		}
	}
	
	
	

}



?>