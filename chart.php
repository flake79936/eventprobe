<!--Module-->
<?PHP
	require_once("./include/membersite_config.php");
	include 'dbconnect.php';
	
// 	$city = $fgmembersite->getCity();
	$city= $_SESSION["city"];
	//$city= "el paso";
	
	$usrname = $fgmembersite->UsrName();
	$bool = $fgmembersite->CheckSession();
	
	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);
?>

<link rel="stylesheet" type="text/css" href="css/chart.css" />
<link rel="stylesheet" type="text/css" href="css/pag.css" />

<script>
	//displays the 
	(function($){
		$(document).ready(function(){
			var $weekContainer = $("#weeklyDays");
			$weekContainer.load("days.php");
		});
	})(jQuery);
	
	/*
	 * This was the best way to make this function without losing reference to what the count was for the start and end values.
	 * runs on the client-side that allows the site to keep track of the values.
	*/
	var start = 0;
	var end = 6;
	
	/*This function is intended to subtract one when the left arrow  next to the days is clicked on.
	 * It's main functionality is to subtract one week to the days being displayed on top of the events in the section that read "Today and this Week Near You".
	 * The algorithm is simple, just make the start subtract 6 and subtract 6 to the end (because there is 6 days in a week).
	 * These values are then passed to the AJAX call to make the 'start' and 'end' run in a for loop.
	 * 
	 */
	function prevWeek(){
		if(start > 0){
			start -= 6;
			end -= 6;
			
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("weeklyDays").innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET", "days.php?st=" + start + "&en=" + end, true);
			xmlhttp.send();
		}
	}
	
	/*This function is intended to add one when the right arrow next to the days is clicked on.
	 * It's main functionality is to add one week to the days being displayed on top of the events in the section that read "Today and this Week Near You".
	 * The algorithm is simple, just make the start date the end and make the end add 6 (because there is 6 days in a week).
	 * These values are then passed to the AJAX call to make the 'start' and 'end' run in a for loop.
	 * 
	 */
	function nextWeek(){
		start = end;
		end += 6;
		
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("weeklyDays").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET", "days.php?st=" + start + "&en=" + end, true);
		xmlhttp.send();
	}
	
	/* The jQuery AJAX functionality below is for the events that display in the 'chart' area. */
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
			var $freeEventsContainer = $("#events");
			$freeEventsContainer.load("getByDayEvent.php?freeDate=" + <?= $toDate ?>);
			
			//var refreshId2 = setInterval(function(){
			//	$freeEventsContainer.load("getByDayEvent.php?freeDate=" + <?= $toDate ?>);
			//}, 120000); //30k = 30 seconds
		});
	})(jQuery);
	
	function getByDayEvent(freeDate) {
		$(".link a").removeClass("In-active current");
		$("#"+freeDate+" a").addClass("In-active current");
		
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("events").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET", "getByDayEvent.php?freeDate=" + freeDate, true);
		xmlhttp.send();
	}
</script>

<div class="box">
	<div class="title">
		<!--<h1>Today and this Week Near You</h1>-->
		<!--To refresh, we can create a method in fg_membersite-->
		<!--<a href="#"><img src="images/btn_refresh.png" alt="Refresh" /></a>-->
		<div class="clear"></div>
	</div>
	
	<div class="a-row">
		<div class="row-left">
			<a onClick='prevWeek();'>
				<img src='./images/icon_ctrl_left.png' alt='Icon'/>
			</a>
		</div>
		
		<div class="row-right">
			<a onClick='nextWeek();'>
				<img src='./images/icon_ctrl_right.png' alt='Icon' />
			</a>
		</div>
	</div>
	
	<div class="row">
		<!--This will dipslay the days-->
		<div id="weeklyDays"></div>
		<?PHP //include './days.php'; ?>
	</div>
	
	<img src="./images/loading.gif" id="loading" alt="loading" style="display:none;" />
	<div class="chart" id="events">Sorry no events</div>
</div>
<div class="clear"></div>