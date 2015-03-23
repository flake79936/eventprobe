<!DOCTYPE html>
<html>
	<head>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script type="text/javascript" src="./jquery.cookie.js"></script>
		
		<script>
			$(document).ready(function(){
				var x = document.getElementById("demo");
			
				function getGeolocation(){
					if (navigator.geolocation) {
						navigator.geolocation.getCurrentPosition(showPosition);
					} else { 
						alert("Geolocation is not supported by this browser.");
					}
				}

				function showPosition(position) {
					$.cookie("MyLat", position.coords.latitude); 
					$.cookie("MyLon", position.coords.longitude);
					x.innerHTML = "Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude;	
				}
			});
		</script>
	</head>
	
	<body>
		<p>Click the button to get your coordinates.</p>
		<!--<button onclick="getGeolocation()">Try It</button>-->
		<div id="demo" value=""></div>
	</body>
</html>