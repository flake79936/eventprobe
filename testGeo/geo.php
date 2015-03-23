<?PHP
	require_once("./include/membersite_config.php");
	
	if(!isset($_SESSION)){ session_start(); }
	
	$_SESSION[$fgmembersite->GetLoginSessionVar()] = $username;
	
	$_SESSION['lattitude']  = $_GET['latitude'];
	$_SESSION['longtitude'] = $_GET['longtitude'];
	
	//$fgmembersite->RedirectToURL("./index2.php?lat=" + $_GET['latitude'] + "&long=" + $_GET['longtitude']);
	
	echo "Latitude: " . $_GET['latitude'] . ", Longtitude: " . $_GET['longtitude'];
?>