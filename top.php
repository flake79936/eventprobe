<?PHP
	require_once("./include/membersite_config.php");
	if($fgmembersite->CheckLogin()){
		$usrname = $fgmembersite->UsrName();  
	}
?>
<head>
	<meta charset='utf-8'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./css/styleMenu.css">
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script src="./scripts/dropDown.js"></script>
</head>
<div class="logo"><img src="images/logo.jpg" alt="Logo" /></div>
<div class="date">
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

			var dayarray = new Array("Sun", "Mon", "Tue", "Wed",
			"Thu", "Fri", "Sat")

			var montharray = new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun",
			"Jul", "Aug", "Sep", "Oct", "Nov", "Dec")

			var mydate = new Date()
			var year = mydate.getYear()
			if (year < 1000)
			year += 1900
			var day = mydate.getDate()
			var month = mydate.getMonth()
			var mymonth = montharray[month]

			var daym = mydate.getDate()
			var day2 = mydate.getDay()
			var myday =dayarray[day2]

			var cdate = "";
			cdate = myday + " " + mymonth + " " + daym + " ";
			document.write(cdate);	
	</script></h1>
		<div class="temp">75</div>
		<div class="clear"></div>
	</div>
</div>

<div class="profile">
	<?PHP	if($fgmembersite->CheckLogin()){ ?>
		<div class="user"><img src="images/sample_profile.png" alt="Profile" /></div>
	<?PHP } ?>
	
	<?PHP if(isset($usrname)){ ?>
		<h2> <?= $usrname;?> </h2>
	<?PHP } ?>
	
	<!--Creating the drop down menu with Jquery-->
	<div id='cssmenu'>
		<ul>
			<li class='has-sub'>
				<img onmouseout="this.src='./images/btn_arrow_right.png';" onmouseover="this.src='./images/btn_arrow_down_black.png';" src="./images/btn_arrow_right.png" alt="Dropdown" />
				<?PHP if(!$fgmembersite->CheckLogin()){ ?>
				<ul>
					<?PHP include './login.php'; ?>
				</ul>
				<?PHP } elseif($fgmembersite->CheckLogin()){?>
				<ul>
					<li><a href='./EventCreation.php'><span>Create Event</span></a>
					<li><a href='./logout.php'><span>logout</span></a>
				</ul>
				<?PHP }?>
			</li>
		</ul>
	</div>
	<div class="clear"></div>
</div>
<div class="clear"></div>