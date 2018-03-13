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
				<a href="mass.php?page=1" class="active item">Mass Schedule</a>
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
			<div class="row"></div>
			<div class="column"></div>
			<div class="fourteen wide column">
				<h1 class="ui grey dividing header">
					<i class="calendar icon"></i> 
					<div class="content">
			           	SEARCH RESULTS
		              <div class="sub header">Showing mass result</div>
	            	</div>
            		<div class="two wide column"></div>
        		</h1> <!-- header --> 
				<h3>SEARCH</h3>
				<form class="ui form" method = "POST" action = "mass.php">
					<div class="inline fields">
						<div class="field">
							<select class="ui search dropdown" id="option1">
								<option value="">Church</option>
								<?php dropdownchurch(); ?>
								<!--  -->
							</select>
						</div>
						<div class="field">
							<select class="ui search dropdown" id="option2">
								<option value="">Address</option>
								<?php dropdownaddress(); ?>
								<!--  -->
							</select>
						</div>
						<div class="field">
							<select class="ui search dropdown" id="option3">
								<option value="">Time</option>
								<?php echo timelist(); ?>
								
							</select>
						</div>
						<div class="field">
							<select class="ui search dropdown"   id="option4">
								<option value="">Select day</option>
								<option>Sunday</option>
								<option>Monday</option>
								<option>Tuesday</option>
								<option>Wednesday</option>
								<option>Thursday</option>
								<option>Friday</option>
								<option>Saturday</option>
							</select> 
						</div>
						<button  type ="button" name = "searchbutton" id="searchbutton" class="searching circular ui basic icon button" onclick="open_search(); " ><i class="search link icon"></i></button>
					</div>
				</form>
				<div class="ui hidden divider"></div>
				<?php 
					$option1 = $_GET['option1'];
					$option2 = $_GET['option2'];
					$option3 = $_GET['option3'];
					$option4 = $_GET['option4'];
					$page = $_GET['page'];
					masssearch($option1,$option2,$option3,$option4);
					
				?>
			</div>
			<div class="column"></div>
			<div class="row">
				<div class="two wide column"></div>
				<?php searchpages($option1,$option2,$option3,$option4,"","massresult.php","schedule","Mass",$page); ?>
				<div class="two wide column"></div>
			</div>
		</div>
		<div class="ui grid">
			<div class="two wide column"></div>
			<div class="two wide column"></div>
			<div class="two wide column"></div>
		</div>
	</div> <!-- content -->
</div>
</body>
</html>
<script>
function open_search(){
	var option1 = $('#option1').val();
	var option2 = $('#option2').val();
	var option3 = $('#option3').val();
	var option4 = $('#option4').val();
	var option5 = "";
	var myURL = "massresult.php?page=1&option1="+ option1+"&option2="+option2+"&option3="+option3+"&option4="+option4+"&option5="+option5;
	window.open(myURL, "_self");
}

$(document).ready(function(){
	$('.ui.dropdown').dropdown();
})
</script>