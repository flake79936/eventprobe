<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<meta http-equiv="refresh" content="5; login.php">
		<title>Thank you!</title>
		
		<!--Style-->
		<link rel="stylesheet" type="text/css" href="css/footer.css" />
		<link rel="stylesheet" type="text/css" href="css/links.css"  />
		<link rel="stylesheet" type="text/css" href="css/login.css"  />
		<link rel="stylesheet" type="text/css" href="css/header.css" />
		<link rel="STYLESHEET" type="text/css" href="css/fgtPass.css"/>
		
	</head>
	
	<body lang="en">
		<?php include_once("analyticstracking.php") ?>
		
		<div class="header">
			<?PHP include './header.php'; ?>
		</div>
		
		<div class="form-wrap">
			<h2>Reset password link sent</h2>
			An email was sent to your email address that contains the link to reset the password.
		</div>

		<div class="links">
			<?PHP include './links.php'; ?>
		</div>

		<div class="footer">
			<?PHP include './footer.php'; ?>
		</div>
	</body>
</html>