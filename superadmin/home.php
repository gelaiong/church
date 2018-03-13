<?php 
	include("functions_sa.php");
	sessionSAdmin(); 
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
			<center><h4>SUPERADMINISTRATOR</h4></center>
		</div>
		<a href="home.php"><div class="active item" style="background: #ededed; color: black !important;"><i class="home left icon"></i>Home</div></a>
		<a href="churches.php?page=1" class="item"><i class="plus icon"></i>Churches</a>
		<a href="schedules.php?page=1" class="item"><i class="calendar icon"></i>Schedules</a>
		<a href="admins.php?page=1" class="item"><i class="user icon"></i>Administrators</a>
		<div class="ui hidden divider"></div>
		<div class="ui hidden divider"></div>
		<div class="ui hidden divider"></div>
		<a href="../logout.php" class="item"><i class="sign out icon"></i>Logout</a>
	</div>
	<div class="pusher" style="max-width: 79% !important;">
		<div class="ui breadcrumb">
			<div class="divider"> <i class="right chevron icon"></i> </div>
			<div class="active section">Home</div>
		</div>
		<div class="ui hidden divider"></div>
		<div class="container">
			<div class="ui segment">
				<div class="ui center aligned middle aligned grid">
					<div class="eight wide middle aligned aligned right aligned column">
						<img src="../img/church.png" class="ui tiny centered image">
					</div>
					<div class="eight wide middle aligned left aligned column">
						<p style="font-size: 3em; font-family: sans-serif;">10 CHURCHES</p>
					</div>
					<div class="eight wide middle aligned aligned right aligned column">
						<center><h1 class="ui grey header"><i class="user grey icon"></i></h1></center>
					</div>
					<div class="eight wide middle aligned left aligned column">
						<p style="font-size: 3em; font-family: sans-serif;">10 ADMINS</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>