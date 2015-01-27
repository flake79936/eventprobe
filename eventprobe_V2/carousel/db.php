<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'database_user');
define('DB_PASSWORD', '********');
define('DB_DATABASE', 'database_name');
$connection = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die(mysqli_error($connection));
?>