<meta http-equiv="refresh" content="2; userPage.php">

<?PHP
	require_once("./include/membersite_config.php");
	/*This part ckecks whether there is a session or not.*/
	if(!$fgmembersite->CheckLogin()){
		$fgmembersite->RedirectToURL("index.php");
		exit;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<title>Event - Thank you!</title>
		<link rel="STYLESHEET" type="text/css" href="css/fg_membersite.css">
		
		<!--(Start) Provided by JetDevLLC-->
		<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="css/style.css"            rel="stylesheet" type="text/css" />
		<link href="css/responsive.css"       rel="stylesheet" type="text/css" />
		<link href="favicon.ico"              rel="shortcut icon"  />	
		<!--[if IE 6]>
		<style type="text/css">img, div, { behavior: url("js/iepngfix.htc") }
		</style>
		<![endif]-->
		<!--(End) Provided by JetDevLLC-->
		<!--(End) Style Sheets-->
		
		<!--(Start) Provided by JetDevLLC-->
		<script src="js/jquery-1.9.0.min.js" type="text/javascript"></script>
		<script src="js/iepngfix_tilebg.js"  type="text/javascript"></script>
		<script src="js/scrollTo.js"         type="text/javascript"></script>
		<script src="js/global.js"           type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".mobile-menu-list").hide();
				$('.mobile-menu-btn').click(function(){
					$(this).toggleClass("active");
					$(".mobile-menu-list").slideToggle(200);
				});
			});
		</script>
		<!--(End) Provided by JetDevLLC-->
		<!--(End) Scripts-->
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
	</body>
</html>