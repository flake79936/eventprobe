<?PHP
	require_once("./include/membersite_config.php");
	include 'dbconnect.php';
	
	if(isset($_POST['submitted'])){
		if($fgmembersite->Login()){
			$fgmembersite->RedirectToURL("./index.php");
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
		
		<!--FAVICON-->
		<link rel="shortcut icon" href="favicon.ico" />
		
		<title>Eventprobe</title>
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link rel="stylesheet" media="all" href=""/>
		
		<!--STYLE-->
		<link rel="stylesheet" type="text/css" href="css/footer.css" />
		<link rel="stylesheet" type="text/css" href="css/links.css"  />
		<link rel="stylesheet" type="text/css" href="css/login.css"  />
		<link rel="stylesheet" type="text/css" href="css/header.css" />
		
		<!--SCRIPTS-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		
		<script type="text/javascript" src="scripts/gen_validatorv31.js"></script>

		<script>
			function showHint(str) {
				if (str.length == 0) {
					document.getElementById("txtHint").innerHTML = "";
					$(".form-wrap").show();
					return;
				} else {
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
						}
					}
					xmlhttp.open("GET", "getEvent.php?q=" + str, true);
					xmlhttp.send();
				}
			}
		</script>

		<script>
			function seeMoreInfo(str){
				window.location = "./eventDisplayPage.php?eid="+str;
			}
		</script>

		<script>
			$(document).ready(function(){
				$(".searchHint").keydown(function(){
					$(".form-wrap").hide();
				});
				
				$("#sport, #concert, #fair, #art").click(function(){
					$(".form-wrap").hide();
				});
			});
		</script>
	</head>

	<body lang="en">
		<div class="header">
			<?PHP include './header.php'; ?>
		</div>
		
		<div class="form-wrap">
			<?PHP if (!$fgmembersite->CheckSession()){ ?>
				<div class="label"><center><h3>Please Login</h3></center></div>
			<?PHP } ?>
			
			<form id="login" action="<?php echo $fgmembersite->GetSelfScript(); ?>" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
				<input type="hidden" name="submitted" id="submitted" value="1" />
				<div><span class="error"><center><?php echo $fgmembersite->GetErrorMessage(); ?></center></span></div>
				<div class="login">
					<div class="top-login">
						<div class="user-input">
							<input class="buttonInput" name="UuserName" type="text" placeholder="Username" id="UuserName" /><br/>
							<span id="login_UuserName_errorloc" class="error"></span>
						</div>
						<div class="user-pass">
							<input class="buttonInput" type="password" name='UPswd' placeholder="Password" id='UPswd' /><br/>
							<span id="login_UPswd_errorloc" class="error"></span>
						</div>
					</div>
					<div class="btn-log">
						<div class="btns">
							<div class="btn-primary">
								<input input id="submitButton" type="image" src="./images/btn_login.png" name="Submit" value="" />
							</div>
							<div class="btn-reg">
								<a href="./reg.php">
									<img src="./images/btn_register.png">
								</a>
							</div>
							<div class="btn-fgtPass">
								<a href="./rstPwdReq.php">
									<img src="./images/btn_fgtPass.png">
								</a>
							</div>
						</div>
						<div class="btn-fb">
							<a href="https://www.facebook.com/dialog/oauth?client_id=861882643830735&amp;redirect_uri=http://www.eventprobe.com/?fbTrue=true">
								<img src="./images/login-button.png" alt="Sign in with Facebook">
							</a>
						</div>
					</div>
				</div>
			</form>
		</div>
		
		<!-- SHOW SEARCH RESULTS 		 -->
		<div class="events" id="txtHint"></div>

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
		var frmvalidator = new Validator("login");
		frmvalidator.EnableOnPageErrorDisplay();
		frmvalidator.EnableMsgsTogether();
		
		frmvalidator.addValidation("UuserName", "req", "Please Input Your Username");
		frmvalidator.addValidation("UPswd",     "req", "Please Input Your Password");
		// ]]>
	</script>
</html>