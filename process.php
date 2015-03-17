<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
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