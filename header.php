<!--Module-->
<?PHP
	require_once("./include/membersite_config.php");

	if(isset($_POST['authenticity_token'])){
		if($fgmembersite->Login()){
			$fgmembersite->RedirectToURL("./index2.php");
		}
	}
	
	function grabCurrentURL(){
		if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
			$url = "https://";
		}else{
			$url = "http://";
		}
		$url .= $_SERVER['SERVER_NAME'];
		if($_SERVER['SERVER_PORT'] != 80){
			$url .= ":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		}else{
			$url .= $_SERVER["REQUEST_URI"];	
		}
		return $url;
	}
	$test=grabCurrentURL();
 
	$mystring = (string)$test;
	
	$findme   = 'loginB.php';
	$pos = strpos($test, $findme);
	
	$findme2 = 'eventCreation.php';
	$pos2 = strpos($test, $findme2);
		
	// if(!$pos !== true){
	// echo "test";
	// }

	$bool = $fgmembersite->CheckSession();
	$usrname = $fgmembersite->UsrName();
?>

<div class="logo">
	<a href="./index2.php"><img src="images/logo.png" onmouseover="this.src='images/logo2.png'" onmouseout="this.src='images/logo.png'" alt="Logo" /></a>
</div>

<div class="search">
	<form>
		<div class="searchBar">
			<input type="text" onKeyUp="showHint(this.value);" placeholder="Search for Event, City, State, Zip Code">
		</div>
		<div class="datePicker">
			<input type="date" id="searchDate" onchange="showHint(this.value);" min="<?PHP echo $minDate; ?>" title="Pick A Date To Filter By">
		</div>
		<div class="search-icons">
			<a id="sport" onClick="showHint('sport');"><img alt="sport" src="./images/icon_marathon.png"/></a> | 
			<a id="concert" onClick="showHint('concert');"><img alt="concert" src="./images/icon_concert.png"/></a> | 
			<a id="fair" onClick="showHint('fair');"><img alt="fair" src="./images/icon_festival.png"/></a> | 
			<a id="art" onClick="showHint('art');"><img alt="art" src="./images/icon_artEvent.png"/></a>
			<a id="" onClick="showHint('');"><img alt="art" src="./images/clear.png"/></a>
		</div>
	</form>
</div>

<!-- <div class="date">
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
</div>-->

<div class="profile">
	<!--<div class="user"></div>-->
 	<?PHP if(!$pos2 !== false){ ?>
		<div class="crtEvent">
			<a href="./eventCreation.php">
				<img src="./images/btn_crtevent.png">
			</a>
		</div>
	<?PHP }?> 
	 
	<?PHP if(!$bool && !$pos !== false){ ?>
		<div class="inbtn">
			<a href="./loginB.php">
				<img src="./images/btn_login.png">
			</a>
		</div>
	<?PHP } else if (!$pos !== false){ ?>
		<div class="outbtn">
			<a href="./logout.php">
				<img src="./images/btn_logout.png">
			</a>
		</div>
	<?PHP } ?>
	
	<div class="clear"></div>
</div>
<div class="clear"></div>