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
	<div class="item" id="searchbar">
		<div class="ui transparent icon input">
			<input class="prompt" type="text" placeholder="Search admins ...">
        	<i class="search link icon"></i>
		</div>
	</div>
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
					<i class="circular plus icon"></i>
					<div class="content">
						Admins
						<div class="sub header">Add new admin</div>
					</div>
				</h1>
				<div class="ui breadcrumb">
					<a class="section" href="admins.php?page=1">Admins</a>
					<i class="right chevron icon divider"></i>
					<div class="active section">Add admin</div>
				</div> <!-- ui breadcrumb -->
			</div>
			<div class="middle aligned column">
				<!-- <button class="ui right floated labeled blue icon button"><i class="plus icon"></i>Add schedule</button> -->
			</div>
		</div>
		<div class="ui attached message">
			<p>All fields are required.</p>
		</div>
		<form class="ui form" method="POST" action="admins.php?page=1">
			<div class="ui attached fluid  basic blue segment">
				<div class="two fields">
					<div class="field">
						<label>Admin Name</label>
						<input type="text" placeholder="Enter full name" name="name">
					</div>
					<div class="field">
						<label>Contact Number</label>
						<input type="text" placeholder="Enter contact number" name="cnum">
					</div>
				</div>
				<div class="two fields">
					<div class="field">
						<label>Username</label>
						<input type="text" placeholder="Enter username" name="username">
					</div>
					<div class="field">
						<label>Password</label>
						<input type="password" placeholder="Enter password" name="password">
					</div>
				</div>
				<div class="two fields">
					<div class="field">
						<label>Church Name</label>
						<select class="ui search dropdown" name="church">
							<option value="">Select church name</option>
							<?php echo selectChurch(); ?>
						</select>
					</div>
				</div>
			</div>
			<div class="ui error message"></div>
			<div class="ui two bottom attached buttons">
				<button class="ui basic labeled red icon button"><i class="remove icon"></i>Cancel</button>
				<button class="ui basic labeled green icon button" name="submit"><i class="plus icon"></i>Submit</button>
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