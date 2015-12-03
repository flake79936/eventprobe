<?PHP
	require_once("./include/membersite_config.php");
	
	if(isset($_POST["submitted"])){
		if($fgmembersite->RegisterUser()){
			$fgmembersite->RedirectToURL("regTnkYou.php");
		}
	}
?>

<!doctype html>
<html>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
		<title>Eventprobe</title>
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link rel="stylesheet" media="all" href=""/>
		
        
        <!--STYLE-->
        <link rel="stylesheet" type="text/css" href="css/registration.css" />
        <link rel="stylesheet" type="text/css" href="css/header.css" />
        <link rel="stylesheet" type="text/css" href="css/app.css" />
        <link rel="stylesheet" type="text/css" href="css/links.css" />
        <link rel="stylesheet" type="text/css" href="css/footer.css" />
		
        <!--FAVICON-->
        <link rel="shortcut icon" href="favicon.ico"  />
        
        <!--JQUERY-->
        <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
		
		<!--Other Scripts-->
		<script type="text/javascript" src="scripts/gen_validatorv31.js"></script>
		<script type="text/javascript" src="./js/formatPhone.js"></script>
		
		<script type="text/javascript">
			$(document).ready(function(){
				$('#UuserName').keyup(function(){
					var UuserName = $(this).val(); // Get username textbox using $(this)
					var Result = $('#result'); // Get ID of the result DIV where we display the results
					if(UuserName.length > 2) { // if greater than 2 (minimum 3)
						Result.html('Loading...'); // you can use loading animation here
						var dataPass = 'action=availability&UuserName='+UuserName;
						$.ajax({ // Send the username val to available.php
							type : 'POST',
							data : dataPass,
							url  : './available.php',
							success: function(responseText){ // Get the result
								//alert(responseText);
							
								//responseText returns a digit '0' (zero) for not in the table
								if(responseText === 0){
									//Result.html('<span class="error">Taken</span>');
									Result.html('<span class="success">Available</span>');
								
								//responseText returns a digit '1+' (one) for in the table
								} else if(responseText > 0){
									//Result.html('<span class="success">Available</span>');
									Result.html('<span class="error">Taken</span>');
								} else {
									// alert('Problem with sql query... ' + responseText);
									Result.html('<span class="error">Available</span>');
								}
							}
						});
					} else {
						Result.html('Enter atleast 3 characters');
					}
					
					if(UuserName.length === 0){
						Result.html('');
					}
				});
			});
		</script>
	</head>
	
	<body lang="en">
		<?php include_once("analyticstracking.php") ?>
		
	    <div class="header">
			<?PHP include './header.php';?>
        </div>
		
		<div class="reg">
			<div class="content">
				<!--Keep this below-->
				<form id="register" action="<?php echo $fgmembersite->GetSelfScript(); ?>" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
					<div class="form-wrap">
						<input type="hidden" name="submitted" id="submitted" value="1"/>
  			
						<div><span class="error"><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
						
						<div class="box">
							<div class="regFirst">
								<h5>First Name</h5>
								<input type="text" placeholder="John" name="UFname" title="Enter your First Name" id="UFname" value="<?php echo $fgmembersite->SafeDisplay('UFname') ?>" maxlength="50" /><br/>
								<span id="register_UFname_errorloc" class="error"></span>
							</div>
							<div class="regLast">
								<h5>Last Name</h5>
								<input type="text" placeholder="Doe" name="ULname" title="Enter your Last Name" id="ULname" value="<?php echo $fgmembersite->SafeDisplay('ULname') ?>" maxlength="50" /><br/>
								<span id="register_ULname_errorloc" class="error"></span>
							</div>
							<div class="regUser">
								<h5>Username</h5>
								<input type="text" placeholder="JohnDoe" name="UuserName" title="Enter your Username" id="UuserName" value="<?php echo $fgmembersite->SafeDisplay("UuserName") ?>" maxlength="50" />
								<div class="result" id="result"></div><br/>
								<span id="register_UuserName_errorloc" class="error"></span>							
							</div>
							<div class="regPass">
								<h5>Password</h5>
								<input type='password' name='UPswd' title="Enter your Password" id='UPswd' value="<?php echo $fgmembersite->SafeDisplay("UPswd") ?>" maxlength="50" /><br/>
								<span id='register_UPswd_errorloc' class='error' style='clear:both'></span>
							</div>
							<div class="regConPass">
								<h5>Confirm Password</h5>
								<input type='password' name="ConPswd" title="Confirm your Password"id="ConPswd" value="<?php echo $fgmembersite->SafeDisplay("ConPswd") ?>" maxlength="50" /><br/>
								<span id="register_ConPswd_errorloc" class="error" style="clear: both"></span>
							</div>
							<div class="regEmail">
								<h5>Email</h5>
								<input type="text"  placeholder="email@domain.com" name="Uemail" title="Enter your Email"id="Uemail" value="<?php echo $fgmembersite->SafeDisplay('Uemail') ?>" maxlength="50" /><br/>
								<span id="register_Uemail_errorloc" class="error"></span>
							</div>
							<div class="regTel">
								<h5>Phone</h5>
								<input type='tel' name="Uphone" id="Uphone" title='Phone Number (Format: (999) 999-9999)' maxlength="16" placeholder="(999) 999-9999" onkeydown="javascript:backspacerDOWN(this, event);" onkeyup="javascript:backspacerUP(this, event);"><br />
								<span id="register_Uphone_errorloc" class="error"></span>
							</div>
							
							<div class="regImage">
								<h5>User Image</h5>
								<img id="uploadPreview" style="width: 200px; height: 200px;" />
								<input id="uploadImage" type="file" name="Upic" onchange="PreviewImage();" />
							</div>
						</div>
						
						<div class="clear"></div>
						<div class="regSubmit">
							<input id="submitButton" type="image" src="./images/btn_register.png" name="Submit" value="submit" />
						</div>
					</div>
				</form>
			</div>
			<div class="clear"></div>
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
		frmvalidator.addValidation("Uphone",    "req", "Please Provide a Valid Phone Number");
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