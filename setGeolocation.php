<?PHP
	require_once("./include/membersite_config.php");
	$fgmembersite->RedirectToURL("./index2.php?lat=" + $_REQUEST['lat'] + "&long=" + $_REQUEST['long']);
?>