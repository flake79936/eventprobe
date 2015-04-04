<!--Module-->
<?PHP
	require_once("./include/membersite_config.php");

	if(isset($_POST['authenticity_token'])){
		if($fgmembersite->Login()){
			$fgmembersite->RedirectToURL("./index2.php");
		}
	}
	
	$bool = $fgmembersite->CheckSession();
	$usrname = $fgmembersite->UsrName();
	
?>

<div class="logo">
	<a href="./index2.php"><img src="images/logo.png" onmouseover="this.src='images/logo2.png'" onmouseout="this.src='images/logo.png'" alt="Logo" /></a>
</div>

<div class="search">
	<form>
		<input class="searchBar" type="text" onKeyUp="showHint(this.value);" placeholder="Search for Event, City, State, Zip Code">
		<input class="datePicker" type="date" id="searchDate" onchange="showHint(this.value);" min="<?PHP echo $minDate; ?>" title="Pick A Date To Filter By">&nbsp;&nbsp;
		<a id="sport" onClick="showHint('sport');"><img alt="sport" src="./images/sports2.png"/></a> | 
		<a id="concert" onClick="showHint('concert');"><img alt="concert" src="./images/music2.png"/></a> | 
		<a id="fair" onClick="showHint('fair');"><img alt="fair" src="./images/fair2.png"/></a> | 
		<a id="art" onClick="showHint('art');"><img alt="art" src="./images/art2.png"/></a>
		<a id="" onClick="showHint('');"><img alt="art" src="./images/clear.png"/></a>
	</form>
</div>

<!--<div class="date">
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
	<div class="user"> </div>
 
	<a href="./eventCreation.php">
		<img src="./images/btn_event2.png">
	</a>&nbsp;
	
	<div class="clear"></div>
</div>
<div class="clear"></div>