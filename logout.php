<?PHP
	require_once("./include/membersite_config.php");
	$fgmembersite->LogOut();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<meta http-equiv="refresh" content="1; index2.php">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
		<link href="favicon.ico" rel="shortcut icon"  />
		<title>Logout</title>
		
		<!--(Start) Style Sheets-->
			<!--(Start) Provided by JetDevLLC-->
				<link rel="stylesheet" type="text/css" href="css/logout.css" />
				<link rel="stylesheet" type="text/css" href="css/header.css" />
				<link rel="stylesheet" type="text/css" href="css/links.css" />
				<link rel="stylesheet" type="text/css" href="css/footer.css" />
				<!--[if IE 6]>
				<style type="text/css">img, div, { behavior: url("js/iepngfix.htc") }
				</style>
				<![endif]-->
			<!--(End) Provided by JetDevLLC-->
		<!--(End) Style Sheets-->
	</head>
	
	<body  lang="en">
		<div class="header">
			<?PHP include './header.php';?>
		</div>
		
		<div class="logout" align="center">
			<h1>You have logged out!</h1>
		</div>
		
		<div class="links">
			<?PHP include './links.php'; ?>
        </div>
        
        <div class="footer">
			<?PHP include './footer.php'; ?>
        </div>
	</body>
</html>