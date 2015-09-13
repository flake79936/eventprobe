<!--Map Section-->
<?PHP
	require_once("./include/membersite_config.php");
	include 'dbconnect.php';
	
	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);
	
	$city = $fgmembersite->getCity();
	//$city= "el paso";
	
	$usrname = $fgmembersite->UsrName();
	$bool = $fgmembersite->CheckSession();
	
	$newformat = date('Y-m-d');
	//echo "NewFormat: " . $newformat . "<br>";
	
	$statement = "Events WHERE EstartDate = '" . $newformat . "' AND Ecity = '" . $city . "' AND Edisplay='1' AND (Erank='Paid' OR Erank='Premium') ORDER BY EstartDate ASC ";
	
	$sql = "SELECT * FROM {$statement};";
	$result = mysqli_query($con, $sql);
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
			};
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
		};
		xmlhttp.open("GET", "events.php?st=" + st, true);
		xmlhttp.send();
	}
</script>

<div class="leftSide">
	<div class="box-title">
		<h1>This week near you</h1>
	</div>

	<!--Map-->
	<div class="map">
		<iframe src="./map.php"></iframe>
	</div>
</div>

<!--Today Section-->
<div class="today">
	<div class="row">
		<div class="box-left">
			<a onClick='prevEvents();'>
				<img src='./images/icon_ctrl_left.png' alt='Icon'/>
			</a>
		</div>
		
		<div class="box-right">
			<a onClick='nextEvents();'>
				<img src='./images/icon_ctrl_right.png' alt='Icon' />
			</a>
		</div>
	</div>
	
	<?PHP //include './events.php'; ?>
	<div id="middleEvents"></div>
	<img src="./images/loading.gif" id="scheLoading" alt="loading" style="display:none;" />
</div>

<div class="clear"></div>