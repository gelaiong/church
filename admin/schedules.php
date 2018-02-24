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
<body style="background: #ededed;">
<div class="ui basic bottom attached segment">
	<div class="ui large left vertical visible sidebar inverted borderless small menu" style="box-shadow: none !important;">
		<div class="item" id="slogo">
			<a class="logo" href="home.php" ><img src="../img/logo.png"></a>
		</div>
		<div class="item">
			<center><h4>ADMINISTRATOR</h4></center>
		</div>
		<a href="home.php"><div class="item"><i class="home left icon"></i>Home</div></a>
		<a href="schedules.php?page=1" class="active item" style="background: #ededed; color: black !important;"><i class="calendar icon"></i>Schedules</a>
		<div class="ui hidden divider"></div>
		<div class="ui hidden divider"></div>
		<div class="ui hidden divider"></div>
		<div class="ui hidden divider"></div>
		<?php 
		    $id = $_SESSION['account_id'];
			echo '
			<a href="manageaccount.php?aid='.$id.'" class="item"><i class="pencil alternative icon"></i>Edit Profile</a>
			<a href="../logout.php" class="item"><i class="sign out icon"></i>Logout</a>';
		?>
	</div>
	<div class="pusher" style="max-width: 79% !important;">
		<div class="ui breadcrumb" style="background: white; padding-top: 16px; padding-bottom: 16px; padding-left: 20px; margin-left: -22px; margin-top:-20px; padding-right: 83.5%; margin-right: -25px;">
			<div class="divider"> <i class="right chevron icon"></i> </div>
			<a href="home.php" class="section">Home</a>
			<div class="divider"> / </div>
			<div class="active section">Schedule Viewer</div>
		</div>
		<div class="ui hidden divider"></div>
		<div class="container">
			<div class="ui segments">
				<div class="ui segment">
					<h3 class="ui header">SCHEDULE VIEWER</h3>
				</div>
				<div class="ui segment">
					<button class="ui facebook button floating dropdown link button"><i class="add icon"></i>ADD SCHEDULE
						<div class="menu">
							<a class="item" href="addmass.php"><i class="plus icon"></i>Mass Schedule</a>
							<a href="addschedule.php" class="item" ><i class="plus icon"></i>Other services schedule</a>
						</div>
					</button>
					<table class="ui very basic padded table">
						<thead>
							<tr>
								<th><h4 class="ui header">Service</h4></th>
								<th><h4 class="ui header">Church Name</h4></th>
								<th><h4 class="ui header">Time</h4></th>
								<th><h4 class="ui header">Day</h4></th>
							</tr>
						</thead>
					</table>
					<table class="ui very basic padded table">
						<tbody>
							<?php displaySchedule(); ?>
						</tbody>
					</table>
					<div class="ui hidden divider"></div>
					<?php pages("schedules.php","schedule"); ?>
					<div class="ui hidden divider"></div>
				</div>
			</div>
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