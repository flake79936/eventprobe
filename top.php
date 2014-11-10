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
<!--
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
//-->
</script> <?= date("D")?> <?= date("M") ?> <?= date("d") ?></h1>
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
			<li class='active has-sub'><a href="#"><img src="images/btn_arrow_down_black.png" alt="Dropdown" /></a>
				<?PHP if(!$fgmembersite->CheckLogin()){ ?>
				<ul>
					<?PHP include ("./login.php"); ?>
				</ul>
				<?PHP } else {?>
				<ul>
					<li><a href='./logout.php'><span>logout</span></a>
				</ul>
				<?PHP }?>
			</li>
		</ul>
	</div>

	<div class="clear"></div>
</div>
<div class="clear"></div>