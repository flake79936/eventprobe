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
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
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
        
         <script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
			<script language="Javascript"> 
			var city = geoplugin_city();
			</script>
			
			  <?PHP $city = "<script>document.write(city)</script>";
// 			  echo $city;
			  ?>
			  
			  
			  <script>
			function showHint(str) {
				if (str.length == 0) {
					document.getElementById("txtHint").innerHTML = "";
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
		</script>
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script>
			$(document).ready(function(){
				$("input").keydown(function(){
					$(".my-events").hide();
					$(".this-week").hide();
					$(".schedule").hide();
					$(".chart").hide();
					$(".app").hide();
				});
			});
		</script>
	</head>
	
	<body lang="en">
    	<div class="top">
			<?PHP include './top.php';?>
			<div class="searchAjax">
				<form>
					<input class="ajax" type="text" onkeyup="showHint(this.value)" placeholder="Search for Event">
				</form>
			</div>
        </div>
		
		<!-- start My events      -->
		<?PHP if($fgmembersite->CheckSession()){ ?>
				<div class="my-events">
			<?PHP include './myevents.php'; ?>
				</div>
		<?PHP } ?>
		
		<!-- end My events -->
        
        <div class="banner">
			<?PHP include './banner.php'; ?>
			
		</div>
        
        <div class="this-week">
			<?PHP include './this-week.php'; ?>
        </div>
        
        <div class="schedule">
        	<div class="map">
        	<iframe src="./geo.php" height="390px" width="390px"></iframe>
<!-- 				<?PHP include('./geo.php'); ?> -->
				<!--<img src="images/map.jpg" alt="Map" />-->
        	        </div>
            <div class="today">
<!--             <iframe src="./geo2.php" height="380px" width="700px"></iframe> -->
				<?PHP include './events.php'; ?>
            </div>
           
            <div class="clear"></div>
        </div>
        
        <div class="chart">
			<?PHP include './chart.php'; ?>
        </div>
		
		<div class="events" id="txtHint"></div>
        
        <div class="app">
			<?PHP include './app.php'; ?>
        </div>
        
        <div class="links">
			<?PHP include './links.php'; ?>
        </div>
        
        <div class="footer">
			<?PHP include './footer.php'; ?>
        </div>
    
	</body>
	
</html>