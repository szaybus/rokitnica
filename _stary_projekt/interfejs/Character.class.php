<?php
class Character {
	protected $name='';
	protected $hp = 100;
	protected $hpMax = 100;
	protected $armor = 3;
	protected $baseDamage = 5;
	
	
	function ulecz() {
		$this->hp += $this->hpMax * 0.07;
		if($this->hp > $this->hpMax) $this->hp = $this->hpMax;
		echo $this->name.' leczy się.<br>';
	}
	function atak($cel) {
		$cel->obrona($this->baseDamage);
	}
	function obrona($obrazenia) {
		$obrazenia = ($obrazenia - $this->armor);
		$this->hp -= $obrazenia;
		echo '<br>'.$this->name.' otrzymuje '.$obrazenia.' obrażeń.';
		echo '<br>'.$this->name.' ma w tej chwili '.$this->hp.' hp.';
	}
	function jestZywy() {
		if($this->hp <= 0) return false;
		else return true;
	}
}
?>