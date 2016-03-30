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
var_dump($wioska);
?>