<?PHP
	require_once("./include/membersite_config.php");

	if(isset($_POST['authenticity_token'])){
		if($fgmembersite->Login()){
			$fgmembersite->RedirectToURL("./index.php");
		}
	}
	
	$bool = $fgmembersite->CheckSession();
	$usrname = $fgmembersite->UsrName();
?>

<head>
	<meta charset='utf-8'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="./css/bootstrap.min.css">
</head>

<div class="logo">
	<a href="./index.php">
		<img src="images/logo.png" onmouseover="this.src='images/logo.jpg'" onmouseout="this.src='images/logo.png'" alt="Logo" />
	</a>
</div>

<div class="date">
<!-- 
	<div class="box">
		<h1>
			<script type="text/javascript">
				var currentTime = new Date()
				var hours = currentTime.getHours()
				var minutes = currentTime.getMinutes()

				if (minutes < 10)
				minutes = "0" + minutes

				var suffix = "AM";
				if (hours >= 12) {
					suffix = "PM";
					hours = hours - 12;
				}
				if (hours == 0) {
					hours = 12;
				}
				document.write("<b>" + hours + ":" + minutes + " " + suffix + "</b>")
			</script> 	

			<script type="text/javascript">
				var dayarray = new Array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat")

				var montharray = new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec")

				var mydate = new Date()
				var year = mydate.getYear()
				if (year < 1000)
				year += 1900;
				var day = mydate.getDate()
				var month = mydate.getMonth()
				var mymonth = montharray[month]

				var daym = mydate.getDate()
				var day2 = mydate.getDay()
				var myday = dayarray[day2]

				var cdate = "";
				cdate = myday + " " + mymonth + " " + daym + " ";
				document.write(cdate);	
			</script>
		</h1>
		<div class="temp">75</div>

		<div class="clear"></div>
		
	</div>
 -->
</div>

<div class="profile">

	<div class="user"> </div>

	<!--clickable dropdown menu-->
<!-- 
	<div>
		<ul class="nav">
			<!~~ here comes the important part ~~>
			<?PHP if(!$bool){ ?>
				<li class="dropdown" id="menu1">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#menu1">
						Login
						<b class="caret"></b>
					</a>
					<div class="dropdown-menu">
						<!~~ <form style="margin: 0px" accept-charset="UTF-8" action="/sessions" method="post"> ~~>
						<form id="login" action="<?php echo $fgmembersite->GetSelfScript(); ?>" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
							<div class="login">
								<div style="margin:0;padding:0;display:inline">
									<input name="utf8" type="hidden" value="&#x2713;" />
									<input name="authenticity_token" type="hidden" value="4L/A2ZMYkhTD3IiNDMTuB/fhPRvyCNGEsaZocUUpw40=" />
								</div>
								<fieldset class='textbox'>
									<input name="UuserName" type="text" placeholder="Username" id="UuserName"  />
									<br>
									<input type="password" name='UPswd' placeholder="Passsword" id='UPswd' />
									<input class="btn-primary" input id="submitButton" type="submit" name="Submit" value="Login" />
									<br>
									<a href="https://www.facebook.com/dialog/oauth?client_id=861882643830735&amp;redirect_uri=http://www.eventprobe.com/?fbTrue=true">
									<img src="./images/login-button.png" alt="Sign in with Facebook"></a>
								</fieldset>
							</div>
						</form>
					</div>
				</li>
			<?PHP } else { ?>
			
				<li class="dropdown" id="menu1">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#menu1">
						<?PHP echo $usrname; ?>
						<b class="caret"></b>
					</a>
					<div class="dropdown-menu">
						<!~~ <form style="margin: 0px" accept-charset="UTF-8" action="/sessions" method="post"> ~~>
						<form style="margin: 0px" id="login" action="<?php echo $fgmembersite->GetSelfScript(); ?>" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
							<div class="login">
								<div style="margin:0;padding:0;display:inline">
									<input name="utf8" type="hidden" value="&#x2713;" />
									<input name="authenticity_token" type="hidden" value="4L/A2ZMYkhTD3IiNDMTuB/fhPRvyCNGEsaZocUUpw40=" />
								</div>
								<fieldset class='textbox' style="padding:10px">
									<a role="menuitem" tabindex="-1" href='./EventCreation.php'>
									<span>Create Event</span>
									</a>
									<br>
									<a role="menuitem" tabindex="-1" href='./logout.php'>
										<span>logout</span>
									</a>
								</fieldset>
							</div>
						</form>
					</div>
				</li>
			<?PHP } ?>
		</ul>      
	</div>
 -->
 
	<a href="./EventCreation.php"> <img src="./images/btn_event.png"> </a>
 
 
	<div class="clear"></div>
</div>
<div class="clear"></div>

<script src="./js/jquery-1.11.1.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script language="javascript">
	$('.dropdown-toggle').dropdown();
	$('.dropdown-menu').find('form').click(function (e) {
		e.stopPropagation();
	});
</script>