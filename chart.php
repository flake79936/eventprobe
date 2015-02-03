<?PHP

	$city = $fgmembersite->getCity();
	
	include 'dbconnect.php';
	

	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);
	
	$today = Date("m/d/Y"); //e.g., 02/03/2015
	$day   = date("D");
	
	$sql = "SELECT * FROM Events WHERE EstartDate >= '" . $today . "' ORDER BY EstartDate LIMIT 7;";
	$result = mysqli_query($con, $sql);
?>
<link rel="stylesheet" type="text/css" href="css/chart.css" />

<script>
	function getByDayEvent(str) {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("events").innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET", "getByDayEvent.php?q=" + str, true);
			xmlhttp.send();
		}
</script>

<div class="box">
	<div class="row">
	<div class="cell">&nbsp;</div>
		<?PHP 
			for($ai = 0; $ai <= 6; $ai++){
				$date = strtotime("+$ai day", strtotime(date("m/d/Y")));
				
				$day = date("D", $date);
				
				$trimDate = date("m/d/Y", $date);
				$trimDate = substr($trimDate, 0, 5); //e.g., From 02/03/2015 to 02/03
		?>
			<div class="cell">
				<div class="circle"><!--Count of how many events the user has in their list.-->1</div>
				<form><a onClick="getByDayEvent(<?= $today ?>);"><h4><?= $trimDate ?><br/><?= $day ?></h4></a></form>
			</div>
		<?PHP } ?>
	</div>

	<div class="chart" id="events"></div>
</div>

<div class="advertisement">
	<a href="#"><img src="images/advertisement_01.jpg" alt="Banner" /></a>
	<a href="#"><img src="images/advertisement_02.jpg" alt="Banner" /></a>
</div>
<div class="clear"></div>