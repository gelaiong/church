<?php 
	include("functions_ad.php");
	sessionAdmin(); 
	manageacc();
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
			<center><h4>ADMINISTRATOR</h4></center>
		</div>
		<a href="index.php" class="active item" style="background: #ededed; color: black !important;"><i class="home left icon"></i>Home</a>
		<a href="schedules.php?page=1" class="item"><i class="calendar icon"></i>Schedules</a>
		<div class="ui hidden divider"></div>
		<div class="ui hidden divider"></div>
		<div class="ui hidden divider"></div>
		<div class="ui hidden divider"></div>
		<?php 
		    $id = $_SESSION['account_id'];
			echo '
			<a href="manageaccount.php?aid='.$id.'" class="item"><i class="pencil alternative icon"></i>Edit Profile</a>
			<a href="../logout.php" class="item"><i class="sign out icon"></i>Logout</a>';
		?>
	</div>
	<div class="pusher" style="max-width: 79% !important;">
		<div class="ui breadcrumb">
			<div class="divider"> <i class="right chevron icon"></i> </div>
			<div class="active section">Home</div>
		</div>
		<div class="ui hidden divider"></div>
		<div class="container">
			<?php dashboard(); ?>
		</div>

	</div>
</div>
</body>
</html>
<script>
$(document).ready(function(){
	$('.ui.dropdown').dropdown();
})

function edit_info(id){
	var myURL = 'editchurch.php?cid='+ id ;
	window.open(myURL, "_self");
}
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