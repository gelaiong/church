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
				<a href="precana.php?page=1" class="item">Pre-Cana Schedule</a>
				<a href="prejordan.php?page=1" class="item">Pre-Jordan Schedule</a>
				<a href="wedding.php?page=1" class="active item">Wedding Schedule</a>
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
			           	WEDDING SCHEDULES
		              <div class="sub header">List of wedding schedules</div>
	            	</div>
	        		<div class="two wide column"></div>
	    		</h1> <!-- header --> 
				<h3>SEARCH</h3>
					<div class="ui form">
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
									<option value="">Start Time</option>
									<?php echo timelist(); ?>
									
								</select>
							</div>
							<button  type ="button" name = "searchbutton" id="searchbutton" class="searching circular ui basic icon button" onclick="open_search(); " ><i class="search link icon"></i></button>
						</div>
					</div>
					<div class="ui hidden divider"></div>
					<?php displaySched("wedding"); ?>
				</div>
				<div class="column"></div>
				<div class="row">
					<div class="column"></div>
					<?php pages("wedding.php","schedule","Wedding"); ?>
					<div class="two wide column"></div>
				</div>
			</div>
			<div class="ui grid">
				<div class="two wide column"></div>
				<div class="two wide column"></div>
				<div class="two wide column"></div>
			</div>
		</div>
	</div> <!-- content -->
</div>
</body>
</html>
<script>
function open_search(){
    var option1 = $('#option1').val().trim();
    var option2 = $('#option2').val().trim();
    var option3 = $('#option3').val().trim();
    var option4 = "";
    var option5 = "";
    var event = "Wedding";

	var myURL = "search.php?page=1&option1="+ option1+"&option2="+option2+"&option3="+option3+"&option4="+option4+"&option5="+option5+"&event="+event;
	window.open(myURL, "_self");
}

$(document).ready(function(){
	$('.ui.dropdown').dropdown();
	$('#option1').on('change',function(){

		var church_name = $(this).val();
		var dataSet = 'church='+church_name;
		$.ajax({
		type: 'POST',
		url: 'address.php',
		data: dataSet,
		cache: false,
		success: function(result){
             $('#option2').html(result);
          },
          error: function(jqXHR, errorThrown){
              console.log(errorThrown);
          }
	});
	});
	$('#option2').on('change',function(){

		var church_address = $(this).val();
		var dataSet = 'address='+church_address;
		$.ajax({
		type: 'POST',
		url: 'address.php',
		data: dataSet,
		cache: false,
		success: function(result){
             $('#option1').html(result);
          },
          error: function(jqXHR, errorThrown){
              console.log(errorThrown);
          }
	});
	});
})
</script>