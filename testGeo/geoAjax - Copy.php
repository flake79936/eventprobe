<!--http://stackoverflow.com/questions/20364242/geolocation-api-and-ajax-requests-->

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0;">
		<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.10.2.min.js" type="text/javascript"></script>
	</head>
	
	<body>
		<div id="wlocation"></div>
		<div id="consultado"></div>
		
		<script type="text/javascript">
			jQuery(document).ready(function($){
				//var KEY = "a701d0d2314662c6";
				var urlpath, wlat, wlong;
				
				if (navigator.geolocation) {
					navigator.geolocation.getCurrentPosition(getLocation);
				} else {
					urlpath = "../index2.php";
				}
				
				function getLocation(position){
					wlat = position.coords.latitude;
					wlong = position.coords.longitude;
					urlpath = "latitude=" + wlat + "&longitude=" + wlong;
					
					setLocation(urlpath);
				}
				
				function setLocation(urlpath){
					$.ajax({
						//url: "http://api.wunderground.com/api/" + KEY + "/" + urlpath + ".json",
						url: "geo.php?" + urlpath,
						async: true,
						//dataType: "php",
						method: "GET",
						//timeout: 4000,
						beforeSend: function(){
							alert("Before the sending info...");
						},
						success: function(){
							/*var localw   = parsed_json['current_observation']['display_location']['full'].toString();
							var temp_c   = parsed_json['current_observation']['temp_c'].toString();
							var winds    = parsed_json['current_observation']['wind_kph'].toString();
							var humidw   = parsed_json['current_observation']['relative_humidity'].toString();
							var iconw    = parsed_json['current_observation']['icon'].toString();
							var consultw = parsed_json['current_observation']['observation_time'].toString();

							$('#wlocation').html(localw);
							$('#imgforecast').attr('src', "images/icons/" + iconw + ".png");
							$('#tempw').html("<strong>Temperature:</strong> " + temp_c.replace(".",",") + " <sup>º C</sup>");
							$('#humidw').html("<strong>Humidity:</strong> " + humidw);
							$('#windw').html("<strong>Wind:</strong> " + winds + " Km/h");
							$('#wconsulted').html(consultw.replace("Last Updated on","<strong>Updated on: </strong>"));
							$('#wlocation').css("font-weight","bold");*/
							
							alert("Your location has been set.\nYou can now see your local events.");
						},
						error: function(request, status, err) {
							if (status == "timeout") {
								$('#wlocation').html("ERROR");
								$('#consultado').html("We were not able to load the information");
								//$('#imgforecast').attr('src', "http://t3.gstatic.com/images?q=tbn:ANd9GcQzl8g-SPI029d0EUZqW_oFPS8HqQ1yVMTBRZcLzulc51WIEIPn");
							} else {
								$('#wlocation').html("Error: " + request + status + err);
							}
						}
					});
				}
			});
		</script>
	</body>
</html>