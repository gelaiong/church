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
<body style="background: #ededed;">
<div class="ui basic bottom attached segment">
	<div class="ui large left vertical visible sidebar inverted borderless small menu" style="box-shadow: none !important;">
		<div class="item" id="slogo">
			<a class="logo" href="home.php" ><img src="../img/logo.png"></a>
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
					<h3 class="ui header">ADD OTHER SCHEDULE</h3>
				</div>
				<div class="ui padded segment">
					<div class="ui center aligned grid">
						<div class="four wide column"></div>
						<div class="eight wide left aligned middle aligned column">
							<form class="ui form" method="POST"  action="schedules.php?page=1">
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

								<div class="ui radio checkbox" onclick="disableFunc(1)"><input type="radio" name="radio" value="1"><label>No specific schedule</label></div>
								<div class="ui segment myclass toHide" id="opt1">
									<input type="text" name="specsched"><br>
									<p>ex. By appointment/ By arrangement/ Not offered in this church</p>
								</div>
								<div class="ui hidden divider"></div>
								<div class="ui radio checkbox" onclick="disableFunc(2)"><input type="radio" name="radio" value="2"><label>By schedule</label></div>
								<div class="ui segment toHide" id="opt2" >
									<div class="two fields">
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
									</div>
									<div class="two fields">
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
								<div class="ui hidden divider"></div>
								<button class="ui google plus button"><i class="remove icon"></i>Cancel</button>
								<button class="disabled ui facebook button" name="submit" type="submit" id="submit"><i class="check icon"></i>Submit</button>
							</form>
						</div>
						<div class="four wide column"></div>
					</div>
				</div>
			</div>
		</div>
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
	$('.toHide').hide();
});

// function disableFunc(id)
// {
// 	if(id==1){
// 		document.getElementById('opt1').className = document.getElementById('opt1').className.replace ( /(?:^|\s)disabled(?!\S)/g, '');
// 	}else{
// 		document.getElementById('opt2').classList.remove("disabled");
// 	}
// }

$(function() {
    $('[name=radio]').click(function(){
            $('.toHide').hide();
            $('#opt'+$(this).val()).show('slow');
            $('#submit').removeClass('disabled');
    });
 });

</script>