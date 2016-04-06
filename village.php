<?php
include "db.php"; 

class Village {
	public $buildings;
	public $resources;
	public $db;
	function __construct($_db) {
		$this->db = $_db;
		$this->getBuildingsFromDB();
		$this->getResourcesFromDB();
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
		foreach ($this->buildings as $b) {
			echo '<tr>';
			echo '<td>'.$b['name'].'</td>';
			echo '<td>'.$b['type'].'</td>';
			echo '<td>'.$b['level'].'</td>';
			echo '</tr>';
		}
		echo '</table>';
	}
}
?>