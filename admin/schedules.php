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
			<a class="logo" href="index.php" ><img src="../img/logo.png"></a>
		</div>
		<div class="item">
			<center><h4>ADMINISTRATOR</h4></center>
		</div>
		<a href="index.php" class="item"><i class="home left icon"></i>Home</a>
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
		<div class="ui breadcrumb">
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
								<th class="one wide"><h4 class="ui header">Service</h4></th>
								<th class="three wide"><h4 class="ui header">Specific Schedule</h4></th>
								<th class="two wide"><h4 class="ui header">Start Time</h4></th>
								<th class="two wide"><h4 class="ui header">End Time</h4></th>
								<th class="two wide"><h4 class="ui header">Day</h4></th>
								<th class="two wide"><h4 class="ui header">Week</h4></th>
								<th class="six wide"><h4 class="ui header">Actions</h4></th>
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
<div class="ui mini modal" id="confirm">

  <div class="header">Delete schedule</div>
  <div class="content">
    <p>Are you sure you want to delete this schedule?</p>
  </div>
  <div class="actions">
  	<form method ='POST' action ='schedules.php?page=1'>
	  	<div class="ui google plus button cancel">Cancel</div>
	    <input type='submit' class="ui facebook button" name='del' value='Delete'>
	    <input type='hidden' name='sid' value='' id='sid'/>
	</form>
  </div>
</div>
</body>
</html>
<script>
$(document).ready(function(){
	$('.delete').click(function(){
		$('#confirm').modal('show');
		$('#sid').val($(this).data("id"));
	});
	$('.cancel').click(function(){
		$('#confirm').modal('hide');
	});
})
function sched_info(id){
	var myURL = 'editschedule.php?sid='+ id ;
	window.open(myURL, "_self");
}
$(document).ready(function(){
	$('.ui.dropdown').dropdown();
})
</script>