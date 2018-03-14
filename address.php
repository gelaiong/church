<?php

     include("sql_connect.php");
	global $mysqli;
	if(isset($_POST['church'])){
		$name = $_POST['church'];
		$query = "SELECT * FROM church WHERE church_status = 'active' AND church_name = '".$name."'";
		$result = mysqli_query($mysqli,$query);

		while($row=mysqli_fetch_array($result)){
			$add = $row['church_address'];
			echo "<option value='".$add."'>".$add."</option>";
		}
	}else if(isset($_POST['address'])){
		$address = $_POST['address'];
		$query = "SELECT * FROM church WHERE church_status = 'active' AND church_address = '".$address."'";
		$result = mysqli_query($mysqli,$query);

		while($row=mysqli_fetch_array($result)){
			$church = $row['church_name'];
			echo "<option value='".$church."'>".$church."</option>";
		}
	}
		
?>