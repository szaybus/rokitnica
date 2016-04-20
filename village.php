<?php
include "db.php"; 

class Village {
	public $buildings;
	public $resources;
	public $db;
	public $capacity;
	public $foodGain;
	public $woodGain;
	public $ironGain;
	public $clayGain;
	function __construct($_db) {
		$this->db = $_db;
		$this->getBuildingsFromDB();
		$this->getResourcesFromDB();
		$this->capacity = pow(2, $this->buildings[5]['level'])*100;
		$this->foodGain = pow(2, $this->buildings[7]['level']) * 0.1;
		$this->woodGain = pow(2, $this->buildings[10]['level']) * 0.1;
		$this->ironGain = pow(2, $this->buildings[3]['level']) * 0.1;
		$this->clayGain = pow(2, $this->buildings[2]['level']) * 0.1;
		
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
	function setResourcesInDB () {
		$q = "UPDATE village SET
			food = ". $this->resources['food'] .",
			wood = ". $this->resources['wood'] .",
			iron = ". $this->resources['iron'] .",
			clay = ". $this->resources['clay'] ."
			WHERE id_village = 1;";
		$this->db->query($q);
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
			$this->resources['food'] -= $foodReq;
			$this->resources['wood'] -= $woodReq;
			$this->resources['iron'] -= $ironReq;
			$this->resources['clay'] -= $clayReq;
			$this->setResourcesInDB();	
			/*zwiększ level budynku
			$q = "UPDATE building SET
			level = level+1
			WHERE id_building=".$_id;
			$this->db->query($q);*/
			$end = strtotime(date("Y-m-d G:i:s")) + 120;
			$endTimestamp = date("Y-m-d G:i:s", $end);
			$q = "INSERT INTO event_building (event_end, id_building) VALUES ('$endTimestamp', $_id)";
			$this->db($q);
		}
	}
	function resourceGain() {
		$q = "SELECT last_check FROM Village WHERE id_village = 1;";
		$result = $this->db->query($q);
		$row = $result->fetch_assoc();
		//mamy poprzedni refresh w $row['last_check']
		$last_refresh = strtotime($row['last_check']);
		$now = strtotime(date("Y-m-d G:i:s"));
		$delta_time = $now - $last_refresh;
		echo "Czas: ".$delta_time;
		
		$this->resources['food'] += $delta_time * $this->foodGain;
		$this->resources['wood'] += $delta_time * $this->woodGain;
		$this->resources['iron'] += $delta_time * $this->ironGain;
		$this->resources['clay'] += $delta_time * $this->clayGain;
		
		if($this->resources['food'] > $this->capacity) { //przekroczyliśmy magazyn
			$this->resources['food'] = $this->capacity;
		}
		if($this->resources['wood'] > $this->capacity) { //przekroczyliśmy magazyn
			$this->resources['wood'] = $this->capacity;
		}
		if($this->resources['iron'] > $this->capacity) { //przekroczyliśmy magazyn
			$this->resources['iron'] = $this->capacity;
		}
		if($this->resources['clay'] > $this->capacity) { //przekroczyliśmy magazyn
			$this->resources['clay'] = $this->capacity;
		}
		$this->setResourcesInDB();
	}
}
?>