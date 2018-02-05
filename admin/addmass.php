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
					<div class="active section">Add mass schedule</div>
				</div> <!-- ui breadcrumb -->
			</div>
			<div class="middle aligned column">
			</div>
		</div>
		<div class="ui attached message">
			<p>All fields are required.</p>
		</div>
		<form class="ui form" method="POST" action="schedules.php?page=1">
			<div class="ui attached fluid basic blue segment">
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
			</div>
			<div class="ui error message"></div>
			<div class="ui two bottom attached buttons">
				<button class="ui basic labeled red icon button"><i class="remove icon"></i>Cancel</button>
				<button class="ui basic labeled green icon button" id="submit" name="submit"><i class="plus icon" ></i>Submit</button>
			</div>
		</form>
	</div>
</div>
</body>
</html>
<script>
$(document).ready(function(){
	$('.ui.dropdown').dropdown();
});
</script>