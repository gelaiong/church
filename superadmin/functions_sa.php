 
<?php

     include("../sql_connect.php");

     function sessionSAdmin()
	{
		session_start();

	    if(isset($_SESSION['username'])==""){
	        header("location:../login.php");
	    }
	}
	function addChurchInfo(){
		global $mysqli;
		if(isset($_POST['submit'])){ 
		    $church = $_POST['church'];
			$address = $_POST['address'];
		    $info = "No description provided.";
		    

		    $get_query = "INSERT INTO church(church_name,church_address,church_info) VALUES ('".$church."','".$address."','".$info."')";

		    $query = mysqli_query($mysqli,$get_query) ;   
		}
	}
	function selectChurch(){
		global $mysqli;
		$output = '';

		$get_query = "SELECT * FROM church WHERE church_status='active'";
		$run_query = mysqli_query($mysqli, $get_query);

		while ($row_query = mysqli_fetch_array($run_query)) {
			$church = $row_query['church_name'];
			$churchID = $row_query['church_id'];
			
			$output .= "<option value = '$churchID'>$church</option> ";

	    }

	    return $output;
	}
    
    function addAdmin(){
    	global $mysqli;
		if(isset($_POST['submit'])){
		    $name = $_POST['name'];
			$cnum = $_POST['cnum'];
		    $username = $_POST['username'];
		    $password = $_POST['password'];
			$church = $_POST['church'];
		    
		    

		    $get_query = "INSERT INTO `account`(`account_username`, `account_password`) VALUES ('$username','$password')";
		    $query = mysqli_query($mysqli,$get_query) ;   

		     if($query){
		    	 $id = $mysqli->insert_id;
		    }

		    $get_query2 = "INSERT INTO `admin`(`admin_name`, `admin_contact`, `admin_account_id`, `admin_church_id`) VALUES ('$name','$cnum','$id','$church')";
		    $query2 = mysqli_query($mysqli,$get_query2) ; 

		    if(!$query2){
		    	$query3 = "UPDATE account SET account_status = 'inactive' WHERE account_id = $id";
    		    mysqli_query($mysqli,$query3);
		    }
		}
		if (isset($_POST['cancel'])){
			header('Location: admins.php?page=1');
		}

    }

function pages($url,$table){
	global $mysqli;

	if($table == 'admin'){
		$query = "SELECT * FROM ".$table." JOIN account ON admin_account_id = account_id WHERE account_status = 'active'";
	}else{
		$query ="SELECT * FROM ".$table." WHERE ".$table."_status = 'active'";
	}
	
	//print_r($query);
	

	$result = mysqli_query($mysqli,$query);
	$cnt = mysqli_num_rows($result);
	$npage = $cnt/10;
	$npage = ceil($npage);

	$page = $_GET['page'];
	if($npage ==0){
		echo "Page <strong> ".$page." </strong> out of 1 pages" ;
	}else{
		echo "Page <strong> ".$page." </strong> out of ".$npage." pages" ;
	}

	echo' <div class="ui centered grid">
				<div class="ui center aligned pagination menu" > ';
	if($cnt == 0){
		echo "<a href = '".$url."?page=1' class='item'>1</a>";
	}else{
		
		for($n=1; $n<=$npage; $n++){
			echo "<a href = '".$url."?page=".$n."' class='item'>".$n."</a>";
		}
}
echo "</div></div>";

}
function editAdminInfo(){
	global $mysqli;
	if(isset($_POST['up'])){
		$aid = $_GET['aid'];
		$church_id= $_POST['church'];
		$name = $_POST['name'];
		$contact = $_POST['contact'];


		$query = "UPDATE admin SET admin_name='".$name."', admin_church_id='".$church_id."',admin_contact='".$contact."' WHERE admin_id = ".$aid;

		 // print_r($query);

		$result = mysqli_query($mysqli,$query);
		
		if($result){
	    	header('Location: admins.php?page=1');
	    }
		
	}
}
function displayAdmins(){
	global $mysqli;

    $n = $_GET['page'];
    
    $page = ($n * 10)-10;

	$query = "SELECT * FROM admin JOIN account ON account_id = admin_account_id JOIN church ON church_id = admin_church_id WHERE account_status = 'active' LIMIT ".$page.",10";
	$run_query = mysqli_query($mysqli,$query);

	if (!$run_query) {
		printf("Error: %s\n", mysqli_error($mysqli));
		exit();
	}

	while ($row_query = mysqli_fetch_array($run_query)) {
		$church = $row_query['church_name'];
		$address = $row_query['church_address'];
		$contact =  $row_query['admin_contact'];
		$name =  $row_query['admin_name'];
		$id = $row_query['account_id'];
		$aid = $row_query['admin_id'];
		
		echo "<form method='POST' action='admins.php?page=1'>
		       <tr>
		       		<td>$aid</td>
					<td class='three wide'>$name</td>
					<td class='two wide'>$contact</td>
					<td class='three wide'>$church</td>
					<td class='three wide'>$address</td>
					<td>
						<a href = 'editadmin.php?aid=".$aid."' class='ui facebook button'><i class='pencil alternate icon'></i>Update<a>
						<button class='ui google plus button' name='delete'><i class='ban icon'></i>Remove</button>
						<input type='hidden' name = 'id' value = '$id' />
					</td>
				</tr>
			  </form>";
    }
 }

function updateDisplay(){
	global $mysqli;

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$query = "UPDATE account SET account_status = 'inactive' WHERE account_id = $id";
		mysqli_query($mysqli,$query);
	}
}



function displayAdInfo(){
	global $mysqli;
	$id = $_GET['aid'];

	$query = "SELECT * FROM admin JOIN church ON church_id = admin_church_id WHERE admin_id= $id";
	$run_query = mysqli_query($mysqli,$query);

	$row_query = mysqli_fetch_array($run_query);
    $church = $row_query['church_name'];
	$address = $row_query['church_address'];
	$contact =  $row_query['admin_contact'];
	$name =  $row_query['admin_name'];

	echo "
	<form class='ui form' action='editadmin.php?aid=".$id."' method='POST'>
	<div class='ui attached fluid  basic blue segment'>
			<div class='two fields'>
				<div class='field'>
					<label>Admin Name</label>
					<input type='text' name='name' value='$name'>
				</div>
				<div class='field'>
					<label>Contact Number</label>
					<input type='text' name='contact' value ='$contact'>
				</div>
			</div>
			<div class='two fields'>
				<div class='field'>
					<label>Church Name</label>
					<select class='ui search dropdown' name='church'>
						".selectChurch()."
					</select>
				</div>
				
			</div>
		</div>
		<div class='ui error message'></div>
		<div class='ui two bottom attached buttons'>
			<a href='admins.php?page=1' class='ui basic labeled red icon button'><i class='remove icon'></i>Cancel</a>
			<button class='ui basic labeled green icon button' name='up' type='submit'><i class='pencil icon'></i>Update</button>
		</div>
		</form>
	";

}
function displayChurches()
 {
    global $mysqli;


    $n = $_GET['page'];
    
    $page = ($n * 10)-10;

    $query = "SELECT * FROM church WHERE church_status = 'active' LIMIT ".$page.",10";
    $run_query = mysqli_query($mysqli,$query);

    while ($row_query = mysqli_fetch_array($run_query)) {
		$church = $row_query['church_name'];
		$address = $row_query['church_address'];
		$cid = $row_query['church_id'];
		
		echo " 	<form method='POST' action='churches.php?page=1'>
					<tr>
						<td>$cid</td>
						<td class='three wide'>$church</td>
						<td class='three wide'>$address</td>
						<td class='three wide'>--------</td>
						<td class='two wide'>--------</td>
						<td class='seven wide'>
							<button class='ui google plus button' name='del'><i class='ban icon'></i>Remove</button>
						</td>
						<input type='hidden' name='cid' value='$cid'/>
					</tr>
				</form>";
    }
 }
function editChurchInfo(){
	global $mysqli;
	if(isset($_POST['update'])){
		$cid = $_GET['cid'];
		$church = $_POST['church'];
		$address = $_POST['address'];
		$info = $_POST['info'];


		$query = "UPDATE church SET church_name='".$church."', church_address='".$address."', church_info='".$info."' WHERE church_id = ".$cid;

		$result = mysqli_query($mysqli,$query);
		if($result){
	    	echo "<script>alert('successfully edited');</script>";
	    }
	}
}
function displayChurchInfo(){
global $mysqli;
$id = $_GET['cid'];
$query = "SELECT * FROM church WHERE church_status = 'active' AND church_id=".$id;
$result = mysqli_query($mysqli,$query);
$row_query = mysqli_fetch_array($result);
$church = $row_query['church_name'];
$address = $row_query['church_address'];
$info = $row_query['church_info'];
echo"
<form class='ui form' method='POST' action='churches.php?page=1&cid=".$id."'>
<div class='ui attached fluid  basic blue segment'>
				<div class='two fields'>
					<div class='field'>
						<label>Church Name</label>
						<input type='text' value='".$church."' name='church'>
					</div>
					<div class='field'>
						<label>Church Address</label>
						<input type='text' value='".$address."' name='address'>
					</div>
				</div>
				<div class='field'>
					<label>Church Info</label>
					<textarea name='info' class='tinymce' value=$info </textarea>
				</div>
			</div> ";
}
function updateChurchDisplay(){
	global $mysqli;

	if(isset($_POST['del'])){
		$id = $_POST['cid'];
		$query = "UPDATE church SET church_status = 'inactive' WHERE church_id = $id";
		mysqli_query($mysqli,$query);
	}
}



function churchinfo(){
	global $mysqli;

	$church_id = $_GET['church'];

	$query = "SELECT * FROM church  WHERE church_id = $church_id";
	
	$run_query = mysqli_query($mysqli,$query);

	if ($run_query) {

	    $row_query = mysqli_fetch_array($run_query);
		$id = $row_query['church_id'];
		$church = $row_query['church_name'];
		$address = $row_query['church_address'];
		$info = $row_query['church_info'];

		$church_info = $row_query['church_info'];
		
		echo '<div class="ui primary segment">
			<h2 class="ui header">'.$church.'</h2>
			<div class="ui divider"></div>
			'.$info.'
		</div>
			';
	}
  }


 function displaySched(){
 	global $mysqli;
 	
    

	$query = "SELECT * FROM schedule JOIN church  ON church_id = schedule_church_id JOIN admin ON admin_church_id = church_id WHERE schedule_status = 'active'";
    $run_query = mysqli_query($mysqli,$query);
    $run_query = mysqli_query($mysqli,$query);


	if (!$run_query) {
		printf("Error: %s\n", mysqli_error($mysqli));
		exit();
	}


    while ($row_query = mysqli_fetch_array($run_query)) {
		$stime = $row_query['schedule_starttime'];
        $etime = $row_query['schedule_endtime'];
		$day = $row_query['schedule_day'];
		$church = $row_query['church_name'];
		$address = $row_query['church_address'];
		$contact = $row_query['admin_contact'];
		$event = $row_query['schedule_event'];

		echo '
			<tr>
				<td>'.$stime.'</td>
				<td>'.$day.'</td>
				<td>'.$event.'</td>
				<td>'.$church.'</td>
				<td>'.$address.'</td>
				<td>
					<div class="ui vertical animated tiny blue button" tabindex="0">
						<div class="visible content">
							<i class="pencil icon"></i>
						</div>
						<div class="hidden content">Edit</div>
					</div>
					<div class="ui vertical animated tiny red button" tabindex="0">
						<div class="visible content">
							<i class="trash icon"></i>
						</div>
						<div class="hidden content">Remove</div>
					</div>
				</td>
			</tr> ';
    }
}

function displaySchedule()
{
	global $mysqli;
    
    $n = $_GET['page'];
        
    $page = ($n * 10)-10;
	$query = "SELECT * FROM schedule JOIN church  ON church_id = schedule_church_id JOIN admin ON admin_church_id = church_id LIMIT ".$page.",10";
    $run_query = mysqli_query($mysqli,$query);


	if (!$run_query) {
		printf("Error: %s\n", mysqli_error($mysqli));
		exit();
	}


    while ($row_query = mysqli_fetch_array($run_query)) {
		$stime = $row_query['schedule_starttime'];
        $etime = $row_query['schedule_endtime'];
		$day = $row_query['schedule_day'];
		$church = $row_query['church_name'];
		$address = $row_query['church_address'];
		$contact = $row_query['admin_contact'];
		$event = $row_query['schedule_event'];

		echo '
			<tr>
				<td>'.$event.'</td>
				<td>'.$church.'</td>
				<td>'.$day.'</td>
				<td>'.$stime.'</td>
			</tr> ';
    }
}


?>
