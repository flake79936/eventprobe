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
?>

<link rel="stylesheet" type="text/css" href="css/chart.css" />
<link rel="stylesheet" type="text/css" href="css/pag.css" />

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
			var $freeEventsContainer = $("#events");
			$freeEventsContainer.load("getByDayEvent.php?freeDate=" + <?= $toDate ?>);
			
			var refreshId2 = setInterval(function(){
				$freeEventsContainer.load("getByDayEvent.php?freeDate=" + <?= $toDate ?>);
			}, 60000); //30k = 30 seconds
		});
	})(jQuery);
	
	function getByDayEvent(freeDate, freePageId) {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("events").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET", "getByDayEvent.php?freeDate=" + freeDate, true);
		xmlhttp.send();
	}
	
	//displays the 
	(function($){
		$(document).ready(function(){
			var $weekContainer = $("#weeklyDays");
			$weekContainer.load("days.php");
		});
	})(jQuery);
	
	/*
	 * Essentially 'shiftDays' should shift the days BACK or FORWARD in intervals of 7.
	 * We will make an AJAX call to the 'days.php' file to move to the desired dates.
	 * 
	 * 
	 * 
	 */
	function prevWeek(minusOne){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("weeklyDays").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET", "days.php?mo=" + minusOne, true);
		xmlhttp.send();
	}
	
	function nextWeek(plusOne){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("weeklyDays").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET", "days.php?po=" + plusOne, true);
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
		<ul class="tsc_pagination tsc_paginationC tsc_paginationC01">
			<li class="first link" id="first">
				<a onClick="prevWeek(0);" >Prev</a>
			</li>
		</ul>
		
		<!--This will dipslay the days-->
		<div id="weeklyDays"></div>
		<?PHP //include './days.php'; ?>
		
		<ul class="tsc_pagination tsc_paginationC tsc_paginationC01">
			<li class="last link" id="last">
				<a onClick="nextWeek(1);" >Next</a>
				
			</li>
		</ul>
	</div>
	
	<img src="./images/loading.gif" id="loading" alt="loading" style="display:none;" />
	<div class="chart" id="events">Sorry no events</div>
</div>
<div class="clear"></div>