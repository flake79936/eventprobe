<!--<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>-->

<?php
echo "Today is " . date("m/d/Y") . "<br>";
echo "Today is " . date("Y.m.d") . "<br>";
echo "Today is " . date("Y-m-d") . "<br>";
echo "Today is " . date("l") . "<br>";
echo "Today is " . date("D") . "<br>";


$trimDate = substr(date("m/d/Y"), 0, 5);
echo $trimDate . "<br>";

$date = strtotime("+2 day", strtotime(date("m/d/Y")));
echo date("Y-m-d", $date) . "<br>";

echo date("G:i") . "<br>";

date_default_timezone_set("America/Denver");
echo date_default_timezone_get() . "<br>";

echo date("G:i") . "<br>";
?>