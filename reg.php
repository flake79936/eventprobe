

<!doctype html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Eventprobe</title>
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link rel="stylesheet" media="all" href=""/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<!-- Adding "maximum-scale=1" fixes the Mobile Safari auto-zoom bug: http://filamentgroup.com/examples/iosScaleBug/ -->
        
        <!--STYLE-->
        <link rel="stylesheet" type="text/css" href="css/style.css" />

        <!--FAVICON-->
        <link rel="shortcut icon" href="favicon.ico"  />
        
        <!--JQUERY-->
        <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>
        
        <!--GOOGLE MAPS-->
        <script type="text/javascript" src="js/googleapis.js"></script>
        <script type="text/javascript" src="js/map.js"></script>
        
	</head>
	
	<body lang="en">
    
		<div class="top">
			<div class="logo"><img src="images/logo.png" alt="Logo" /></div>
		</div>
		
		<div class="main">
			<div class="content">
				<!--Keep this below-->
				<form>
					<div class="form-wrap">
						<div class="box">
							<h5>description</h5>
							<textarea></textarea>
							<h5>Location</h5>
							<div class="location">
								<div class="image"><img src="images/icon_location.png" /></div>
								<input type="text" />
								<div class="clear"></div>
							</div>
							<div class="wrap">
								<div class="type">
									<h5>Date</h5>
									<input type="text" />
								</div>
								<div class="type">
									<h5>Time</h5>
									<input type="text" />
								</div>
								<div class="type">
									<h5>Price</h5>
									<input type="text" />
								</div>
								<div class="clear"></div>
							</div>
							<h5>Hashtag</h5>
							<input type="text" />
						</div>
						<div class="clear"></div>
					</div>
					<div class="box"><input type="submit" value="submit" /></div>
				</form>
			</div>
			<div class="clear"></div>
		</div>
		<div class="footer"></div>
	</body>
</html>