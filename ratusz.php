<?php
include "village.php";
echo '<h1>Ratusz</h1>';
$v = new Village($conn);

$v->showBuildings();


?>