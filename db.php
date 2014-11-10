<?php
	class databaseAtt{
		$mysql_hostname = "localhost";
		$mysql_user = "admindev";
		$mysql_password = "17s_9Eyr";
		$mysql_database = "EventAdvisors";
		$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
		mysql_select_db($mysql_database, $bd) or die("Could not select database");
	}
?>