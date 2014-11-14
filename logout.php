<meta http-equiv="refresh" content="2; index.php">

<?PHP
	require_once("./include/membersite_config.php");
	$fgmembersite->LogOut();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<link href="favicon.ico" rel="shortcut icon"  />
		<title>Login</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<meta name="format-detection" content="telephone=no" />
		<meta name="format-detection" content="email=no" />
		
		<!--(Start) Style Sheets-->
			<link rel="STYLESHEET" type="text/css" href="css/fg_membersite.css">
			<link href="css/accordion.css" rel="stylesheet" type="text/css" />
			
			<!--(Start) Provided by JetDevLLC-->
				<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
				<link href="css/style.css"            rel="stylesheet" type="text/css" />
				<link href="css/responsive.css"       rel="stylesheet" type="text/css" />	
				<!--[if IE 6]>
				<style type="text/css">img, div, { behavior: url("js/iepngfix.htc") }
				</style>
				<![endif]-->
			<!--(End) Provided by JetDevLLC-->
		<!--(End) Style Sheets-->
		
		<!--(Start) Scripts-->
			<script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
				
			<!--(Start) Twitter Script-->
				<script type="text/javascript">
					!function(d,s,id){
						var js,fjs=d.getElementsByTagName(s)[0];
						if(!d.getElementById(id)){
							js = d.createElement(s);
							js.id=id;
							js.src="//platform.twitter.com/widgets.js";
							fjs.parentNode.insertBefore(js,fjs);
						}
					}(document, "script", "twitter-wjs");
				</script>
			<!--(End) Twitter script-->
			
			<!--(Start) Hashtag Script-->
				<script type="text/javascript">
					!function(d,s,id){
						var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
						if(!d.getElementById(id)){
							js=d.createElement(s);
							js.id=id;
							js.src=p+'://platform.twitter.com/widgets.js';
							fjs.parentNode.insertBefore(js,fjs);
						}
					}(document, 'script', 'twitter-wjs');
				</script>
			<!--(End) Hashtag script-->
			
			<!--(Start) Tooltip Scripts-->
				<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
				<link rel="stylesheet" href="/resources/demos/style.css">
				<script src="//code.jquery.com/jquery-1.10.2.js"></script>
				<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
				<script type="text/javascript">
					$(function(){
						$(document).tooltip();
					});
				</script>
			<!--(End) Tooltip Scripts-->
			
			<!--(Start) Provided by JetDevLLC-->
				<script src="js/jquery-1.9.0.min.js" type="text/javascript"></script>
				<script src="js/iepngfix_tilebg.js"  type="text/javascript"></script>
				<script src="js/scrollTo.js"         type="text/javascript"></script>
				<script src="js/global.js"           type="text/javascript"></script>
				
				<!--(Start) Mobile Menu Toggle-->
					<script type="text/javascript">
						$(function(){
							$(".mobile-menu-list").hide();
							$('.mobile-menu-btn').click(function(){
								$(this).toggleClass("active");
								$(".mobile-menu-list").slideToggle(200);
							});
						});
					</script>
				<!--(End) Mobile Menu Toggle-->
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
			<div class="wrap">
				<h2>You have logged out!</h2>
			</div>
		</div>
	</body>
</html>