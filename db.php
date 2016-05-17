
<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "rokitnica";
if (file_exists('./config.local.php'))
  include('./config.local.php');
// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
$conn->set_charset("utf8");
?>
