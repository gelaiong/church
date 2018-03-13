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
		<a href="index.php" class="item" ><i class="home left icon"></i>Home</a>
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
			<a href="index.php" class="section">Home</a>
			<div class="divider"> / </div>
			<div class="active section">Schedule Viewer</div>
		</div>
		<div class="ui hidden divider"></div>
		<div class="container">
			<div class="ui segments">
				<div class="ui segment">
					<h3 class="ui header">EDIT SCHEDULE</h3>
				</div>
				<div class="ui padded segment">
					<div class="ui center aligned grid">
						<div class="column"></div>
						<div class="fourteen wide left aligned middle aligned column">
							<?php 
								$sid = $_GET['sid'];

								echo "
								<form class='ui form' action='schedules.php?page=1&sid=".$sid."' method='POST'>"; ?>
									<?php displaySchedInfo(); ?>

									<button class="ui google plus button" style="float: left;"><i class="remove icon"></i>Cancel</button>
									<button class="ui facebook button" name="edit" style="float: left;"><i class="plus icon"></i>Submit</button>
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
})
</script>