<?PHP
	require_once("./include/membersite_config.php");
	$emailsent = false;
	if(isset($_POST['submitted'])){
		if($fgmembersite->emailResetPasswordLink()){
			$fgmembersite->RedirectToURL("rstPwdLinkSent.php");
			exit;
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<title>Reset Password Request</title>
		
		<!--STYLE-->
		<link rel="stylesheet" type="text/css" href="css/footer.css" />
		<link rel="stylesheet" type="text/css" href="css/links.css"  />
		<link rel="stylesheet" type="text/css" href="css/login.css"  />
		<link rel="stylesheet" type="text/css" href="css/header.css" />
		<link rel="STYLESHEET" type="text/css" href="css/fgtPass.css"/>
		
		<script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
	</head>
	
	<body lang="en">
		<div class="header">
			<?PHP include './header.php'; ?>
		</div>
		
		<div class="form-wrap">
			<form id="resetreq" action="<?php echo $fgmembersite->GetSelfScript(); ?>" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
				<input type="hidden" name="submitted" id="submitted" value="1" />
				<div><span class="error"><center><?php echo $fgmembersite->GetErrorMessage(); ?></center></span></div>
				<div class="login">
					<input type="text"  placeholder="email@domain.com" name="Uemail" title="Enter your Email"id="Uemail" value="<?php echo $fgmembersite->SafeDisplay('Uemail') ?>" maxlength="50" /><br/>
					<span id='resetreq_email_errorloc' class='error'></span>
				</div>
				
				<div class='short_explanation'>A link to reset your password will be sent to the email address</div>
				
				<div class="btn-primary">
					<input input id="submitButton" type="image" src="./images/btn_login.png" name="Submit" value="" />
				</div>
			</form>
		</div>

		<div class="links">
			<?PHP include './links.php'; ?>
		</div>

		<div class="footer">
			<?PHP include './footer.php'; ?>
		</div>
	</body>
	
	<!-- client-side Form Validations:
	Uses the excellent form validation script from JavaScript-coder.com-->

	<script type='text/javascript'>
		// <![CDATA[

		var frmvalidator  = new Validator("resetreq");
		frmvalidator.EnableOnPageErrorDisplay();
		frmvalidator.EnableMsgsTogether();

		frmvalidator.addValidation("email", "req", "Please provide the email address used to sign-up");
		frmvalidator.addValidation("email", "email", "Please provide the email address used to sign-up");

		// ]]>
	</script>
</html>