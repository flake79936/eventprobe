<?PHP
	require_once("./include/membersite_config.php");
	
	$success = false;
	if($fgmembersite->isSetCode()){
		$success = true;
	}
	
	if(isset($_POST['submitted'])){
		if($fgmembersite->changePassword()){
			$fgmembersite->redirectToURL("chngPwd.php");
		}
	}
	
	$ue = $_GET['ue'];
	$co = $_GET['co'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
		
		<title>Change Password</title>
		
		<!--STYLE-->
		<link rel="stylesheet" type="text/css" href="./css/footer.css" />
		<link rel="stylesheet" type="text/css" href="./css/links.css"  />
		<link rel="stylesheet" type="text/css" href="./css/login.css"  />
		<link rel="stylesheet" type="text/css" href="./css/header.css" />
		<link rel="stylesheet" type="text/css" href="./css/pwdwidget.css" />
		
		<script type='text/javascript' src='./js/gen_validatorv31.js'></script>
		<script type='text/javascript' src='./js/pwdwidget.js'></script>
	</head>
	
	<body>
		<?php include_once("analyticstracking.php") ?>
		
		<div class="header">
			<?PHP include './header.php'; ?>
		</div>
		
		<?php
			if($success){
		?>
			<form id='changepwd' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='POST' accept-charset='UTF-8'>
				<input type='hidden' name='submitted' id='submitted' value='1'/>
				<input type='hidden' name='ue' id='ue' value='<?PHP echo $ue; ?>'/>
				<input type='hidden' name='co' id='co' value='<?PHP echo $co; ?>'/>
				
				<div><span class="error"><center><?php echo $fgmembersite->GetErrorMessage(); ?></center></span></div>
				
				<div class="login">
					<div class='pwdwidgetdiv' id='newPwddiv'></div><br/>
					<noscript>
						<input type='password' name='newPwd' id='newPwd' maxlength="50" placeholder="New Password"/>
					</noscript>    
					<span id='changepwd_newPwd_errorloc' class='error'></span>
				</div>
				
				<div class="login">
					<div class='pwdwidgetdiv' id='conNewPwddiv' ></div>
					<noscript>
						<input type='password' name='conNewPwd' id='conNewPwd' maxlength="50" placeholder="Confirm Password"/><br/>
					</noscript>
					<span id='changepwd_conNewpwd_errorloc' class='error'></span>
				</div>
				
				<div class="btn-primary">
					<input input id="submitButton" type="image" src="./images/btn_sub.png" name="Submit" value="" />
				</div>
			</form>
		<?php
			} else {
		?>
			<div class="errMsg">
				<h2>An error occurred, please request your password request again.</h2>
				<span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span>
			</div>
		<?php
			}
		?>
		
		<div class="links">
			<?PHP include './links.php'; ?>
		</div>

		<div class="footer">
			<?PHP include './footer.php'; ?>
		</div>
	</body>
	
	<!-- client-side Form Validations: Uses the excellent form validation script from JavaScript-coder.com-->
	<script type='text/javascript'>
		// <![CDATA[
		var pwdwidget = new PasswordWidget('newPwddiv', 'newPwd');
		pwdwidget.enableGenerate = false;
		pwdwidget.enableShowStrength = false;
		pwdwidget.enableShowStrengthStr = false;
		pwdwidget.MakePWDWidget();

		var pwdwidget = new PasswordWidget('conNewPwddiv', 'conNewPwd');
		pwdwidget.MakePWDWidget();

		var frmvalidator  = new Validator("changepwd");
		frmvalidator.EnableOnPageErrorDisplay();
		frmvalidator.EnableMsgsTogether();

		frmvalidator.addValidation("newPwd", "req", "Please Provide Your New Password");
		frmvalidator.addValidation("conNewPwd", "req", "Please Re-type Your Password");

		// ]]>
	</script>
	<!--Form Code End (see html-form-guide.com for more info.)-->
</html>