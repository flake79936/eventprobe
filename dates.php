<?PHP
	require_once("./include/membersite_config.php");

	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);

	for($ai = 12; $ai <= 24; $ai++){
		$date = strtotime("+$ai day", strtotime(date("m/d/Y"))); //increments by 1
		echo "Date: " . $date . "<br>";

		$today = date("m/d/Y", $date); //e.g., 02/03/2015, 
		echo "Today: " . $today . "<br>";
		
		$day = date("D", $date); //Tue, Wed, etc.
		echo "Day: " . $day . "<br>";
		
		$to = date("d", $date);
		echo "To + ai: " . ($to+$ai) . "<br>";

		$trimDate = substr($today, 0, 5); //e.g., From 02/03/2015 to 02/03
		echo "trimDate: " . $trimDate . "<br>";

		$toDate = strtotime($today);
		echo "toDate: " . $toDate . "<br><br>";
	}
?>