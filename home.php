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

<div class="container" id="container">
	<!-- MENU -->
	<div class="ui attached secondary pointing stackable sticky mobile tablet menu" id="menu">
		<div class="item" id="logo">
			<a class="logo" href="home.php"><img src="img/logo.png"></a>
		</div> <!-- logo -->
		<a href="home.php" class="active item">HOME</a>
		<a href="churches.php?page=1" class="item">CHURCHES</a>
		<div class="ui dropdown item services" >
			SERVICES
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

	<div class="content" id="context">
		<div class="ui grid">
			<div class="row">
				<div class="ui column">
					<img class="img" src="img/home.jpg">
				</div>
			</div>
			<div class="row">
				<div class="column"></div>
				<div class="center aligned middle aligned fourteen wide column">
					<img src="img/queen.png">
				</div>
				<div class="column"></div>
			</div>
			<div class="ui section divider"></div>
			<div class="row">
				<div class="column"></div>
				<div class="seven wide column">
					<img src="img/info-1.png" class="ui centered medium image">
				</div>
				<div class="seven wide column">
					<img src="img/info-2.png" class="ui centered medium image">
				</div>
				<div class="column"></div>
			</div>
			<div class="ui section divider"></div>
			<div class="row">
				<div class="column"></div>
				<div class="center aligned middle aligned seven wide column">
					<img src="img/info-3.png">
				</div>
				<div class="center aligned middle aligned seven wide column">
					<img src="img/info-4.png">
				</div>
				<div class="column"></div>
			</div>
			<div class="ui section divider"></div>
			<div class="row">
				<div class="two wide column"></div>
				<div class="twelve wide column">
					<h1 class="ui grey dividing header">
		            
			            <div class="content">
			            	<i class="calendar icon"></i>
				            MASS SCHEDULES
			              <!-- <div class="sub header">Shows the dashboard</div> -->
		            	</div>
	            		<div class="two wide column"></div>
	        		</h1> <!-- header --> 
				</div>
			</div>
			<div class="row">
				<div class="two wide column"></div>
				<div class="twelve wide column">	
					<?php displayMassHome(); ?>
				</div>
				<div class="two wide column"></div>
			</div>

			<div class="ui section divider"></div>
			<div class="row">
				<div class="two wide column"></div>
				<div class="twelve wide column">
					<h1 class="ui grey dividing header">
		            
			            <div class="content">
			            	<i class="calendar icon"></i>
				            OTHER SERVICES SCHEDULES
			              <!-- <div class="sub header">Shows the dashboard</div> -->
		            	</div>
	            		<div class="two wide column"></div>
	        		</h1> <!-- header --> 
				</div>
			</div>
			<div class="row">
				<div class="two wide column"></div>
				<div class="twelve wide column">
					<?php displayServiceHome(); ?>
				</div>
				<div class="two wide column"></div>
			</div>
			<div class="row"></div>
		</div>

	</div> <!-- context -->
</div> <!-- container -->
<!-- <footer style="color: white;">
<center >Cebu Churches Services Schedule 2017</center>
</footer> -->

</body>
</html>

<script>
function open_churches(){
	window.open("mass.php?page=1", "_self")
}

function open_services(){
	window.open("services.php?page=1", "_self");
}
function open_info(id){
	var myURL = 'churchinfo.php?church='+ id ;
	window.open(myURL, "_self");
}

$(document).ready(function(){
	$('.ui.dropdown').dropdown();

	$("#user").on("click",function(){
        $("#login").toggle();
    });

	$(".ui.sticky").sticky({
		context:"#context"
	});
});
</script>