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
				<a class="item" href="#"><i class="user icon"></i>Manage account</a>
				<a class="item" href="../logout.php"><i class="sign out icon"></i>Log out</a>
			</div>
		</div>
		<!-- <a class="item"><i class="sign out icon"></i>Log out</a> -->
	</div>
</div>
<div class="ui left visible vertical sidebar menu">
	<div class="item" id="slogo">
		<a class="logo" href="index.php" ><img src="../img/logo.png"></a>
	</div>
	<a class="item" href="index.php"><i class="home icon"></i>Home</a>
	<a class="item" href="schedules.php?page=1"><i class="calendar icon"></i>Schedules</a>
</div>
<div class="pusher">
	<div class="content" id="content">
		<div class="ui stackable two column grid">
			<div class="column">
				<h1 class="ui header">
					<i class="circular user icon"></i>
					<div class="content">
						Account
						<div class="sub header">Manage Account</div>
					</div>
				</h1>
				<div class="ui breadcrumb"></div>
			</div>
			<div class="middle aligned column"></div>
		</div>
		
		<?php accinfo(); ?>
		
	</div>
</div>
</body>
</html>
<script>
$(document).ready(function(){
	$('.ui.dropdown').dropdown();
})
</script>