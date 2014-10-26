// Geolocation detection with JavaScript, HTML5 and PHP
// http://locationdetection.mobi/
// Andy Moore
// http://andymoore.info/
// this is linkware if you use it please link to me:
// <a href="http://web2txt.co.uk/">Mp3 Downloads</a>

// this is called when the browser has shown support of navigator.geolocation
function GEOprocess(position) {
	// update the page to show we have the lat and long and explain what we do next
  document.getElementById('geo').innerHTML = 'Latitude: ' + position.coords.latitude + ' Longitude: ' + position.coords.longitude;
	// now we send this data to the php script behind the scenes with the GEOajax function
	GEOajax("geo.php?accuracy=" + position.coords.accuracy + "&latlng=" + position.coords.latitude + "," + position.coords.longitude +"&altitude="+position.coords.altitude+"&altitude_accuracy="+position.coords.altitudeAccuracy+"&heading="+position.coords.heading+"&speed="+position.coords.speed+"");
}

// this is used when the visitor bottles it and hits the "Don't Share" option
function GEOdeclined(error) {
  document.getElementById('geo').innerHTML = 'Error: ' + error.message;
}

if (navigator.geolocation) {
	navigator.geolocation.getCurrentPosition(GEOprocess, GEOdeclined);
}else{
  document.getElementById('geo').innerHTML = 'Your browser sucks. Upgrade it.';
}

// this checks if the browser supports XML HTTP Requests and if so which method
if (window.XMLHttpRequest) {
 xmlHttp = new XMLHttpRequest();
}else if(window.ActiveXObject){
 xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
}

// this calls the php script with the data we have collected from the geolocation lookup
function GEOajax(url) {
 xmlHttp.open("GET", url, true);
 xmlHttp.onreadystatechange = updatePage;
 xmlHttp.send(null);
}

// this reads the response from the php script and updates the page with it's output
function updatePage() {
 if (xmlHttp.readyState == 4) {
  var response = xmlHttp.responseText;
  document.getElementById("geo").innerHTML = '' + response;
 }
}
