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
<body>
<div class="ui top attached borderless menu">
	<div class="item" id="searchbar">
		<div class="ui transparent icon input">
			<input class="prompt" type="text" placeholder="Search churches ...">
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
	<a class="active item" href="churches.php?page=1"><i class="plus icon"></i>Churches</a>
	<a class="item" href="schedules.php?page=1"><i class="calendar icon"></i>Schedules</a>
	<a class="item" href="admins.php?page=1"><i class="user icon"></i>Admin</a>
</div>
<div class="ui pusher">
	<div class="content" id="content">
		<div class="ui stackable two column grid">
			<div class="column">
				<h1 class="ui header">
					<i class="circular plus icon"></i>
					<div class="content">
						Churches
						<div class="sub header">Add New Church</div>
					</div>
				</h1>
				<div class="ui breadcrumb">
					<a class="section" href="churches.php?page=1">Churches</a>
					<i class="right chevron icon divider"></i>
					<div class="active section">Add church</div>
				</div> <!-- ui breadcrumb -->
			</div>
			<div class="middle aligned column"></div>
		</div>
		<div class="ui attached message">
			<p>All fields are required.</p>
		</div>
		<form class="ui form" method="POST" action="churches.php?page=1">
			<div class="ui attached fluid  basic blue segment">

				<div class="eight wide field">
					<label>Church Name</label>
					<input type="text" placeholder="Enter church name" name="church">
				</div>
				<div class="eight wide field">
					<label>Church Address</label>
					<input type="text" placeholder="Enter church address" name="address">
				</div>

				<button class="ui labeled red icon button"><i class="remove icon"></i>Cancel</button>
				<button class="ui labeled green icon button" name="submit" type="submit"><i class="check icon"></i>Submit</button>
			</div>
			
			<div class="ui error message"></div>
		</form>
	</div>


<div class="ui modal" id="password">
    <div class="ui header">
        <div class="ui two column grid">
            <div class="column">
                <h3 class="ui header">
                    <i class="circular lock icon"></i>
                    <div class="content">Change Password</div>
                </h3>
            </div>
            <div class="right aligned column">
                <button type="button" class="close" id="closepa" title="Close"><span>&times;</span></button>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="ui form">
            <form method="POST" action="'.site_url().'/cAgents/updatePassword">
                <div class="required field">
                    <label>Old Password</label>
                    <input type="password" name="oldpass" placeholder="Enter old password" required="">
                </div>
                <div class="required field">
                    <label>New Password</label>
                    <input type="password" name="newpass" placeholder="Enter new password" required="" id = "newpass">
                </div>
                <div class="required field">
                    <label>Confirm New Password</label>
                    <input type="password" name="newpass1" id = "newpass1" placeholder="Confirm new password" required=""><span id="message"></span>
                </div>
                <div class="actions">
                    <div class="ui right floated buttons">
                        <button class="ui negative button">Cancel</button>
                        <div class="or"></div>
                        <button class="ui positive button" name = "update">Save</button>
                    </div>
                </div>
                <br>
                <br>
            </form>
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
