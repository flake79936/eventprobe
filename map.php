<?PHP
	require_once("./include/membersite_config.php");
	$city = $fgmembersite->getCity();


	$city = (string)$city;



	if(isset($_POST["submitted"])){
		$result = $fgmembersite->searchEvent();
	}
	
	include 'dbconnect.php';
	$today = Date("m/d/Y");
	$sql = "SELECT * FROM Events WHERE EstartDate >= '".$today."' AND Ecity = '". $city ."'  ORDER BY EstartDate;";

	$result = mysqli_query($con, $sql);
	
	$i = 0;
	while($row = mysqli_fetch_array($result)){
		$event = $row['Evename'];
		$Elat  = $row['Elat'];
		$Elong = $row['Elong'];

		$eventArray[$i]=[$event,$Elat,$Elong];

		$i++;
	}
?>


<!DOCTYPE html>
<head> 
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
		<title>Google Maps Multiple Markers</title> 
		<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.10.1.min.js"></script>
	</head> 
	<body>
		<div id="map" style="width: 370px; height: 370px;"></div>
		<script type="text/javascript" language= "php">
			// Define your locations: HTML content for the info window, latitude, longitude

			var locations = <?php echo json_encode($eventArray);?>;

			// Setup the different icons and shadows
			var iconURLPrefix = 'http://maps.google.com/mapfiles/ms/icons/';

			var icons = [
			'images/favicon.png'
			]
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

			var infowindow = new google.maps.InfoWindow({
			maxWidth: 160
			});

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
			}
			AutoCenter();
		</script>
	</body>
</html>