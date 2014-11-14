<?PHP
	require_once("./include/membersite_config.php");
	if(isset($_POST['submitted'])){
		if($fgmembersite->Login()){
			$fgmembersite->RedirectToURL("index.html");
		}
	}
?>

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
<!-- 
        
        <!~~GOOGLE MAPS~~>
        <script type="text/javascript" src="js/googleapis.js"></script>
        <script type="text/javascript" src="js/map.js"></script>
		
 -->
		<!--Other Scripts-->
        <script type="text/javascript" src="scripts/gen_validatorv31.js"></script>
		<script src="scripts/pwdwidget.js" type="text/javascript"></script>
		
<!-- 
		(Start) Tooltip Scripts		<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" href="/resources/demos/styleEdit.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
		<script type="text/javascript">
			$(function(){$(document).tooltip();});
		</script>
		
 -->
	</head>
	
	<body lang="en">
    
<!--  commented to remove the top, needs to be modified to adapt the whole desing.
		<div class="top">
			<div class="logo"><img src="images/logo.png" alt="Logo" /></div>
		</div>
 -->
		
		<div class="main">
			<div class="content">
				<!--Keep this below-->


				<form id="login" action="<?php echo $fgmembersite->GetSelfScript(); ?>" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">

					<div class="form-wrap">
					<!--New inputs-->
					
						<input type="hidden" name="submitted" id="submitted" value="1"/>
						
<!-- 						<input type="text" class="spmhidip" name="<?php echo $fgmembersite->GetSpamTrapInputName(); ?>" /> -->

						<div><span class="error"><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
					
						<div class="box">

							<h5>UserName *</h5>
							<input type="text" name="UuserName" title="Enter your Username" id="UuserName"  value="<?php echo $fgmembersite->SafeDisplay('UuserName') ?>" maxlength="50" /><br/>
							<span id="register_UuserName_errorloc" class="error"></span>

							<h5>Password *</h5>
							<input type='password' title="Enter your Password" name='UPswd' id='UPswd' maxlength="50" /><br/>
							<span id='login_UPswd_errorloc' class='error'></span>
							
					<!--End of new inputs-->
												
						</div><!--End of form-wrap -->

						<div class="clear"></div>
					</div>
					<input id="submitButton" type="submit" name="Submit" value="submit" />
					<a href="https://www.facebook.com/dialog/oauth?client_id=861882643830735&amp;redirect_uri=http://www.eventprobe.com/?fbTrue=true">
					<img src="./images/login-button.png" alt="Sign in with Facebook"></a>
				</form>
			</div>
			<div class="clear"></div>
		</div>t
		<div class="footer"></div>
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