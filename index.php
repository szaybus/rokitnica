<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>
	<script>
	function loadDoc(id_budynku) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      document.getElementById("own-modal").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "dzialanie.php?id="+id_budynku, true);
  xhttp.send();
}
	function openDetails(id_budynku) {
		loadDoc(id_budynku);
		document.getElementById("own-overlay").style.display = "block";
		document.getElementById("own-modal").style.display = "block";
	}
	function closeDetails() {

		document.getElementById("own-overlay").style.display = "none";
		document.getElementById("own-modal").style.display = "none";
	}
	</script>
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
  <body>
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
	
	<div class="container">
		<div class="row">
			<div class="own-overlay" id="own-overlay"></div>
			<div class="own-modal" id="own-modal" onclick="closeDetails()">I'm the modal window!</div>
			<div class="col-md-9" style="background-image: url('img/village_background.png'); background-size:100%">
			<div style="height:100px"></div>
			<div class="row">
			<div class="col-md-2 col-md-offset-4" onclick="openDetails(1)" style="height:100px;"><img src="img/budynki/cegielnia.png" alt="tekst alternatywny" title="Cegielnia" width="60" height="61"></div>
			<div class="col-md-2" onclick="openDetails(2)" style="height:100px;"><img src="img/budynki/ratusz.png" alt="tekst alternatywny" title="Ratusz" width="60" height="61"></div>
			</div>
			<div class="row">
			<div class="col-md-2 col-md-offset-2" style="height:100px;"><img src="img/budynki/stajnia.png" alt="tekst alternatywny" title="Stajnia" width="60" height="61"></div>
			<div class="col-md-2 col-md-offset-1" style="height:100px;"><img src="img/budynki/piedestal.png" alt="tekst alternatywny" title="Piedesta�" width="60" height="61"></div>
			<div class="col-md-2 col-md-offset-1" style="height:100px;"><img src="img/budynki/farma.png" alt="tekst alternatywny" title="Farma" width="60" height="61"></div>
			</div>
			<div class="row">
			<div class="col-md-2 col-md-offset-1" style="height:100px;"><img src="img/budynki/piekarnia.png" alt="tekst alternatywny" title="Piekarnia" width="60" height="61"></div>
			<div class="col-md-2 col-md-offset-1" style="height:100px;"><img src="img/budynki/zbrojownia.png" alt="tekst alternatywny" title="Zbrojownia" width="60" height="61"></div>
			<div class="col-md-2 col-md-offset-1" style="height:100px;"><img src="img/budynki/spichlerz.png" alt="tekst alternatywny" title="Spichlerz" width="60" height="61"></div>
			<div class="col-md-2 col-md-offset-1" style="height:100px;"><img src="img/budynki/tartak.png" alt="tekst alternatywny" title="Tartak" width="60" height="61"></div>
			</div>
				<div class="row">
			<div class="col-md-2 col-md-offset-2" style="height:100px;"><img src="img/budynki/kopalnia_zelaza.png" alt="tekst alternatywny" title="Kopalnia zelaza" width="60" height="61"></div>
			<div class="col-md-2 col-md-offset-1" style="height:100px;"><img src="img/budynki/huta_stali.png" alt="tekst alternatywny" title="Huta stali" width="60" height="61"></div>
			<div class="col-md-2 col-md-offset-1" style="height:100px;"><img src="img/budynki/kopalnia_gliny.png" alt="tekst alternatywny" title="Kopalnia gliny" width="60" height="61"></div>
			</div>
				<div class="col-md-2 col-md-offset-4" style="height:100px;"><img src="img/budynki/koszary.png" alt="tekst alternatywny" title="Koszary" width="60" height="61"></div>
			<div class="col-md-2" style="height:100px;"><img src="img/budynki/kamieniolom.png" alt="tekst alternatywny" title="Kamienio�om" width="60" height="61"></div>
			</div>
			
			<div class="col-md-3">
			<h3> Surowce/Wojsko </h3>
			<table class="table">
			<tr><th>Nazwa surowca</th><th>Ilosc</th><th>Przyrost /min</th></tr>
			<tr><td>Jedzenie</td><td><?php echo $wioska['food'].' / '.pow(2, $spichlerz['level'])*100; ?></td>
				<td><?php echo (pow(2, $zagroda['level'])*15)/60; ?></td></tr>
			<tr><td>Drewno</td><td><?php echo $wioska['wood'].' / '.pow(2, $spichlerz['level'])*100; ?></td>
				<td>20</td></tr>
			<tr><td>Zelazo</td><td><?php echo $wioska['iron'].' / '.pow(2, $spichlerz['level'])*100; ?></td>
				<td>20</td></tr>
			<tr><td>Glina</td><td><?php echo $wioska['clay'].' / '.pow(2, $spichlerz['level'])*100; ?></td>
				<td>20</td></tr>
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
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>