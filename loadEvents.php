<?php
	require_once("./include/membersite_config.php");
	include 'dbconnect.php';
	
	$usrname = $fgmembersite->UsrName();
	
	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);
	
	$newformat = date('Y-m-d');
	
	$pageId = (int)(!isset($_GET["myEventPageId"]) ? 1 : $_GET["myEventPageId"]);
	if ($pageId <= 0) { $pageId = 1; } //DEFAULT pageId # 1
	//echo "page var: " . $pageId . "<br>";
	
	$per_paging = 5; // Set how many records do you want to display per pageId.

	$startpoint = ($per_paging * $pageId) - $per_paging;
	
	//please do not add a semicolon at the end of this line, inside of the double quotes.
	$statement = "Events WHERE EstartDate >= '" . $newformat . "'  AND UuserName = '" . $usrname . "' AND Edisplay='1' ORDER BY EstartDate ASC ";
	
	$sql = "SELECT * FROM {$statement} LIMIT {$startpoint}, {$per_paging};";
	$result = mysqli_query($con, $sql);
	//echo "<br>Query: " . $sql . "<br>";
	//echo "Query: " . $result . "<br>";
	
	$count = mysqli_num_rows($result);
	//echo "Count: " . $count . "<br>";
	
	while($row = mysqli_fetch_array($result)){
		//day name of the date
		$date = date_create($row['EstartDate']);
		$EstartDate = date_format($date, 'm/d/Y');
		
		$today = date("m/d/Y");
		$dt    = strtotime($EstartDate);
		$day   = date("D", $dt);
		
		if ($today === $EstartDate){
			$day = "Today";
		}
		
		echo '<ul>';
		echo '	<li>' . $day . '&nbsp;' . substr($EstartDate, 0, 5); . '</li>';
		echo '	<li>' . substr($row['Evename'], 0, 12) . ' ...'; . '</li> ';
		echo '	<li>' . $row['EtimeStart'] . ' - ' . $row['EtimeEnd'] . '</li>';
		
		echo '	<li>';
				if($row['Eid'] !== ""){
					$inDBUser = $fgmembersite->getUserFromDB($row['Eid']);
				}
		echo '		<form class="myEventForm" id="eventForm" action="' . echo $fgmembersite->GetSelfScript(); . '" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" onsubmit="return confirm("Do you wish to delete?");">';
		echo '			<input type="hidden" name="submitted" id="submitted" value="1" />';
		echo '			<input type="hidden" name="Eid" id="Eid" value="'. echo $row['Eid']; . '/>';
				
		echo '			<input type="hidden" name="dbUserName" id="dbUserName" value="<?PHP echo $inDBUser; ?>" />';
		echo '			<input type="hidden" name="usrName" id="usrName" value="<?PHP echo $usrname; ?>" />';
				
						if($fgmembersite->CheckSession() && ($usrname === $inDBUser)){
		echo '				<input class="dltButton" type="image" src="./images/btn_delete.png" name="submit" value=""/>';
						}
		echo '		</form>';
		echo '	</li>';
				
		echo '	<li><?PHP echo "<a class="myEventForm" onClick="editEvent("'. $row['Eid']. '")"><img src="images/btn_editevent.png"></a></li>';
		echo '</ul>';
	}
	mysqli_close($con);
?>
<div class="clear"></div>