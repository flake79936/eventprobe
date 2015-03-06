<?php
// include "database_connection.php"; //Include database connection settings file
		require_once("./include/membersite_config.php");
include "dbconnect.php";
	if(!$fgmembersite->CheckSession()){
		$fgmembersite->RedirectToURL("./index.php");
		exit;
	}

		$usrname = $fgmembersite->UsrName();
?>
<title>Eventprobe</title>
	<link rel="shortcut icon" href="favicon.ico"  /> 
	
<?PHP
// if(isset($_POST['id']) 			&& 
// 	isset($_POST['Evename'])  &&
// 	isset($_POST['Edescription'])   &&
// 	isset($_POST['Efacebook'])		&& 
// 	!empty($_POST['id']) 		&& 
// 	!empty($_POST['Evename']) && 
// 	!empty($_POST['Edescription'])  && 
// 	!empty($_POST['Efacebook'])
// 	)
// {
// $con = mysqli_connect('localhost', 'user', 'Xzr?f270', 'EventAdvisors');
$newEventID = $_GET['eid'];

$sql= "DELETE FROM Events  WHERE Eid = '".$newEventID."' AND UuserName = '".$usrname."' ";
mysqli_query($con, $sql);
		$fgmembersite->RedirectToURL("./index.php");

?>