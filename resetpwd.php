<?PHP
	require_once("./include/membersite_config.php");
		$success = false;
		if($fgmembersite->resetPassword()){
			$success = true;
		}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<title>Reset Password</title>
		
		<!--STYLE-->
		<link rel="stylesheet" type="text/css" href="css/footer.css" />
		<link rel="stylesheet" type="text/css" href="css/links.css"  />
		<link rel="stylesheet" type="text/css" href="css/login.css"  />
		<link rel="stylesheet" type="text/css" href="css/header.css" />
		
		<script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
	</head>
	
	<body lang="en">
		<div class="header">
			<?PHP include './header.php'; ?>
		</div>
		
		<div class="form-wrap">
			<?php
				if($success){
			?>
				<h2>Password is Reset Successfully</h2>
				Your temporary password has been sent to your email address.
			<?php
				} else {
			?>
				<h2>Error</h2>
				<span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span>
			<?php
				}
			?>
		</div>

		<div class="links">
			<?PHP include './links.php'; ?>
		</div>

		<div class="footer">
			<?PHP include './footer.php'; ?>
		</div>
	</body>
</html>