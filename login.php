<?php
      include("functions.php");
      login();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Cebu Churches Services Schedule</title>
	<link rel="stylesheet" type="text/css" href="../cstyle.css">	
	<link rel="stylesheet" href="semantic/semantic.min.css">
	<script src="jquery/jquery.min.js"></script>
	<script src="semantic/semantic.min.js"></script>
	<style>

    	body{
    		overflow-y: none;
    		background-color: black;
    	}
    	body > .grid{
    		height: 100%;
    	}
    	.column{
    		max-width: 420px;
    	}
    	div{
    		font-weight: bold;
    	}
    </style>
</head>
<body>
<div class="ui middle aligned center aligned grid">
	<div class="column">
		<form class="ui small form" method="POST" action="login.php">
			<div class="ui segment" style="background-color: white;">
				<img src="img/login.jpg">
				<div class="field">
					<div class="ui left icon input">
						<i class="user icon"></i>
						<input type="text" name="username" id = "user" placeholder="Username">
					</div>
				</div>
				<div class="field">
					<div class="ui left icon input">
						<i class="lock icon"></i>
						<input type="password" name="password" id = "pass" placeholder="Password">
					</div>
				</div>
				<button class="ui fluid large blue submit button" name="login" value="login">
					Login
				</button>
			</div>
		</form>
	</div>
</div>
</body>
</html>
