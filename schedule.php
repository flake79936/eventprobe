<!--Map Section-->
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
	
	$toDate = (isset($_GET["eventDate"]) ? $_GET["eventDate"] : strtotime($today));
	//echo "toDate: " . $toDate . "<br>";
	
	$newformat = date('Y-m-d');
	//echo "NewFormat: " . $newformat . "<br>";
	
	$pageId = (isset($_GET["eventPageId"]) ? $_GET["eventPageId"] : 0);
	//echo "Page: " . $pageId . "<br>";
	
	$sql = "SELECT * FROM Events WHERE EstartDate = '" . $newformat . "' AND Ecity = '" . $city . "' AND Edisplay='1' AND (Erank='Paid' OR Erank='Premium') ORDER BY EstartDate ASC;";
	$result = mysqli_query($con, $sql);
	$count = mysqli_num_rows($result);
	//echo "<br>Query: " . $sql . "<br>";
	//echo "count: " . $count;

	if($count > 0){
		$paginationCount = $fgmembersite->getPagination($count, 8);
	}
	
	//echo "<br/>Pagination Count: " . $paginationCount . "<br/>";
?>

<script>
	(function($){
		$(document).ready(function(){
			$.ajaxSetup({
				cache: false,
				beforeSend: function(){
					$('#scheLoading').show();
					$('#eventMap').hide();
					$('#middleEvents').hide();
				},
				complete: function(){
					$('#scheLoading').hide();
					$('#eventMap').show();
					$('#middleEvents').show();
				},
				success: function(){
					$('#scheLoading').hide();
					$('#eventMap').show();
					$('#middleEvents').show();
				}
			});
			var $mapContainer = $("#eventMap");
			$mapContainer.load("map.php?eventPageId=0");
			
			var $eventsContainer = $("#middleEvents");
			$eventsContainer.load("events.php?eventPageId=0");
			
			var refreshId1 = setInterval(function(){
				$mapContainer.load("map.php?eventPageId=0");
				
				$eventsContainer.load("events.php?eventPageId=0");
			}, 60000); //30k = 30 seconds
		});
	})(jQuery);
	
	function getMidEvents(pageId){
		var xmlhttp1 = new XMLHttpRequest();
		var xmlhttp2 = new XMLHttpRequest();
		
		xmlhttp1.onreadystatechange = function() {
			if (xmlhttp1.readyState == 4 && xmlhttp1.status == 200) {
				document.getElementById("middleEvents").innerHTML = xmlhttp1.responseText;
			}
		}
		
		xmlhttp2.onreadystatechange = function() {
			if (xmlhttp2.readyState == 4 && xmlhttp2.status == 200) {
				document.getElementById("eventMap").innerHTML = xmlhttp2.responseText;
			}
		}
		
		xmlhttp1.open("GET", "./events.php?eventPageId=" + pageId, true);
		xmlhttp2.open("GET", "./map.php?eventPageId=" + pageId, true);
		
		xmlhttp1.send();
		xmlhttp2.send();
	}
</script>

<img src="./images/loading.gif" id="scheLoading" alt="loading" style="display:none;" />

<!--Map-->
<div class="map">
	<iframe src="./map.php"></iframe>
</div>

<!--Today Section-->
<div class="today">
	<?PHP //include './events.php'; ?>
	<div id="middleEvents"></div>
	
	<!--Displays the previous, #'s, and next buttons-->
	<?PHP if($count > 0){ ?>
		<ul class="tsc_pagination tsc_paginationC tsc_paginationC01">
			<li class="first link" id="first">
				<a onClick="getMidEvents(0)">First</a>
			</li>
			
			<!--Displays the page numbers-->
			<?PHP for($i = 0; $i < $paginationCount; $i++){ ?>
				<li id="<?= $i."_no" ?>" class="link">
					<a onClick="getMidEvents(<?PHP echo ($i+1); ?>)"><?PHP echo ($i+1); ?></a>
				</li>
			<?PHP } ?>
		
			<li class="last link" id="last">
				<a onClick="getMidEvents(<?PHP echo $paginationCount; ?>)">Last</a>
			</li>
		</ul>
	<?PHP } ?>
</div>

<div class="clear"></div>