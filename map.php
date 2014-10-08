<?PHP

	require_once("./include/membersite_config.php");
	if(!$fgmembersite->CheckLogin()){
		$fgmembersite->RedirectToURL("login.php");
		exit;
	}
	
		if(isset($_POST["submitted"])){
		$result = $fgmembersite->searchEvent();
	}
	
	$usrname = $fgmembersite->UsrName();
	
	$con = mysqli_connect('localhost', 'admindev', '17s_9Eyr', 'EventAdvisors');
	
	if (!$con) {
		die('Could not connect: ' . mysqli_error($con));
	}

	mysqli_select_db($con, "EventAdvisors");
	
	$sql = "SELECT * FROM Events WHERE Ecity = 'el paso' ORDER BY EstartDate";
	
	$result = mysqli_query($con, $sql);

?>

		<div id="main_container">
			<div id='middle_box'>
				<div id="inner-mid-box">
					<?PHP
						$i = 0;
						while($row = mysqli_fetch_array($result)){ 
						
						//if the street name contains two or more words, the map will not recognize the street.
						$address = $row['Eaddress'] . ", " . $row['Ecity'] . ", " . $row['Estate'] . " " . $row['Ezip'];
						$expression = "/\s/";
						$replace = " ";

						$street = preg_replace($expression, $replace, $address);
					?>
					
					
						<div class="accordion vertical">
							<ul>
<!-- 							<?= $street?> -->


<?php
// $address = '201 S. Division St., Ann Arbor, MI 48104'; // Google HQ
$prepAddr = str_replace(' ','+',$street);
 
$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
 
$output= json_decode($geocode);
 
$lat = $output->results[0]->geometry->location->lat;
$long = $output->results[0]->geometry->location->lng;
 
echo $address.'<br>Lat: '.$lat.'<br>Long: '.$long;
 $zlat=$lat;
 $zlong=$long;
?>




							</ul>
						</div>
					<?PHP $i++; } ?>
				<div>
			</div>
		</div>

<!-- end of accordion -->


<!DOCTYPE html>
<html> 
<head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <title>Google Maps Multiple Markers</title> 
  <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.10.1.min.js"></script>
</head> 
<body>
  <div id="map" style="width: 500px; height: 400px;"></div>

  <script type="text/javascript" language= "php">
    // Define your locations: HTML content for the info window, latitude, longitude
    var locations = [
      ['<h4>Bondi Beach</h4>', -33.890542, 151.274856],
      ['<h4>Coogee Beach</h4>', -33.923036, 151.259052],
      ['<h4>Cronulla Beach</h4>', -34.028249, 151.157507],
      ['<h4>Manly Beach</h4>', -33.80010128657071, 151.28747820854187],
      ['<h4>Maroubra Beach</h4>', -33.950198, 151.259302]
    ];
    
    // Setup the different icons and shadows
    var iconURLPrefix = 'http://maps.google.com/mapfiles/ms/icons/';
    
    var icons = [
    'images/favicon.ico'
    ]
    var icons_length = icons.length;
    
    
    var shadow = {
      anchor: new google.maps.Point(15,33),
      url: iconURLPrefix + 'msmarker.shadow.png'
    };

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: new google.maps.LatLng(-37.92, 151.25),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      mapTypeControl: false,
      streetViewControl: false,
      panControl: false,
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