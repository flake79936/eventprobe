<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>

<?PHP	
	require_once("./include/membersite_config.php");

	if(!$fgmembersite->CheckSession()){
		$fgmembersite->RedirectToURL("./index.php");
		exit;
	}
	
	$usrname = $fgmembersite->UsrName();
	
	echo "Get -> " . $_GET['eid'] . "<br/>";
	
	$newEventID = $_GET['eid'];
	include 'dbconnect.php';
	echo "newEventID -> " . $newEventID . "<br/>";
	
	$sql = "INSERT INTO ".$usrname."MyEvents(Eid) VALUES(".$newEventID.")";
	echo "Query -> " . $sql . "<br/>";
	
	$result = mysqli_query($con, $sql);
	
	mysqli_close($con);
?>