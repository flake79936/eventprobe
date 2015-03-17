<?php
	include 'dbconnect.php';
	
	!isset($_GET['Eflyer']) ? print("sorry no image to upload") : $pic = $_GET['Eflyer'];
	
	echo $pic;

	mysql_query("UPDATE Events SET Ehashtag = 'helllo' WHERE Eid=10;"); //mysql insert query

	$pict = $_REQUEST['Eflyer'];
	
	echo $pict;
?>