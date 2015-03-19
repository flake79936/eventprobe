<?PHP
	require_once("./include/membersite_config.php");
	session_start();
	
	$_SESSION['lat'] = $_GET['lat'];
	$_SESSION['long'] = $_GET['long'];
	
	return "Success";
?>