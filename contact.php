<?PHP require_once("./include/membersite_config.php"); ?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Eventprobe</title>
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link rel="stylesheet" media="all" href=""/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
		<!-- Adding "maximum-scale=1" fixes the Mobile Safari auto-zoom bug: http://filamentgroup.com/examples/iosScaleBug/ -->
        
        <!--STYLE-->
        <link rel="stylesheet" type="text/css" href="css/style.css"  />
        <link rel="stylesheet" type="text/css" href="css/header.css" />
        <link rel="stylesheet" type="text/css" href="css/links.css"  />
        <link rel="stylesheet" type="text/css" href="css/footer.css" />

        <!--FAVICON-->
        <link rel="shortcut icon" href="favicon.ico"/>
	</head>
	
	<body lang="en">
		<div class="wrap">
			<div class="header">
				<?PHP include './header.php';?>
			</div>
			
			<div class="content">
				<div class="con-wrap">
					<h4>Content to be provided by LLC</h4>
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
        </div>
	</body>	
</html>