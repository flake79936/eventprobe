<?PHP require_once("./include/membersite_config.php"); ?>

<!doctype html>
<html>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
		
		<title>Eventprobe - Services</title>
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link rel="stylesheet" media="all" href=""/>
		
        <!--STYLE-->
        <link rel="stylesheet" type="text/css" href="css/style.css"  />
        <link rel="stylesheet" type="text/css" href="css/header.css" />
        <link rel="stylesheet" type="text/css" href="css/links.css"  />
        <link rel="stylesheet" type="text/css" href="css/footer.css" />

        <!--FAVICON-->
        <link rel="shortcut icon" href="favicon.ico"  />
	</head>
	
	<body lang="en">
		<?php include_once("analyticstracking.php") ?>
		
    	<div class="header">
			<?PHP include './header.php';?>
        </div>
        
		<div class="content">
			<div class="con-wrap">
				<h1>Services</h1>
				<p>Its pretty simple folks. 
				For end users we compile all the public events in every city and bring it to you in a simple site and app. 
				All events can be searched by zip code, genre, and timeframe. 
				We give you the power to know what you're doing before you ever get there!<br> 
				If you are a promoter posting events is free if we didn’t already do it for you. 
				Free Listings are just that. </p>
				<div class="clear"> </div>
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="clear"></div>
		
        <div class="links">
			<?PHP include './links.php'; ?>
        </div>
        
        <div class="footer">
			<?PHP include './footer.php'; ?>
        </div>
	</body>
</html>