<?PHP require_once("./include/membersite_config.php"); ?>

<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
		
		<title>Eventprobe - About</title>
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link rel="stylesheet" media="all" href=""/>
		
        <!--STYLE-->
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/header.css" />
        <link rel="stylesheet" type="text/css" href="css/links.css" />
        <link rel="stylesheet" type="text/css" href="css/footer.css" />

        <!--FAVICON-->
        <link rel="shortcut icon" href="favicon.ico" />
	</head>
	
	<body lang="en">
		<?php include_once("analyticstracking.php") ?>
		
		<div class="wrap">
			<div class="header">
				<?PHP include './header.php'; ?>
			</div>
			
			<div class="content">
				<div class="con-wrap">
					<h1>About Us</h1>
					<p>Everyone is working more and vacationing less these days. 
					And getting away for a 3-day weekend is more common now than ever. 
					Making the most of those 72 hours has become key. 
					When you get there what are going to do? 
					Where should you go? Is there a concert? 
					Theres an app for that! Say hello to your friends at EventProbe. 
					All events across the nation in the palm of your hand. 
					Searchable by location, genre, time…you get the picture. 
					No more fumbling through multiple sites.</p>
					<img src="images/about_events.png">
					<div class="clear"></div>
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
		</div>
	</body>
</html>