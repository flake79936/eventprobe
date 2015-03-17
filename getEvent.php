<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>

<?PHP	
	require_once("./include/membersite_config.php");

	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);
?>

<head>
	<link rel="stylesheet" type="text/css" href="css/getEvent.css" />
</head>

<body>
<?php
	//$q = intval($_GET['q']);

$con = mysqli_connect('localhost', 'user', 'Xzr?f270', 'EventAdvisors');
if (!$con) { die('Could not connect: ' . mysqli_error($con)); }
mysqli_select_db($con, "EventAdvisors");
// 
// 	$lat = $fgmembersite->getLat();
// 	$lon = $fgmembersite->getLon();
// 	$jsonObject = file_get_contents("https://maps.googleapis.com/maps/api/timezone/json?timestamp=0&sensor=true&location=".$lat.",".$lon."");
// 	$object = json_decode($jsonObject);
// 
// 	$timezone=$object->timeZoneId;
// 
// 	date_default_timezone_set($timezone);
	
	$today = Date("m/d/Y");

	$var = isset($_GET['q']) && $_GET['q'] != "" ? "'.*" . $_GET['q'] .".*'" : null;
	$qry = "SELECT * FROM Events ";
	$qry .= $var != null ? 

			" WHERE (Etype REGEXP $var OR Ezip REGEXP $var OR Ecity REGEXP $var OR Evename REGEXP $var OR EtimeStart REGEXP $var OR EtimeEnd REGEXP $var OR Efacebook REGEXP $var OR Erank REGEXP $var) AND EstartDate >='".$today."' AND Edisplay ='1' " 

			: "";
			
	//$sql = "SELECT * FROM master WHERE id = '".$q."'";
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
				//echo "Inside the Today " . $row['EstartDate'];
				echo "<div class='row'>";
				echo "	<div><a onClick='seeMoreInfo(".$row['Eid'].");'>";
				echo "		<div class='profile'><img src='".$row['Eflyer']."' alt='Image' /></div>";
				echo "			<div class='info'>";
				echo "				<div class='box'>" . $row['EtimeStart'] ." - ". $row['EtimeEnd'] . "</div>";
				echo "				<div class='box'>" . $row['Evename'] . "</div>";
				if ($row['Efacebook'])
				{
				echo "				<div class='box'> <a href=". $row['Efacebook']." target='_blank'  > <img src='images/icon_fb.png'
									 > </div>";
				}
				if ($row['Etwitter'])
				{
				echo "				<div class='box'> <a href=https://twitter.com/". $row['Etwitter']." target='_blank'  > <img src='images/btn_twitter.png'
									 > </a></div>";
				}
				if ($row['Egoogle'])
				{
				echo "				<div class='box'> <a href=". $row['Egoogle']." target='_blank'  > <img src='images/btn_google.png'
									 > </a></div>";
				}
				 if ($row['Ehashtag'])
				{
				echo "				<div class='box'>" . $row['Ehashtag'] . "</div>";
				}
				echo "				<div class='box'>More Info</div>";

				echo "			</div>";
				echo "		<div class='clear'></div>";
				echo "	</a></div>";
				echo "</div>";
			}
			mysqli_close($con);

// 			while($row = mysqli_fetch_array($result)) {
// 				echo "<div class='row'>";
// 				echo "<div>";
// 				echo "	<div class='profile'><img src='".$row['Eflyer']."' alt='Image' /> </div>";
// 				echo "		<div class='info'>";
// 				echo "			<div class='box'>" .  $row['EtimeStart'] ." - ". $row['EtimeEnd'] . "</div>";
// 				echo "			<div class='box'>" . $row['Evename'] . "</div>";
// 				echo "			<div class='box'>";
// 				echo "				<ul>";
// 				echo "					<li><img src='images/icon_star.png' alt='Icon' /></li>";
// 				echo "					<li><img src='images/icon_star.png' alt='Icon' /></li>";
// 				echo "					<li><img src='images/icon_star.png' alt='Icon' /></li>";
// 				echo "					<li><img src='images/icon_star.png' alt='Icon' /></li>";
// 				echo "					<li><img src='images/icon_star.png' alt='Icon' /></li>";
// 				echo "				</ul>";
// 				echo "			</div>";
// 				echo "			<div class='box'> " . $row['Efacebook'] . " </div>";
// 				echo "			<div class='box'>" . $row['Egoogle'] . "</div>";
// 				echo "			<div class='box'><a href='#'>" . $row['Etwitter'] . "</a></div>";
// 				echo "		</div>";
// 				echo "	<div class='clear'></div>";
// 				echo "</div>";
// 				echo "</div>";
// 			}
// 			
// 			mysqli_close($con);
		?>
	</div>
</body>