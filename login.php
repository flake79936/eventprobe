<?PHP
	require_once("./include/membersite_config.php");
	if(isset($_POST['submitted'])){
		if($fgmembersite->Login()){
			$fgmembersite->RedirectToURL("userPage.php");
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="shortcut icon" href="favicon.ico" />
		<title>Login</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<meta name="format-detection" content="telephone=no" />
		<meta name="format-detection" content="email=no" />
		
		<!--(Start) Style Sheets-->
			<link href="css/fg_membersite.css" rel="STYLESHEET" type="text/css"  />
			
			<!--(Start) Provided by JetDevLLC-->
				<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
				<link href="css/styleEdit.css"        rel="stylesheet" type="text/css" />
				<link href="css/responsiveEdit.css"   rel="stylesheet" type="text/css" />	
				<!--[if IE 6]>
				<style type="text/css">img, div, { behavior: url("js/iepngfix.htc") }
				</style>
				<![endif]-->
			<!--(End) Provided by JetDevLLC-->
		<!--(End) Style Sheets-->
		
		<!--(Start) Scripts-->
			<script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
			
			<!--(Start) Tooltip Scripts-->
				<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
				<link rel="stylesheet" href="/resources/demos/styleEdit.css">
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
				<ul class="head-social-icons">
					<li><a class="facebook"   href="#"></a></li>
					<li><a class="twitter"    href="#"></a></li>
					<li><a class="googleplus" href="#"></a></li>
				</ul><!--//head-social-icons-->

				<ul class="nav">
					<li><a href="./index.php">Home</a></li>
					<li><span class="shadow">|</span></li>
					<li><a id="findstadarena-nav" href="#findstadarena">Find a Stadium/Arena</a></li>
					<li><span class="shadow">|</span></li>
					<li><a id="emaildeals-nav" href="#emaildeals">Email Deals</a></li>
					<li><span class="shadow">|</span></li>
					<li><a id="product-nav" href="#product">Product</a></li>
					<li><span class="shadow">|</span></li>
					<li><a href="#Events">Events</a></li>
				</ul>
				<div class="mobile-menu-btn"><span class="icon-reorder"></span></div>
			</div><!--//header-->
		</div><!--//header-wrap-->

		<div class="mobile-menu-list">
			<ul>
				<li><a href="./index.php">Home</a></li>
				<!--<li><a href="#findstadarena">Find a Stadium/Arena</a></li>
				<li><a href="#emaildeals">Email Deals</a></li>
				<li><a href="#product">Product</a></li>
				<li><a href="#faq">FAQ</a></li>-->
			</ul>   
		</div><!--//mobile-menu-list-->
		
		<!-- Form Code Start -->
		<div id='fg_membersite' align="center">
			<fieldset align="left">
				<legend>Login</legend>
				<form id='login' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
						<input type='hidden' name='submitted' id='submitted' value='1'/>

						<div class='short_explanation'>* required fields</div>

						<div>
							<span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span>
						</div>
						<div class='container'>
							<label for='UuserName' >UserName*:</label><br/>
							<input type='text' name='UuserName' title="Enter your Username" id='UuserName' value='<?php echo $fgmembersite->SafeDisplay('UuserName') ?>' maxlength="50" /><br/>
							<span id='login_UuserName_errorloc' class='error'></span>
						</div>
						<div class='container'>
							<label for='UPswd' >Password*:</label><br/>
							<input type='password' title="Enter your Password" name='UPswd' id='UPswd' maxlength="50" /><br/>
							<span id='login_UPswd_errorloc' class='error'></span>
						</div>

						<div class='container'>
							<input type='submit' name='Submit' value='Submit' />
						</div>
				</form>
			</fieldset>
			
			<fieldset align="left">
				<legend>Help?</legend>
				<table>
					<tr>
						<td>
							<form id="register" action="./registration.php" method="GET">
								<input type="submit" value="Register" name="Register"/>
							</form>
						</td>
						<td>&nbsp;</td>
						<td>
							<form id="ForgotPswd" action="./reset-pwd-req.php" method="GET">
								<input type="submit" value="Forgot Password?" name="ForgotPswd"/>
							</form>
						</td>
					</tr>
				</table>
			</fieldset>
		</div>
	</body>
	
	<!--This script needs to wihtin the file. 
		It is validating the form.-->
	<script type='text/javascript'>
		// <![CDATA[

		var frmvalidator  = new Validator("login");
		frmvalidator.EnableOnPageErrorDisplay();
		frmvalidator.EnableMsgsTogether();

		frmvalidator.addValidation("UuserName", "req", "provide your username");

		frmvalidator.addValidation("UPswd", "req", "Please provide the password");

		// ]]>
	</script>
</html>