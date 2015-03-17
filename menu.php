<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>

<?PHP
	require_once("./include/membersite_config.php"); 
	$bool = $fgmembersite->CheckSession();
	  
	if(isset($_POST['hSubmitted'])){
		if($fgmembersite->Login()){
			$fgmembersite->RedirectToURL("./index.php");
		}
	}
?>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="./css/bootstrap.min.css">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!--'Login' Scripts and Styles-->
<meta charset="utf-8"/>
<title>Eventprobe</title>
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<link rel="stylesheet" media="all" href=""/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<!-- Adding "maximum-scale=1" fixes the Mobile Safari auto-zoom bug: http://filamentgroup.com/examples/iosScaleBug/ -->

<!--STYLE-->
<link rel="stylesheet" type="text/css" href="./css/login.css" />

<!--FAVICON-->
<link rel="shortcut icon" href="favicon.ico"  />

<!--Other Scripts-->
<script type="text/javascript" src="./scripts/gen_validatorv31.js"></script>


<div class="dropdown clearfix">
	<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-expanded="true">
		User Account
		<span class="caret"></span>
	</button>
<!--IF the session is created then show the menu items-->
	<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu3">
<!-- 
		<?PHP //if($bool){ ?>
				<li role="presentation">
					<a role="menuitem" tabindex="-1" href='./EventCreation.php'>
						<span>Create Event</span>
					</a>
				</li>
				<li role="presentation">
					<a role="menuitem" tabindex="-1" href='./logout.php'>
						<span>logout</span>
					</a>
				</li>
				
<!~~ELSE show the login form~~>
		<?PHP // } else { ?>
 -->
				<li role="presentation">
				

				
				
					<body lang="en">
						
					<!--  commented to remove the top, needs to be modified to adapt the whole desing.-->
						
						<div class="main">
							<div class="content">
								<!--Keep this below-->
								<form id="login" action="<?php echo $fgmembersite->GetSelfScript(); ?>" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">

									<div class="login">
									<!--New inputs-->
									
										<input type="hidden" name="hSubmitted" id="submitted" value="1"/>
 
										<div><span class="error"><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
									
										<div class="box">

											<h5>UserName *</h5>
											<input type="text" name="UuserName" title="Enter your Username" id="UuserName" value="<?php echo $fgmembersite->SafeDisplay('UuserName') ?>" maxlength="50" />
											<span id="register_UuserName_errorloc" class="error"></span>
											
											<h5>Password *</h5>
											<input type='password' title="Enter your Password" name='UPswd' id='UPswd' maxlength="50" />
											<span id='login_UPswd_errorloc' class='error'></span>
											
										<!--End of new inputs-->
																
										</div><!--End of form-wrap -->

										<div class="clear"></div>
									</div>
									<input id="submitButton" type="submit" name="Submit" value="submit" />
									<a  href="./reg.php"><button type="button">Register</button></a>
									<!--Facebook plugin-->
									<a href="https://www.facebook.com/dialog/oauth?client_id=861882643830735&amp;redirect_uri=http://www.eventprobe.com/?fbTrue=true">
									<img src="./images/login-button.png" alt="Sign in with Facebook"></a>
								</form>
							</div>
						</div>
					</body>

					<!--This script needs to wihtin the file. 
						It is validating the form.-->
					<script type='text/javascript'>
						// <![CDATA[
						var frmvalidator  = new Validator("login");
						frmvalidator.EnableOnPageErrorDisplay();
						frmvalidator.EnableMsgsTogether();

						frmvalidator.addValidation("UuserName", "req", "Provide Your Username");

						frmvalidator.addValidation("UPswd", "req", "Provide Your Password");

						// ]]>
					</script>

				</li>
		<?PHP // } ?>
	</ul>
</div>