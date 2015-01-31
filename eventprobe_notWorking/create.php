<?php
$link = mysql_connect('localhost', 'admindev', '17s_9Eyr');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

$sql = 'USE EventAdvisors; ';
if (mysql_query($sql, $link)) {
    echo "Select succesful\n";
} else {
    echo 'Error selecting database: ' . mysql_error() . "\n";
}

$sql2 = 'DROP TABLE Events';
if (mysql_query($sql2, $link)) {
    echo "Drop table succesful\n";
} else {
    echo 'Error droping table: ' . mysql_error() . "\n";
}



?>