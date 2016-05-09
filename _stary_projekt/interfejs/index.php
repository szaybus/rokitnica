<?php 
include 'Character.class.php';
include 'Hero.class.php';
include 'Goblin.class.php';
session_start(); 

//jeżeli w sesji nie jest zapisana pozycja gracza
if(!isset($_SESSION['pozX']) && !isset($_SESSION['pozY'])) {
	//uwstaw ją na zero
	$_SESSION['pozX'] = 0;
	$_SESSION['pozY'] = 0;
}
//nie robimy else bo albo zczyta obecna pozycje albo nowo 
//ustawione zera
$pozX = $_SESSION['pozX'];
$pozY = $_SESSION['pozY'];
//przygotuj zmienną przechowującą mapę
$mapa = Array();
//jeżeli nie istnieje w sesji zmienna mapa
if(!isset($_SESSION['mapa'])) {
	//to ja stworz i wygeneruj losowo
	
	for($i = -10; $i<10; $i++) {
		for($j = -10; $j<10; $j++) {
			$mapa[$i][$j] = rand(0, 9);
		}
	}
	//zapisz wygenerowaną mapę do sesji
	$_SESSION['mapa'] = $mapa;
}
//jeśli istnieje to wczytaj z sesji do zmiennej lokalnej
else $mapa = $_SESSION['mapa'];
//przypisz komendy z sesji

//var_dump($mapa);
//tabela odwołań do typów terenu
$teren = Array("Woda", "Góry", "Las", "Łąka", "Bagno", 
				"Pustynia", "Pole", "Tundra", "Lodowiec", "Jaskinie");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
 
<body>
<div style="width: 300px; height: 300px;" id="interface">
<div style="width: 33%; float: left;"> . </div>
<div style="width: 33%; float: left;"> 
	<a href="index.php?ruch=polnoc">Północ</a>
</div>
<div style="width: 33%; float: left;"> . </div>
<div style="width: 33%; float: left;"> 
	<a href="index.php?ruch=zachod">Zachód</a>
</div>
<div style="width: 33%; float: left;"> . </div>
<div style="width: 33%; float: left;"> 
	<a href="index.php?ruch=wschod">Wschód</a>
</div>
<div style="width: 33%; float: left;"> . </div>
<div style="width: 33%; float: left;"> 
	<a href="index.php?ruch=poludnie">Południe</a>
</div>
<div style="width: 33%; float: left;"> . </div>
</div>
<!-- podgląd mapy -->
<div id="podglad" style="width: 500px; height: 500px;">
	<?php
		for($i=$pozY-2; $i<$pozY+3; $i++) {
			for($j=$pozX-2; $j<$pozX+3; $j++) {
				if(isset($mapa[$i][$j]))
				echo '<div style="width: 20%;float: left;">'.$teren[$mapa[$i][$j]].'</div>';
				else echo '<div style="width: 20%;float: left;"> nic </div>';
			}
		}
	?>
	
	
</div>
<?php 
//jeżeli wykonano ruch

switch($_REQUEST['ruch']) {
	case "polnoc":
		$_SESSION['pozY']++;
		break;
	case "poludnie":
		$_SESSION['pozY']--;
		break;
	case "wschod":
		$_SESSION['pozX']++;
		break;
	case "zachod":
		$_SESSION['pozX']--;
		break;
	default:
		break;
}
$pozX = $_SESSION['pozX'];
$pozY = $_SESSION['pozY'];
//tu kończy się poprzedni if
//znowu sprawdzamy czy istnieje zmienna ruch
if(isset($_REQUEST['ruch']))
echo "<p> Idziesz na ".$_REQUEST['ruch']."</p>"; 
//wyswietl pozycje gracza
echo "<p> Twoje współrzędne to: ".$pozX." , ".$pozY."</p>";
//Wyświetl typ terenu używając cyfry zapisanej w mapie jako indexu

echo "<p> Typ terenu na którym się znajdujesz to: ".$teren[$mapa[$pozX][$pozY]]."</p>";
if(!isset($_SESSION['bohater'])) { //jeżeli nie ma w sesji bohatera
	$bohater = new Hero(); //stworz nowy obiekt klasy bohater
	$_SESSION['bohater'] = $bohater; } //zapisz go do sesji
else $bohater = $_SESSION['bohater'];//jeśli jest to wczytaj go z sesji
$goblin = new Goblin();

$bohater->ulecz();
$goblin->ulecz();

while($bohater->jestZywy() && $goblin->jestZywy()){
	if($bohater->jestZywy())$bohater->atak($goblin);
	if($goblin->jestZywy())$goblin->atak($bohater);
}

$_SESSION['bohater'] = $bohater;
//var_dump($bohater);
echo "<br><br><br>";
print_r($bohater);
echo "<br>";
print_r($goblin);
//session_destroy();
?>
</body>
</html>