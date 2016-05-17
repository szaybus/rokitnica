<?php include "db.php";
	include "village.php";
	include "squad.php";
$v = new Village($conn);

if(isset($_REQUEST['ulepszBudynekId'])) {
	$v->upgradeBuilding($_REQUEST['ulepszBudynekId']);
}
$v->resourceGain();
$s= new Squad ($conn);
//$s->squadAttack(1,3);
//$s->squadBack();
	?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Rokitnica</title>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/rokitnica.js"></script>
    <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body onload="rescaleImageMap()">
    <nav class="navbar navbar-default">
		<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Brand</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
					<li><a href="#">Link</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="#">Separated link</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="#">One more separated link</a></li>
						</ul>
					</li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">Wyloguj</a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
  	<div class="modal-dialog">
    <!-- Modal content-->
    	<div class="modal-content">
    	</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-9">
				<img src="img/village_full.jpg" class="col-sm-12" usemap="#wioska" id="villageBackground" style="padding:0px;">
				<map name="wioska">
					<area class="map-area" shape="rect" coords="410,110,525,230" href="#" id="Ratusz" alt="Ratusz">
					<area class="map-area" shape="rect" coords="535,305,625,380" href="#" id="Koszary" alt="Koszary">
					<area class="map-area" shape="poly" coords="630,500,700,440,750,490,685,550" href="#" id="Tartak" alt="Tartak">
					<area class="map-area" shape="poly" coords="0,420,90,420,195,500,100,600,0,600" href="#" id="Cegielnia" alt="Cegielnia">
					<area class="map-area" shape="poly" coords="295,215,370,185,435,265,410,315,310,305" href="#" id="Rynek" alt="Rynek">
				</map>
			</div>
			<div class="col-md-3">
			<h3> Surowce/Wojsko </h3>
			<table class="table">
			<tr><th>Nazwa surowca</th><th>Ilosc</th><th>Przyrost /min</th></tr>
			<tr><td>Jedzenie</td><td><?php echo floor($v->resources['food']).' / '.$v->capacity; ?></td>
				<td><?php echo $v->foodGain*60; ?></td></tr>
			<tr><td>Drewno</td><td><?php echo floor($v->resources['wood']).' / '.$v->capacity; ?></td>
				<td><?php echo $v->woodGain*60; ?></td></tr>
			<tr><td>Zelazo</td><td><?php echo floor($v->resources['iron']).' / '.$v->capacity; ?></td>
				<td><?php echo $v->ironGain*60; ?></td></tr>
			<tr><td>Glina</td><td><?php echo floor($v->resources['clay']).' / '.$v->capacity; ?></td>
				<td><?php echo $v->clayGain*60; ?></td></tr>
			<tr><th>Jednostka</th><th>Liczebnosc</th><th>Morale</th></tr>
			<tr><td>Pikinierzy</td><td>115/1000</td><td>20</td></tr>
			<tr><td>Topornicy</td><td>115/1000</td><td>20</td></tr>
			</table>
			</div>

			<!--
				<div class="col-md-4"> Drewno </div>
				<div class="col-md-4"> Ilość</div>
				<div class="col-md-4"> Ilość/min</div>
				<div class="col-md-4"> Żelazo </div>
				<div class="col-md-4"> Ilość</div>
				<div class="col-md-4"> Ilość/min</div>
				<div class="col-md-4"> Cegły </div>
				<div class="col-md-4"> Ilość</div>
				<div class="col-md-4"> Ilość/min</div>
				<div class="col-md-4"> Żywność </div>
				<div class="col-md-4"> Ilość</div>
				<div class="col-md-4"> Ilość/min</div>
			<h3 style="padding-top: 100px;"> Wojsko </h3>
				<div class="col-md-8"> Łucznicy </div>
				<div class="col-md-4"> Ilość </div> -->
			</div>

	</div>

	</div>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
