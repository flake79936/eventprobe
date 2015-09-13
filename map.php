<!--Module-->
<?PHP
	require_once("./include/membersite_config.php");
	include 'dbconnect.php';
	
	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);
	
	// 	$city = $fgmembersite->getCity();
	$city  = $_SESSION["city"];
	$state = $_SESSION["state"];
	//$city = "El Paso";
	
	if(isset($_POST["submitted"])){
		$result = $fgmembersite->searchEvent();
	}
	
	$newformat = date('Y-m-d');
	
	$pageId = (!isset($_GET["eventPageId"]) ? 1 : $_GET["eventPageId"]);
	if ($pageId <= 0) { $pageId = 1; } //DEFAULT pageId # 1
	
	$per_paging = 8; // Set how many records do you want to display per pageId.
	
	$startpoint = ($per_paging * $pageId) - $per_paging;
	
	$qry = "SELECT * FROM Events WHERE EstartDate >= '" . $newformat . "' AND Ecity = '" . $city . "' AND Edisplay='1' AND (Erank='premium' OR Erank='paid') ;";
	$result2 = mysqli_query($con, $qry);

	$num_rows = mysqli_num_rows($result2);
	
	if ($num_rows < 1 ){
		$statement = "Events WHERE EstartDate >= '" . $newformat . "' AND Estate = '" . $state . "' AND Edisplay='1' AND (Erank='premium' OR Erank='paid') ORDER BY EstartDate ";	
	} else {
		$statement = "Events WHERE EstartDate >= '" . $newformat . "' AND Ecity = '" . $city . "' AND Edisplay='1' AND (Erank='premium' OR Erank='paid') ORDER BY EstartDate ";
	}
		
	//please do not add a semicolon at the end of this line, inside of the double quotes.
// 	$statement = "Events WHERE EstartDate >= '" . $newformat . "' AND Ecity = '" . $city . "' AND Edisplay='1' AND (Erank='premium' OR Erank='paid') ORDER BY EstartDate ";
	
	$sql = "SELECT * FROM {$statement} LIMIT {$startpoint}, {$per_paging};";

	$result = mysqli_query($con, $sql);
	
	$i = 0;
	while($row = mysqli_fetch_array($result)){
		$event = $row['Evename'];
		$Elat  = $row['Elat'];
		$Elong = $row['Elong'];

		$eventArray[$i] = [$event, $Elat, $Elong];

		$i++;
	}
?>

<head>
	<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.10.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="./css/map.css" />
</head>

<body lang="en">
	<div id="map" class="map"></div>
	<script type="text/javascript" language="php">
		// Define your locations: HTML content for the info window, latitude, longitude

		var locations = <?php echo json_encode($eventArray);?>;

		// Setup the different icons and shadows
		var iconURLPrefix = 'http://maps.google.com/mapfiles/ms/icons/';

		var icons = ['images/favicon.png'];
		var icons_length = icons.length;

		var shadow = {
			anchor: new google.maps.Point(15, 33),
			url: iconURLPrefix + 'msmarker.shadow.png'
		};

		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 3,
			center: new google.maps.LatLng(37.6, -95.665),
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
				zoom: 5,
				map: map,
				icon : icons[iconCounter],
				shadow: shadow
			});

			markers.push(marker);

			google.maps.event.addListener(marker, 'click', (function(marker, i) {
				return function() {
					infowindow.setContent(locations[i][0]);
					infowindow.open(map, marker);
				};
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
</body>
