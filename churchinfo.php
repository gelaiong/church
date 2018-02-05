<?php include("functions.php"); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Cebu Churches Services Schedule</title>
	<link rel="stylesheet" type="text/css" href="cstyle.css">
	<link rel="stylesheet" href="semantic/semantic.min.css">
	<script src="jquery/jquery.min.js"></script>
	<script src="semantic/semantic.min.js"></script>
</head>
<body>
<div class="container" id="container">
		<div class="ui attached secondary pointing stackable sticky mobile tablet menu" id="menu">
		<div class="item" id="logo">
			<a class="logo" href="home.php"><img src="img/logo.png"></a>
		</div> <!-- logo -->
		<a href="home.php" class="item">HOME</a>
		<a href="churches.php?page=1" class="active item">CHURCHES</a>
		<div class="ui dropdown item services" >
			<a id="services">SERVICES</a>
			<i class="dropdown icon"></i>
			<div class="menu">
				<a href="baptism.php?page=1" class="item">Baptism Schedule</a>
				<a href="confession.php?page=1" class="item">Confession Schedule</a>
				<a href="mass.php?page=1" class="item">Mass Schedule</a>
				<a href="precana.php?page=1" class="item">Pre-Cana Schedule</a>
				<a href="prejordan.php?page=1" class="item">Pre-Jordan Schedule</a>
				<a href="wedding.php?page=1" class="item">Wedding Schedule</a>
			</div> <!-- menu -->
		</div> <!-- services dropdown -->
		<div class="right item">
		</div> <!-- right item -->
	</div> <!-- menu -->
	<div class="results"></div> <!-- search results -->
	<div class="content" id="context">
		<div class="ui container" id="content">
			<div class="ui stackable two column grid">
				<div class="column">
					<h1 class="ui header">
						<!-- <i class="circular calendar icon"></i> -->
						<div class="content">
							Church Information
							<!-- <div class="sub header">List of Schedules</div> -->
						</div>
					</h1>
					<div class="ui breadcrumb">
						<a class="section" href="home.php">Home</a>
						<i class="right chevron icon divider"></i>
						<a class="section" href="churches.php?page=1">Churches</a>
						<i class="right chevron icon divider"></i>
						<div class="active section">View church info</div>
					</div>
				</div>
			</div>
			         <?php churchinfo(); ?>
			</div> <!-- segment -->
		</div> <!-- container -->
	</div> <!-- content -->
</div>
</body>
</html>

<script type="text/javascript" src="/tinymce_4.x/tinymce/js/tinymce/tinymce.min.js"></script>
<script>


$(document).ready(function(){
	$('.ui.dropdown').dropdown();
})

tinymce.init({
  selector: "textarea",
  
  // ===========================================
  // INCLUDE THE PLUGIN
  // ===========================================
	
  plugins: [
    "advlist autolink lists link image charmap print preview anchor",
    "searchreplace visualblocks code fullscreen",
    "insertdatetime media table contextmenu paste jbimages"
  ],
	
  // ===========================================
  // PUT PLUGIN'S BUTTON on the toolbar
  // ===========================================
	
  toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
	
  // ===========================================
  // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
  // ===========================================
	
  relative_urls: false
	
});

</script>