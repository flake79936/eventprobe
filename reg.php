<?PHP
	require_once("./include/membersite_config.php");
	
	if(isset($_POST["submitted"])){
		if($fgmembersite->RegisterUser()){
			$fgmembersite->RedirectToURL("reg_thank_you.php");
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
        
        <!--GOOGLE MAPS-->
        <script type="text/javascript" src="js/googleapis.js"></script>
        <script type="text/javascript" src="js/map.js"></script>
		
		<!--Other Scripts-->
        <script type="text/javascript" src="scripts/gen_validatorv31.js"></script>
		<script src="scripts/pwdwidget.js" type="text/javascript"></script>
		
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
					<!--New inputs-->

					
						<div class="box">

							
							<h5>First Name</h5>
							<input type="text" name="UFname" title="Enter your First Name" id="UFname"  value="<?php echo $fgmembersite->SafeDisplay('UFname') ?>" maxlength="50" /><br/>
							<span id="register_UFname_errorloc" class="error"></span>

							<h5>Last Name</h5>
							<input type="text" name="ULname" title="Enter your First Name" id="ULname"  value="<?php echo $fgmembersite->SafeDisplay('ULname') ?>" maxlength="50" /><br/>
							<span id="register_UFname_errorloc" class="error"></span>
							
							<h5>Username</h5>
							<input type="text" name="UuserName" title="Enter your Username" id="UuserName"  value="<?php echo $fgmembersite->SafeDisplay("UuserName") ?>" maxlength="50" /><br/>
							<span id="register_UuserName_errorloc" class="error"></span>							
							
							<h5>Password</h5>							
							<div class='pwdwidgetdiv' id='thepwddiv' ></div>
							<noscript>
							<input type='password' name='UPswd' title="Enter your Password" id='UPswd' value="<?php echo $fgmembersite->SafeDisplay("UPswd") ?>" maxlength="50" />
							</noscript>
							<br/><span id='register_UPswd_errorloc' class='error' style='clear:both'></span>
							
							<h5>Confirm Password</h5>
							<input type='password' name="ConPswd" title="Confirm your Password"id="ConPswd" value="<?php echo $fgmembersite->SafeDisplay("ConPswd") ?>" maxlength="50" /><br/>
							<span id="register_ConPswd_errorloc" class="error" style="clear: both"></span>
							
							<h5>Email</h5>
							<input type="text" name="Uemail" title="Enter your Email"id="Uemail" onchange="check()" value="<?php echo $fgmembersite->SafeDisplay('Uemail') ?>" maxlength="50" /><br/>
							<span id="register_Uemail_errorloc" class="error"></span>
							
							<h5>Phone</h5>
							<input type="text" name="Uphone" title="Enter your Phone Number"id="Uphone" onchange="check()" value="<?php echo $fgmembersite->SafeDisplay("Uphone") ?>" maxlength="50" /><br/>
							<span id="register_Uphone_errorloc" class="error"></span>
							

					<!--End of new inputs-->
												
						</div><!--End of form-wrap -->

						<div class="clear"></div>
					</div>
					<input id="submitButton" type="submit" name="Submit" value="submit" />
				</form>
			</div>
			<div class="clear"></div>
		</div>
		<div class="footer"></div>
	</body>
		<!--This script needs to wihtin the file. 
		It is validating the form.-->
	<script type="text/javascript">
		// <![CDATA[
		//'PasswordWidget()'
		// @param1: The IDname of the <div> that it is going to be used in.
		// @param2: The name of the <input> field.
		var pwdwidget = new PasswordWidget('thepwddiv', 'UPswd');
		pwdwidget.MakePWDWidget();

		var frmvalidator = new Validator("register");
		frmvalidator.EnableOnPageErrorDisplay();
		frmvalidator.EnableMsgsTogether();
		
		frmvalidator.addValidation("UFname",    "req", "Please Input Your First Name");
		frmvalidator.addValidation("ULname",    "req", "Please Input Your Last Name");
		frmvalidator.addValidation("UuserName", "req", "Please Provide a User Name");
		frmvalidator.addValidation("UPswd",     "req", "Please Provide a Password");
		frmvalidator.addValidation("ConPswd",   "req", "Please Confirm Your Password");
		frmvalidator.addValidation("Uemail",    "req", "Please Please fill in Name");
		frmvalidator.addValidation("Uphone",    "req", "Please Provide a Phone Number");
		//frmvalidator.addValidation("Uadmin",    "req", "Please fill in Name");
		
		// ]]>
	</script>
</html>