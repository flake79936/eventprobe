<?PHP	require_once("./include/membersite_config.php"); 
	$newEventID = $_GET['eid'];
// 	$newEventID = "35";
	include 'dbconnect.php';
	?>

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
        <link rel="stylesheet" type="text/css" href="css/eventDisplayPage.css" />
        <link rel="stylesheet" type="text/css" href="css/links.css" />
        <link rel="stylesheet" type="text/css" href="css/footer.css" />
        <link rel="stylesheet" type="text/css" href="css/search.css" />
        
        <!--GOOGLE MAP-->        
		<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.10.1.min.js"></script>
		
		<script>
			function showHint(str) {
				if (str.length == 0) {
//					document.getElementById("txtHint").innerHTML = "";
					$(".eventDisplayPage").show();
					$(".right").show();
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
					
			function seeMoreInfo(str){
				window.location = "./eventDisplayPage.php?eid="+str;
			}
		</script>		
		
		<script>
			$(document).ready(function(){
				$("input").keydown(function(){
					$(".eventDisplayPage").hide();
					$(".right").hide();

				});
			});
		</script>
		
		
        <!--FAVICON-->
        <link rel="shortcut icon" href="favicon.ico"  />
	</head>
	
	<body lang="en">
	
			<div class="search">
			<form>
				<input type="text" onkeyup="showHint(this.value)" placeholder="Search for Event">
			</form>
		</div>
		
    	<div class="top">
			<?PHP include './top.php';?>
        </div>
        
        <?PHP
  		$qry = "SELECT * FROM Events WHERE Eid = '".$newEventID."' ;";
		$result = mysqli_query($con, $qry);   
		
		while($row = mysqli_fetch_array($result)) {   
		$i = 0 ;
		$event = $row['Evename'];
		$Elat  = $row['Elat'];
		$Elong = $row['Elong'];

		$eventArray[$i]=[$event,$Elat,$Elong];
		
		/**  Format phone number **/
		$formatPhone = $row['EphoneNumber'];
    	$formatPhone = preg_replace("/[^0-9]/", "", $formatPhone);

    	if(strlen($formatPhone) == 7)
        	 $formatPhone=preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $formatPhone);
    	elseif(strlen($formatPhone) == 10)
        	$formatPhone= preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $formatPhone);
		/** End format phone number**/
        
        ?>
				<div class="eventDisplayPage">		

		
							<div class="left">

							<h1> <?= $row['Evename'] ?> - <?= $row['Ehashtag'] ?></h1>
							<h2><?= $row['EstartDate'] ?> <?= $row['EtimeStart'] ?> to <?= $row['EtimeEnd'] ?> </h2>
							<br>
							<img src= <?= $row['Eflyer'] ?> width="400px" height="300px"  >
							<br>
							<br>
							
<!-- 	START OF MAP SCRIPT						 -->
		<div id="map" style="width: 400px; height: 300px;"></div>
		<script type="text/javascript" language= "php">
			// Define your locations: HTML content for the info window, latitude, longitude

			var locations = <?php echo json_encode($eventArray);?>;

			// Setup the different icons and shadows
			var iconURLPrefix = 'http://maps.google.com/mapfiles/ms/icons/';

			var icons = ['images/favicon.png']
			var icons_length = icons.length;

			var shadow = {
				anchor: new google.maps.Point(15,33),
				url: iconURLPrefix + 'msmarker.shadow.png'
			};

			var map = new google.maps.Map(document.getElementById('map'), {
				zoom: 12,
				center: new google.maps.LatLng(-50.92, 120.25),
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				mapTypeControl: true,
				streetViewControl: true,
				panControl: true,
				zoomControlOptions: {
					position: google.maps.ControlPosition.LEFT_BOTTOM
				}
			});

			var infowindow = new google.maps.InfoWindow({ maxWidth: 160 });

			var marker;
			var markers = new Array();

			var iconCounter = 0;

			// Add the markers and infowindows to the map
			for (var i = 0; i < locations.length; i++) {  
				marker = new google.maps.Marker({
					position: new google.maps.LatLng(locations[i][1], locations[i][2]),
					map: map,
					icon : icons[iconCounter],
					shadow: shadow
				});

				markers.push(marker);

				google.maps.event.addListener(marker, 'click', (function(marker, i) {
					return function() {
						infowindow.setContent(locations[i][0]);
						infowindow.open(map, marker);
					}
				})(marker, i));

				iconCounter++;
				// We only have a limited number of possible icon colors, so we may have to restart the counter
				if(iconCounter >= icons_length){
					iconCounter = 0;
				}
			}

			function AutoCenter() {
				//  Create a new viewpoint bound
				var bounds = new google.maps.LatLngBounds();
				//  Go through each...
				$.each(markers, function (index, marker) {
					bounds.extend(marker.position);
				});
				//  Fit these bounds to the map
				map.fitBounds(bounds);
			} AutoCenter();
		</script> 
<!-- 				END OF MAP SCRIPT										 -->
							</div><!-- End of left-->
							
							
							</div>
							
							

		<div class="right">
<br>
<br>
<br>
<br>
<br>
<br>
<br>

			<h1><?= $row['Edescription'] ?></h1>
				<br>
						<a href="<?= $row['Ewebsite'] ?>" target="_blank"><?= $row['Ewebsite'] ?>
				<br>	
						<?PHP if ($row['Efacebook']){?>
						<a href="<?= $row['Efacebook'] ?>" target="_blank"><img src="images/btn_fb.png" onmouseover="this.src='images/btn_fbColor.png'" onmouseout="this.src='images/btn_fb.png'" alt="Facebook" />
						</a>
						<?PHP }?>
						<?PHP if ($row['Etwitter']){?>
						<a href="<?= $row['Etwitter'] ?>" target="_blank"><img src="images/btn_twitter.png" onmouseover="this.src='images/btn_twitterColor.png'" onmouseout="this.src='images/btn_twitter.png'" alt="Twitter" />
						</a>
						<?PHP }?>
						<?PHP if ($row['Egoogle']){?>
						<a href="<?= $row['Egoogle'] ?>"><img src="images/btn_google.png" onmouseover="this.src='images/btn_googleColor.png'" onmouseout="this.src='images/btn_google.png'" alt="Google" />
						</a>
						<?PHP }?>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>	
						<br>						
						<br>
						<h4><img src='images/favicon.png'><?= $row['Eaddress'] ?>, <?= $row['Ecity'] ?>, <?= $row['Estate'] ?>, <?= $row['Ezip'] ?> </h4>
						<h4>&nbsp;  &nbsp;  &nbsp;  &nbsp;  Phone: <?= $formatPhone?> </h4>

											<div class="clear"></div>



							</div><!-- End of Right -->  
							
							
						<?PHP	}?>

        <br>
        <br>
		
		<!-- SHOW SEARCH RESULTS 		 -->
		<div class="events" id="txtHint"></div>
        
        <div class="links">
			<?PHP include './links.php'; ?>
        </div>
        
        <div class="footer">
			<?PHP include './footer.php'; ?>
        </div>
	</body>
</html>