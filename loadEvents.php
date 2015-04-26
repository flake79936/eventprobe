<?PHP
	require_once("./include/membersite_config.php");
	include './dbconnect.php';
	
	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);
	
	$usrname = $fgmembersite->UsrName();
	
	$newformat = date('Y-m-d');
	
	//Gets the 's' variable which denotes to be the starting point value.
	$s = (int)(isset($_GET["s"]) ? $_GET["s"] : 1;
	$e = 5;
	
	//please do not add a semicolon at the end of this line, inside of the double quotes.
	$statement = " Events WHERE EstartDate >= '" . $newformat . "' AND UuserName = '" . $usrname . "' AND Edisplay='1' ORDER BY EstartDate ASC ";
	
	$sql = "SELECT * FROM {$statement} LIMIT {$s}, {$e};";
	
	$result = mysqli_query($con, $sql);
	
	while($row = mysqli_fetch_array($result)){
		//day name of the date
		$date = date_create($row['EstartDate']);
		$EstartDate = substr(date_format($date, 'm/d/Y'), 0, 5);
		
		$today = date("m/d/Y");
		
		$day   = date("D", strtotime($EstartDate));
		
		if ($today === $EstartDate){ $day = "Today"; }
		
		$eventName = substr($row['Evename'], 0, 12);
		
		echo '<ul>';
		echo '	<li><div class="dateEvent">' . $day . ' ' . $EstartDate . '</div></li>';
		echo '	<li><div class="nameEvent">' . $eventName . '</div></li>';
		echo '	<li><div class="timeEvent">' . $row['EtimeStart'] . ' - ' . $row['EtimeEnd'] . '</div></li>';
		echo '	<li>';
					if($row['Eid'] !== ""){
						$inDBUser = $fgmembersite->getUserFromDB($row['Eid']);
					}
		echo '		<form class="myEventForm" id="eventForm" action="' . $fgmembersite->GetSelfScript() . '" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" >';
		echo '			<input type="hidden" name="submitted" id="submitted" value="1" />';
		echo '			<input type="hidden" name="Eid" id="Eid" value="'. $row['Eid'] . '" />';
		echo '			<input type="hidden" name="dbUserName" id="dbUserName" value="' . $inDBUser . '" />';
		echo '			<input type="hidden" name="usrName" id="usrName" value="' . $usrname . '" />';
		
						if($fgmembersite->CheckSession() && ($usrname === $inDBUser)){
		echo '				<input class="dltButton" type="image" src="./images/btn_delete.png" name="submit" value=""/>';
						}
		echo '		</form>';
		echo '	</li>';
		echo '	<li><a class="myEventForm" onClick="editEvent('. $row['Eid']. ')"><img src="./images/btn_editevent.png"></a></li>';
		echo '</ul>';
	}
	mysqli_close($con);
?>