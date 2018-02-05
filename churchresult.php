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
		<div class="ui attached secondary pointing stackable sticky mobile tablet menu" id="menu">
		<div class="item" id="logo">
			<a class="logo" href="home.php"><img src="img/logo.png"></a>
		</div> <!-- logo -->
		<a href="home.php" class="item">HOME</a>
		<a href="churches.php?page=1" class="active item">CHURCHES</a>
		<div class="ui dropdown item services">
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
	<div class="content" id="context">
		<!-- <div class="ui container" id="breadcrumbs">
			<div class="ui breadcrumb">
				<a class="section" href="home.php">Home</a>
				<span class="divider">/</span>
				<div class="active section">Churches</div>
			</div>
		</div> -->
		<div class="results"></div> <!-- search results -->
		<div class="ui container" id="content">
			<div class="ui stackable two column grid">
				<div class="column">
					<h1 class="ui header">
						<!-- <i class="circular calendar icon"></i> -->
						<div class="content">
							Church within Cebu Province
							<!-- <div class="sub header">List of Schedules</div> -->
						</div>
					</h1>
					<div class="ui breadcrumb">
						<a class="section" href="home.php">Home</a>
						<i class="right chevron icon divider"></i>
						<div class="active section">Churches</div>
					</div>
				</div>
				<div class="right aligned middle aligned column">
					

					<div class="field">
						<select class="ui mini search dropdown" id="option1">
							<option value="">Church</option>
							<?php dropdownchurch(); ?>
							<!--  -->
						</select>
					</div>
					<div class="field">
						<select class="ui mini search dropdown" id="option2">
							<option value="">Address</option>
							<?php dropdownaddress(); ?>
							<!--  -->
						</select>
					</div>
					<button  type ="button" name = "searchbutton" id="searchbutton" class="searching circular ui basic icon button" onclick="open_search(); " ><i class="search link icon"></i></button>
				</div>
			</div>
			<div class="ui primary padded container black segment">
				<?php 
					$option1 = $_GET['option1'];
					$option2 = $_GET['option2'];
					$page = $_GET['page'];
					churchsearch($option1,$option2);
					searchpages($option1,$option2,"","","","churchresult.php","church","",$page);
				?>
			</div> <!-- segment -->
			<br>
		</div> <!-- container -->
	</div> <!-- content -->
</div>
</body>
</html>
<script>
function open_info(id){
	var myURL = 'churchinfo.php?church='+ id ;
	window.open(myURL, "_self");
}
function open_search(){
	var option1 = $('#option1').val().trim();
    var option2 = $('#option2').val().trim();
    var option3 = "";
    var option4 = "";
    var option5 = "";

	var myURL = "churchresult.php?page=1&option1="+ option1+"&option2="+option2+"&option3="+option3+"&option4="+option4+"&option5="+option5;
	window.open(myURL, "_self");
}
$(document).ready(function(){
	$('.ui.dropdown').dropdown();
})
</script>