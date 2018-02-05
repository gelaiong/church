<?php 
	include("functions_sa.php");
	sessionSAdmin();
	updateChurchDisplay();
	addChurchInfo(); 
	editChurchInfo();
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
	<a class="item" href="admins.php?page=1"><i class="user icon"></i>Admins</a>
</div>
<div class="ui pusher">
	<div class="content" id="content">
		<div class="ui stackable two column grid">
			<div class="column">
				<h1 class="ui header">
					<i class="circular plus icon"></i>
					<div class="content">
						Churches 
						<div class="sub header">List of Churches</div>
					</div>
				</h1>
				<div class="ui breadcrumb"></div>
			</div>
			<div class="middle aligned column">
				<button class="ui right floated labeled blue icon button" onclick="window.open('addchurch.php','_self')"><i class="plus icon"></i>Add church </button>
			</div>
		</div>		
		<div class="ui segment">
			<table class="ui striped celled stackable table">
				<thead>
					<tr>
						<th>Church Name</th>
						<th>Address</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php displayChurches(); ?>
				</tbody>
			</table>
			<br>
				<?php pages("churches.php","church"); ?>
			<br>
		</div>
	</div>
</div>

</body>
</html>

<script>
function church_info(id){
	var myURL = 'editchurch.php?cid='+ id ;
	window.open(myURL, "_self");
}
function open_info(id){
	var myURL = 'viewchurch.php?church='+ id ;
	window.open(myURL, "_self");
}
</script>