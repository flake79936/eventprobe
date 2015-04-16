<?php
	require_once("./include/membersite_config.php");
	include 'dbconnect.php';

	if(isset($_GET['pageId']) && !empty($_GET['pageId'])){
		$id = $_GET['pageId'];
	} else {
		$id = '0';
	}
	
	echo $id;
	
	$page_per_no = 3;
	
	$pageLimit = $page_per_no * $id;
	
	$sql = "SELECT * FROM Events WHERE EstartDate >= '".$today."'  AND UuserName = '" . $usrname . "' AND Edisplay='1' ORDER BY EstartDate ASC LIMIT $pageLimit, $page_per_no;";
	$result = mysqli_query($con, $sql);
	
	$count = mysqli_num_rows($result);
	echo $count;
	$HTML = '';
	
	if($count > 0){
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
	} else {
		echo 'No Data Found';
	}
?>