<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>

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

$sql="UPDATE Events SET 
	  Evename = '".mysql_escape_string(strip_tags($_POST['Evename']))."',
	  EstartDate = '".mysql_escape_string(strip_tags($_POST['EstartDate']))."',
	  EendDate = '".mysql_escape_string(strip_tags($_POST['EendDate']))."',
	  EphoneNumber = '".mysql_escape_string(strip_tags($_POST['EphoneNumber']))."',
	  Edescription = '".mysql_escape_string(strip_tags($_POST['Edescription']))."',
	  Etype = '".mysql_escape_string(strip_tags($_POST['Etype']))."',
	  Ewebsite = '".mysql_escape_string(strip_tags($_POST['Ewebsite']))."',
	  Ehashtag = '".mysql_escape_string(strip_tags($_POST['Ehashtag']))."',
	  Efacebook = '".mysql_escape_string(strip_tags($_POST['Efacebook']))."',
	  Etwitter = '".mysql_escape_string(strip_tags($_POST['Etwitter']))."',
  	  Egoogle = '".mysql_escape_string(strip_tags($_POST['Egoogle']))."',
	  EtimeStart = '".mysql_escape_string(strip_tags($_POST['EtimeStart']))."',
	  EtimeEnd = '".mysql_escape_string(strip_tags($_POST['EtimeEnd']))."'
	   WHERE Eid = '".mysql_escape_string(strip_tags($_POST['id']))."'";
	   mysqli_query($con, $sql);

// 	mysqli_query("UPDATE `Events` SET `Evename` = '".mysql_escape_string(strip_tags($_POST['Evename']))."',
// 	  `Edescription` = '".mysql_escape_string(strip_tags($_POST['Edescription']))."',
// 	  `Ewebsite` = '".mysql_escape_string(strip_tags($_POST['Efacebook']))."'
// 	   WHERE `Eid` = '28'");
	   
// 	   $result = mysqli_query($con, $sql);
// }
?>