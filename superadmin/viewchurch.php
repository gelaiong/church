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
<body>
<div class="ui top attached borderless menu">
	<div class="right menu">
		<a class="item" href="../logout.php"><i class="sign out icon"></i>Log out</a>
	</div>
</div>
<div class="ui left visible vertical sidebar menu">
	<div class="item" id="slogo">
		<a class="logo" href="home.php" ><img src="../img/logo.png"></a>
	</div>
	<a class="item" href="home.php"><i class="home icon"></i>Home</a>
	<a class="active item" href="churches.php?page=1"><i class="plus icon"></i>Churches</a>
	<a class="item" href="schedules.php?page=1"><i class="calendar icon"></i>Schedules</a>
	<a class="item" href="admins.php?page=1"><i class="user icon"></i>Admin</a>
</div>
<div class="ui pusher">
	<div class="content" id="content">
		<div class="ui stackable two column grid">
			<div class="column">
				<h1 class="ui header">
					<i class="circular search icon"></i>
					<div class="content">
						Churches
						<div class="sub header">View Church Info</div>
					</div>
				</h1>
				<div class="ui breadcrumb">
					<a class="section" href="churches.php?page=1">Back to list of churches</a>
					<i class="left arrow icon divider"></i>
					<div class="active section">View Church Info</div>
				</div> <!-- ui breadcrumb -->
			</div>
			<div class="middle aligned column">
			</div>
		</div>
		<?php churchinfo(); ?>
	</div>
</div>

</body>
</html>

<script>

function open_info(id){
	var myURL = 'viewchurch.php?church='+ id ;
	window.open(myURL, "_self");
}

</script>