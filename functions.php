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
			'<table class="ui teal inverted large table">
				<thead>
					<th class="two wide">SCHEDULE</th>
					<th class="two wide">DAY</th>
					<th class="seven wide">CHURCH</th>
					<th>ADDRESS</th>
				</thead>
			</table>
			<table class="ui very basic striped large table">
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
					<td class='two wide'>$time</td>
					<td class='two wide'>$day</td>
					<td class='seven wide'>$church</td>
					<td>$address</td>
				</tr> ";
		    }
			echo 	'</tbody>
				</table> <!-- table -->
				<button class="ui basic icon button" value="View More" onclick="open_churches()" name="">View More</button>';
		}else{
			echo "<i class='warning circle icon'></i>No schedules to display.";
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
			echo '
				<h3>SEARCH</h3>
				<div class="ui form">
					<div class="inline fields">
						<div class="field">
							<select class="ui search dropdown" id="option1">
								<option value="">Church</option>
								<?php dropdownchurch(); ?>
								<!--  -->
							</select>
						</div>
						<div class="field">
							<select class="ui search dropdown" id="option2">
								<option value="">Address</option>
								<?php dropdownaddress(); ?>
								<!--  -->
							</select>
						</div>
						<div class="field">
							<select class="ui search dropdown" id="option3">
								<option value="">Time</option>
								<?php echo timelist(); ?>
								
							</select>
						</div>
						<button  type ="button" name = "searchbutton" id="searchbutton" class="searching circular ui basic icon button" onclick="open_search(); " ><i class="search link icon"></i></button>
					</div>
				</div>
				<div class="ui hidden divider"></div>
			';
			if($event=="Baptism"){
				echo
				'<table class="ui teal inverted large table">
					<thead>
						<th class="four wide">CHURCH</th>
						<th class="four wide">ADDRESS</th>
						<th class="one wide">TIME</th>
						<th class="one wide">DAY/WEEK</th>
						<th class="two wide">CONTACT NUMBER</th>
					</thead>
				</table>
				<table class="ui very basic striped large table">
					<tbody>
				';
			}else{
				echo
				'<table class="ui teal inverted large table">
					<thead>
						<th class="three wide">CHURCH</th>
						<th class="two wide">ADDRESS</th>
						<th class="one wide">START TIME</th>
						<th class="one wide">END TIME</th>
						<th class="one wide">DAY/WEEK</th>
						<th class="two wide">CONTACT NUMBER</th>
					</thead>
				</table>
				<table class="ui very basic striped large table">
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
						<td id='church' class='four wide'>$church</td>
						<td id='address' class='four wide'>$address</td>
						<td id='stime' class='one wide'>$stime</td>
						<td id='day' class='one wide'>$day</td>
						<td id='contact' class='two wide'>$contact</td>
					</tr> ";
				}else{
					echo "
				<tr>
					<td id='church' class='three wide'>$church</td>
					<td id='address' class='two wide'>$address</td>
					<td id='stime' class='one wide'>$stime</td>
					<td id='etime' class='one wide'>$etime</td>
					<td id='day' class='one wide'>$day</td>
					<td id='contact' class='two wide'>$contact</td>
				</tr> ";
				}
		    }
	 		$pageName;

	 		if($event=="Pre-Cana"){
	 			$pageName="precana";
	 		}else if($event=="Pre-Jordan"){
	 			$pageName="prejordan";
	 		}else{
	 			$pageName=$event;
	 		}

			echo '</tbody>
				</table>
				</div>
				<div class="column"></div>
				<div class="row">
					<div class="two wide column"></div>
					<?php pages("$pageName.php","schedule", $event); ?>
					<div class="two wide column"></div>
				</div>

				';
		}else{
			echo "
				<div class='ui grid'>
					<div class='row'></div>
					<div class='sixteen wide column'>
						<div class='ui grey inverted segment'>
							<i class='warning circle icon'></i>No schedules to display.
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
			echo '<table class="ui teal inverted large table">
				<thead>
					<th class="six wide">Church</th>
					<th class="five wide">Address</th>
					<th class="two wide">Time</th>
					<th>Day/Week</th>
				</thead>
			</table>
			<table class="ui very basic striped large table">
				<tbody>';
			while ($row_query = mysqli_fetch_array($run_query)) {
				$time = $row_query['schedule_starttime'];
				$day = $row_query['schedule_day'];
				$church = $row_query['church_name'];
				$address = $row_query['church_address'];

				echo "
				<tr>
					<td class='six wide'>$church</td>
					<td class='five wide'>$address</td>
					<td class='two wide'>$time</td>
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
							<i class='warning circle icon'></i>No schedules to display.
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
			'<table class="ui teal inverted large table">
				<thead>
					<th class="two wide">Service</th>
					<th class="two wide">Schedule</th>
					<th class="two wide">Day</th>
					<th class="seven wide">Church</th>
					<th>Address</th>
				</thead>
			</table>
			<table class="ui very basic striped large table">
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
					<td class='two wide'>$event</td>
					<td class='two wide'>$time</td>
					<td class='two wide'>$day</td>
					<td class='seven wide'>$church</td>
					<td>$address</td>
				</tr> ";
		    }
			echo '</tbody>
				</table> <!-- table -->
				<button class="ui basic icon button" value="View More" onclick="open_services()" name="">View More</button>';
		}else{
			echo "<i class='warning circle icon'></i>No schedules to display.";
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
			'<table class="ui teal inverted large table">
				<thead>
					<th class="one wide">Service</th>
					<th class="three wide">Church</th>
					<th class="three wide">Address</th>
					<th class="one wide">Start Time</th>
					<th class="one wide">End Time</th>
					<th class="one wide">Day</th>
					<th class="one wide">Week</th>
					<th class="two wide">Contact Number</th>
				</thead>
			</table>
			<table class="ui very basic striped large table">
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
					<td class='one wide'>$service</td>
					<td class='three wide'>$church</td>
					<td class='three wide'>$address</td>
					<td class='one wide'>$stime</td>
					<td class='one wide'>$etime</td>
					<td class='one wide'>$day</td>
					<td class='one wide'>$week</td>
					<td class='two wide'>$contact</td>
				</tr> ";
		    }
		    echo '</tbody>
				</table>';
		}else{
			echo "<i class='warning circle icon'></i>No schedules found.";
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
			'<table class="ui teal inverted large table">
				<thead>
					<th class="eight wide">CHURCH</th>
					<th class="eight wide">ADDRESS</th>
				</thead>
			</table>
			<table class="ui very basic striped large table">
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
        	echo "<i class='warning circle icon'></i>No churches to display.";
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
     
     function displayChurchesHome()
     {
        global $mysqli;

        $query = "SELECT * FROM church WHERE church_status='active' LIMIT 5";
        $run_query = mysqli_query($mysqli,$query);

		$cnt=mysqli_num_rows($run_query);

		if($cnt > 0){
			echo '<table class="ui fixed very basic mobile tablet small monitor stackable table">
								<thead>
									<tr>
										<th class="eight wide">Church Name</th>
										<th class="eight wide">Address</th>
									</tr>
								</thead>
								<tbody>';
			while ($row_query = mysqli_fetch_array($run_query)) {
	        	$id = $row_query['church_id'];
				$church = $row_query['church_name'];
				$address = $row_query['church_address'];
				
				echo "
				<tr class='clickable-row' onclick='open_info($id);'>
					<td>$church</td>
					<td>$address</td>
				</tr> ";
		    }
		    echo '</tbody>
							</table>';
		}else{
			echo '<i class="warning circle icon"></i>No church to display.';
		}
     }

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
							<th>Church Name</th>
							<th>Address</th>
							<th>Start Time</th>
							<th>End Time</th>
							<th>Day/Week</th>
							<th>Contact Number</th>
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
	    	$output.= "<i class='warning circle icon'></i>No results found.";
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
		    	$output.='<table class="ui very padded very basic mobile tablet small monitor fixed single line striped table">
					<thead>
						<tr>
							<th>Church</th>
							<th>Address</th>
						</tr>
					</thead>
					<tbody>';
		    	
				 while ($row_query = mysqli_fetch_array($result)) {
					$church = $row_query['church_name'];
					$address = $row_query['church_address'];
					$cid = $row_query['church_id'];
					$output .= "
					<tr class='clickable-row' onclick='open_info($cid);'>
						<td>$church</td>
						<td>$address</td>
					</tr>";
			    }
			    $output .="</tbody>
						</table>";    
	    }else{
	    	$output.= "<i class='warning circle icon'></i>No results found.";
	    }
		 
		 echo $output;
		 echo "</div> <br>"; 	
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
						<th>Service</th>
						<th>Church</th>
						<th>Address</th>
						<th>Start Time</th>
						<th>End Time</th>
						<th>Day</th>
						<th>Week</th>
						<th>Contact Number</th>
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
		$output .= "<i class='warning circle icon'></i>No schedules found.";
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
					<th>Church Name</th>
					<th>Address</th>
					<th>Time</th>
					<th>Day/Week</th>
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
    	$output.= "<i class='warning circle icon'></i>No results found.";
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
			echo "<a href = '".$url."?option1=".$option1."&option2=".$option2."&option3=".$option3."&option4=".$option4."&option5=".$option5."&page=".$n."' class='item'>".$n."</a>";
		}
    }
    echo "</div></div>";
	    	
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
	
	echo '<div class="ui primary padded container black segment">
			<h2 class="ui header">'.$church.'</h2>
			<div class="ui divider"></div>'.$church_info.'
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
	</div> <!-- segment -->
			';
  }


?>