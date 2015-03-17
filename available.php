<!--AJAX Module-->

<?php
	require_once("./include/membersite_config.php");
	
	/*Connects only to the DB*/
	include './dbconnect.php';
	
	if(isset($_POST['action']) && $_POST['action'] == 'availability'){
		$UuserName = $fgmembersite->Sanitize($_POST['UuserName']); // Get the username values
		$query = "SELECT UuserName FROM Registration WHERE UuserName='" . $UuserName . "'";
		$res = mysqli_query($con, $query);
		$count = mysqli_num_rows($res);
		echo $count;
	}
?>