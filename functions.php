<?php

     include("sql_connect.php");

     function displayMassHome()
     {
        global $mysqli;

        // $query = "SELECT TIME_FORMAT(schedule_starttime, '%h:%i %p') as 'schedule_starttime',schedule_day,church_name, church_address FROM schedule JOIN church ON church_id = schedule_church_id WHERE schedule_event = 'mass' LIMIT 5";
        $query = "SELECT * FROM schedule JOIN church ON church_id = schedule_church_id WHERE schedule_status = 'active' AND schedule_event = 'mass' LIMIT 5";
        $run_query = mysqli_query($mysqli,$query);

		if (!$run_query) {
    		printf("Error: %s\n", mysqli_error($mysqli));
    		exit();
		}

		$cnt=mysqli_num_rows($run_query);

		if($cnt!=0){

			echo 
			'

			<table class="ui fixed very basic mobile tablet small monitor only stackable celled padded striped table">
				<thead>
					<tr>
						<th>SCHEDULE</th>
						<th>DAY</th>
						<th>CHURCH</th>
						<th>ADDRESS</th>
					</tr>
				</thead>
				<tbody>
			';

	
			while ($row_query = mysqli_fetch_array($run_query)) {
				$time = $row_query['schedule_starttime'];
				$day = $row_query['schedule_day'];
				$church = $row_query['church_name'];
				$address = $row_query['church_address'];

				echo 
				"
				<tr>
					<td>$time</td>
					<td>$day</td>
					<td>$church</td>
					<td>$address</td>
				</tr> ";
		    }
			echo 	'</tbody>
				</table> <!-- table -->
				<button class="ui basic icon button" value="View More" onclick="open_churches()" name="">View More</button>';
		}else{
			echo "<div class='ui grid'>
					<div class='row'></div>
					<div class='sixteen wide column'>
						<div class='ui grey inverted segment'>
							<center><h3><i class='warning circle icon'></i>No schedules to display.</h3></center>
						</div>
					</div>
				</div>";
		}

	        
 
     }

function dropdownaddress()
{
	global $mysqli;
	$query = "SELECT * FROM church WHERE church_status = 'active'";
	$result = mysqli_query($mysqli,$query);

	while($row=mysqli_fetch_array($result)){
		$add = $row['church_address'];
		echo "<option value='".$add."'>".$add."</option>";
	}
}
function dropdownchurch()
{
	global $mysqli;
	$query = "SELECT * FROM church WHERE church_status = 'active'";
	$result = mysqli_query($mysqli,$query);

	while($row=mysqli_fetch_array($result)){
		$name = $row['church_name'];
		echo "<option value='".$name."'>".$name."</option>";
	}
}
function login(){
    global $mysqli;
    session_start();
    if(isset($_POST['username']) && isset($_POST['password'])){
        $query =  "SELECT * FROM account WHERE
                                account_username = '".$_POST['username']."'
                            AND account_password = '".$_POST['password']."'";

        $result=mysqli_query($mysqli,$query);
        $row_admin = mysqli_fetch_array($result);
      
        if(mysqli_num_rows($result)==1){
            $_SESSION['username']=$_POST['username'];
            $_SESSION['account_id'] = $row_admin['account_id'];

            if($result){
            	if($row_admin['account_type']=='admin'){
                 	header("location:admin/index.php");
            	}else{
            		header("location:superadmin/home.php");
            	}
            }
        }else{
            echo "<script>alert('Invalid Username or Password')</script>";
         }
         
    }
}

function displaySched($event)
     {
        global $mysqli;

        $query = "SELECT *
        		  FROM schedule JOIN church 
        		  ON church_id = schedule_church_id JOIN admin 
        		  ON admin_church_id = church_id 
        		  WHERE schedule_status = 'active' AND schedule_event = '$event' LIMIT 10";
        $run_query = mysqli_query($mysqli,$query);


		if (!$run_query) {
    		printf("Error: %s\n", mysqli_error($mysqli));
    		exit();
		}

		$cnt=mysqli_num_rows($run_query);

		if($cnt!=0){
			if($event=="Baptism"){
				echo
				'
				<table class="ui fixed very basic mobile tablet small monitor only stackable celled padded striped table">
				<thead>
					<tr>
						<th>CHURCH</th>
						<th>ADDRESS</th>
						<th>TIME</th>
						<th>DAY/WEEK</th>
						<th>CONTACT NUMBER</th>
					</tr>
				</thead>
				<tbody>
				';
			}else{
				echo
				'
				<table class="ui fixed very basic mobile tablet small monitor only stackable celled padded striped table">
				<thead>
					<tr>
						<th>CHURCH</th>
						<th>ADDRESS</th>
						<th>START TIME</th>
						<th>END TIME</th>
						<th>DAY/WEEK</th>
						<th>CONTACT NUMBER</th>
					</tr>
				</thead>
				<tbody>
				';
			}
			while ($row_query = mysqli_fetch_array($run_query)) {
				$stime = $row_query['schedule_starttime'];
	            $etime = $row_query['schedule_endtime'];
				$day = $row_query['schedule_day'];
				$church = $row_query['church_name'];
				$address = $row_query['church_address'];
				$contact = $row_query['admin_contact'];

				if($event == "Baptism"){
					echo "
					<tr>
						<td id='church'>$church</td>
						<td id='address'>$address</td>
						<td id='stime'>$stime</td>
						<td id='day'>$day</td>
						<td id='contact'>$contact</td>
					</tr> ";
				}else{
					echo "
				<tr>
					<td id='church'>$church</td>
					<td id='address'>$address</td>
					<td id='stime'>$stime</td>
					<td id='etime'>$etime</td>
					<td id='day'>$day</td>
					<td id='contact'>$contact</td>
				</tr> ";
				}

				
		    }
		    echo '</tbody>
				</table>
				';

		}else{
			echo "
				<div class='ui grid'>
					<div class='row'></div>
					<div class='sixteen wide column'>
						<div class='ui grey inverted segment'>
							<center><h3><i class='warning circle icon'></i>No schedules to display.</h3></center>
						</div>
					</div>
				</div>
			";
		}
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
	return $output;
}
 function displayMassSched()
 {
        global $mysqli;

        // $query = "SELECT TIME_FORMAT(schedule_starttime, '%h:%i %p') as 'schedule_starttime',schedule_day,church_name, church_address FROM schedule JOIN church ON church_id = schedule_church_id JOIN admin ON admin_church_id = church_id WHERE schedule_event = 'mass' LIMIT 10";
       
        $n = $_GET['page'];
        
        $page = ($n * 10)-10;
        $query = "SELECT * FROM schedule JOIN church ON church_id = schedule_church_id JOIN admin ON admin_church_id = church_id WHERE schedule_status = 'active' AND schedule_event = 'Mass' LIMIT ".$page.",10";
        $run_query = mysqli_query($mysqli,$query);

		$cnt=mysqli_num_rows($run_query);

		echo '
			
		';

		if($cnt!=0){
			echo '

			<table class="ui fixed very basic mobile tablet small monitor only stackable celled padded striped table">
				<thead>
					<tr>
						<th>CHURCH</th>
						<th>ADDRESS</th>
						<th>TIME</th>
						<th>DAY/WEEK</th>
					</tr>
				</thead>
				<tbody>
			';
			while ($row_query = mysqli_fetch_array($run_query)) {
				$time = $row_query['schedule_starttime'];
				$day = $row_query['schedule_day'];
				$church = $row_query['church_name'];
				$address = $row_query['church_address'];

				echo "
				<tr>
					<td>$church</td>
					<td>$address</td>
					<td>$time</td>
					<td>$day</td>
				</tr> ";
		    }
			echo '</tbody>
				</table>
				';
		}else{
			echo "
				<div class='ui grid'>
					<div class='row'></div>
					<div class='sixteen wide column'>
						<div class='ui grey inverted segment'>
							<center><h3><i class='warning circle icon'></i>No schedules to display.</h3></center>
						</div>
					</div>
				</div>
			";
		}
     }
     function displayServiceHome()
     {
        global $mysqli;

        // $query = "SELECT TIME_FORMAT(schedule_starttime, '%h:%i %p') as 'schedule_starttime',schedule_event,church_name,church_address FROM schedule JOIN church ON church_id = schedule_church_id WHERE schedule_event != 'mass' LIMIT 10";
        $query = "SELECT * FROM schedule JOIN church ON church_id = schedule_church_id WHERE schedule_status = 'active' AND schedule_event != 'mass' LIMIT 10";
        $run_query = mysqli_query($mysqli,$query);

		if (!$run_query) {
    		printf("Error: %s\n", mysqli_error($mysqli));
    		exit();
		}

		$cnt=mysqli_num_rows($run_query);
		if($cnt!=0){
			echo 
			'
			<table class="ui fixed very basic mobile tablet small monitor only stackable celled padded striped table">
				<thead>
					<tr>
						<th>SERVICE</th>
						<th>SCHEDULE</th>
						<th>DAY</th>
						<th>CHURCH</th>
						<th>ADDRESS</th>
					</tr>
				</thead>
				<tbody>
			';

			while ($row_query = mysqli_fetch_array($run_query)) {
				$time = $row_query['schedule_starttime'];
				$event = $row_query['schedule_event'];
				$day = $row_query['schedule_day'];
				$church = $row_query['church_name'];
				$address = $row_query['church_address'];
				
				echo "
				<tr>
					<td>$event</td>
					<td>$time</td>
					<td>$day</td>
					<td>$church</td>
					<td>$address</td>
				</tr> ";
		    }
			echo '</tbody>
				</table> <!-- table -->
				<button class="ui basic icon button" value="View More" onclick="open_services()" name="">View More</button>';
		}else{
			echo "<div class='ui grid'>
					<div class='row'></div>
					<div class='sixteen wide column'>
						<div class='ui grey inverted segment'>
							<center><h3><i class='warning circle icon'></i>No schedules to display.</h3></center>
						</div>
					</div>
				</div>";
		}
 
     }

function displayAllServices()
     {
        global $mysqli;

        // $query = "SELECT TIME_FORMAT(schedule_starttime, '%h:%i %p') as 'schedule_starttime',
        // TIME_FORMAT(schedule_starttime, '%h:%i %p') as 'schedule_endtime',schedule_day,
        // schedule_event,church_name,church_address,admin_contact FROM schedule JOIN church 
        // ON church_id = schedule_church_id  JOIN admin ON admin_church_id = church_id LIMIT 10";
 
        $n = $_GET['page'];
        $page = ($n * 10)-10;

        $query = "SELECT * FROM schedule JOIN church 
        ON church_id = schedule_church_id  JOIN admin ON admin_church_id = church_id WHERE schedule_status = 'active' LIMIT ".$page.",10";
        $run_query = mysqli_query($mysqli,$query);

		if (!$run_query) {
    		printf("Error: %s\n", mysqli_error($mysqli));
    		exit();
		}

		$cnt=mysqli_num_rows($run_query);

		if($cnt!=0){
			echo 
			'
				<table class="ui fixed very basic mobile tablet small monitor only stackable celled padded striped table">
				<thead>
					<tr>
						<th>SERVICE</th>
						<th>CHURCH</th>
						<th>ADDRESS</th>
						<th>START TIME</th>
						<th>END TIME</th>
						<th>DAY</th>
						<th>WEEK</th>
						<th>CONTACT NUMBER</th>
					</tr>
				</thead>
				<tbody>
			';
			while ($row_query = mysqli_fetch_array($run_query)) {

	        	$service = $row_query['schedule_event'];
	        	if($service == "Mass"){
	        		$etime="------------";
	        		$week ="------------";
	        	}else{
	        		$etime = $row_query['schedule_endtime'];
	        		$week = $row_query['schedule_week'];
	        	}
				$stime = $row_query['schedule_starttime'];
				$day = $row_query['schedule_day'];
				$church = $row_query['church_name'];
				$address = $row_query['church_address'];
				$contact = $row_query['admin_contact'];
	            
				echo "
				<tr>
					<td>$service</td>
					<td>$church</td>
					<td>$address</td>
					<td>$stime</td>
					<td>$etime</td>
					<td>$day</td>
					<td>$week</td>
					<td>$contact</td>
				</tr> ";
		    }
		    echo '</tbody>
				</table>';
		}else{
			echo "<div class='ui grid'>
					<div class='row'></div>
					<div class='sixteen wide column'>
						<div class='ui grey inverted segment'>
							<center><h3><i class='warning circle icon'></i>No schedules to display.</h3></center>
						</div>
					</div>
				</div>";
		}
 
	        
	 
     }
     function displayChurches()
     {
        global $mysqli;

        $n = $_GET['page'];
        $page = ($n * 10)-10;
        
        $query = "SELECT * FROM church WHERE church_status = 'active' LIMIT ".$page.",10";
        $result = mysqli_query($mysqli,$query);
     
        $cnt=mysqli_num_rows($result);

        if($cnt !=0){
        	echo
			'
			<table class="ui fixed very basic mobile tablet small monitor only stackable celled padded striped table">
				<thead>
					<tr>
						<th>CHURCH</th>
						<th>ADDRESS</th>
					</tr>
				</thead>
				<tbody>
			';
	        while ($row_query = mysqli_fetch_array($result)) {
				$church = $row_query['church_name'];
				$address = $row_query['church_address'];
				$cid = $row_query['church_id'];
				
				
				echo "
				<tr class='clickable-row' onclick='open_info($cid);'>
					<td class='eight wide'>$church</td>
					<td class='eight wide'>$address</td>
				</tr> ";
		    }
		    echo '</tbody>
				</table>';
        }else{
        	echo "<div class='ui grid'>
					<div class='row'></div>
					<div class='sixteen wide column'>
						<div class='ui grey inverted segment'>
							<center><h3><i class='warning circle icon'></i>No churches to display.</h3></center>
						</div>
					</div>
				</div>";
        }
	    
        
     }
     function pages($url,$table,$event){
 	global $mysqli;

 	if($event == ""){
 		$query = "SELECT * FROM ".$table." WHERE ".$table."_status = 'active'";
 	}else{
 		$query = "SELECT * FROM ".$table." WHERE ".$table."_status = 'active' AND schedule_event='".$event."'";
 	}
    
    $result = mysqli_query($mysqli,$query);
    $cnt = mysqli_num_rows($result);
    $npage = $cnt/10;
    $npage = ceil($npage);

    echo "<div class='six wide left aligned column'>";
    $page = $_GET['page'];
    if($npage ==0){
    	echo "Page <strong> ".$page." </strong> out of 1 pages" ;
    }else{
    	echo "Page <strong> ".$page." </strong> out of ".$npage." pages" ;
    }
	echo "</div>";

    echo' <div class="six wide right aligned column">
			<div class="ui pagination menu" > ';
    if($cnt == 0){
    	echo "<a href = '".$url."?page=1' class='item'>1</a>";
    }else{
    	
    	for($n=1; $n<=$npage; $n++){
			echo "<a href = '".$url."?page=".$n."' class='item'>".$n."</a>";
		}
    }
    echo "</div>
    	</div>";
    
 }
     
  //    function displayChurchesHome()
  //    {
  //       global $mysqli;

  //       $query = "SELECT * FROM church WHERE church_status='active' LIMIT 5";
  //       $run_query = mysqli_query($mysqli,$query);

		// $cnt=mysqli_num_rows($run_query);

		// if($cnt > 0){
		// 	echo '<table class="ui fixed very basic mobile tablet small monitor stackable table">
		// 						<thead>
		// 							<tr>
		// 								<th class="eight wide">Church Name</th>
		// 								<th class="eight wide">Address</th>
		// 							</tr>
		// 						</thead>
		// 						<tbody>';
		// 	while ($row_query = mysqli_fetch_array($run_query)) {
	 //        	$id = $row_query['church_id'];
		// 		$church = $row_query['church_name'];
		// 		$address = $row_query['church_address'];
				
		// 		echo "
		// 		<tr class='clickable-row' onclick='open_info($id);'>
		// 			<td>$church</td>
		// 			<td>$address</td>
		// 		</tr> ";
		//     }
		//     echo '</tbody>
		// 					</table>';
		// }else{
		// 	echo '<i class="warning circle icon"></i>No church to display.';
		// }
  //    }

     function search($event,$option1,$option2,$option3){
			global $mysqli;
		    $output = '';
		   
		    $n = $_GET['page'];
    		$page = ($n * 10)-10;

    		if($option1 != "" && $option2=="" && $option3==""){
    			 $query = "SELECT * FROM schedule JOIN church 
        		  ON church_id = schedule_church_id JOIN admin 
        		  ON admin_church_id = church_id WHERE  schedule_status = 'active' AND schedule_event = '$event' AND church_name LIKE '%$option1%' LIMIT ".$page.",10";
    		}else if($option1 == "" && $option2 !="" && $option3==""){
    			 $query = "SELECT * FROM schedule JOIN church 
        		  ON church_id = schedule_church_id JOIN admin 
        		  ON admin_church_id = church_id WHERE  schedule_status = 'active' AND schedule_event = '$event' AND church_address LIKE '%$option2%' LIMIT ".$page.",10";
    		}else if($option1 == "" && $option2=="" && $option3!=""){
    			 $query = "SELECT * FROM schedule JOIN church 
        		  ON church_id = schedule_church_id JOIN admin 
        		  ON admin_church_id = church_id WHERE  schedule_status = 'active' AND schedule_event = '$event' AND schedule_starttime LIKE '%$option3%' LIMIT ".$page.",10";
    		}else if($option1 != "" && $option2=="" && $option3!=""){
    			 $query = "SELECT * FROM schedule JOIN church 
        		  ON church_id = schedule_church_id JOIN admin 
        		  ON admin_church_id = church_id WHERE  schedule_status = 'active' AND schedule_event = '$event' AND church_name LIKE '%$option1%' AND schedule_starttime LIKE '%$option3%' LIMIT ".$page.",10";
    		}else if($option1 == "" && $option2 !="" && $option3==""){
    			 $query = "SELECT * FROM schedule JOIN church 
        		  ON church_id = schedule_church_id JOIN admin 
        		  ON admin_church_id = church_id WHERE  schedule_status = 'active' AND schedule_event = '$event' AND church_address LIKE '%$option2%' AND schedule_starttime LIKE '%$option3%' LIMIT ".$page.",10";
    		}else if($option1 == "" && $option2=="" && $option3==""){
    			 $query = "SELECT * FROM schedule JOIN church 
        		  ON church_id = schedule_church_id JOIN admin 
        		  ON admin_church_id = church_id WHERE  schedule_status = 'active' AND schedule_event = '$event' AND church_name LIKE '%$option1%' AND church_address LIKE '%$option2%' AND schedule_starttime LIKE '%$option3%' LIMIT ".$page.",10";
    		}

		     $result = mysqli_query($mysqli,$query) or die("nothing to display");
		     $count = mysqli_num_rows($result);

		    if($count > 0){
		    	$output.="<div class='ui divider'></div>
				<table class='ui fixed very basic mobile tablet small monitor only stackable celled padded striped table'>
					<thead>
						<tr>
							<th>CHURCH NAME</th>
							<th>ADDRESS</th>
							<th>START TIME</th>
							<th>END TIME</th>
							<th>DAY/WEEK</th>
							<th>CONTACT NUMBER</th>
						</tr>
					</thead>
					<tbody>";
				 while ($row_query = mysqli_fetch_array($result)) {
		        	$stime = $row_query['schedule_starttime'];
		            $etime = $row_query['schedule_endtime'];
		            if(is_null($etime)){
		            	$etime = '--------';
		            }
					$day = $row_query['schedule_day'];
					$church = $row_query['church_name'];
					$address = $row_query['church_address'];
					$contact = $row_query['admin_contact'];

					$output .= "
					<tr>
						<td id='church'>$church</td>
						<td id='address'>$address</td>
						<td id='stime'>$stime</td>
						<td id='etime'>".$etime."</td>
						<td id='day'>$day</td>
						<td id='contact'>$contact</td>
					</tr> ";
			    }
			    $output .="</tbody>
						</table>
					";    
	    }else{
	    	$output.= "<div class='ui grid'>
					<div class='row'></div>
					<div class='sixteen wide column'>
						<div class='ui grey inverted segment'>
							<center><h3><i class='warning circle icon'></i>No results found.</h3></center>
						</div>
					</div>
				</div>";
	    }
		 
		 echo $output; 	
		 echo "</div> <br>";

     }

    function churchsearch($option1, $option2){
    	global $mysqli;
		    $output = '';
		   
		   // $search = preg_replace("#[^0-9a-z]#i", "replacement", $search);
		    $n = $_GET['page'];
    		$page = ($n * 10)-10;
    		if($option1!="" && $option2 != ""){
    			 $query = "SELECT * FROM church WHERE church_status = 'active' AND church_name LIKE '%$option1%' AND church_address LIKE '%$option2%'LIMIT ".$page.",10";
    		}else if($option1 !="" && $option2 == ""){
    			$query = "SELECT * FROM church WHERE church_status = 'active' AND church_name LIKE '%$option1%' LIMIT ".$page.",10";
    		}else if ($option1 =="" && $option2 != "") {
    			$query = "SELECT * FROM church WHERE church_status = 'active' AND church_address LIKE '%$option2%' LIMIT ".$page.",10";
    		}else{
    			$query = "SELECT * FROM church WHERE church_status = 'active' AND church_name LIKE '%$option1%' OR church_address LIKE '%$option2%' LIMIT ".$page.",10";
    		}
		   
		     $result = mysqli_query($mysqli,$query);
		     $count = mysqli_num_rows($result);

		    if($count > 0){
		     $output.="<table class='ui fixed very basic mobile tablet small monitor only stackable celled padded striped table'>
				<thead>
					<tr>
						<th>CHURCH</th>
						<th>ADDRESS</th>
					</tr>
				</thead>
				<tbody>
			";
		    	
				 while ($row_query = mysqli_fetch_array($result)) {
					$church = $row_query['church_name'];
					$address = $row_query['church_address'];
					$cid = $row_query['church_id'];
					$output .= "
					<tr class='clickable-row' onclick='open_info($cid);'>
						<td class='eight wide'>$church</td>
						<td class='eight wide'>$address</td>
					</tr>";
			    }
			    $output .="</tbody>
						</table>";    
	    }else{
	    	$output.= "<div class='ui grid'>
					<div class='row'></div>
					<div class='sixteen wide column'>
						<div class='ui grey inverted segment'>
							<center><h3><i class='warning circle icon'></i>No results found.</h3></center>
						</div>
					</div>
				</div>";
	    }
	    echo $output;
    }
function searchAllService($search){
	global $mysqli;
    $output = '';
   
    $n = $_GET['page'];
    $page = ($n * 10)-10;
    $query = "SELECT * FROM schedule JOIN church 
		  ON church_id = schedule_church_id JOIN admin ON church_id = admin_church_id WHERE schedule_status = 'active' AND church_name LIKE '%$search%' OR church_address LIKE '%$search%' OR schedule_day LIKE '%$search%' OR schedule_event LIKE '%$search%'  OR schedule_week LIKE '%$search%' LIMIT ".$page.",10";

     $result = mysqli_query($mysqli,$query);
  
	$cnt=mysqli_num_rows($result);

	if($cnt > 0){
		$output.= '
			<div class="ui divider"></div>
			<table class="ui fixed very basic mobile tablet small monitor only stackable celled padded striped table">
				<thead>
					<tr>
						<th>SERVICE</th>
						<th>CHURCH</th>
						<th>ADDRESS</th>
						<th>START TIME</th>
						<th>END TIME</th>
						<th>DAY</th>
						<th>WEEK</th>
						<th>CONTACT NUMBER</th>
					</tr>
				</thead>
				<tbody>';
		while ($row_query = mysqli_fetch_array($result)) {

        	$service = $row_query['schedule_event'];
        	if($service == "Mass"){
        		$etime="------------";
        		$week ="------------";
        	}else{
        		$etime = $row_query['schedule_endtime'];
        		$week = $row_query['schedule_week'];
        	}
			$stime = $row_query['schedule_starttime'];
			$day = $row_query['schedule_day'];
			$church = $row_query['church_name'];
			$address = $row_query['church_address'];
			$contact = $row_query['admin_contact'];
            
			$output .= "
			<tr>
				<td>$service</td>
				<td>$church</td>
				<td>$address</td>
				<td>$stime</td>
				<td>$etime</td>
				<td>$day</td>
				<td>$week</td>
				<td>$contact</td>
			</tr> ";
	    }
	    $output .='</tbody>
			</table>';
	}else{
		$output .= "<div class='ui grid'>
					<div class='row'></div>
					<div class='sixteen wide column'>
						<div class='ui grey inverted segment'>
							<center><h3><i class='warning circle icon'></i>No schedules to found.</h3></center>
						</div>
					</div>
				</div>";
	}
 

    echo $output;
    echo "</div> <br>";
}

function masssearch($option1,$option2,$option3,$option4){
	global $mysqli;
    $output = '';
    $n = $_GET['page'];
    $page = ($n * 10)-10;
    if($option1 != "" && $option2=="" && $option3=="" && $option4==""){
    	$query = "SELECT * FROM schedule JOIN church 
		  ON church_id = schedule_church_id WHERE schedule_status = 'active' AND  church_name LIKE '%$option1%' AND schedule_event = 'Mass' LIMIT ".$page.",10";
    }else if($option1 == "" && $option2 !="" && $option3=="" && $option4==""){
    	$query = "SELECT * FROM schedule JOIN church 
		  ON church_id = schedule_church_id WHERE schedule_status = 'active' AND  church_address LIKE '%$option2%' AND schedule_event = 'Mass' LIMIT ".$page.",10";
    }else if($option1 == "" && $option2=="" && $option3 !="" && $option4==""){
    	$query = "SELECT * FROM schedule JOIN church 
		  ON church_id = schedule_church_id WHERE schedule_status = 'active' AND  schedule_starttime LIKE '%$option3%' AND schedule_event = 'Mass' LIMIT ".$page.",10";
    }else if($option1 == "" && $option2=="" && $option3=="" && $option4 !=""){
    	$query = "SELECT * FROM schedule JOIN church 
		  ON church_id = schedule_church_id WHERE schedule_status = 'active' AND  schedule_day LIKE '%$option4%' AND schedule_event = 'Mass' LIMIT ".$page.",10";
    }else if($option1 != "" && $option2 =="" && $option3 !="" && $option4 ==""){
    	$query = "SELECT * FROM schedule JOIN church 
		  ON church_id = schedule_church_id WHERE schedule_status = 'active' AND  church_name LIKE '%$option1%' AND schedule_starttime LIKE '%$option3%' AND schedule_event = 'Mass' LIMIT ".$page.",10";
    }else if($option1 == "" && $option2 !="" && $option3 !="" && $option4 ==""){
    	$query = "SELECT * FROM schedule JOIN church 
		  ON church_id = schedule_church_id WHERE schedule_status = 'active' AND  church_address LIKE '%$option2%' AND schedule_starttime LIKE '%$option3%' AND schedule_event = 'Mass' LIMIT ".$page.",10";
    }else if($option1 == "" && $option2 =="" && $option3 !="" && $option4 !=""){
    	$query = "SELECT * FROM schedule JOIN church 
		  ON church_id = schedule_church_id WHERE schedule_status = 'active' AND schedule_starttime LIKE '%$option3%' AND schedule_day LIKE '%$option4%' AND schedule_event = 'Mass' LIMIT ".$page.",10";
    }else if($option1 != "" && $option2 =="" && $option3 =="" && $option4 !=""){
    	$query = "SELECT * FROM schedule JOIN church 
		  ON church_id = schedule_church_id WHERE schedule_status = 'active' AND church_name LIKE '%$option1%' AND schedule_day LIKE '%$option4%' AND schedule_event = 'Mass' LIMIT ".$page.",10";
    }else if($option1 == "" && $option2 !="" && $option3 =="" && $option4 !=""){
    	$query = "SELECT * FROM schedule JOIN church 
		  ON church_id = schedule_church_id WHERE schedule_status = 'active' AND church_address LIKE '%$option2%' AND schedule_day LIKE '%$option4%' AND schedule_event = 'Mass' LIMIT ".$page.",10";
    }







    // $query = "SELECT * FROM schedule JOIN church 
		  // ON church_id = schedule_church_id WHERE schedule_status = 'active' AND (church_name LIKE '%$option1%' AND church_address LIKE '%$option2%' AND schedule_starttime LIKE '%$option3%' AND schedule_day LIKE '%$option4%') OR (church_name LIKE '%$option1%' OR church_address LIKE '%$option2%' OR schedule_starttime LIKE '%$option3%' OR schedule_day LIKE '%$option4%') AND schedule_event = 'Mass' LIMIT ".$page.",10";

     $result = mysqli_query($mysqli,$query) or die("nothing to display");
     $cnt = mysqli_num_rows($result);

    if($cnt > 0){
    	$output.=' <table class="ui fixed very basic mobile tablet small monitor only stackable celled padded striped table">
			<thead>
				<tr>
					<th>CHURCH NAME</th>
					<th>ADDRESS</th>
					<th>TIME</th>
					<th>DAY/WEEK</th>
				</tr>
			</thead>
			<tbody>';
    	
		 while ($row_query = mysqli_fetch_array($result)) {
        	$time = $row_query['schedule_starttime'];
			$day = $row_query['schedule_day'];
			$church = $row_query['church_name'];
			$address = $row_query['church_address'];

			$output.="
			<tr>
				<td>$church</td>
				<td>$address</td>
				<td>$time</td>
				<td>$day</td>
			</tr> ";
	    }
	    $output .="</tbody>
				</table>
			";
    }else{
    	$output.= "<div class='ui grid'>
					<div class='row'></div>
					<div class='sixteen wide column'>
						<div class='ui grey inverted segment'>
							<center><h3><i class='warning circle icon'></i>No results found.</h3></center>
						</div>
					</div>
				</div>";
    }

    echo $output;
    echo "</div> <br>";
  
}

function searchpages($option1,$option2,$option3, $option4,$option5,$url,$table,$event,$n)
{
	global $mysqli;
	$n = $_GET['page'];
    $page = ($n * 10)-10;

	if($event == ""){
		//allservice
		if($table == 'schedule'){
			$query = "SELECT * FROM schedule JOIN church 
			ON church_id = schedule_church_id JOIN admin ON church_id = admin_church_id WHERE schedule_status = 'active' AND  (church_name LIKE '%$option1%' AND church_address LIKE '%$option2%'AND schedule_day LIKE '%$option4%' AND schedule_week LIKE '%$option5%') OR church_name LIKE '%$option1%' OR church_address LIKE '%$option2%'OR schedule_day LIKE '%$option4%' OR schedule_week LIKE '%$option5%'";
		}else{
			 if($option1!="" && $option2 != ""){
    			 $query = "SELECT * FROM church WHERE church_status = 'active' AND church_name LIKE '%$option1%' AND church_address LIKE '%$option2%'LIMIT ".$page.",10";
    		}else if($option1 !="" && $option2 == ""){
    			$query = "SELECT * FROM church WHERE church_status = 'active' AND church_name LIKE '%$option1%' LIMIT ".$page.",10";
    		}else if ($option1 =="" && $option2 != "") {
    			$query = "SELECT * FROM church WHERE church_status = 'active' AND church_address LIKE '%$option2%' LIMIT ".$page.",10";
    		}else{
    			$query = "SELECT * FROM church WHERE church_status = 'active' AND church_name LIKE '%$option1%' OR church_address LIKE '%$option2%' LIMIT ".$page.",10";
    		}
		}
		
	}else if($event == "Mass"){
		 if($option1 != "" && $option2=="" && $option3=="" && $option4==""){
	    	$query = "SELECT * FROM schedule JOIN church 
			  ON church_id = schedule_church_id WHERE schedule_status = 'active' AND  church_name LIKE '%$option1%' AND schedule_event = 'Mass' LIMIT ".$page.",10";
	    }else if($option1 == "" && $option2 !="" && $option3=="" && $option4==""){
	    	$query = "SELECT * FROM schedule JOIN church 
			  ON church_id = schedule_church_id WHERE schedule_status = 'active' AND  church_address LIKE '%$option2%' AND schedule_event = 'Mass' LIMIT ".$page.",10";
	    }else if($option1 == "" && $option2=="" && $option3 !="" && $option4==""){
	    	$query = "SELECT * FROM schedule JOIN church 
			  ON church_id = schedule_church_id WHERE schedule_status = 'active' AND  schedule_starttime LIKE '%$option3%' AND schedule_event = 'Mass' LIMIT ".$page.",10";
	    }else if($option1 == "" && $option2=="" && $option3=="" && $option4 !=""){
	    	$query = "SELECT * FROM schedule JOIN church 
			  ON church_id = schedule_church_id WHERE schedule_status = 'active' AND  schedule_day LIKE '%$option4%' AND schedule_event = 'Mass' LIMIT ".$page.",10";
	    }else if($option1 != "" && $option2 =="" && $option3 !="" && $option4 ==""){
	    	$query = "SELECT * FROM schedule JOIN church 
			  ON church_id = schedule_church_id WHERE schedule_status = 'active' AND  church_name LIKE '%$option1%' AND schedule_starttime LIKE '%$option3%' AND schedule_event = 'Mass' LIMIT ".$page.",10";
	    }else if($option1 == "" && $option2 !="" && $option3 !="" && $option4 ==""){
	    	$query = "SELECT * FROM schedule JOIN church 
			  ON church_id = schedule_church_id WHERE schedule_status = 'active' AND  church_address LIKE '%$option2%' AND schedule_starttime LIKE '%$option3%' AND schedule_event = 'Mass' LIMIT ".$page.",10";
	    }else if($option1 == "" && $option2 =="" && $option3 !="" && $option4 !=""){
	    	$query = "SELECT * FROM schedule JOIN church 
			  ON church_id = schedule_church_id WHERE schedule_status = 'active' AND schedule_starttime LIKE '%$option3%' AND schedule_day LIKE '%$option4%' AND schedule_event = 'Mass' LIMIT ".$page.",10";
	    }else if($option1 != "" && $option2 =="" && $option3 =="" && $option4 !=""){
	    	$query = "SELECT * FROM schedule JOIN church 
			  ON church_id = schedule_church_id WHERE schedule_status = 'active' AND church_name LIKE '%$option1%' AND schedule_day LIKE '%$option4%' AND schedule_event = 'Mass' LIMIT ".$page.",10";
	    }else if($option1 == "" && $option2 !="" && $option3 =="" && $option4 !=""){
	    	$query = "SELECT * FROM schedule JOIN church 
			  ON church_id = schedule_church_id WHERE schedule_status = 'active' AND church_address LIKE '%$option2%' AND schedule_day LIKE '%$option4%' AND schedule_event = 'Mass' LIMIT ".$page.",10";
	    }
	}else{
		if($option1 != "" && $option2=="" && $option3==""){
    			 $query = "SELECT * FROM schedule JOIN church 
        		  ON church_id = schedule_church_id JOIN admin 
        		  ON admin_church_id = church_id WHERE  schedule_status = 'active' AND schedule_event = '$event' AND church_name LIKE '%$option1%' LIMIT ".$page.",10";
    		}else if($option1 == "" && $option2 !="" && $option3==""){
    			 $query = "SELECT * FROM schedule JOIN church 
        		  ON church_id = schedule_church_id JOIN admin 
        		  ON admin_church_id = church_id WHERE  schedule_status = 'active' AND schedule_event = '$event' AND church_address LIKE '%$option2%' LIMIT ".$page.",10";
    		}else if($option1 == "" && $option2=="" && $option3!=""){
    			 $query = "SELECT * FROM schedule JOIN church 
        		  ON church_id = schedule_church_id JOIN admin 
        		  ON admin_church_id = church_id WHERE  schedule_status = 'active' AND schedule_event = '$event' AND schedule_starttime LIKE '%$option3%' LIMIT ".$page.",10";
    		}else if($option1 != "" && $option2=="" && $option3!=""){
    			 $query = "SELECT * FROM schedule JOIN church 
        		  ON church_id = schedule_church_id JOIN admin 
        		  ON admin_church_id = church_id WHERE  schedule_status = 'active' AND schedule_event = '$event' AND church_name LIKE '%$option1%' AND schedule_starttime LIKE '%$option3%' LIMIT ".$page.",10";
    		}else if($option1 == "" && $option2 !="" && $option3==""){
    			 $query = "SELECT * FROM schedule JOIN church 
        		  ON church_id = schedule_church_id JOIN admin 
        		  ON admin_church_id = church_id WHERE  schedule_status = 'active' AND schedule_event = '$event' AND church_address LIKE '%$option2%' AND schedule_starttime LIKE '%$option3%' LIMIT ".$page.",10";
    		}else if($option1 == "" && $option2=="" && $option3==""){
    			 $query = "SELECT * FROM schedule JOIN church 
        		  ON church_id = schedule_church_id JOIN admin 
        		  ON admin_church_id = church_id WHERE  schedule_status = 'active' AND schedule_event = '$event' AND church_name LIKE '%$option1%' AND church_address LIKE '%$option2%' AND schedule_starttime LIKE '%$option3%' LIMIT ".$page.",10";
    		}

	}


	$result = mysqli_query($mysqli,$query);
    $cnt = mysqli_num_rows($result);  
	$npage = $cnt/10;
    $npage = ceil($npage);



    echo "<div class='ui grid'><div class='six wide center aligned column'>";
    $page = $_GET['page'];
    if($npage ==0){
    	echo "Page <strong> ".$page." </strong> out of 1 pages" ;
    }else{
    	echo "Page <strong> ".$page." </strong> out of ".$npage." pages" ;
    }
	echo "</div>";

    echo' <div class="six wide right aligned column">
			<div class="ui pagination menu" > ';
    if($cnt == 0){
    	echo "<a href = '".$url."?page=1' class='item'>1</a>";
    }else{
    	
    	for($n=1; $n<=$npage; $n++){
			echo "<a href = '".$url."?option1=".$option1."&option2=".$option2."&option3=".$option3."&option4=".$option4."&option5=".$option5."&page=".$n."' class='item'>".$n."</a>";
		}
    }
    echo "</div>
    	</div></div>";





  //   $page = $_GET['page'];
  //   if($npage ==0){
  //   	echo "Page <strong> ".$page." </strong> out of 1 pages" ;
  //   }else{
  //   	echo "Page <strong> ".$page." </strong> out of ".$npage." pages" ;
  //   }
	

  //   echo' <div class="ui centered grid">
		// 		<div class="ui center aligned pagination menu" > ';
  //   if($cnt == 0){
  //   	echo "<a href = '".$url."?page=1' class='item'>1</a>";
  //   }else{
    	
  //   	for($n=1; $n<=$npage; $n++){
		// 	echo "<a href = '".$url."?option1=".$option1."&option2=".$option2."&option3=".$option3."&option4=".$option4."&option5=".$option5."&page=".$n."' class='item'>".$n."</a>";
		// }
  //   }
  //   echo "</div></div>";
	    	
}


function churchinfo(){
	global $mysqli;

	$church_id = $_GET['church'];

	$query_church = "SELECT * FROM church WHERE church_id = ".$church_id;
	
	$result_church = mysqli_query($mysqli,$query_church);

    $row_church = mysqli_fetch_array($result_church);
	$church = $row_church['church_name'];
	$address = $row_church['church_address'];
	$address = $row_church['church_address'];
	$church_info = $row_church['church_info'];
	
	echo '	
			<h2 class="ui header">'.$church.'</h2>
			<div class="ui divider"></div>'.$church_info.'
			<div class="ui hidden divider"></div>
			<h5 class="ui header">Address: <strong>'.$address.'</strong></h5>';
            
			

    $query_admin = "SELECT * FROM admin WHERE admin_church_id = ".$church_id;
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

			';
  }


?>