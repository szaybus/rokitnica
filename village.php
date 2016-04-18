<?php
include "db.php"; 

class Village {
	public $buildings;
	public $resources;
	public $db;
	public $capacity;
	function __construct($_db) {
		$this->db = $_db;
		$this->getBuildingsFromDB();
		$this->getResourcesFromDB();
		$this->capacity = pow(2, $this->buildings[5]['level'])*100;
	}
	function getBuildingsFromDB() {
		$result = $this->db->query("SELECT * FROM `building`;"); //pobierz wszystkie budynki z tabeli building
		for($i = 1; $i <= $result->num_rows; $i++) {
			$wiersz = $result->fetch_assoc();
			$this->buildings[$wiersz['type']] = $wiersz;
		}
	}
	function getResourcesFromDB() {
		$result = $this->db->query("SELECT * FROM `village` WHERE id_village = 1");
		$wiersz = $result->fetch_assoc();
		$this->resources['wood'] = $wiersz['wood'];
		$this->resources['clay'] = $wiersz['clay'];
		$this->resources['iron'] = $wiersz['iron'];
		$this->resources['food'] = $wiersz['food'];
	}
	function showBuildings() {
		//var_dump($this->buildings);
		echo '<table class="table">';
		echo '<tr><td>nazwa</td><td>typ</td><td>level</td><td>ulepsz</td>';
		foreach ($this->buildings as $b) {
			echo '<tr>';
			echo '<td>'.$b['name'].'</td>';
			echo '<td>'.$b['type'].'</td>';
			echo '<td>'.$b['level'].'</td>';
			//sprawdz czy mozemy ulepszyć
			$foodReq = $b['level']*0;
			$woodReq = $b['level']*100;
			$ironReq = $b['level']*50;
			$clayReq = $b['level']*50;
			if($this->resources['food'] > $foodReq && $this->resources['wood'] > $woodReq
			&& $this->resources['iron'] > $ironReq && $this->resources['clay'] > $clayReq) {
			echo '<td><a href="index.php?ulepszBudynekId='.$b['id_building'].'">Ulepsz</a></td>'; }
			else { echo '<td>Brak surowców</td>'; }
			echo '</tr>';
		}
		echo '</table>';
	}
	function upgradeBuilding($_id) {
		//odczytaj stan budynku
		$q = "SELECT * from building WHERE id_building = ".$_id;
		$result = $this->db->query($q);
		$row = $result->fetch_assoc();
		$foodReq = $row['level']*0;
		$woodReq = $row['level']*100;
		$ironReq = $row['level']*50;
		$clayReq = $row['level']*50;
		if($this->resources['food'] > $foodReq && $this->resources['wood'] > $woodReq
		&& $this->resources['iron'] > $ironReq && $this->resources['clay'] > $clayReq) {
			//zdejmij surowce ze stanu
			$q = "UPDATE village SET
			food = food-". $foodReq .",
			wood = wood-". $woodReq .",
			iron = iron-". $ironReq .",
			clay = clay-". $clayReq .";";
			$this->db->query($q);	
			//zwiększ level budynku
			$q = "UPDATE building SET
			level = level+1
			WHERE id_building=".$_id;
			$this->db->query($q);
		}
		
	}
}
?>