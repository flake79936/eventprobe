<?php
	/**
	* Grabs and returns the URL of current page.
	* @param   none
	* @return  URL of current page
	*/
	
	function grabCurrentURL(){
		
		(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on") ? $url = "https://" : $url = "http://";
		
		//echo "First echo: " . $url;
		
		$url .= $_SERVER['SERVER_NAME'];
		
		//echo "<br>Second echo: " . $url;
		
		($_SERVER['SERVER_PORT'] !== 80) ? $url .= ":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"] : $url .= $_SERVER["REQUEST_URI"];
		
		//echo "<br>Third echo: " . $url;
		
		return $url;
	}
	$test = grabCurrentURL();
	
	//echo "<br>Fourth echo: " . $test;

	$mystring = (string)$test;
	
	//echo "<br>Fifth echo: " . $mystring;

	//$findme = 'url.php';
	
	//echo "<br>Sixth echo: " . $findme;
	
	$pos = strpos($test, $findme);
	
	//echo "<br>Seventh echo: " . $pos;

	// if(!$pos !== true){
	// echo "test";
	// }
	// else {
	// echo "not found";
	// }
?>

<!DOCTYPE html> 
<html> 
	<head> 
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
		<title>EventProbe</title> 

		<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script> 
		<script type="text/javascript">
			//alert("Initializing variables.");
			var geocoder, lat, lng, mycity, mystate, city, latlng;
			
			//alert("check if your browser supports geolocation.");
			if ("geolocation" in navigator) {
				//alert("inside the IF navigator.geolocation");
				navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
			}
			
			//alert("checking if it was success.");
			//Get the latitude and the longitude;
			function successFunction(position) {
				//hasParameters();
				//console.log(position);
				lat = position.coords.latitude;
				lng = position.coords.longitude;
				//alert("Inside successFunction " + lat + ": " + lng);
				codeLatLng(lat, lng);
			}
			
			//alert("checking if any errors.");
			function errorFunction(){
				mycity = prompt("It appears that your GPS is off, Please enter your city", "");
				mystate = prompt("It appears that your GPS is off, Please enter your state", "TX");
				if (mycity !== null) {
					window.location.href = "./index2.php?city=" + mycity + "&state=" + mystate;
				}
			}

			//alert("going to initialize()");
			//function initialize() {
			//	geocoder = new google.maps.Geocoder();
			//}
			
			//alert("checking the codeLatLng()");
			function codeLatLng(lat, lng) {
				geocoder = new google.maps.Geocoder();
				latlng = new google.maps.LatLng(lat, lng);
				//alert("inside codeLatLng: \nLatLng:" + latlng);
				geocoder.geocode({'latLng': latlng}, function(results, status) {
					//alert("Before the google OK");
					if (status === google.maps.GeocoderStatus.OK) {
						//alert("Results: " + results + "\nStatus: " + status);
						if (results[1]) {
							//formatted address
							//alert("Formatted Address: " + results[0].formatted_address);
							
							//find country name
							for (var i = 0; i < results[0].address_components.length; i++) {
								for (var b = 0; b < results[0].address_components[i].types.length; b++) {
									//there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
									if (results[0].address_components[i].types[b] == "locality") {
										//this is the object you are looking for
										city = results[0].address_components[i];
										//break;
									}
									if (results[0].address_components[i].types[b] == "administrative_area_level_1") {
										//this is the object you are looking for
										mystate = results[0].address_components[i];
										//break;
									}
								}
							}
							//city data
							window.location.href = "./index2.php?city=" + city.long_name +"&state=" + mystate.short_name;
							//alert("City name: " + city.long_name);
						} else {
							//alert("No results found");
						}
					} else {
						//alert("Geocoder failed due to: " + status);
					}
				});
			}
			
			//alert("end of script...");
		</script> 
	</head>
	
	<body>
		<?php include_once("analyticstracking.php") ?>
	</body>
</html>