<?php
/*********================================*****************
* Live Information Editting System
* Written by Vasplus Programming Blog
* Website: www.vasplus.info
* All Copy Rights Reserved by Vasplus Programming Blog
*********=================================*****************/

//Database connection Settings
define ('localhost',''); //Your server name or host name goes in here
define ('user',''); //Your database username goes in here
define ('Xzr?f270',''); //Your database password goes in here
define ('EventAdvisors',''); //Your database name goes in here

global $connection;
$connection = @mysql_connect(hostnameorservername,serverusername,serverpassword) or die('Connection could not be made to the SQL Server. Please report this system error at <font color="blue">info@servername.com</font>');
@mysql_select_db(databasenamed,$connection) or die('Connection could not be made to the database. Please report this system error at <font color="blue">info@servername.com</font>');	
?>
