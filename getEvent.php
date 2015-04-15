<!--AJAX Module-->
<?PHP	
	require_once("./include/membersite_config.php");

	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);
?>

<head>
	<link rel="stylesheet" type="text/css" href="css/getEvent.css" />
</head>

<body lang="en">
	<?php
		//$q = intval($_GET['q']);

		$con = mysqli_connect('localhost', 'user', 'Xzr?f270', 'EventAdvisors');
		if (!$con) { die('Could not connect: ' . mysqli_error($con)); }
		mysqli_select_db($con, "EventAdvisors");
		
		$today = Date("m/d/Y");

		$var = isset($_GET['q']) && $_GET['q'] != "" ? "'.*" . $_GET['q'] .".*'" : null;
		$qry = "SELECT * FROM Events ";
		$qry .= $var != null ? 
				" WHERE (EstartDate REGEXP $var OR Etype REGEXP $var OR Ezip REGEXP $var OR Ecity REGEXP $var OR Evename REGEXP $var OR EtimeStart REGEXP $var OR EtimeEnd REGEXP $var OR Efacebook REGEXP $var OR Erank REGEXP $var) AND EstartDate >='".$today."' AND Edisplay ='1' " 
				: "";
				
		$result = mysqli_query($con, $qry);
	?>
	<div class="box">
		<div class="title">
			<h1>Today and this Week Near You</h1>
			<!--To refresh, we can create a method in fg_membersite-->
			<!--<a href="#"><img src="images/btn_refresh.png" alt="Refresh" /></a>-->
			<div class="clear"></div>
		</div>
		
		<?PHP
			while($row = mysqli_fetch_array($result)) {
				$formattedDate= str_replace("-","/",$row['EstartDate']);
				$formattedDate= substr($formattedDate,5,10);
				$type = $row['Etype'];
				if($row['Eflyer'] === ""){
					switch($type){
						case "Art":            $row['Eflyer'] = "./images/icon_artEventHD.png";   break;
						case "Concert":        $row['Eflyer'] = "./images/icon_concertHD.png";    break;
						case "Fair":           $row['Eflyer'] = "./images/icon_festivalHD.png";   break;
						case "Social":         $row['Eflyer'] = "./images/icon_kettleballHD.png"; break;
						case "Sport":          $row['Eflyer'] = "./images/icon_marathonHD.png";   break;
						case "Public Speaker": $row['Eflyer'] = "./images/icon_speakerHD.png";    break;
						default:               $row['Eflyer'] = "./images/icon_fireworksHD.png";  break;
					}
				}
				
				//echo "Inside the Today " . $row['EstartDate'];
				echo "<div class='row'>";
				echo "	<div><a onClick='seeMoreInfo(".$row['Eid'].");'>";
				echo "		<div class='profile'><img src='".$row['Eflyer']."' alt='Image' /></div>";
				echo "			<div class='info'>";
				echo "				<div class='text-info'>";
				//echo "					<div class='box'>" . $row['EtimeStart'] ." - ". $row['EtimeEnd'] . "</div>";
				echo "					<div class='ename'>" . substr($row['Evename'], 0, 12) . " ...</div>";
				echo "					<div class='etime'>" . $row['EtimeStart'] ." - ". $row['EtimeEnd'] . " </div>";
				echo "					<div class='ecity'>" . ucfirst($row['Ecity']) . ", " . strtoupper($row['Estate']) . " </div>";
				echo "				</div>";
				echo "				<div class='social-icons'>";
				if ($row['Efacebook']){
				echo "					<div class='FB'> <a href=". $row['Efacebook']." target='_blank'  > <img src='images/icon_fb.png'> </div>";
				}
				if ($row['Etwitter']){
				echo "					<div class='TW'> <a href=https://twitter.com/". $row['Etwitter']." target='_blank'> <img src='images/icon_twitter.png'> </a></div>";
				}
				if ($row['Egoogle']){
				echo "					<div class='Goo'> <a href=". $row['Egoogle']." target='_blank'  > <img src='images/icon_google.png'> </a></div>";
				}
				if ($row['Ehashtag']){
				echo "					<div class='Hashtag'>" . $row['Ehashtag'] . "</div>";
				}
				echo "				</div>";
				//echo "				<div class='more'>More Info</div>";

				echo "			</div>";
				echo "		<div class='clear'></div>";
				echo "	</a></div>";
				echo "</div>";
			}
			mysqli_close($con);
		?>
	</div>
</body>