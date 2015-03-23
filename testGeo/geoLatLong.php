<?PHP
	if($_GET['latitude'] !== "" && $_GET['longtitude'] !== ""){
		$latitude = $_GET['latitude'];
		$longtitude = $_GET['longtitude'];
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		
		<script>
			//$(document).ready(function(){
				//getGeolocation();
				
				/*function getGeolocation(){
					if (navigator.geolocation) {
						navigator.geolocation.getCurrentPosition(showPosition);
					} else { 
						alert("Geolocation is not supported by this browser.");
					}
				}*/
				
				/*function showPosition(position) {
					/* pass lat and long back to server
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function(){
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							document.getElementById("#demo").innerHTML = xmlhttp.responseText;
						}
					}
					xmlhttp.open("GET", "geo.php?latitude=" + position.coords.latitude + "&longtitude=" + position.coords.longitude, true);
					xmlhttp.send();
				}*/
			//});
		</script>
		
		
	</head>
	
	<body>
		<p>Click the button to get your coordinates.</p>
		<button onclick="getLocation()">Try It</button>
		<!--<button onclick="getGeolocation()">Try It</button>-->
		<div id="demo" value=""></div>
		
		<p id="lat" value=""><?PHP echo $latitude; ?></p>
		<p id="long" value=""><?PHP echo $longitude; ?></p>
		
		<script>
			$(document).ready(function(){
				getLocation();
			});
			
			var x = document.getElementById("demo");

			function getLocation() {
				if (navigator.geolocation) {
					navigator.geolocation.getCurrentPosition(showPosition);
				} else { 
					x.innerHTML = "Geolocation is not supported by this browser.";
				}
			}

			function showPosition(position) {
				x.innerHTML = "Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude;	
			}
		</script>
		
		
	</body>
</html>