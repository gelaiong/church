<?php 
	include("functions.php"); 
?>
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
				<a href="precana.php?page=1" class="active item">Pre-Cana Schedule</a>
				<a href="prejordan.php?page=1" class="item">Pre-Jordan Schedule</a>
				<a href="wedding.php?page=1" class="item">Wedding Schedule</a>
			</div> <!-- menu -->
		</div> <!-- services dropdown -->
		<div class="right item">
		</div> <!-- right item -->
	</div> <!-- menu -->
	
	<div class="content" id="context">
		<div class="ui grid">
			<div class="row"></div>
			<div class="column"></div>
			<div class="fourteen wide column">
				<h1 class="ui grey dividing header">
					<i class="calendar icon"></i> 
					<div class="content">
			           	PRE-CANA SCHEDULES
		              <div class="sub header">List of pre-cana schedules</div>
	            	</div>
            		<div class="two wide column"></div>
        		</h1> <!-- header --> 
				<?php displaySched("pre-cana"); ?>
			
		</div>
	</div> <!-- content -->
</body>
</html>
<script>

function open_search(){
    var option1 = $('#option1').val().trim();
    var option2 = $('#option2').val().trim();
    var option3 = $('#option3').val().trim();
    var option4 = "";
    var option5 = "";
    var event = "Pre-Cana";

	var myURL = "search.php?page=1&option1="+ option1+"&option2="+option2+"&option3="+option3+"&option4="+option4+"&option5="+option5+"&event="+event;
	window.open(myURL, "_self");
}
$(document).ready(function(){
	$('.ui.dropdown').dropdown();
})
</script>