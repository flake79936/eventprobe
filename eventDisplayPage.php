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
        <link rel="stylesheet" type="text/css" href="css/app.css" />
        <link rel="stylesheet" type="text/css" href="css/links.css" />
        <link rel="stylesheet" type="text/css" href="css/footer.css" />
        
        <!--GOOGLE MAP-->        
		<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.10.1.min.js"></script>
		
		
		
        <!--FAVICON-->
        <link rel="shortcut icon" href="favicon.ico"  />
	</head>
	
	<body lang="en">
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

        
        ?>
				<div class="app">		

		
							<div class="left">

							 <?= $row['Evename'] ?> - <?= $row['Ehashtag'] ?>
							<?= $row['EstartDate'] ?> <?= $row['EtimeStart'] ?> to <?= $row['EtimeEnd'] ?> 
							<br>
							<img src= <?= $row['Eflyer'] ?> height="200px" width="300px" >
							
<!-- 	START OF MAP SCRIPT						 -->
		<div id="map" style="width: 370px; height: 370px;"></div>
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

								Right

							<div class="clear"></div>



							</div><!-- End of Right -->  
							
							
						<?PHP	}?>

        
        <div class="links">
			<?PHP include './links.php'; ?>
        </div>
        
        <div class="footer">
			<?PHP include './footer.php'; ?>
        </div>
	</body>
</html>