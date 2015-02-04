<?PHP	require_once("./include/membersite_config.php");
		
		if(!$fgmembersite->CheckSession()){
		$fgmembersite->RedirectToURL("./index.php");
		exit;
		}


		include 'dbconnect.php';
		$newEventID;
		
		$sql = 'INSERT INTO "' .$usrname.'"MyEvents VALUES("'.$newEventID.'") ';

?>