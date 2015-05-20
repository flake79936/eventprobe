<?php
/**
 * Grabs and returns the URL of current page.
 * @param   none
 * @return  URL of current page
 */
function grabCurrentURL(){
	if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
		$url = "https://";
	}else{
		$url = "http://";
	}
	$url .= $_SERVER['SERVER_NAME'];
	if($_SERVER['SERVER_PORT'] != 80){
		$url .= ":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	}else{
		$url .= $_SERVER["REQUEST_URI"];	
	}
	return $url;
}
$test=grabCurrentURL();
 
	 $mystring = (string)$test;
	
	$findme   = 'url.php';
	$pos = strpos($test, $findme);
	
// if(!$pos !== true){
// echo "test";
// }
// else {
// echo "not found";
// }

?>

<!-- 
//Check if browser supports W3C Geolocation API
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
} 
//Get latitude and longitude;
function successFunction(position) {
    var lat = position.coords.latitude;
    var long = position.coords.longitude;
}
 -->
	
<!DOCTYPE html> 
<html> 
<head> 
<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/> 
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
<title>EventProbe</title> 

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script> 
<script type="text/javascript"> 
  var geocoder;

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
} 
//Get the latitude and the longitude;
function successFunction(position) {
    var lat = position.coords.latitude;
    var lng = position.coords.longitude;
    codeLatLng(lat, lng)
}

function errorFunction(){
var mycity = prompt("It appears that your GPS is off, Please enter your city", "");
var mystate = prompt("It appears that your GPS is off, Please enter your state", "TX");

if (mycity != null) {

window.location.href = "./index2.php?city=" + mycity + "&state=" + mystate;
    }
   
}

  function initialize() {
    geocoder = new google.maps.Geocoder();



  }

  function codeLatLng(lat, lng) {

    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
      console.log(results)
        if (results[1]) {
         //formatted address
        // alert(results[0].formatted_address)
        //find country name
             for (var i=0; i<results[0].address_components.length; i++) {
            for (var b=0;b<results[0].address_components[i].types.length;b++) {

            //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                if (results[0].address_components[i].types[b] == "locality") {
                    //this is the object you are looking for
                    city= results[0].address_components[i];
//                     break;
                }
                
                if (results[0].address_components[i].types[b] == "administrative_area_level_1") {
                    //this is the object you are looking for
                    mystate= results[0].address_components[i];
//                     break;
                }
                
                
                
            }
        }
        //city data
        window.location.href = "./index2.php?city=" + city.long_name +"&state=" + mystate.short_name;
//         alert(city.long_name)


        } else {
          alert("No results found");
        }
      } else {
        alert("Geocoder failed due to: " + status);
      }
    });
  }
</script> 
</head> 
<body onload="initialize()"> 

</body> 
</html>
