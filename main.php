<?php
	echo "<h1> City  : ".$_GET['city']."</h1><br>";
	$city = $_GET['city'];

	session_start();
	$_SESSION["city"] = $city;

	echo $city;
?>