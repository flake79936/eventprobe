<?PHP
$city=$_GET['city'];
$state=$_GET['state'];

session_start();
$_SESSION["city"] = $city;
$_SESSION["state"] = $state;

	require_once("./include/membersite_config.php"); 
	$minDate = date("Y-m-d");
	
	$toDate = strtotime(date("m/d/Y"));
	//echo "toDate: " . $toDate . "<br>";
	
	$pageId = (isset($_GET["pageId"]) ? $_GET["pageId"] : 0);
	//echo "Page: " . $pageId . "<br>";
?>

<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
		<title>Eventprobe - Home</title>
		
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link rel="stylesheet" media="all" href=""/>
        
        <!--STYLE-->
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/header.css" />
        <link rel="stylesheet" type="text/css" href="css/myEvents.css" />
        <link rel="stylesheet" type="text/css" href="css/banner.css" />
        <link rel="stylesheet" type="text/css" href="css/thisWeek.css" />
        <link rel="stylesheet" type="text/css" href="css/schedule.css" />
        <link rel="stylesheet" type="text/css" href="css/app.css" />
        <link rel="stylesheet" type="text/css" href="css/links.css" />
        <link rel="stylesheet" type="text/css" href="css/footer.css" />

        <!--FAVICON-->
        <link rel="shortcut icon" href="favicon.ico"  />
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		
		<script>
			$(document).ready(function(){ 
				<?php if($fgmembersite->geoNotSet()) echo "getGeolocation();"; ?> 
				getGeolocation();
			});
			
			function getGeolocation(){
				if (navigator.geolocation) {
					navigator.geolocation.getCurrentPosition(setGeolocation);
				} else { 
					alert("Geolocation is not supported by this browser.");
				}
			}
			
			function setGeolocation(position) {
				/* pass lat and long back to server*/
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function(){
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						// $fgmembersite->RedirectToURL("./index2.php");
						alert("lat=" + position.coords.latitude + "&long=" + position.coords.longitude);
					}
				}
				xmlhttp.open("GET", "setGeolocation.php?lat=" + position.coords.latitude + "&long=" + position.coords.longitude, true);
				xmlhttp.send();
			}
		</script>
		
		<script>
			/* User types in search bar, this will send an HTTP request on the 
			 * background to search the DB and get the result based on what the 
			 * user typed
			 */
			//function showHint(str) {
			//	if (str.length == 0){
			//		document.getElementById("txtHint").innerHTML = "";
			//		$(".my-events").show();
			//		$(".this-week").show();
			//		$(".schedule").show();
			//		$(".chart").show();
			//		$(".app").show();
			//		return;
			//	} else {
			//		var xmlhttp = new XMLHttpRequest();
			//		xmlhttp.onreadystatechange = function() {
			//			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			//				document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
			//			}
			//		}
			//		xmlhttp.open("GET", "./getEvent.php?q=" + str, true);
			//		xmlhttp.send();
			//	}
			//}
			
			/*When the '+' plus button on the chart section is clicked,
			  it will be added to a list for the user on which they are related
			  to them. The events are the ones the user likes and would like to 
			  attend in the future.
			*/
			function addToUserTable(str){
				$.ajaxSetup({
					cache: false,
					beforeSend: function(){
						//myEvents Section
						$('#myEventsDataLoading').show();
						$('#myEventsData').hide();
						
						//$('#events').hide();
						//$('#loading').show();
					},
					complete: function(){
						//myEvents Section
						$('#myEventsDataLoading').hide();
						$('#myEventsData').show();
						
						//$('#loading').hide();
						//$('#events').show();
					},
					success: function(){
						//myEvents Section
						$('#myEventsDataLoading').hide();
						$('#myEventsData').show();
						
						$(".chart .box .row .info ." + str).css({ "background": "#f05a28" });
						//$('#loading').hide();
						//$('#events').show();
					}
				});
				var $freeEventsContainer = $("#events");
				$freeEventsContainer.load("./insert.php?eid=" + str);
				
				//var xmlhttp = new XMLHttpRequest();
				//xmlhttp.onreadystatechange = function() {
				//	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				//		//document.getElementById("highlight").innerHTML = xmlhttp.responseText;
				//		$(".chart .box .row .info").css({ "background": "#f05a28" });
				//	}
				//}
				//xmlhttp.open("GET", "./insert.php?eid=" + str, true);
				//xmlhttp.send();
			}
		</script>
		
		<script>
			$(document).ready(function(){
				//$("input").keydown(function(){
				//	$(".my-events").hide();
				//	$(".this-week").hide();
				//	$(".schedule").hide();
				//	$(".chart").hide();
				//	$(".app").hide();
				//});
				
				//$("#concert, #fair, #sport, #art").click(function(){
				//	$(".my-events").hide();
				//	$(".this-week").hide();
				//	$(".schedule").hide();
				//	$(".chart").hide();
				//	$(".app").hide();
				//});
				
				//$("#searchDate").change(function(){
				//	$(".my-events").hide();
				//	$(".this-week").hide();
				//	$(".schedule").hide();
				//	$(".chart").hide();
				//	$(".app").hide();
				//});
			});
		</script>
		
		<!--Displays by Event ID in a new page-->
		<script>
			function seeMoreInfo(str){
				window.location = "./eventDisplayPage.php?eid="+str;
			}
		</script>
	</head>
	
	<body lang="en">
		<div class="header">
			<?PHP include './header.php'; ?>
		</div>
		
		<div class="clear"></div>
		
		<!--My Events Section-->
		<?PHP if($fgmembersite->CheckSession()){ ?>
			<div class="my-events">
				<?PHP include './myEvents.php'; ?>
			</div>
		<?PHP } ?>

		<!--Banner  Section-->
		<div class="banner">
			<?PHP include './banner.php'; ?>
		</div>

		<!--This-Week Section-->
		<div class="this-week">
			<?PHP include './thisWeek.php'; ?>
		</div>

		<!--Schedule Section-->
		<div class="schedule">
			<?PHP include './schedule.php'; ?>
		</div>

		<!--Chart Section-->
		<div class="chart">
			<?PHP include './chart.php'; ?>
		</div>

		<!--Section where events will show when user types on the search bar-->
		<!--<div class="events" id="txtHint"></div>-->
		<div class="clear"></div>

		<!--App Section-->
		<div class="app">
			<?PHP include './app.php'; ?>
		</div>

		<!--Links  Section-->
		<div class="links">
			<?PHP include './links.php'; ?>
		</div>

		<!--Footer Section-->
		<div class="footer">
			<?PHP include './footer.php'; ?>
		</div>
	</body>
</html>