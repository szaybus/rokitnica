<?php
include "db.php"; 
class Squad 
{
public $db;
public $target;
function __construct($_db) {
		$this->db = $_db;
}
function squadAttack($_id, $target)
{
	//odczytaj stan armii
		$q = "SELECT pikeman,axeman,id_squad,id_village FROM squad WHERE id_squad = ".$_id;
		$result = $this->db->query($q);
		$row = $result->fetch_assoc();
		// ustaw status na moving
			$q = "UPDATE squad SET
 			status = moving 
 			WHERE id_squad = $_id ;";
			$this->db->query($q);
		//utworzenie eventu
		$end = strtotime(date("Y-m-d G:i:s")) + 120;
		$endTimestamp = date("Y-m-d G:i:s", $end);
		$start=$row['id_village'];
		$q = "INSERT INTO event_squad (event_end, id_squad,position_start,position_end) VALUES ('$endTimestamp', $_id,$start, $target)";
			$this->db->query($q);
			echo $q;
}
function squadBack() {
		//pobierz te eventy których czas wykonania już minął
		$q = "SELECT * FROM event_squad WHERE event_end < NOW();";
		$result = $this->db->query($q);
		while($event = $result ->fetch_assoc())
		{
			//zwiększ level budynku
			$q = "UPDATE squad SET
 			id_village = ".$event['position_end']."
 			WHERE id_squad=".$event['id_squad'];
			echo $q;
			$this->db->query($q);
			$q="DELETE FROM event_squad WHERE id_event =" .$event['id_event'];
			$this->db->query($q);
			$this->squadAttack($event['id_squad'],$event['position_start']);
		}
}
}		
?>		