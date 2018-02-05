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
</head>
<body>
<div class="ui top attached borderless menu">
	<div class="right menu">
		<div class="ui dropdown item">
			Settings
			<i class="dropdown icon"></i>
			<div class="menu">
				<?php 
				    $id = $_SESSION['account_id'];
					echo '
					<a class="item" href="manageaccount.php?aid='.$id.'"><i class="user icon"></i>Manage account</a>
					<a class="item" href="../logout.php"><i class="sign out icon"></i>Log out</a>';
				?>
			</div>
		</div>
	</div>
</div>
<div class="ui left visible vertical sidebar menu">
	<div class="item" id="slogo">
		<a class="logo" href="home.php" ><img src="../img/logo.png"></a>
	</div>
	<a class="item" href="index.php"><i class="plus icon"></i>Church Info</a>
	<a class="item" href="schedules.php?page=1"><i class="calendar icon"></i>Schedules</a>
</div>
<div class="ui pusher">
	<div class="content" id="content">
		
		<?php churchinfo(); ?>
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

</script>