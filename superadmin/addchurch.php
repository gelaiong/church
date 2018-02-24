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
	<script type="text/javascript" src = "../tinymce/js/jquery.min.js"></script>
    <script type="text/javascript" src = "../tinymce/js/tinymce/jquery.tinymce.min.js"></script>
    <script type="text/javascript" src = "../tinymce/js/tinymce/tinymce.min.js"></script>
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
		<a href="churches.php?page=1" class="active item" style="background: #ededed; color: black !important;"><i class="plus icon"></i>Churches</a>
		<a href="schedules.php?page=1" class="item"><i class="calendar icon"></i>Schedules</a>
		<a href="admins.php?page=1" class="item"><i class="user icon"></i>Administrators</a>
		<div class="ui hidden divider"></div>
		<div class="ui hidden divider"></div>
		<div class="ui hidden divider"></div>
		<a href="../logout.php" class="item"><i class="sign out icon"></i>Logout</a>
	</div>
	<div class="pusher" style="max-width: 79% !important;">
		<div class="ui breadcrumb" style="background: white; padding-top: 16px; padding-bottom: 16px; padding-left: 20px; margin-left: -22px; margin-top:-20px; padding-right: 82%; margin-right: -30px;">
			<div class="divider"> <i class="right chevron icon"></i> </div>
			<a href="home.php" class="section">Home</a>
			<div class="divider"> / </div>
			<div class="active section">Church Management</div>
		</div>
		<div class="ui hidden divider"></div>
		<div class="container">
			<div class="ui segments">
				<div class="ui segment">
					<h3 class="ui header">ADD CHURCH</h3>
				</div>
				<div class="ui padded segment">
					<div class="ui center aligned grid">
						<div class="four wide column"></div>
						<div class="eight wide left aligned middle aligned column">
							<h3>All fields are required.</h3>
							<form class="ui form" method="POST" action="churches.php?page=1">
								<div class="field">
									<label>Church Name</label>
									<input type="text" placeholder="Enter church name" name="church">
								</div>
								<div class="field">
									<label>Church Address</label>
									<input type="text" placeholder="Enter church address" name="address">
								</div>

								<button class="ui google plus button"><i class="remove icon"></i>Cancel</button>
								<button class="ui facebook button" name="submit" type="submit"><i class="check icon"></i>Submit</button>
							</form>
						</div>
						<div class="four wide column"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



</body>
</html>

<script>
tinymce.init({
  selector: 'textarea',
  height: 350,
  menubar: false,

  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code jbimages'
  ],
  toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | jbimages',   
  relative_urls : false, 
  remove_script_host : false,
 
});


</script>
