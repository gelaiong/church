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
	<script type="text/javascript" src = "../tinymce/js/jquery.min.js"></script>
    <script type="text/javascript" src = "../tinymce/js/tinymce/jquery.tinymce.min.js"></script>
    <script type="text/javascript" src = "../tinymce/js/tinymce/tinymce.min.js"></script>
</head>
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
					<i class="circular pencil icon"></i>
					<div class="content">
						Churches
						<div class="sub header">Edit Church Info</div>
					</div>
				</h1>
				<div class="ui breadcrumb">
					<a class="section" href="churches.php?page=1">Churches</a>
					<i class="right chevron icon divider"></i>
					<div class="active section">Edit church info</div>
				</div> <!-- ui breadcrumb -->
			</div>
			<div class="middle aligned column"></div>
		</div>
		<div class="ui attached message">
			<p>All fields are required.</p>
		</div>
		<!-- action="churches.php?page=1" -->
			<?php  displayChurchInfo();   ?>
			<div class="ui error message"></div>
			<div class="ui two bottom attached buttons">
				<button class="ui basic labeled red icon button"><i class="remove icon"></i>Cancel</button>
				<button class="ui basic labeled green icon button" name="update"><i class="pencil icon"></i>Update</button>
			</div>
		</form>
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