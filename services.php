<?php include("functions.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Cebu Churches Services Schedule</title>
	<link rel="stylesheet" type="text/css" href="cstyle.css">
	<link rel="stylesheet" href="semantic/semantic.min.css">
	<script src="jquery/jquery.min.js"></script>
	<script src="semantic/semantic.min.js"></script>
</head>
<body>
<div class="container">
	<div class="ui attached secondary pointing stackable sticky mobile tablet menu" id="menu">
		<div class="item" id="logo">
			<a class="logo" href="home.php"><img src="img/logo.png"></a>
		</div> <!-- logo -->
		<a href="home.php" class="item">HOME</a>
		<a href="churches.php?page=1" class="item">CHURCHES</a>
		<div class="ui dropdown item services" >
			<a id="services">SERVICES</a>
			<i class="dropdown icon"></i>
			<div class="menu">
				<a href="baptism.php?page=1" class="item">Baptism Schedule</a>
				<a href="confession.php?page=1" class="item">Confession Schedule</a>
				<a href="mass.php?page=1" class="item">Mass Schedule</a>
				<a href="precana.php?page=1" class="item">Pre-Cana Schedule</a>
				<a href="prejordan.php?page=1" class="item">Pre-Jordan Schedule</a>
				<a href="wedding.php?page=1" class="item">Wedding Schedule</a>
			</div> <!-- menu -->
		</div> <!-- services dropdown -->
		<div class="right item">
		</div> <!-- right item -->
	</div> <!-- menu -->
	<div class="results"></div> <!-- search results -->

	<div class="content" id="context">
		<div class="ui grid">
			<div class="row"></div>
			<div class="column"></div>
			<div class="fourteen wide column">
				<h1 class="ui grey dividing header">
					<i class="calendar icon"></i> 
					<div class="content">
			           	OTHER CHURCH SERVICES
		              <div class="sub header">List of other church services</div>
	            	</div>
            		<div class="two wide column"></div>
        		</h1> <!-- header --> 
				<h3>SEARCH</h3>
				<form class="ui form" method = "POST" action = "mass.php">
					<div class="inline fields">
						<div class="ui small icon input search">
							<input type="text" class="search" name="search" id="search" placeholder="Search...">
						</div>
						<button  type ="button" name = "searchbutton" id="searchbutton" class="searching circular ui basic icon button" onclick="open_search(); " onkeyup="open_search();"><i class="search link icon"></i></button>
					</div>
				</form>
				<div class="ui hidden divider"></div>
				<?php displayAllServices(); ?>
			</div>
			<div class="column"></div>
			<div class="row">
				<div class="two wide column"></div>
				<?php pages("services.php","schedule",""); ?>
				<div class="two wide column"></div>
			</div>
		</div>
	</div> <!-- content -->
</div>

</body>
</html>
<script>

function open_search(){
	var search = $('#search').val();
	var myURL = "allserviceresults.php?search="+ search+"&page=1";
	window.open(myURL, "_self");
}
$(document).ready(function(){
	$('.ui.dropdown').dropdown();
})
</script>