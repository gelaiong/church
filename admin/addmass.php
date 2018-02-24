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
					<h3 class="ui header">ADD MASS SCHEDULE</h3>
				</div>
				<div class="ui padded segment">
					<div class="ui center aligned grid">
						<div class="column"></div>
						<div class="fourteen wide left aligned middle aligned column">
							<form class="ui form" method="POST"  action="schedules.php?page=1">
								<div class="seven fields">
									<div class="field">
										<label>SUNDAY</label>
										<?php echo timemass("sun"); ?>
									</div>
									<div class="field">
										<label>MONDAY</label>
										<?php echo timemass("mon"); ?>
									</div>
									<div class="field">
										<label>TUESDAY</label>
										<?php echo timemass("tue"); ?>
									</div>
									<div class="field">
										<label>WEDNESDAY</label>
										<?php echo timemass("wed"); ?>
									</div>
									<div class="field">
										<label>THURSDAY</label>
										<?php echo timemass("thu"); ?>
									</div>
									<div class="field">
										<label>FRIDAY</label>
										<?php echo timemass("fri"); ?>
									</div>
									<div class="field">
										<label>SATURDAY</label>
										<?php echo timemass("sat"); ?>
									</div>
								</div>

								<button class="ui google plus button"><i class="remove icon"></i>Cancel</button>
								<button class="ui facebook button" name="submit" type="submit"><i class="check icon"></i>Submit</button>
							</form>
						</div>
						<div class="column"></div>
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
});
</script>