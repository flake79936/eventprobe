<?php
include("dbconnect.php");
if($_GET['Eid'] and $_GET['data'])
{
	$Eid = $_GET['Eid'];
	$data = $_GET['data'];
	if(mysql_query("UPDATE Events SET Evename='$data' where Eid='$Eid'"))
	echo 'success';
}
?>