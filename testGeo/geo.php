<?PHP
	require_once("./include/membersite_config.php");
	
	if(!isset($_SESSION)){ session_start(); }
	
	$_SESSION['name'] = "Hello Test";
	
	$_SESSION['latitude']  = $_GET['latitude'];
	$_SESSION['longtitude'] = $_GET['longtitude'];
	
	//$fgmembersite->RedirectToURL("./index2.php?lat=" + $_GET['latitude'] + "&long=" + $_GET['longtitude']);
	
	echo "Latitude: " . $fgmembersite->getLatitude() . ", Longtitude: " . $fgmembersite->getLongtitude();
?>