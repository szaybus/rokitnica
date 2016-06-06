<?php
include "db.php";

class Village {
	public $buildings;
	public $resources;
	public $db;
	public $pozX;
	public $poxY;
	public $capacity;
	public $foodGain;
	public $woodGain;
	public $ironGain;
	public $clayGain;
	function __construct($_db) {
		// Konstruktor jest wywoływany każdorazowo kiedy uruchomimy z
		// kodu instrukcję new np.: $v = new Village($conn)
		//
		// Podepnij obiekt bazy danych do zmiennej w obiekcie wioska
		$this->db = $_db;
		// Identyfikator wioski w tabeli village
		$this->id = 1;
		$this->checkEvents();
		$this->getBuildingsFromDB();
		$this->getResourcesFromDB();
		$this->capacity = pow(2, $this->buildings[5]['level'])*100;
		$this->foodGain = pow(2, $this->buildings[7]['level']) * 0.1;
		$this->woodGain = pow(2, $this->buildings[10]['level']) * 0.1;
		$this->ironGain = pow(2, $this->buildings[3]['level']) * 0.1;
		$this->clayGain = pow(2, $this->buildings[2]['level']) * 0.1;
		$this->resourceGain();
		$this->getPositionFromDB();
	}
	function getPositionFromDB() {
		$q = "SELECT pozX, pozY FROM village WHERE id_village = $this->id;";
		$result = $this->db->query($q);
		$row = $result->fetch_assoc();
		$this->pozX = $row['pozX'];
		$this->pozY = $row['pozY'];
	}
	function getBuildingsFromDB() {
		// Pobierz budynki z bazy danych do tablicy
		$q = "SELECT * FROM building WHERE id_village = $this->id;";
		$result = $this->db->query($q);
		// Pobieraj kolejne budynki z tej wioski
		while ($row = $result->fetch_assoc()) {
			// Zapisz do tablicy buildings pod numerkiem zgodnym z type
			$this->buildings[$row['type']] = $row;
		}
	}
	function getResourcesFromDB() {
		// Pobierz ilość surowców z bazy
		$q = "SELECT * FROM village WHERE id_village = $this->id;";
		$result = $this->db->query($q);
		// Spodziewamy się jednego wiersza - brak pętli
		$row = $result->fetch_assoc();
		// Wczytaj do tabeli resources ilość surowców
		$this->resources['wood'] = $row['wood'];
		$this->resources['clay'] = $row['clay'];
		$this->resources['iron'] = $row['iron'];
		$this->resources['food'] = $row['food'];
	}
	function setResourcesInDB () {
		// Zapisz ilość surowców pobraną z obiektu do bazy
		$q = "UPDATE village SET
			food = ". $this->resources['food'] .",
			wood = ". $this->resources['wood'] .",
			iron = ". $this->resources['iron'] .",
			clay = ". $this->resources['clay'] ."
			WHERE id_village = $this->id;";
		$this->db->query($q);
	}
	function showBuildings() {
		//var_dump($this->buildings);
		echo '<table class="table table-hover">';
		echo '<tr><td>Nazwa:</td><td>Poziom:</td><td>Ulepszenia:</td>';
		foreach ($this->buildings as $b) {
			echo '<tr>';
			echo '<td>'.$b['name'].'</td>';
			echo '<td>'.$b['level'].'</td>';
			//sprawdz czy mozemy ulepszyć
			$foodReq = $b['level']*0;
			$woodReq = $b['level']*100;
			$ironReq = $b['level']*50;
			$clayReq = $b['level']*50;
			if($this->resources['food'] > $foodReq && $this->resources['wood'] > $woodReq
			&& $this->resources['iron'] > $ironReq && $this->resources['clay'] > $clayReq) {
			echo '<td><button id="'.$b['id_building'].'"
						onclick="upgradeBuilding('.$b['id_building'].')">Ulepsz</button></td>';}
			else { echo '<td>Brak surowców</td>'; }
			echo '</tr>';
		}
		echo '</table>';
	}
	function showMarketOrders() {
		$q = "SELECT * FROM  `market`
					LEFT JOIN user ON market.owner = user.id_user";
		$result = $this->db->query($q);
		echo '<table class="table table-hover">';
		echo '<tr><td>Oferta od:</td><td>Jedzenie:</td><td>Drewno:</td>
					<td>Żelazo:</td><td>Glina:</td><td></td>';
		while($row = $result->fetch_assoc()) {
			echo '<tr>';
			echo '<td>'.$row['name'].'</td>';
			echo '<td>'.$row['food'].'</td>';
			echo '<td>'.$row['wood'].'</td>';
			echo '<td>'.$row['iron'].'</td>';
			echo '<td>'.$row['clay'].'</td>';
			echo '<td><button onclick="acceptMarketOrder('.$row['id_order'].')">Wymień</button></td>';
			echo '</tr>';
		}
		echo '</table>';
	}
	function acceptMarketOrder($_id) {
		$this->getResourcesFromDB();
		$q = "SELECT * FROM market
					LEFT JOIN user ON market.owner = user.id_user
					WHERE id_order = $_id";
		$result = $this->db->query($q);
		if($result->num_rows == 1) {
			$row = $result->fetch_assoc();
			$this->resources['food'] += $row['food'];
			$this->resources['wood'] += $row['wood'];
			$this->resources['iron'] += $row['iron'];
			$this->resources['clay'] += $row['clay'];
			$q = "DELETE FROM market WHERE id_order = $_id";
			$this->db->query($q);
			$this->setResourcesInDB();
		}
	}
	function showResidentSquads() {
		$q = "SELECT * FROM squad
					LEFT JOIN user ON squad.id_user = user.id_user
					WHERE id_village = $this->id";
		$result = $this->db->query($q);
		echo '<h4>Oddziały obecne w mieście:</h4>';
		echo '<table class="table table-hover">';
		echo '<tr><td>Właściciel:</td><td>Stan:</td>
					<td>Pikinierzy:</td><td>Topornicy:</td>';
		while($row = $result->fetch_assoc()) {
			echo '<tr>';
			echo '<td>'.$row['name'].'</td><td>'.$row['status'].'</td>
						<td>'.$row['pikeman'].'</td><td>'.$row['axeman'].'</td>';
			echo '</tr>';
		}
		echo '</table>';
	}
	function showNewSquadForm() {
		echo '<h4>Rekrutuj nowy oddział</h4>
					<div class="row">
					<label for="pikeman" class="col-sm-6 control-label">Pikinierzy</label>
					<div class="col-sm-2">
					<input class="form-control" type="number" id="pikeman" value="0">
					</div></div>
					<div class="row">
					<label for="axeman" class="col-sm-6 control-label">Topornicy</label>
					<div class="col-sm-2">
					<input class="form-control" type="number" id="axeman" value="0">
					</div></div>
					<div class="row">
					<button class="col-sm-6 col-sm-offset-3" onclick="recruitNewSquad()">Rekrutuj</button>
					</div>';
	}
	function recruitNewSquad($_pikeman, $_axeman) {
		$q = "INSERT INTO squad (id_user, id_village, status, pikeman, axeman)
					VALUES (1, $this->id, 'training', $_pikeman, $_axeman)";
		$this->db->query($q);
	}
	function upgradeBuilding($_id) {
		//odczytaj stan budynku
		$q = "SELECT * from building WHERE id_building = $_id;";
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
			$end = strtotime(date("Y-m-d G:i:s")) + 120;
			$endTimestamp = date("Y-m-d G:i:s", $end);
			$q = "INSERT INTO event_building (event_end, id_building) VALUES ('$endTimestamp', $_id)";
			$this->db->query($q);
		}
	}
	function resourceGain() {
		// Pobierz timestamp ostatniego odświeżenia strony
		$q = "SELECT last_check FROM village WHERE id_village = $this->id;";
		$result = $this->db->query($q);
		// Spodziewamy się jednego wiersza więc zamieniamy na tablicę
		// asocjacyjną bez pętli
		$row = $result->fetch_assoc();
		// Zamieniamy timestamp na ilość sekund od 01-01-1970 do last_check
		$last_refresh = strtotime($row['last_check']);
		// Wstawiamy do $now ilość sekund od 01-01-1970 do teraz
		$now = strtotime(date("Y-m-d G:i:s"));
		// Obliczamy różnicę czasu w sekundach
		$delta_time = $now - $last_refresh;
		// Zwiększamy surowce mnożąc wcześniej wyliczony zysk przez ilość sekund
		// KOD SKRAJNIE BRZYDKI - DO WYMIANY
		$this->resources['food'] += $delta_time * $this->foodGain;
		$this->resources['wood'] += $delta_time * $this->woodGain;
		$this->resources['iron'] += $delta_time * $this->ironGain;
		$this->resources['clay'] += $delta_time * $this->clayGain;
		// Przechodzimy przez tablicę z surowcami.
		// $key będzie odpowiednio równy food/wood/iron/clay
		// $value będzie równy ilości surowców w tabeli
		foreach ($this->resources as $key => $value) {
			if($value > $this->capacity) {
				$this->resources[$key] = $this->capacity;
			}
		}
		// Zapisujemy przeliczone surowce do bazy danych
		$this->setResourcesInDB();
	}
	function checkEvents() {
		//pobierz te eventy których czas wykonania już minął
		$q = "SELECT * FROM event_building WHERE event_end < NOW();";
		$result = $this->db->query($q);
		while($event = $result->fetch_assoc()) {
			/*zwiększ level budynku*/
			$q = "UPDATE building SET
			level = level+1
			WHERE id_building=".$event['id_building'];
			$this->db->query($q);
			$q = "DELETE FROM event_building WHERE id_event = ".$event['id_event'];
			$this->db->query($q);
		}
	}
}
?>
