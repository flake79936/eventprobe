<?PHP require_once("./include/membersite_config.php"); ?>

<html>
	<head>
		<script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
	</head>
	<body>
		<script language="Javascript"> 
			var city = geoplugin_city();
			window.location.href = "./events.php?city=" + city;
		</script>

	</body>
</html>