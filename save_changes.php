<?php
// include "database_connection.php"; //Include database connection settings file
include "dbconnect.php";

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

$sql="UPDATE `Events` SET 
	  `Evename` = '".mysql_escape_string(strip_tags($_POST['Evename']))."',
	  `Ewebsite` = '".mysql_escape_string(strip_tags($_POST['Ewebsite']))."',
	  `Efacebook` = '".mysql_escape_string(strip_tags($_POST['Efacebook']))."'
	   WHERE `Eid` = '".mysql_escape_string(strip_tags($_POST['id']))."'";
	   mysqli_query($con, $sql);

// 	mysqli_query("UPDATE `Events` SET `Evename` = '".mysql_escape_string(strip_tags($_POST['Evename']))."',
// 	  `Edescription` = '".mysql_escape_string(strip_tags($_POST['Edescription']))."',
// 	  `Ewebsite` = '".mysql_escape_string(strip_tags($_POST['Efacebook']))."'
// 	   WHERE `Eid` = '28'");
	   
// 	   $result = mysqli_query($con, $sql);
// }
?>