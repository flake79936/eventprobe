<!--Module-->

<?PHP
	require_once("./include/membersite_config.php");
	include 'dbconnect.php';
	
	$city = $fgmembersite->getCity();
	//$city= "el paso";
	
	$usrname = $fgmembersite->UsrName();
	$bool = $fgmembersite->CheckSession();
	
	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);
	
	$today = Date("m/d/Y"); //e.g., 02/03/2015
	//echo "Today: " . $today . "<br>";
	
	//$newformat = date('Y-m-d');
	//echo "NewFormat: " . $newformat . "<br>";
	
	$toDate = (isset($_GET["date"]) ? $_GET["date"] : strtotime($today));
	//echo "toDate: " . $toDate . "<br>";
	
	$pageId = (isset($_GET["pageId"]) ? $_GET["pageId"] : 0);
	//echo "Page: " . $pageId . "<br>";
	
	//$sql = "SELECT * FROM Events WHERE EstartDate = '" . $newformat . "' AND Ecity = '" . $city . "' AND Edisplay='1' AND (Erank='Free' OR Erank='Premium' OR Erank='Paid') ORDER BY EstartDate ASC;";
	//$result = mysqli_query($con, $sql);
	//$count = mysqli_num_rows($result);
	//echo "<br>Query: " . $sql . "<br>";
	//echo "count: " . $count;

	//if($count > 0){
	//	$paginationCount = $fgmembersite->getPagination($count, 2);
	//}
	
	//echo "<br/>Pagination Count: " . $paginationCount . "<br/>";
?>

<link rel="stylesheet" type="text/css" href="css/chart.css" />
<link rel="stylesheet" type="text/css" href="css/pag.css" />

<script>
	/*(function($){
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
			$container.load("./getByDayEvent.php?date=" + <?= $toDate ?> + "&pageId=" + <?= $pageId ?>);			
			var refreshId = setInterval(function(){
				$container.load("./getByDayEvent.php?date=" + <?= $toDate ?> + "&pageId=" + <?= $pageId ?>);
			}, 60000); //30k = 30 seconds
		});
	})(jQuery);*/
	
	function getByDayEvent(str, pageId) {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("events").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET", "./getByDayEvent.php?date=" + str + "&pageId=" + pageId, true);
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
				
				//for pagination, each day will have its own pagination.
				$newformat = date('Y-m-d', $toDate);
				
				$sql = "SELECT * FROM Events WHERE EstartDate = '" . $newformat . "' AND Ecity = '" . $city . "' AND Edisplay='1' AND (Erank='Free' OR Erank='Premium' OR Erank='Paid') ORDER BY EstartDate ASC;";
				$result = mysqli_query($con, $sql);
				$count = mysqli_num_rows($result);
				
				if($count > 0){
					$paginationCount = $fgmembersite->getPagination($count, 2);
				}
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
					<a onClick="getByDayEvent(<?= $toDate ?>, <?= $pageId ?>);">
						<h4><?= $trimDate ?><br/><?= $day ?></h4>
					</a>
					<?PHP if($count > 0){ ?>
						<ul class="<?= $ai."_no" ?> tsc_pagination tsc_paginationC tsc_paginationC01">
							<li class="first link" id="first">
								<a onClick="getByDayEvent(<?= $toDate ?>, 0)">First</a>
							</li>
							
							<!--Displays the page numbers-->
							<?PHP for($i = 0; $i < $paginationCount; $i++){ ?>
								<li id="<?= $i."_no" ?>" class="link">
									<a onClick="getByDayEvent(<?= $toDate ?>, <?PHP echo ($i+1); ?>)"><?PHP echo ($i+1); ?></a>
								</li>
							<?PHP } ?>
						
							<li class="last link" id="last">
								<a onClick="getByDayEvent(<?= $toDate ?>, <?PHP echo $paginationCount; ?>)">Last</a>
							</li>
						</ul>
					<?PHP } ?>
				</form>
			</div>
		<?PHP } ?>
	</div>
	
	<img src="./images/loading.gif" id="loading" alt="loading" style="display:none;" />
	<div class="chart" id="events">Sorry no events</div>
</div>
<div class="clear"></div>