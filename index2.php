<?PHP require_once("./include/membersite_config.php"); ?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Eventprobe</title>
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link rel="stylesheet" media="all" href=""/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
		<!-- Adding "maximum-scale=1" fixes the Mobile Safari auto-zoom bug: http://filamentgroup.com/examples/iosScaleBug/ -->
        
        <!--STYLE-->
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/top.css" />
        <link rel="stylesheet" type="text/css" href="css/search.css" />
        <link rel="stylesheet" type="text/css" href="css/myEvents.css" />
        <link rel="stylesheet" type="text/css" href="css/banner.css" />
        <link rel="stylesheet" type="text/css" href="css/thisWeek.css" />
        <link rel="stylesheet" type="text/css" href="css/schedule.css" />
        <link rel="stylesheet" type="text/css" href="css/app.css" />
        <link rel="stylesheet" type="text/css" href="css/links.css" />
        <link rel="stylesheet" type="text/css" href="css/footer.css" />

        <!--FAVICON-->
        <link rel="shortcut icon" href="favicon.ico"  />
        
		<!--<script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>-->
		
		<!--<script language="Javascript"> var city = geoplugin_city(); </script>-->
			
		<?PHP $city = "<script>document.write(city)</script>";
		// echo $city;
		?>
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		
		<!--<script>
			$(document).ready(function(){
				$.ajaxSetup({
					cache: false,
					beforeSend: function getGeolocation(){
						//var x = document.getElementById("demo");
						if (navigator.geolocation) {
							navigator.geolocation.getCurrentPosition(setGeolocation);
						} else { 
							//x.innerHTML = "Geolocation is not supported by this browser.";
							alert("Geolocation is not supported by this browser.");
						}
					},
					complete: function setGeolocation(position) {
						//x.innerHTML = "Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude;
						/*pass lat and long back to server*/
						var xmlhttp = new XMLHttpRequest();
						xmlhttp.onreadystatechange = function(){
							if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
								//document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
								alert(xmlhttp.responseText + " You are now pinged!");
							}
						}
						xmlhttp.open("GET", "setGeolocation.php?lat=" + position.coords.latitude + "&long=" + position.coords.longitude, true);
						xmlhttp.send();
					},
					success: function(){
						//$('#loading').hide();
						//$('#events').show();
						url: './index2.php';
					}
				});
			});

			/*function getByDayEvent(str) {
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById("events").innerHTML = xmlhttp.responseText;
					}
				}
				xmlhttp.open("GET", "getByDayEvent.php?date=" + str, true);
				xmlhttp.send();
			}*/
		</script>-->
		
		<script>
			/* User types in search bar, this will send an HTTP request on the 
			 * background to search the DB and get the result based on what the 
			 * user typed
			 */
			function showHint(str) {
				if (str.length == 0) {
					document.getElementById("txtHint").innerHTML = "";
					$(".my-events").show();
					$(".this-week").show();
					$(".schedule").show();
					$(".chart").show();
					$(".app").show();
					return;
				} else {
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
						}
					}
					xmlhttp.open("GET", "getEvent.php?q=" + str, true);
					xmlhttp.send();
				}
			}
			
			/*When the '+' plus button on the chart section is clicked,
			  it will be added to a list for the user on which they are related
			  to them. The events are the ones the user likes and would like to 
			  attend in the future.
			*/
			function addToUserTable(str) {
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						//document.getElementById("highlight").innerHTML = xmlhttp.responseText;
						$(".chart .box .row .info").css({ "background": "#f05a28" });
					}
				}
				xmlhttp.open("GET", "insert.php?eid=" + str, true);
				xmlhttp.send();
			}
		</script>
		
		<script>
			$(document).ready(function(){
				$("input").keydown(function(){
					$(".my-events").hide();
					$(".this-week").hide();
					$(".schedule").hide();
					$(".chart").hide();
					$(".app").hide();
				});
				
				$("#concert, #fair, #sport, #art").click(function(){
					$(".my-events").hide();
					$(".this-week").hide();
					$(".schedule").hide();
					$(".chart").hide();
					$(".app").hide();
				});
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
		<div class="search">
			<form>
				<input type="text" onKeyUp="showHint(this.value)" placeholder="Search for Event, City, State, Zip Code"><br/>
				<div style="text-align: center;">
					<a id="sport" onClick="showHint('sport');"><img alt="sport" src="./images/sports40.png"/></a> | 
					<a id="concert" onClick="showHint('concert');"><img alt="concert" src="./images/music.png"/></a> | 
					<a id="fair" onClick="showHint('fair');"><img alt="fair" src="./images/fair35.png"/></a> | 
					<a id="art" onClick="showHint('art');"><img alt="art" src="./images/art35.png"/></a>
					<a id="" onClick="showHint('');"><img alt="art" src="./images/clear.png"/></a>
				</div>
			</form>
		</div>
		
    	<div class="top">
			<?PHP include './top.php';?>
        </div>
		
		<!--My Events Section-->
		<?PHP if($fgmembersite->CheckSession()){ ?>
			<div class="my-events">
				<?PHP include './myevents.php'; ?>
			</div>
		<?PHP } ?>
        
		<!--Banner  Section-->
        <div class="banner">
			<?PHP include './banner2.php'; ?>
		</div>
        
		<!--This-Week Section-->
        <div class="this-week">
			<?PHP include './this-week.php'; ?>
        </div>
        
		<!--Schedule Section-->
        <div class="schedule">
			<!--Map Section-->
        	<div class="map">
				<iframe src="./map.php" height="390px" width="390px"></iframe>
				<!-- <?PHP //include('./geo.php'); ?> -->
				<!--<img src="images/map.jpg" alt="Map" />-->
			</div>
			
			<!--Today Section-->
            <div class="today">
				<?PHP include './events.php'; ?>
            </div>
			
            <div class="clear"></div>
        </div>
        
		<!--Chart Section-->
        <div class="chart">
			<?PHP include './chart.php'; ?>
        </div>
		
		<!--Section where events will show when user types on the search bar-->
		<div class="events" id="txtHint"></div>
        
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