<?PHP
	require_once("./include/membersite_config.php");
	$fgmembersite->RedirectToURL("./index2.php?lat=" + $_GET['lat'] + "&long=" + $_GET['long']);
?>