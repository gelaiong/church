<?php 
	include("functions_ad.php");

	sessionAdmin();
	
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
					<i class="circular plus icon"></i>
					<div class="content">
						Schedules
						<div class="sub header">Add new schedule</div>
					</div>
				</h1>
				<div class="ui breadcrumb">
					<a class="section" href="schedules.php?page=1">Schedules</a>
					<i class="right chevron icon divider"></i>
					<div class="active section">Add schedule</div>
				</div> <!-- ui breadcrumb -->
			</div>
			<div class="middle aligned column">
			</div>
		</div>
		<div class="ui attached message">
			<p>All fields are required.</p>
		</div>
		<form class="ui form" action="schedules.php?page=1" method="POST">
			<div class="ui attached fluid  basic blue segment">
				<div class="field">
					<label>Service</label>
					<select class="ui search dropdown" name="event">
						<option value="">Select service</option>
						<option>Baptism</option>
						<option>Confession</option>
						<option>Pre-Cana</option>
						<option>Pre-Jordan</option>
						<option>Wedding</option>
					</select>
				</div>
				<div class="ui radio checkbox" onclick="disableFunc(1)"><input type="radio" name="radio" ><label>No specific schedule</label></div>
				<div class="ui disabled myclass segment" id="opt1">
					<input type="text" name="specsched"><br>
					<p>ex. By appointment/ By arrangement/ Not offered in this church</p>
				</div>
				<div class="ui radio checkbox" onclick="disableFunc(2)"><input type="radio" name="radio" ><label>By schedule</label></div>
				<div class="ui disabled segment" id="opt2">
					<div class="four fields">
						<div class="field">
							<label>Start Time</label>
							<select class="ui search dropdown" name="start">
								<option value="">Select start time</option>
								<?php echo timelist(); ?>
							</select>
						</div>
						<div class="field">
							<label>End Time</label>
							<select class="ui search dropdown" name="end">
								<option value="">Select end time</option>
								<?php echo timelist(); ?>
							</select>
						</div>
						<div class="field">
							<label>Week</label>
							<select class="ui search dropdown" name="week">
								<option value="">Select week</option>
								<option>1st</option>
								<option>2nd</option>
								<option>3rd</option>
								<option>4th</option>
								<option>5th</option>
							</select>
						</div>
						<div class="field">
							<label>Day</label>
							<select class="ui search dropdown" name="day">
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
					</div>
				</div>
			</div>
			<div class="ui error message"></div>
			<div class="ui two bottom attached buttons">
				<button class="ui basic labeled red icon button"><i class="remove icon"></i>Cancel</button>
				<button class="ui basic labeled green icon button" name="sub"><i class="plus icon"></i>Submit</button>
			</div>
		</form>
	</div>
</div>
</body>
</html>
<script>
$(document).ready(function(){
	$('.ui.dropdown').dropdown();
	$('ui.checkbox').checkbox();
	$('ui.checkbox').click(function(){
		$('myclass').removeClass("disabled");
	})
});

function disableFunc(id)
{
	if(id==1){
		document.getElementById('opt1').className = document.getElementById('opt1').className.replace ( /(?:^|\s)disabled(?!\S)/g, '');
	}else{
		document.getElementById('opt2').classList.remove("disabled");
	}
}

</script>