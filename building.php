<?php
include "village.php";
$v = new Village($conn);

echo '
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h3 class="modal-title">'.$_REQUEST['building'].'</h3>
  </div>
  <div class="modal-body">';
switch ($_REQUEST['building']) {
  case 'Ratusz':
    $v->showBuildings();
    break;
  case 'Rynek':
    $v->showMarketOrders();
    break;
  case 'Koszary':
    $v->showResidentSquads();
    $v->showNewSquadForm();
    break;
  default:
    echo "Błedny ID budynku.";
    break;
}
echo '
  </div>
  <div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
  </div>';




?>
