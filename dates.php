<?PHP
	require_once("./include/membersite_config.php");
	include './dbconnect.php';
	
	echo "Before everything that is suppose to happen<br>";
	
	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);
	
	$usrname = $fgmembersite->UsrName();
	echo "Username: " . $usrname . "<br>";
	
	$newformat = date('Y-m-d');
	echo "NewFormat: " . $newformat . "<br>";
	
	//Gets the 's' variable which denotes to be the starting point value.
	$s = (int)(isset($_GET["s"]) ? $_GET["s"] : 1);
	echo "Start: " . $s . "<br>";
	
	$e = 10;
	echo "End: " . $e . "<br>";
	
	//please do not add a semicolon at the end of this line, inside of the double quotes.
	$statement = " Events WHERE EstartDate >= '" . $newformat . "' AND UuserName = '" . $usrname . "' AND Edisplay='1' ORDER BY EstartDate ASC ";
	echo "Statement: " . $statement . "<br>";
	
	$sql = "SELECT * FROM {$statement} LIMIT {$s}, {$e};";
	echo "Query: " . $sql . "<br>";
	
	if(isset($con)){
		echo "You have admin rights. <br>";
	}
	
	$result = mysqli_query($con, $sql);
	
	while($row = mysqli_fetch_array($result)){
		echo "Hello inside the while<br>";
	}
?>

<body>
	hello up here
</body>

<?PHP
	//	//day name of the date
	//	$date = date_create($row['EstartDate']);
	//	$EstartDate = date_format($date, 'm/d/Y');
	//	
	//	$today = date("m/d/Y");
	//	$day   = date("D", strtotime($EstartDate));
	//	
	//	if ($today === $EstartDate){ $day = "Today"; }
	//	
	//	echo '<ul>';
	//	echo '	<li>' . $day . '&nbsp;' . substr($EstartDate, 0, 5);  . '</li>';
	//	echo '	<li>' . substr($row['Evename'], 0, 12) . ' ...';      . '</li>';
	//	echo '	<li>' . $row['EtimeStart'] . ' - ' . $row['EtimeEnd'] . '</li>';
	//	
	//	echo '	<li>';
	//			if($row['Eid'] !== ""){
	//				$inDBUser = $fgmembersite->getUserFromDB($row['Eid']);
	//			}
	//	echo '		<form class="myEventForm" id="eventForm" action="' . $fgmembersite->GetSelfScript(); . '" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" >';
	//	echo '			<input type="hidden" name="submitted" id="submitted" value="1" />';
	//	echo '			<input type="hidden" name="Eid" id="Eid" value="'. $row['Eid']; . '/>';
	//			
	//	echo '			<input type="hidden" name="dbUserName" id="dbUserName" value="' . $inDBUser; . '" />';
	//	echo '			<input type="hidden" name="usrName" id="usrName" value="' . $usrname; . '" />';
	//			
	//					if($fgmembersite->CheckSession() && ($usrname === $inDBUser)){
	//	echo '				<input class="dltButton" type="image" src="./images/btn_delete.png" name="submit" value=""/>';
	//					}
	//	echo '		</form>';
	//	echo '	</li>';
	//			
	//	echo '	<li><a class="myEventForm" onClick="editEvent('. $row['Eid']. ')"><img src="images/btn_editevent.png"></a></li>';
	//	echo '</ul>';

	//mysqli_close($con);
	
	
	//for($ai = 12; $ai <= 24; $ai++){
	//	$date = strtotime("+$ai day", strtotime(date("m/d/Y"))); //increments by 1
	//	echo "Date: " . $date . "<br>";
    //
	//	$today = date("m/d/Y", $date); //e.g., 02/03/2015, 
	//	echo "Today: " . $today . "<br>";
	//	
	//	$day = date("D", $date); //Tue, Wed, etc.
	//	echo "Day: " . $day . "<br>";
	//	
	//	$to = date("d", $date);
	//	echo "To + ai: " . ($to+$ai) . "<br>";
    //
	//	$trimDate = substr($today, 0, 5); //e.g., From 02/03/2015 to 02/03
	//	echo "trimDate: " . $trimDate . "<br>";
    //
	//	$toDate = strtotime($today);
	//	echo "toDate: " . $toDate . "<br><br>";
	//}
	

	//$sql = 'UPDATE Events SET Etype = "Premium", EstartDate = "2015-04-24" WHERE Ecity = "Stephenville"';
	
	//mysqli_query($con, $sql);
?>