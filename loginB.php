<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
				"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
				<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300' rel='stylesheet' type='text/css'>

	<link rel="StyleSheet" href="./includes/menu.css" />
	<script type="text/javascript" src="./includes/menu.js"></script>

	<style type="text/css">

	#pageWrapper {
		font: 18px/1.4 'Roboto Condensed', sans-serif;
		font-weight: 300;
		width: ;
		height: 800px;
		background-color: #FFF;
		margin-left: auto;
		margin-right: auto;
	}

	</style>

<?PHP	require_once("./include/membersite_config.php");
// 	$newEventID = $_GET['eid'];
// 	$newEventID = "35";

	if(isset($_POST['authenticity_token'])){
		if($fgmembersite->Login()){
			$fgmembersite->RedirectToURL("./index2.php");
		}
	}

	include 'dbconnect.php';
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
        <link rel="stylesheet" type="text/css" href="css/style.css"  />
        <link rel="stylesheet" type="text/css" href="css/top.css"    />
        <link rel="stylesheet" type="text/css" href="css/links.css"  />
        <link rel="stylesheet" type="text/css" href="css/footer.css" />
        <link rel="stylesheet" type="text/css" href="css/search.css" />

        <!--GOOGLE MAP-->
		<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.10.1.min.js"></script>

		<script>
			function showHint(str) {
				if (str.length == 0) {
//					document.getElementById("txtHint").innerHTML = "";
					$(".eventDisplayPage").show();
					$(".right").show();
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

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

		<script>
			function seeMoreInfo(str){
				window.location = "./eventDisplayPage.php?eid="+str;
			}
		</script>

		<script>
			$(document).ready(function(){
				$("input").keydown(function(){
					$(".eventDisplayPage").hide();
					$(".right").hide();

				});
			});
		</script>

        <!--FAVICON-->
        <link rel="shortcut icon" href="favicon.ico"  />
	</head>

	<body lang="en">
		<div class="search">
			<form>
				<input type="text" onkeyup="showHint(this.value)" placeholder="Search for Event">
			</form>
		</div>

    	<div class="top">
			<?PHP include './top.php';
			if (!$fgmembersite->CheckSession()) { ?>
			<center><h3> Please Login</h3></center>

			<?PHP } ?>

        </div>
				<center>
				<div id="pageWrapper"</div>
						<table border="0">
							<br>
						 <form id="login" action="<?php echo $fgmembersite->GetSelfScript(); ?>" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
							<tr>
							<div class="login">
								<div style="margin:0;padding:0;display:inline">
									<input name="utf8" type="hidden" value="&#x2713;" />
									<input name="authenticity_token" type="hidden" value="4L/A2ZMYkhTD3IiNDMTuB/fhPRvyCNGEsaZocUUpw40=" />
								</div>
								<fieldset class='textbox'>
									<input name="UuserName" type="text" placeholder="Username" id="UuserName"  />
									<br>
									<input type="password" name='UPswd' placeholder="Password" id='UPswd' />
									<br>
									<br>
									<input class="btn-primary" input id="submitButton" type="submit" name="Submit" value="Login" />
							</tr>
									<br>
									<a href="https://www.facebook.com/dialog/oauth?client_id=861882643830735&amp;redirect_uri=http://www.eventprobe.com/?fbTrue=true">
									<img src="./images/login-button.png" alt="Sign in with Facebook"></a>
									<br>
									<a href="./reg.php"><img src="./images/btn_register.png"></a>
									<br>
								</center>
								</fieldset>
							</div>
						</form>


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
