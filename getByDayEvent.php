<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>

<link rel="stylesheet" type="text/css" href="css/chart.css" />

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

		<script>
			function seeMoreInfo(str){
				window.location = "./eventDisplayPage.php?eid="+str;
			}
		</script>	
<body>
	<?php
		$con = mysqli_connect('localhost', 'user', 'Xzr?f270', 'EventAdvisors');
		if (!$con) { die('Could not connect: ' . mysqli_error($con)); }
		mysqli_select_db($con, "EventAdvisors");
		
		require_once("./include/membersite_config.php");
		$timezone = $fgmembersite->getLocalTimeZone();
		date_default_timezone_set($timezone);
		
		$city = $fgmembersite->getCity();
// 		$city = "El Paso";
	
		$today = date("m/d/Y");

		/*$var = isset($_GET['q']) && $_GET['q'] != "" ? "'.*" . $_GET['q'] .".*'" : null;
		$qry = "SELECT EstartDate, Eflyer, EtimeStart, EtimeEnd, Evename, Efacebook, Egoogle, Etwitter, Ehashtag, Erank FROM Events ";
		$qry .= $var != null ? 
				" WHERE (EstartDate REGEXP $var OR Evename REGEXP $var OR EtimeStart REGEXP $var OR EtimeEnd REGEXP $var OR Efacebook REGEXP $var OR Erank REGEXP $var) AND EstartDate >='".$today."' " 
				: "";*/
				
		//echo "Passing -> " . $_GET['q'];
		$newformat = date('m/d/Y', $_GET['date']);
		//echo "<br/>New time format -> " . $newformat;
		
		$qry = "SELECT * FROM Events WHERE EstartDate = '".$newformat."' AND Ecity = '" . $city . "' AND Edisplay='1' ;";
		$result = mysqli_query($con, $qry);
		
		$bool = $fgmembersite->CheckSession();
	?>
	
	<div class="box" >
		<?PHP
			while($row = mysqli_fetch_array($result)) {
				//echo "Inside the Today " . $row['EstartDate'];
				echo "<div class='row' >";
				echo "	<div><a onClick='seeMoreInfo(".$row['Eid'].");'>";
				echo "		<div class='profile'><img src='".$row['Eflyer']."' alt='Image' /></div>";
				echo "			<div class='info'>";
				echo "				<div class='box'>" . $row['EtimeStart'] ." - ". $row['EtimeEnd'] . "</div>";
				echo "				<div class='box'>" . $row['Evename'] . "</div>";
				if ($row['Efacebook'])
				{
				echo "				<div class='box'> <a href=". $row['Efacebook']." target='_blank'  > <img src='images/icon_fb.png'
									 > </a></div>";
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
				echo "				<div class='box'><a href=https://instagram.com/" . $row['Ehashtag'] . " target='_blank'  > <img src='images/icon_instagram2.png'
									 > </a></div>";
				}
				echo "				<div class='box'><a onClick='seeMoreInfo(".$row['Eid'].");'>More Info</div>";
				if($bool){
				echo "				<div class='box'><a onClick='addToUserTable(".$row['Eid'].");'><img src='images/btn_cross.png' alt='Icon' /></a></div>";
				}
				echo "			</div>";
				echo "		<div class='clear'></div>";
				echo "	</a></div>";
				echo "</div>";
			}
			mysqli_close($con);
		?>
	</div>
</body>

<!--<div class="row">
	<div>
		<div class="profile"><img src="images/sample_today.jpg" alt="Image" /></div>
			<div class="info">
				<div class="box">4:30 PM - 6:000 PM</div>
				<div class="box">Muligans Happy Hour</div>
				<div class="box">
					<ul>
						<li><img src="images/icon_star.png" alt="Icon" /></li>
						<li><img src="images/icon_star.png" alt="Icon" /></li>
						<li><img src="images/icon_star.png" alt="Icon" /></li>
						<li><img src="images/icon_star.png" alt="Icon" /></li>
						<li><img src="images/icon_star.png" alt="Icon" /></li>
					</ul>
				</div>
				<div class="box"><img src="images/icon_fb.png" alt="Facebook" /></div>
				<div class="box">more</div>
				<div class="box"><a href="#"><img src="images/btn_cross.png" alt="Icon" /></a></div>
			</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>-->