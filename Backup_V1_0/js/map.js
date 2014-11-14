function initialize(){
	var mapProp = {
		center: new google.maps.LatLng(49.2804177, -122.9971808),
		zoom:13,
		panControl:false,
		zoomControl:true,
		mapTypeControl:false,
		scaleControl:true,
		streetViewControl:false,
		overviewMapControl:false,
		rotateControl:false,   
		scrollwheel: false,
		mapTypeId:google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
}
google.maps.event.addDomListener(window, 'load', initialize);
