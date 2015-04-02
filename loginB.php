<?PHP
	require_once("./include/membersite_config.php");

	if(isset($_POST['authenticity_token'])){
		if($fgmembersite->Login()){
			$fgmembersite->RedirectToURL("./index2.php");
		}
	}

	include 'dbconnect.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
		
		<!--FAVICON-->
		<link rel="shortcut icon" href="favicon.ico" />
		
		<title>Eventprobe</title>
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link rel="stylesheet" media="all" href=""/>
		<!-- Adding "maximum-scale=1" fixes the Mobile Safari auto-zoom bug: http://filamentgroup.com/examples/iosScaleBug/ -->

		<!--STYLE-->
		<link rel="stylesheet" type="text/css" href="css/style.css"  />
		<link rel="stylesheet" type="text/css" href="css/header.css" />
		<link rel="stylesheet" type="text/css" href="css/login.css"  />
		<link rel="stylesheet" type="text/css" href="css/links.css"  />
		<link rel="stylesheet" type="text/css" href="css/footer.css" />
		
		<!--SCRIPTS-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

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
		
		<?PHP if (!$fgmembersite->CheckSession()){ ?>
			<div class="label" ><center><h3>Please Login</h3></center></div>
		<?PHP } ?>
		
		<div class="form-wrap">
			<form id="login" action="<?php echo $fgmembersite->GetSelfScript(); ?>" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
				<div class="login">
					<div style="margin:0;padding:0;display:inline">
						<input name="utf8" type="hidden" value="&#x2713;" />
						<input name="authenticity_token" type="hidden" value="4L/A2ZMYkhTD3IiNDMTuB/fhPRvyCNGEsaZocUUpw40=" />
					</div>
					<fieldset class='textbox'>
						<input class="buttonInput" name="UuserName" type="text" placeholder="Username" id="UuserName"  />
						<br>
						<input class="buttonInput" type="password" name='UPswd' placeholder="Password" id='UPswd' />
						<br>
						<br>
						<input class="btn-primary" input id="submitButton" type="image" src="./images/btn_login.png" name="Submit" value="" />
						<a href="./reg.php">
							<img src="./images/btn_register.png">
						</a>
						<br>
						<a href="https://www.facebook.com/dialog/oauth?client_id=861882643830735&amp;redirect_uri=http://www.eventprobe.com/?fbTrue=true">
							<img src="./images/login-button.png" alt="Sign in with Facebook">
						</a>
					</fieldset>
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
</html>