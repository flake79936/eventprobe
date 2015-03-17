<?php
	/*Connects only to the DB*/
	include './dbconnect.php';
	
	$sql = "SELECT UuserName FROM Registration";
	$result = mysqli_query($con, $sql);
	
	while($row = mysqli_fetch_array($result)){
		echo $row['UuserName'] . "<br>";
	}
?>