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
		
        <link rel="stylesheet" type="text/css" href="css/registration.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/top.css" />
        <link rel="stylesheet" type="text/css" href="css/app.css" />
        <link rel="stylesheet" type="text/css" href="css/links.css" />
        <link rel="stylesheet" type="text/css" href="css/footer.css" />
		<!--<link rel="stylesheet" type="text/css" href="css/picStyle.css"/>-->
		
		<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed|Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
		
        <!--FAVICON-->
        <link rel="shortcut icon" href="favicon.ico"  />
        
        <!--JQUERY-->
        <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>
        <script type="text/javascript" src="js/picScripts.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        
        <!--GOOGLE MAPS-->
<!--         <script type="text/javascript" src="js/googleapis.js"></script> -->
<!--         <script type="text/javascript" src="js/map.js"></script> -->
		
		<!--Other Scripts-->
<!--         <script type="text/javascript" src="scripts/gen_validatorv31.js"></script> -->
<!-- 		<script src="scripts/pwdwidget.js" type="text/javascript"></script> -->
<!-- 
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="./js/picScript.js"></script>
 -->
		
		<!--Conflict with Bootstrap-->
		<!--(Start) Tooltip Scripts
		<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" href="/resources/demos/styleEdit.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
		<script type="text/javascript">
			$(function(){$(document).tooltip();});
		</script>-->
		
	</head>
	
	<body lang="en">
	    <div class="top">
			<?PHP include './top.php';?>
        </div>
		<div class="main">
			<div class="content">
				<!--Keep this below-->
				<form id="register" action="<?php echo $fgmembersite->GetSelfScript(); ?>" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
					<div class="form-wrap">
						<input type="hidden" name="submitted" id="submitted" value="1"/>
  			
						<div><span class="error"><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
						
						<div class="box">
							<h5>First Name</h5>
							<input type="text" placeholder="John" name="UFname" title="Enter your First Name" id="UFname"  value="<?php echo $fgmembersite->SafeDisplay('UFname') ?>" maxlength="50" /><br/>
							<span id="register_UFname_errorloc" class="error"></span>

							<h5>Last Name</h5>
							<input type="text" placeholder="Doe" name="ULname" title="Enter your Last Name" id="ULname"  value="<?php echo $fgmembersite->SafeDisplay('ULname') ?>" maxlength="50" /><br/>
							<span id="register_UFname_errorloc" class="error"></span>
							
							<h5>Username</h5>
							<input type="text" placeholder="JohnDoe"  name="UuserName" title="Enter your Username" id="UuserName"  value="<?php echo $fgmembersite->SafeDisplay("UuserName") ?>" maxlength="50" /><br/>
							<span id="register_UuserName_errorloc" class="error"></span>							
							
							<h5>Password</h5>
							<input type='password'  name='UPswd' title="Enter your Password" id='UPswd' value="<?php echo $fgmembersite->SafeDisplay("UPswd") ?>" maxlength="50" />
							<br/><span id='register_UPswd_errorloc' class='error' style='clear:both'></span>
							
							<h5>Confirm Password</h5>
							<input type='password' name="ConPswd" title="Confirm your Password"id="ConPswd" value="<?php echo $fgmembersite->SafeDisplay("ConPswd") ?>" maxlength="50" /><br/>
							<span id="register_ConPswd_errorloc" class="error" style="clear: both"></span>
							
							<h5>Email</h5>
							<input type="text"  placeholder="email@email.com" name="Uemail" title="Enter your Email"id="Uemail" onchange="check()" value="<?php echo $fgmembersite->SafeDisplay('Uemail') ?>" maxlength="50" /><br/>
							<span id="register_Uemail_errorloc" class="error"></span>
							
							<h5>Phone</h5>
							<input type="text" placeholder="1234567890" name="Uphone" title="Enter your Phone Number"id="Uphone" onchange="check()" value="<?php echo $fgmembersite->SafeDisplay("Uphone") ?>" maxlength="50" /><br/>
							<span id="register_Uphone_errorloc" class="error"></span>
						
							<h5>User Image</h5>
							<img id="uploadPreview" style="width: 200px; height: 200px;" />
							<input id="uploadImage" type="file" name="Upic" onchange="PreviewImage();" />
						</div>
						
						<div class="clear"></div>
					<input id="submitButton" type="submit" name="Submit" value="submit" />
					</div>
				</form>
			</div>
			<div class="clear"></div>
		</div>
		
        <div class="app">
			<?PHP include './app.php'; ?>
        </div>
        
        <div class="links">
			<?PHP include './links.php'; ?>
        </div>
        
        <div class="footer">
			<?PHP include './footer.php'; ?>
        </div>
	</body>
	
	<!--This script needs to wihtin the file. It is validating the form.-->
	<script type="text/javascript">
		// <![CDATA[
		var frmvalidator = new Validator("register");
		frmvalidator.EnableOnPageErrorDisplay();
		frmvalidator.EnableMsgsTogether();
		
		frmvalidator.addValidation("UFname",    "req", "Please Input Your First Name");
		frmvalidator.addValidation("ULname",    "req", "Please Input Your Last Name");
		frmvalidator.addValidation("UuserName", "req", "Please Provide a User Name");
		frmvalidator.addValidation("UPswd",     "req", "Please Provide a Password");
		frmvalidator.addValidation("ConPswd",   "req", "Please Confirm Your Password");
		frmvalidator.addValidation("Uemail",    "req", "Please Please fill in Name");
		// ]]>
	</script>
	
	<script type="text/javascript">
		function PreviewImage() {
			var oFReader = new FileReader();
			oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

			oFReader.onload = function (oFREvent) {
				document.getElementById("uploadPreview").src = oFREvent.target.result;
			};
		};
	</script>
</html>