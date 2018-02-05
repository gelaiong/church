<?php 
	include("functions_ad.php");
	sessionAdmin(); 
	updateDisplay();
	
	addMass();
	addschedule();
	editSchedule();
	
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Cebu Churches Services Schedule</title>
	<link rel="stylesheet" type="text/css" href="../cstyle.css">	
	<link rel="stylesheet" href="../semantic/semantic.min.css">
	<script src="../jquery/jquery.min.js"></script>
	<script src="../semantic/semantic.min.js"></script>
</head>
<body>
<div class="ui top attached borderless menu">
	<div class="right menu">
		<div class="ui dropdown item">
			Settings
			<i class="dropdown icon"></i>
			<div class="menu">
				<a class="item" href="manageaccount.php"><i class="user icon"></i>Manage account</a>
				<a class="item" href="../logout.php"><i class="sign out icon"></i>Log out</a>
			</div>
		</div>
		<!-- <a class="item"><i class="sign out icon"></i>Log out</a> -->
	</div>
</div>
<div class="ui left visible vertical sidebar menu">
	<div class="item" id="slogo">
		<a class="logo" href="home.php" ><img src="../img/logo.png"></a>
	</div>
	<a class="item" href="index.php"><i class="plus icon"></i>Church Info</a>
	<a class="active item" href="schedules.php?page=1"><i class="calendar icon"></i>Schedules</a>
</div>
<div class="ui pusher">
	<div class="content" id="content">
		<div class="ui stackable two column grid">
			<div class="column">
				<h1 class="ui header">
					<i class="circular calendar icon"></i>
					<div class="content">
						Schedules
						<div class="sub header">List of Schedules</div>
					</div>
				</h1>
				<div class="ui breadcrumb"></div>
			</div>
			<div class="middle aligned column">
				<div class="ui right floated buttons">
					<div class="ui labeled icon floating dropdown primary link button">
						<i class="plus icon"></i>
						Add schedule
						<div class="menu">
							<a class="item" href="addmass.php"><i class="plus icon"></i>Mass Schedule</a>
							<a href="addschedule.php" class="item" ><i class="plus icon"></i>Other services schedule</a>
						</div>
					</div>
				</div>
			</div> 
		</div>
		
		<div class="ui segment">
			<table class="ui striped celled stackable table">
				<thead>
					<tr>
						<th>By Appointment</th>
						<th>Start Time</th>
						<th>End Time</th>
						<th>Day</th>
						<th>Week</th>
						<th>Service</th>
						<th>Church Name</th>
						<th>Church Address</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php displaySchedule(); ?>
				</tbody>
			</table>
			<br>
			
			     <?php pages("schedules.php","schedule"); ?>
			
			<br>
		</div>
	
	</div>
</div>

</body>
</html>
<script>
function sched_info(id){
	var myURL = 'editschedule.php?sid='+ id ;
	window.open(myURL, "_self");
}
$(document).ready(function(){
	$('.ui.dropdown').dropdown();
})
</script>