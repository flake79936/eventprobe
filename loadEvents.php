<?PHP
	require_once("./include/membersite_config.php");
	include './dbconnect.php';
	
	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);
	
	isset($_GET['success']) ? $_GET['success'] : false;
	isset($_GET['eid']) ? $_GET['eid'] : null;
	
	if($_GET['success']){
		$fgmembersite->deleteEvent($_GET['eid']);
	}
	
	$usrname = $fgmembersite->UsrName();
	
	$newformat = date('Y-m-d');
	
	//Gets the 's' variable which denotes to be the starting point value.
	$s = (int)(isset($_GET["s"]) ? $_GET["s"] : 1);
	$e = 5;
	
	//please do not add a semicolon at the end of this line, inside of the double quotes.
	$statement = " Events WHERE EstartDate >= '" . $newformat . "' AND UuserName = '" . $usrname . "' AND Edisplay='1' ORDER BY EstartDate ASC, EtimeStart ";
	
	$sql = "SELECT * FROM {$statement} LIMIT {$s}, {$e};";
	//echo "Query: " . $sql . "<br>";
	
	$result = mysqli_query($con, $sql);
	
	while($row = mysqli_fetch_array($result)){
		//day name of the date
		$date = date_create($row['EstartDate']);
		$EstartDate = substr(date_format($date, 'm/d/Y'), 0, 5);
		$newStartTime =date("g:i a", strtotime($row['EtimeStart']));
		
		$today = date("m/d/Y");
		
		$day   = date("D", strtotime($EstartDate));
		
		if ($today === $EstartDate){ $day = "Today"; }
		
		$eventName = substr($row['Evename'], 0, 12);
		
		echo '<ul>';
		echo '	<li><div class="dayDate">' . $day . ' ' . $EstartDate . '</div></li>';
		echo '	<li><div class="nameEvent">' . $eventName . '</div></li>';
		echo '	<li><div class="timeEvent">' . $newStartTime . ' - ' . $row['EtimeEnd'] . '</div></li>';
		echo '	<li>';
			if($row['Eid'] !== ""){
				$inDBUser = $fgmembersite->getUserFromDB($row['Eid']);
			}
		if($fgmembersite->CheckSession() && ($usrname === $inDBUser)){
		echo '		<a class="myEventForm" onClick="deleteEvent(' . $row['Eid'] . ')"><img src="./images/btn_delete.png"></a>';
		}
		echo '	</li>';
		echo '	<li><a class="myEventForm" onClick="editEvent(' . $row['Eid'] . ')"><img src="./images/btn_editevent.png"></a></li>';
		echo '</ul>';
	}
	mysqli_close($con);
?>