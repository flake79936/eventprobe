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
	/*
	 * This was the best way to make this function without losing reference to what the count was for the start and end values.
	 * runs on the client-side that allows the site to keep track of the values.
	*/
	var st = 0;
	var en = 8;
	
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
			$eventsContainer.load("events.php?st=" + st);
			
			var refreshId1 = setInterval(function(){
				$mapContainer.load("map.php?eventPageId=0");
				
				$eventsContainer.load("events.php?st=" + st);
			}, 30000); //30k = 30 seconds
		});
	})(jQuery);
	
	/*This function is intended to subtract one when the left arrow  next to the days is clicked on.
	 * It's main functionality is to subtract one week to the days being displayed on top of the events in the section that read "Today and this Week Near You".
	 * The algorithm is simple, just make the start subtract 6 and subtract 6 to the end (because there is 6 days in a week).
	 * These values are then passed to the AJAX call to make the 'start' and 'end' run in a for loop.
	 * 
	 */
	function prevEvents(){
		if(st > 0){
			st -= 8;
			en -= 8;
			
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("middleEvents").innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET", "events.php?st=" + st, true);
			xmlhttp.send();
		}
	}
	
	/*This function is intended to add one when the right arrow next to the days is clicked on.
	 * It's main functionality is to add one week to the days being displayed on top of the events in the section that read "Today and this Week Near You".
	 * The algorithm is simple, just make the start date the end and make the end add 6 (because there is 6 days in a week).
	 * These values are then passed to the AJAX call to make the 'start' and 'end' run in a for loop.
	 * 
	 */
	function nextEvents(){
		st = en;
		en += 8;
		
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("middleEvents").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET", "events.php?st=" + st, true);
		xmlhttp.send();
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
</div>

<div class="clear"></div>