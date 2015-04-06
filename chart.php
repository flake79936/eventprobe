<!--Module-->

<?PHP
	require_once("./include/membersite_config.php");
	include 'dbconnect.php';
	$city = $fgmembersite->getCity();
	//$city= "el paso";
	
	$usrname = $fgmembersite->UsrName();
	
	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);
	
	$today = Date("m/d/Y"); //e.g., 02/03/2015, 
	$toDate = (isset($_GET["date"]) ? $_GET["date"] : strtotime($today));
	
	$bool = $fgmembersite->CheckSession();
	
	$paging = (isset($_GET["paging"]) ? $_GET["paging"] : 1);
?>

<link rel="stylesheet" type="text/css" href="css/chart.css" />

<script>
	(function($){
		$(document).ready(function(){
			$.ajaxSetup({
				cache: false,
				beforeSend: function(){
					$('#events').hide();
					$('#loading').show();
				},
				complete: function(){
					$('#loading').hide();
					$('#events').show();
				},
				success: function(){
					$('#loading').hide();
					$('#events').show();
				}
			});
			var $container = $("#events");
			$container.load("getByDayEvent.php?date=" + <?= $toDate ?> + "&paging=" + <?= $paging ?>);			
			var refreshId = setInterval(function(){
				$container.load("getByDayEvent.php?date=" + <?= $toDate ?> + "&paging=" + <?= $paging ?>);
			}, 100000000); //30k = 30 seconds
		});
	})(jQuery);
	
	function getByDayEvent(str, paging) {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("events").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET", "getByDayEvent.php?date=" + str + "&paging=" + paging, true);
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
						$qry = "SELECT Eid, COUNT(Eid) FROM ".$usrname."MyEvents WHERE Eid IN (SELECT Eid FROM Events WHERE EstartDate = '" . $today . "' AND Edisplay='1')";
						$result = mysqli_query($con, $qry);
						if(mysqli_num_rows($result) > 0){
							while($row = mysqli_fetch_assoc($result)){ 
				?>
								<div class="circle" ><!--Count of how many events the user has in their list.-->
									<?= $row['COUNT(Eid)']; ?>
								</div>
					  <?PHP }
						} 
					} ?>
				<form>
					<a onClick="getByDayEvent(<?= $toDate ?>, <?= $paging ?>);">
						<h4><?= $trimDate ?><br/><?= $day ?></h4>
					</a>
				</form>
			</div>
		<?PHP } ?>
	</div>
	<img src="./images/loading.gif" id="loading" alt="loading" style="display:none;" />
	<div class="chart" id="events"></div>
</div>
<div class="clear"></div>