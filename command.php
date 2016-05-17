<?php
if (isset($_REQUEST['buildingID'])) {
  include 'village.php';
  $v = new Village($conn);
  $v->upgradeBuilding($_REQUEST['buildingID']);
}
if (isset($_REQUEST['orderID'])) {
  include 'village.php';
  $v = new Village($conn);
  $v->acceptMarketOrder($_REQUEST['orderID']);
}
if (isset($_REQUEST['pikeman']) && isset($_REQUEST['axeman'])) {
  $v = new Village($conn);
  $v->recruitNewSquad($_REQUEST['pikeman'], $_REQUEST['axeman']);
}
?>
