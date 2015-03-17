<meta http-equiv="refresh" content="1; index.php">
<!--<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>-->

<?PHP
	require_once("./include/membersite_config.php");
	$fgmembersite->LogOut();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<link href="favicon.ico" rel="shortcut icon"  />
		<title>Logout</title>
		
<!-- 
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<meta name="format-detection" content="telephone=no" />
		<meta name="format-detection" content="email=no" />
		
 -->
		<!--(Start) Style Sheets-->
			<link rel="STYLESHEET" type="text/css" href="css/fg_membersite.css">
<!-- 			<link href="css/accordion.css" rel="stylesheet" type="text/css" /> -->
			
			<!--(Start) Provided by JetDevLLC-->
				<link rel="stylesheet" type="text/css" href="css/style.css" />
<!-- 
				<link rel="stylesheet" type="text/css" href="css/top.css" />
				<link rel="stylesheet" type="text/css" href="css/search.css" />
				<link rel="stylesheet" type="text/css" href="css/myEvents.css" />
				<link rel="stylesheet" type="text/css" href="css/banner.css" />
				<link rel="stylesheet" type="text/css" href="css/thisWeek.css" />
				<link rel="stylesheet" type="text/css" href="css/schedule.css" />
				<link rel="stylesheet" type="text/css" href="css/app.css" />
 -->
				<link rel="stylesheet" type="text/css" href="css/links.css" />
				<link rel="stylesheet" type="text/css" href="css/footer.css" />
				<!--[if IE 6]>
				<style type="text/css">img, div, { behavior: url("js/iepngfix.htc") }
				</style>
				<![endif]-->
			<!--(End) Provided by JetDevLLC-->
		<!--(End) Style Sheets-->
	</head>
	
	<body>
<!-- 
		<div class="top">
			<?PHP //include './ezTop.php';?>
		</div>
 -->
		
		<div id='fg_membersite' align="center">
			<div class="wrap">
				<h1>You have logged out!</h1>
			</div>
		</div>
		
		<div class="links">
			<?PHP include './links.php'; ?>
        </div>
        
        <div class="footer">
			<?PHP include './footer.php'; ?>
        </div>
	</body>
</html>