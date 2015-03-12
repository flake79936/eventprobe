<meta http-equiv="refresh" content="2; .php">

<?PHP
	require_once("./include/membersite_config.php");
	/*This part ckecks whether there is a session or not.*/
	if(!$fgmembersite->CheckSession()){
		$fgmembersite->RedirectToURL("loginB.php");
		exit;
	}
	//this site needs to redirect the user to the event that has been created just moments ago.
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<title>Event - Thank you!</title>
		<link rel="STYLESHEET" type="text/css" href="css/fg_membersite.css">
		
		<!--(Start) Provided by JetDevLLC-->
		<link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/top.css" />
        <link rel="stylesheet" type="text/css" href="css/search.css" />
        <link rel="stylesheet" type="text/css" href="css/myEvents.css" />
        <link rel="stylesheet" type="text/css" href="css/banner.css" />
        <link rel="stylesheet" type="text/css" href="css/thisWeek.css" />
        <link rel="stylesheet" type="text/css" href="css/schedule.css" />
        <link rel="stylesheet" type="text/css" href="css/app.css" />
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
		<div class="header-wrap">
			<div class="header">
			</div><!--//header-->
		</div><!--//header-wrap-->
		
		<div class="mobile-menu-list">  
		</div><!--//mobile-menu-list-->
		
		<div id='fg_membersite' align="center">
			<h2>Your Event Has Been Posted!</h2>
		</div>
		
		<div class="links">
			<?PHP include './links.php'; ?>
        </div>
        
        <div class="footer">
			<?PHP include './footer.php'; ?>
        </div>
	</body>
</html>