<?php 
	include("functions_sa.php");
	sessionSAdmin(); 
	editAdminInfo();
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
	<!-- <div class="item" id="searchbar">
		<div class="ui transparent icon input">
			<input class="prompt" type="text" placeholder="Search admins ...">
        	<i class="search link icon"></i>
		</div>
	</div> -->
	<div class="right menu">
		<a class="item" href="../logout.php"><i class="sign out icon"></i>Log out</a>
	</div>
</div>
<div class="ui left visible vertical sidebar menu">
	<div class="item" id="slogo">
		<a class="logo" href="home.php" ><img src="../img/logo.png"></a>
	</div>
	<a class="item" href="home.php"><i class="home icon"></i>Home</a>
	<a class="item" href="churches.php?page=1"><i class="plus icon"></i>Churches</a>
	<a class="item" href="schedules.php?page=1"><i class="calendar icon"></i>Schedules</a>
	<a class="active item" href="admins.php?page=1"><i class="user icon"></i>Admins</a>
</div>
<div class="ui pusher">
	<div class="content" id="content">
		<div class="ui stackable two column grid">
			<div class="column">
				<h1 class="ui header">
					<i class="circular pencil icon"></i>
					<div class="content">
						Admins
						<div class="sub header">Edit admin info</div>
					</div>
				</h1>
				<div class="ui breadcrumb">
					<a class="section" href="admins.php?page=1">Admins</a>
					<i class="right chevron icon divider"></i>
					<div class="active section">Edit admin info</div>
				</div> <!-- ui breadcrumb -->
			</div>
			<div class="middle aligned column">
				<!-- <button class="ui right floated labeled blue icon button"><i class="plus icon"></i>Add schedule</button> -->
			</div>
		</div>
		<div class="ui attached message">
			<p>All fields are required.</p>
		</div>
			<?php displayAdInfo(); ?>
		
	</div>
</div>

</body>
</html>

<script>
$(document).ready(function(){
	$('.ui.dropdown').dropdown();
});
</script>