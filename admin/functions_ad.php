<?php 

include("../sql_connect.php");


function sessionAdmin()
{
	session_start();

    if(isset($_SESSION['username'])==""){
        header("location:../login.php");
    }
}

function dashboard(){
	global $mysqli;

	
	$id = $_SESSION['account_id'];

	$query_admin = "SELECT * FROM admin WHERE admin_account_id = ".$id;
	$result_admin = mysqli_query($mysqli,$query_admin);
	$row_admin = mysqli_fetch_array($result_admin);

	$id = $row_admin['admin_church_id'];

	$query_church = "SELECT * FROM church WHERE church_id = ".$id;
	
	$result_church = mysqli_query($mysqli,$query_church);

    $row_church = mysqli_fetch_array($result_church);
	$church = $row_church['church_name'];
	$address = $row_church['church_address'];
	$church_info = $row_church['church_info'];
	$cid = $row_church['church_id'];


	echo '<div class="ui segment">
				<h1 class="ui grey dividing header">
					<img src="../img/church.png" class="ui huge image">
					<div class="content">
			          '.$church.'
		              <div class="sub header">Displays the church information</div>
	            	</div>
            		<div class="two wide column"></div>
        		</h1>
        		<p>	'.$church_info.'</p>
        		<div class="ui hidden divider"></div>
        		<button onclick="edit_info('.$cid.')" class="ui facebook button"><i class="add icon"></i>EDIT CHURCH INFO</button>
			</div>';
}
function timelist()
{
	$output = '';
	for($i=3; $i<21; $i++){
		$t = $i - 12;
		for($j=0; $j<=45;$j+=15){
		    
		    $s = ($i < 12) ? 'AM' : 'PM';
			if($j==0 && $i > 12){
				$output .='<option value="'.$t.':'.$j.'0 '.$s.'">'.$t.':'.$j.'0 '.$s.'</option>';
			}else if($i > 12 && $j != 0){
				$output.='<option value="'.$t.':'.$j.' '.$s.'">'.$t.':'.$j.' '.$s.'</option>';
			}else if($j == 0){
				$output.= '<option value="'.$i.':'.$j.'0 '.$s.'">'.$i.':'.$j.'0 '.$s.'</option>';
			}else{
				$output.= '<option value="'.$i.':'.$j.' '.$s.'">'.$i.':'.$j.' '.$s.'</option>';

			}	
		}
	}
	$output.= '<option value="9:00 PM">9:00 PM</option>';
	return $output;
}

function accinfo(){
	global $mysqli;
     
    $id = $_GET['aid'];
	$query = "SELECT * FROM account JOIN admin ON admin_account_id = account_id WHERE account_id =".$id;

	$result = mysqli_query($mysqli,$query);
	$row_query = mysqli_fetch_array($result);

	$contact = $row_query['admin_contact'];
	$password = $row_query['account_password'];


	echo '
	<form class="ui form" method = "POST" action = "index.php?id='.$id.'">
		<div class="field">
			<label>Contact Number</label>
			<input type="number" name="newnum" value="'.$contact.'">
		</div>
		<div class="field">
			<label>Password</label>
			<input type="password" name="newpass" value="'.$password.'">
		</div>
		<div class="field">
			<label>Re-enter Password</label>
			<input type="password" name="newpass2">
		</div>
		<button class="ui google plus button"><i class="remove icon"></i>Cancel</button>
		<button class="ui facebook button" name="updateacc"><i class="pencil icon"></i>Update</button>
	</form>';
}
function manageacc()
{
	global $mysqli;
    if(isset($_POST['updateacc'])){
$password = $_POST['newpass'];
	$password2 = $_POST['newpass2'];
	$contact = $_POST['newnum'];
	$id = $_GET['id'];

    if($password == $password2){
    	$query = "UPDATE account SET account_password=".$password;
    	mysqli_query($mysqli,$query);
    	$query1 = "UPDATE admin SET admin_contact=".$contact." WHERE admin_account_id=".$id;
    	mysqli_query($mysqli,$query1);
    }
    }
	
}
	
function timemass($day)
{
	$output = '';
	for($i=3; $i<21; $i++){
		$t = $i - 12;
		for($j=0; $j<=45;$j+=15){
		    $s = "";
		    $s = ($i < 12) ? "AM" : "PM";
			if($j==0 && $i > 12){
				$output .= '<div class="ui checkbox"><input type="checkbox" name="'.$day.'[]" class="get_value" value="'.$t.':'.$j.'0 '.$s.'"><label>'.$t.':'.$j.'0 '.$s.'</label></div>';
			}else if($i > 12 && $j != 0){
				$output .= '<div class="ui checkbox"><input type="checkbox" name="'.$day.'[]" class="get_value" value="'.$t.':'.$j.' '.$s.'" ><label>'.$t.':'.$j.' '.$s.'</label></div>';
			}else if($j == 0){
				$output .= '<div class="ui checkbox"><input type="checkbox" name="'.$day.'[]" class="get_value" value="'.$i.':'.$j.'0 '.$s.'"><label>'.$i.':'.$j.'0 '.$s.'</label></div>';
			}else{
				$output .= '<div class="ui checkbox"><input type="checkbox" name="'.$day.'[]" class="get_value" value="'.$i.':'.$j.' '.$s.'"><label>'.$i.':'.$j.' '.$s.'</label></div>';
			}	
		}
	}
	$output .= '<div class="ui checkbox"><input type="checkbox" name=""><label>9:00 PM</label></div>';

	return $output;
}
function churchinfo(){
	global $mysqli;

	
	$id = $_SESSION['account_id'];

	$query_admin = "SELECT * FROM admin WHERE admin_account_id = ".$id;
	$result_admin = mysqli_query($mysqli,$query_admin);
	$row_admin = mysqli_fetch_array($result_admin);

	$id = $row_admin['admin_church_id'];

	$query_church = "SELECT * FROM church WHERE church_id = ".$id;
	
	$result_church = mysqli_query($mysqli,$query_church);

    $row_church = mysqli_fetch_array($result_church);
	$church = $row_church['church_name'];
	$address = $row_church['church_address'];
	$address = $row_church['church_address'];
	$church_info = $row_church['church_info'];
	$cid = $row_church['church_id'];
	
	echo '  <div class="ui stackable two column grid">
			<div class="column">
				<h1 class="ui header">
					<div class="content">
						'.$church.'
					</div>
				</h1>
			</div>
			<div class="middle aligned column">
				<button class="ui right floated labeled blue icon button" type="button" onclick="edit_info('.$cid.');"><i class="pencil icon"></i>Edit church info</button>
			</div>
		</div>
			<div class="ui divider"></div>'.$church_info.'
			<h5 class="ui header">Address: <strong>'.$address.'</strong></h5>';

    $query_admin = "SELECT * FROM admin WHERE admin_church_id = ".$id;
    $result_admin = mysqli_query($mysqli,$query_admin);

    $row_admin = mysqli_fetch_array($result_admin);
    $cnt = mysqli_num_rows($result_admin);
    if($cnt > 0 ){
    	$contact = $row_admin['admin_contact'];
		$name = $row_admin['admin_name'];
    }else{
    	$contact = "N/A";
		$name = "N/A";
    }
   
    echo'
	<h5 class="ui header">Contact Person: <strong>'.$name.'</strong></h5>
	<h5 class="ui header">Contact Number: <strong>'.$contact.'</strong></h5>
	</div> <!-- segment -->
			';
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
	}
}
function addschedule()
{
	global $mysqli;

	if(isset($_POST['submit'])){
		$event = $_POST['event'];
		$id = $_SESSION['account_id'];
		$radio = $_POST['radio'];
		$specsched = $_POST['specsched'];

		$query = "SELECT * FROM admin  WHERE admin_account_id = $id";
		$result = mysqli_query($mysqli,$query);
		$row_admin = mysqli_fetch_array($result);

		$church = $row_admin['admin_church_id'];
	
        if($radio == '1' ){
        	

		 $query1= "INSERT INTO `schedule`(`schedule_specific_sched`,`schedule_event`, `schedule_church_id`) VALUES ('$specsched','$event',$church)";
        }else{
			$start = $_POST['start'];
			$end = $_POST['end'];
			$week = $_POST['week'];
			$day = $_POST['day'];
        	$query1= "INSERT INTO `schedule`(`schedule_starttime`, `schedule_endtime`, `schedule_day`, `schedule_week`, `schedule_event`, `schedule_church_id`) VALUES ('$start','$end','$day','$week','$event',$church)";
        }


		$result1 = mysqli_query($mysqli,$query1);

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
<form class='ui form' method='POST' action='index.php?cid=".$id."'>
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
					<textarea name='info' class='tinymce' value=$info> </textarea>
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


function displaySchedule()
{
	global $mysqli;

    $n = $_GET['page'];
    $page = ($n * 10)-10;

	$query = "SELECT * FROM schedule JOIN church  ON church_id = schedule_church_id JOIN admin ON admin_church_id = church_id WHERE schedule_status = 'active' LIMIT ".$page.",10";
    $run_query = mysqli_query($mysqli,$query);

    while ($row_query = mysqli_fetch_array($run_query)) {
		$stime = $row_query['schedule_starttime'];
		$day = $row_query['schedule_day'];
		$church = $row_query['church_name'];
		$address = $row_query['church_address'];
		$contact = $row_query['admin_contact'];
		$event = $row_query['schedule_event'];
		$sid = $row_query['schedule_id'];
		$specsched = $row_query['schedule_specific_sched'];

		if($event != "Mass"){
			$etime = $row_query['schedule_endtime'];
			$week = $row_query['schedule_week'];
		}else{
			$etime = "-------------";
			$week =  "-------------";
		}

        if(empty($specsched)){
        	$specsched = "---------------------";
        }else{
        	$stime = "-------------";
        	$etime = "-------------";
        	$day = "-------------";
        	$week = "-------------";
        }
		echo "
			<tr>
				<td class='one wide'>".$event."</td>
			    <td class='three wide'>".$specsched."</td>
				<td class='two wide'>".$stime."</td>
				<td class='two wide'>".$etime."</td>
				<td class='two wide'>".$day."</td>
				<td class='two wide'>".$week."</td>
				
				<td class='six wide'>
					<button type='button' class='ui facebook button' onclick='sched_info(".$sid.");'><i class='pencil icon'></i>Edit</button>
					<a class='ui google plus button delete' name='del' data-id='".$sid."'><i class='ban icon'></i>Remove</a>
				    
						</td>
						
			</tr> ";

    }
}


// <button class=''></button>
// 					<button type='button' class='ui vertical animated blue button' tabindex='0' onclick='sched_info(".$sid.");'>
// 								<div class='visible content' >
// 									<i class='pencil icon'></i>
// 								</div>
// 								<div class='hidden content'>Edit</div>
// 							</button>
// 							<button class='ui vertical animated red button' tabindex='0' name='del'>
// 								<div class='visible content'>
// 									<i class='trash icon'></i>
// 								</div>
// 								<div class='hidden content'>Remove</div>
								
// 							</button>
// 							<input type='hidden' name ='sid' value = '$sid' />

function pages($url,$table){
 	global $mysqli;

 	
 	$query = "SELECT * FROM ".$table." WHERE ".$table."_status='active'";
 	// print_r($query);
    
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
     
function editSchedule(){
	global $mysqli;
	if(isset($_POST['edit'])){
		$id = $_GET['sid'];
	    $event = $_POST['event'];
	    $start = $_POST['start'];
	    $day = $_POST['day'];
	    $week = $_POST['week'];
	    $end = $_POST['end'];
	    if($event != 'Mass'){
	    	$query =" UPDATE schedule SET schedule_starttime='".$start."',schedule_endtime='".$end."',schedule_day='".$day."',schedule_week='".$week."' WHERE schedule_id= ".$id;
	    	$result= mysqli_query($mysqli,$query);
	    }else{
	    	$query =" UPDATE schedule SET schedule_starttime='".$start."' WHERE schedule_id= ".$id;
	    	$result= mysqli_query($mysqli,$query);
	    }
	}
	
}
function displaySchedInfo(){
	global $mysqli;
	$id = $_GET['sid'];

	$query = "SELECT * FROM schedule WHERE schedule_status = 'active' AND schedule_id =".$id;
	$result = mysqli_query($mysqli,$query);
	$row_query = mysqli_fetch_array($result);

	$event = $row_query['schedule_event'];
	$end = $row_query['schedule_endtime'];
	$start = $row_query['schedule_starttime'];
	$day = $row_query['schedule_day'];
	$week = $row_query['schedule_week'];

	echo"<div class='disabled field'>
			<label>Service</label>
			<input type='text' name='event' value='".$event."'>
		</div>
		<div class='four fields'> 
			<div class='field'>
				<label>Start Time</label>
				<select class='ui search dropdown' name='start'>
					<option value='".$start."'>".$start."</option>
					".timelist()."
				</select>
			</div>
				";
	if($event != 'Mass'){
		echo "
					<div class='field'>
						<label>End Time</label>
						<select class='ui search dropdown' name='end'>
							<option value='".$end."'>".$end."</option>
							".timelist()."
						</select>
					</div>

					<div class='field'>
						<label>Week</label>
						<select class='ui search dropdown' name='week'>
							<option value='".$week."'>".$week."</option>
							<option>1st</option>
							<option>2nd</option>
							<option>3rd</option>
							<option>4th</option>
						</select>
					</div> 
					<div class='field'>
						<label>Day</label>
						<select class='ui search dropdown' name='day'>
							<option value='".$day."'>".$day."</option>
							<option>Sunday</option>
							<option>Monday</option>
							<option>Tuesday</option>
							<option>Wednesday</option>
							<option>Thursday</option>
							<option>Friday</option>
							<option>Saturday</option>
						</select>
					</div>
				</div>
			</div>";
					
	}else{
		echo "<div class='disabled field'>
						<label>End Time</label>
						<select class='ui disabled search dropdown' name='end'>
							<option value=''>Select time</option>
							".timelist()."
						</select>
					</div>
					<div class='disabled field'>
						<label>Week</label>
						<select class='ui search dropdown' name='week'>
							<option value=''>Select day</option>
							<option>1st</option>
							<option>2nd</option>
							<option>3rd</option>
							<option>4th</option>
						</select>
					</div>
					<div class='disabled field'>
						<label>Day</label>
						<select class='ui search dropdown' name='day'>
							<option value='".$day."'>".$day."</option>
							<option>Sunday</option>
							<option>Monday</option>
							<option>Tuesday</option>
							<option>Wednesday</option>
							<option>Thursday</option>
							<option>Friday</option>
							<option>Saturday</option>
						</select>
					</div>
				</div>
			</div>";
	}
}
function updateDisplay(){
    	global $mysqli;

    	if(isset($_POST['del'])){
    		$sid = $_POST['sid'];
    		$query = "UPDATE schedule SET schedule_status = 'inactive' WHERE schedule_id = ".$sid;
    		mysqli_query($mysqli,$query);
    	}
    }


function addMass()
{

	global $mysqli;

	if(isset($_POST['submit'])){
		$id = $_SESSION['account_id'];
        $query = "SELECT * FROM admin  WHERE admin_account_id = $id";
			$result = mysqli_query($mysqli,$query);
			$row_admin = mysqli_fetch_array($result);

			$church = $row_admin['admin_church_id'];

		if(isset($_POST['sun'])){
			$sun= $_POST['sun']; 
			foreach($sun as $suntime){ 
				$query1="INSERT INTO `schedule`(`schedule_starttime`, `schedule_event`,`schedule_day`, `schedule_church_id`) VALUES('" . $suntime . "','Mass','Sunday','".$church."')"; 
				$result1=mysqli_query($mysqli,$query1); 
			}
		}
		if(isset($_POST['mon'])){
			$mon= $_POST['mon']; 
			foreach($mon as $montime){ 
				$query1="INSERT INTO `schedule`(`schedule_starttime`, `schedule_event`,`schedule_day`, `schedule_church_id`) VALUES('" . $montime . "','Mass','Monday','".$church."')"; 
				$result1=mysqli_query($mysqli,$query1); 

			}
		}
		if(isset($_POST['tue'])){
			$tue= $_POST['tue']; 
			foreach($tue as $tuetime){ 
				$query1="INSERT INTO `schedule`(`schedule_starttime`, `schedule_event`,`schedule_day`, `schedule_church_id`) VALUES('" . $tuetime . "','Mass','Tuesday','".$church."')"; 
				$result1=mysqli_query($mysqli,$query1); 

			}
		}
		if(isset($_POST['wed'])){
			$wed= $_POST['wed'];
			foreach($wed as $wedtime){ 
				$query1="INSERT INTO `schedule`(`schedule_starttime`, `schedule_event`,`schedule_day`, `schedule_church_id`) VALUES('" . $wedtime . "','Mass','Wednesday','".$church."')"; 
				$result1=mysqli_query($mysqli,$query1); 

			}
		}
		if(isset($_POST['thu'])){
			$thu= $_POST['thu']; 
			foreach($thu as $thutime){ 
				$query1="INSERT INTO `schedule`(`schedule_starttime`, `schedule_event`,`schedule_day`, `schedule_church_id`) VALUES('" . $thutime . "','Mass','Thursday','".$church."')"; 
				$result1=mysqli_query($mysqli,$query1); 

			}
		}
		if(isset($_POST['fri'])){
			$fri= $_POST['fri']; 
			foreach($fri as $fritime){ 
				$query1="INSERT INTO `schedule`(`schedule_starttime`, `schedule_event`,`schedule_day`, `schedule_church_id`) VALUES('" . $fritime . "','mass','Friday','".$church."')"; 
				$result1=mysqli_query($mysqli,$query1); 

			}
		}
		if (isset($_POST['sat'])) {
			$sat= $_POST['sat']; 
			foreach($sat as $sattime){ 
				$query1="INSERT INTO `schedule`(`schedule_starttime`, `schedule_event`,`schedule_day`, `schedule_church_id`) VALUES('" . $sattime . "','Mass','Saturday','".$church."')"; 
				$result1=mysqli_query($mysqli,$query1); 

			}
		}
	}


}

 

?>