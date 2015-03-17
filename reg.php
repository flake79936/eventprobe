<!--<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>-->
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
		
		<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed|Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
		
        <!--FAVICON-->
        <link rel="shortcut icon" href="favicon.ico"  />
        
        <!--JQUERY-->
        <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		
		<!--Other Scripts-->
		<script type="text/javascript" src="scripts/gen_validatorv31.js"></script>
		
		<script type="text/javascript">
			$(document).ready(function(){
				$('#UuserName').keyup(function(){
					var UuserName = $(this).val(); // Get username textbox using $(this)
					var Result = $('#result'); // Get ID of the result DIV where we display the results
					if(UuserName.length > 2) { // if greater than 2 (minimum 3)
						Result.html('Loading... ' + UuserName); // you can use loading animation here
						var dataPass = 'action=availability&UuserName='+UuserName;
						$.ajax({ // Send the username val to available.php
							type : 'POST',
							data : dataPass,
							url  : './available.php',
							success: function(responseText){ // Get the result
								if(responseText == 0){
									Result.html('<span class="success">Available</span>');
								} else if(responseText > 0){
									Result.html('<span class="error">Taken</span>');
								} else {
									alert('Problem with sql query');
								}
							}
						});
					} else {
						Result.html('Enter atleast 3 characters');
					}
					
					if(UuserName.length == 0){
						Result.html('');
					}
				});
			});
		</script>
		<style type="text/css">
			.success{ color: green; }
			.error{ color: red; }
			.content{ width:900px; margin:0 auto; }
			#UuserName{ width:500px; border:solid 1px #000; padding:10px; font-size:14px; }
		</style>
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
							<input type="text" placeholder="John" name="UFname" title="Enter your First Name" id="UFname" value="<?php echo $fgmembersite->SafeDisplay('UFname') ?>" maxlength="50" /><br/>
							<span id="register_UFname_errorloc" class="error"></span>

							<h5>Last Name</h5>
							<input type="text" placeholder="Doe" name="ULname" title="Enter your Last Name" id="ULname" value="<?php echo $fgmembersite->SafeDisplay('ULname') ?>" maxlength="50" /><br/>
							<span id="register_ULname_errorloc" class="error"></span>
							
							<h5>Username</h5>
							<input type="text" placeholder="JohnDoe" name="UuserName" title="Enter your Username" id="UuserName" value="<?php echo $fgmembersite->SafeDisplay("UuserName") ?>" maxlength="50" />
							<div class="result" id="result"></div><br/>
							<span id="register_UuserName_errorloc" class="error"></span>							
							
							<h5>Password</h5>
							<input type='password' name='UPswd' title="Enter your Password" id='UPswd' value="<?php echo $fgmembersite->SafeDisplay("UPswd") ?>" maxlength="50" />
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