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
<body style="background: #ededed;">
<div class="ui basic bottom attached segment">
	<div class="ui large left vertical visible sidebar inverted borderless small menu" style="box-shadow: none !important;">
		<div class="item" id="slogo">
			<a class="logo" href="home.php" ><img src="../img/logo.png"></a>
		</div>
		<div class="item">
			<center><h4>SUPERADMINISTRATOR</h4></center>
		</div>
		<a href="home.php" class=" item"><i class="home left icon"></i>Home</a>
		<a href="churches.php?page=1" class="item"><i class="plus icon"></i>Churches</a>
		<a href="schedules.php?page=1" class="item"><i class="calendar icon"></i>Schedules</a>
		<a href="admins.php?page=1" class="active item" style="background: #ededed; color: black !important;"><i class="user icon"></i>Administrators</a>
		<div class="ui hidden divider"></div>
		<div class="ui hidden divider"></div>
		<div class="ui hidden divider"></div>
		<a href="../logout.php" class="item"><i class="sign out icon"></i>Logout</a>
	</div>
	<div class="pusher" style="max-width: 79% !important;">
		<div class="ui breadcrumb">
			<div class="divider"> <i class="right chevron icon"></i> </div>
			<a href="home.php" class="section">Home</a>
			<div class="divider"> / </div>
			<div class="active section">Account Management</div>
		</div>
		<div class="ui hidden divider"></div>
		<div class="container">
			<div class="ui segments">
				<div class="ui segment">
					<h3 class="ui header">ACCOUNT MANAGEMENT</h3>
				</div>
				<div class="ui segment">
					<button onclick="window.open('addadmin.php', '_self')" class="ui facebook button"><i class="add icon"></i>ADD ADMINISTRATOR</button>
					<table class="ui very basic padded table">
						<thead>
							<tr>
								<th><h4 class="ui header">#</h4></th>
								<th class="three wide"><h4 class="ui header">Admin Name</h4></th>
								<th class="two wide"><h4 class="ui header">Contact #</h4></th>
								<th class="three wide"><h4 class="ui header">Church Name</h4></th>
								<th class="four wide"><h4 class="ui header">Address</h4></th>
								<th class="five wide"><h4 class="ui header">Actions</h4></th>
							</tr>
						</thead>
					</table>
					<table class="ui very basic padded table">
						<tbody>
							<?php displayAdmins(); ?>
						</tbody>
					</table>
					<div class="ui hidden divider"></div>
					<?php pages("admins.php","admin"); ?>
					<div class="ui hidden divider"></div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="ui mini modal" id="confirm">
  <div class="header">Delete administrator</div>
  <div class="content">
    <p>Are you sure you want to delete this administrator?</p>
  </div>
  <div class="actions">
  	<form method='POST' action='admins.php?page=1'>
	  	<div class="ui google plus button cancel ">Cancel</div>
	    <input type='submit' class="ui facebook button" name='delAd' value="Delete">
	    <input type='hidden' name='id' value='' id='id'/>
	</form>
  </div>
</div>


</body>
</html>
<script>
$(document).ready(function(){
	$('.delete').click(function(){
		$('#confirm').modal('show');
		$('#id').val($(this).data("id"));
	});
	$('.cancel').click(function(){
		$('#confirm').modal('hide');
	});
})
</script>