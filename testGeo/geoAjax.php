<html>
	<head>
		<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.10.2.min.js" type="text/javascript"></script>
	</head>
	
	<body>
		<div id="wlocation"></div>
		<div id="consultado"></div>
		
		<script type="text/javascript">
			$(document).ready(function(){
				//var KEY = "a701d0d2314662c6";
				var urlpath, wlat, wlong;
				
				if (navigator.geolocation) {
					navigator.geolocation.getCurrentPosition(getLocation);
				} else {
					alert("Sorry could not get the location!");
				}
				
				function getLocation(position){
					wlat = position.coords.latitude;
					wlong = position.coords.longitude;
					urlpath = "latitude=" + wlat + "&longtitude=" + wlong;
					
					$.ajax({
						url: "geo.php?" + urlpath,
						cache: false,
						async: true,
						method: "GET",
						beforeSend: function(){
							alert("Before the sending info...");
						},
						success: function(){
							alert("Your location has been set.\nYou can now see your local events.");
						}/*,
						error: function(request, status, err) {
							if (status == "timeout") {
								$('#wlocation').html("ERROR");
								$('#consultado').html("We were not able to load the information");
								//$('#imgforecast').attr('src', "http://t3.gstatic.com/images?q=tbn:ANd9GcQzl8g-SPI029d0EUZqW_oFPS8HqQ1yVMTBRZcLzulc51WIEIPn");
							} else {
								$('#wlocation').html("Error: " + request + status + err);
							}
						}*/
					});
				}
			});
		</script>
	</body>
</html>