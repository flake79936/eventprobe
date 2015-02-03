<?PHP
	require_once("./include/membersite_config.php");
	include 'dbconnect.php';
	$city = $fgmembersite->getCity();
	
	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);
	
	//$sql = "SELECT * FROM Events WHERE EstartDate >= '" . $today . "' ORDER BY EstartDate LIMIT 7;";
	//$result = mysqli_query($con, $sql);
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
	<div class="title">
		<h1>Today and this Week Near You</h1>
		<!--To refresh, we can create a method in fg_membersite-->
		<!--<a href="#"><img src="images/btn_refresh.png" alt="Refresh" /></a>-->
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<div class="cell">&nbsp;</div>
		<?PHP
			
			for($ai = 0; $ai <= 6; $ai++){
				$tew = "tew";
				
				//increments by 1
				$date = strtotime("+$ai day", strtotime(date("m/d/Y")));
				
				$day = date("D", $date); //Tue, Wed, etc.
				
				$today = Date("m/d/Y", $date); //e.g., 02/03/2015
				
				$trimDate = substr($today, 0, 5); //e.g., From 02/03/2015 to 02/03
				$toDate = strtotime($today);
				
		?>
			<div class="cell">
				<div class="circle"><!--Count of how many events the user has in their list.--><?= $ai ?></div>
				<form><a onClick="getByDayEvent(<?= $toDate ?>);"><h4><?= $trimDate ?><br/><?= $day ?></h4></a></form>
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