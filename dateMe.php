<?PHP
	require_once("./include/membersite_config.php");
	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);
	
	include 'dbconnect.php';
	
	$today = Date("m/d/Y"); //should format to 12/12/2000
	
	$sql = "SELECT EstartDate FROM Events ORDER BY EstartDate ASC";
	$result = mysqli_query($con, $sql);
	
	while($row = mysqli_fetch_array($result)){ 
		echo "Start date: " . $row['EstartDate'] . "<br>";
	}
?>