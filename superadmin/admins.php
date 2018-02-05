<?php 
	include("functions_sa.php");
	sessionSAdmin();
	updateDisplay();
	addAdmin();
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
					<i class="circular user icon"></i>
					<div class="content">
						Admins
						<div class="sub header">List of Admins</div>
					</div>
				</h1>
				<div class="ui breadcrumb"></div>
			</div>
			<div class="middle aligned column">
				<button class="ui right floated labeled blue icon button" onclick="window.open('addadmin.php', '_self')"><i class="plus icon"></i>Add admin</button>
			</div>
		</div>
		<div class="ui segment">
			<table class="ui striped celled stackable table">
				<thead>
					<tr>
						<th>Admin Name</th>
						<th>Contact Number</th>
						<th>Church Name</th>
						<th>Church Address</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php displayAdmins(); ?>
				</tbody>
			</table>
			<br>
			
				<?php pages("admins.php","admin"); ?>
			
			<br>
		</div>
	</div>
</div>

</body>
</html>
<script>
function admin_info(id){
	var myURL = 'editadmin.php?aid='+ id ;
	window.open(myURL, "_self");
}
</script>