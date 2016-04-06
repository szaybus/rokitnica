<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "rokitnica";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";
$wioska = $conn->query("SELECT * FROM `village` WHERE id_village = 1");
$wioska = $wioska->fetch_assoc();

$budynki = $conn->query("SELECT * FROM `building` WHERE type = 5");
$spichlerz = $budynki->fetch_assoc();

$budynki = $conn->query("SELECT * FROM `building` WHERE type = 7");
$zagroda = $budynki->fetch_assoc();

?>