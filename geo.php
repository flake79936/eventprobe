<?PHP require_once("./include/membersite_config.php"); ?>

<html>
	<head>
		<script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
	</head>
	<body>
		<script language="Javascript"> 
			document.write("Welcome to our visitors from "+geoplugin_city()+", "+geoplugin_countryName()); 
			var city = geoplugin_city();
			document.write("\n" + city);
			
			window.location.href = "./map.php?city=" + city;
		</script>

		<?PHP
			$newcity = "";
			$city = $newcity;
			echo $city;
			//$fgmembersite->RedirectToURL("./map.php?city=" . $newcity);
		?>
	</body>
</html>