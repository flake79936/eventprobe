<?PHP
	require_once("./include/membersite_config.php");
	include 'dbconnect.php';
	$city = $fgmembersite->getCity();
// 	$city= "el paso";
	
	$usrname = $fgmembersite->UsrName();
	
	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);
	
	$bool = $fgmembersite->CheckSession();
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
		xmlhttp.open("GET", "getByDayEvent.php?date=" + str, true);
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
				$date = strtotime("+$ai day", strtotime(date("m/d/Y"))); //increments by 1
				
				$day = date("D", $date); //Tue, Wed, etc.
				
				$today = Date("m/d/Y", $date); //e.g., 02/03/2015, 
				
				$trimDate = substr($today, 0, 5); //e.g., From 02/03/2015 to 02/03
				$toDate = strtotime($today);
		?>
			<div class="cell">
				<?PHP
					if($bool){
						//Sub-query to show events that the user has related to the master table of the events.
						$qry = "SELECT Eid, COUNT(Eid) FROM ".$usrname."MyEvents WHERE Eid IN (SELECT Eid FROM Events WHERE EstartDate = '" . $today . "')";
						$result = mysqli_query($con, $qry);
						if(mysqli_num_rows($result) > 0){
							while($row = mysqli_fetch_assoc($result)){ ?>
								<div class="circle" ><!--Count of how many events the user has in their list.--><?= $row['COUNT(Eid)']; ?></div>
							<?PHP }
						} 
					} ?>
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