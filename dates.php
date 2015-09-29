<?PHP
	require_once("./include/membersite_config.php");
	include './dbconnect.php';
	////
	//echo "Before everything that is suppose to happen<br>";
	////
	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);
	////
	$usrname = $fgmembersite->UsrName();
	//echo "Username: " . $usrname . "<br>";
	////
	$newformat = date('Y-m-d');
	//echo "NewFormat: " . $newformat . "<br>";	
?>

<body>
	hello up here
</body>

<?PHP
	$sql = 'UPDATE Events SET Etype = "Premium", EstartDate = "' . $newformat . '" WHERE Ecity = "Fort Worth"';
	mysqli_query($con, $sql);
	
	$dltUpdtQuery = "UPDATE Events SET Edisplay = 1;";
	mysqli_query($con, $dltUpdtQuery);
	
	//$altTable = "ALTER TABLE Events ALTER COLUMN Ebanner CHAR(255);";
	//mysqli_query($con, $altTable);
	
	//$showTable = "SHOW COLUMNS FROM Events;";
	//$sT = mysqli_query($con, $showTable);
	//echo mysqli_num_rows($sT);
?>