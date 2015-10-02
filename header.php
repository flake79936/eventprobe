<!--Module-->

<head>
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<link rel="stylesheet" type="text/css" href="./css/jquery-ui.css" />
	<script type="text/javascript" src="./js/jquery-ui.js"></script>
		
	<script>
		$(function(){
			$( "#datepicker" ).datepicker({ minDate: 0, maxDate: "+12M" });
		});
	</script>
</head>

<?PHP
	require_once("./include/membersite_config.php");

	if(isset($_POST['authenticity_token'])){
		if($fgmembersite->Login()){
			$fgmembersite->RedirectToURL("./index2.php");
		}
	}
	
	function grabCurrentURL(){
		(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") ? $url = "https://" : $url = "http://";
		
		$url .= $_SERVER['SERVER_NAME'];
		
		($_SERVER['SERVER_PORT'] != 80) ? $url .= ":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"] : $url .= $_SERVER["REQUEST_URI"];
		
		return $url;
	}
	
	$test = grabCurrentURL();
 
	$mystring = (string)$test;
	
	$findme = 'login.php';
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
	<a href="./index.php">
		<img id="logo" src="images/logo.png" onmouseover="this.src='images/logo2.png'" onmouseout="this.src='images/logo.png'" alt="Logo" />
	</a>
</div>
<?PHP if(!$pos2 !== false){ ?>
	<div class="search">
		<form action="./getEvent.php" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
			<div class="searchBar">
				<input type="text" name="qry" id="qry" placeholder="Search for Event, City, State, Zip Code">
				<div class="submitButton">
					<input type="image" src="./images/btn_search.png" id="submitButton" name="submitButton">
				</div>
			</div>
		</form>
		
		<!--<form>
			<div class="picker">
				<input type="text" id="datepicker" onChange="showHint(this.value);" value="" min="<?PHP echo $minDate; ?>" title="Pick A Date To Filter By">
			</div>
		</form>-->
		
		
		<div class="search-icons">
			<div class="center">
				<a onclick="queryShows('sport');" >
					<input class="sport" type="image" src="./images/w40/icon_marathonHD.png" id="subSport" name="subSport"/>
				</a>
				
				<img class="spacer" alt="spacer" src="./images/spacer.png"/>
				
				<a onclick="queryShows('concert');" >
					<input class="concert" type="image" src="./images/w40/icon_concertHD.png" id="subConcert" name="subConcert"/>
				</a>
				
				<img class="spacer" alt="spacer" src="./images/spacer.png"/>
				
				<a onclick="queryShows('fair');" >
					<input class="fair" type="image" src="./images/w40/icon_festivalHD.png" id="subFair" name="subFair"/>
				</a>
				
				<img class="spacer" alt="spacer" src="./images/spacer.png"/>
				
				<a onclick="queryShows('art');" >
					<input class="art" type="image" src="./images/w40/icon_artEventHD.png" id="subArt" name="subArt"/>
				</a>
				
				<!--<img class="spacer" alt="spacer" src="./images/spacer.png"/>-->
				
				<!--<a onclick="queryShows('');" >
					<input class="clearX" type="image" src="./images/clear.png" id="subClear" name="subClear"/>
				</a>-->
			</div>
		</div>
	</div>
<?PHP } ?>
 
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
	<?PHP } ?> 
	 
	<?PHP if(!$bool && !$pos !== false){ ?>
		<div class="inbtn">
			<a href="./login.php">
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