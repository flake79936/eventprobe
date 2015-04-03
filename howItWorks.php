<?PHP require_once("./include/membersite_config.php"); ?>

<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=.9, maximum-scale=.9, user-scalable=0"/>
		
		<title>Eventprobe - H.I.W.</title>
		
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link rel="stylesheet" media="all" href=""/>
		<!-- Adding "maximum-scale=.9" fixes the Mobile Safari auto-zoom bug: http://filamentgroup.com/examples/iosScaleBug/ -->
        
        <!--STYLE-->
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/header.css" />
        <link rel="stylesheet" type="text/css" href="css/links.css" />
        <link rel="stylesheet" type="text/css" href="css/footer.css" />

        <!--FAVICON-->
        <link rel="shortcut icon" href="favicon.ico"  />
	</head>
	
	<body lang="en">
    	<div class="header">
			<?PHP include './header.php';?>
        </div>
		
        <div class="content">
			<h3>How It Works</h3>
            <p>Events are by default will be listed in descending order by date. Closest due dates at top. We have no affiliation with promoters, or organizers and our only wish is to bring true and current information to you. Events that have been boosted will always be listed first in their category because that keeps the lights on. </p>
			<div class="clear"> </div>
        </div>
        
        <div class="links">
			<?PHP include './links.php'; ?>
        </div>
        
        <div class="footer">
			<?PHP include './footer.php'; ?>
        </div>
	</body>
</html>