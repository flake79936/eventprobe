<!DOCTYPE html>
<html>
    <head>
        <title>Weather</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0;">
        <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.10.2.min.js" type="text/javascript"></script>
    </head>
<body>
    <div id="container">
        <div class="sliceinfo" id="weather">
            <span class="ttitle">The weather</span>
            <div id="weathercnt">
                <p id="wlocation" class="sliceheadr">Loading location...</p>
                <p id="wconsulted">Loading data...</p>
                <img id="imgforecast" src="images/loading.gif" class="sliceimg" alt="Some icon">
                <div id="detailw">
                    <p id="tempw"></p>
                    <p id="windw"></p>
                    <p id="humidw"></p>
                </div>
            </div>
        </div>
    </div> 
<script type="text/javascript">
$(document).ready(function($) {
            var KEY = "a701d0d2314662c6";
            var urlpath, wlat, wlong;
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(getLocation);
            }
            else {
            urlpath = "geolookup/q/autoip.json";
            }
            function getLocation(position) {
                wlat = position.coords.latitude;
                wlong = position.coords.longitude;
                urlpath = "geolookup/q/" + wlat + "," + wlong ;
            }
            if (KEY != "a701d0d2314662c6")
            {
                $.ajax({
                    url: "http://api.wunderground.com/api/" + KEY + "/" + urlpath + ".json",
                    async: false,
                    dataType: "jsonp",
                    timeout: 4000,
                    success: function(parsed_json) {
                        var localw = parsed_json['current_observation']['display_location']['full'].toString();
                        var temp_c = parsed_json['current_observation']['temp_c'].toString();
                        var winds = parsed_json['current_observation']['wind_kph'].toString();
                        var humidw = parsed_json['current_observation']['relative_humidity'].toString();
                        var iconw = parsed_json['current_observation']['icon'].toString();
                        var consultw = parsed_json['current_observation']['observation_time'].toString();

                        $('#wlocation').html(localw);
                        $('#imgforecast').attr('src', "images/icons/" + iconw + ".png");
                        $('#tempw').html("<strong>Temperature:</strong> " + temp_c.replace(".",",") + " <sup>º C</sup>");
                        $('#humidw').html("<strong>Humidity:</strong> " + humidw);
                        $('#windw').html("<strong>Wind:</strong> " + winds + " Km/h");
                        $('#wconsulted').html(consultw.replace("Last Updated on","<strong>Updated on: </strong>"));
                        $('#wlocation').css("font-weight","bold");
            },
            error: function(request, status, err) {
                if (status == "timeout") {
                    $('#wlocation').html("ERROR");
                    $('#consultado').html("We were not able to load the information");
                    $('#imgforecast').attr('src', "http://t3.gstatic.com/images?q=tbn:ANd9GcQzl8g-SPI029d0EUZqW_oFPS8HqQ1yVMTBRZcLzulc51WIEIPn");
                } else {
                     $('#wlocation').html("Error: " + request + status + err);
                }
            }
        });
    }
    else
        alert("Fatal error");
});
</script>
</body>
</html>