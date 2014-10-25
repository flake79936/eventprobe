<html>
 <head>
  <script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
 </head>
 <body>
  <script language="Javascript"> 
// 	document.write("Welcome to our visitors from "+geoplugin_city()+", "+geoplugin_countryName()); 
	var city = geoplugin_city()

  </script>
  
  <?PHP 
  
   $city = "<script>document.write(city)</script>";
  echo $city;
  ?>
  
 </body>
</html>