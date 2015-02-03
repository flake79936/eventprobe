<!--
	need to retrieve the events that are within a 7 days range.
	Mon 0000 hrs to Sun 2400 hrs.
-->

<head>
	<link rel="stylesheet" type="text/css" href="css/getEvent.css" />
</head>

<body>
	<?php

		$con = mysqli_connect('localhost', 'user', 'Xzr?f270', 'EventAdvisors');
		if (!$con) { die('Could not connect: ' . mysqli_error($con)); }
		mysqli_select_db($con, "EventAdvisors");

	require_once("./include/membersite_config.php");
	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);
	
		$today = date("m/d/Y");

		$var = isset($_GET['q']) && $_GET['q'] != "" ? "'.*" . $_GET['q'] .".*'" : null;
		$qry = "SELECT EstartDate Eflyer, EtimeStart, EtimeEnd, Evename, Efacebook, Egoogle, Etwitter, Ehashtag, Erank FROM Events ";
		$qry .= $var != null ? 
				" WHERE (EstartDate REGEXP $var OR Evename REGEXP $var OR EtimeStart REGEXP $var OR EtimeEnd REGEXP $var OR Efacebook REGEXP $var OR Erank REGEXP $var) AND EstartDate >='".$today."' " 
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
				echo "<div class='row'>";
				echo "<div>";
				echo "	<div class='profile'><img src='".$row['Eflyer']."' alt='Image' /> </div>";
				echo "		<div class='info'>";
				echo "			<div class='box'>" . $row['EtimeStart'] ." - ". $row['EtimeEnd'] . "</div>";
				echo "			<div class='box'>" . $row['Evename'] . "</div>";
				echo "			<div class='box'>";
				echo "				<ul>";
				echo "					<li><img src='images/icon_star.png' alt='Icon' /></li>";
				echo "					<li><img src='images/icon_star.png' alt='Icon' /></li>";
				echo "					<li><img src='images/icon_star.png' alt='Icon' /></li>";
				echo "					<li><img src='images/icon_star.png' alt='Icon' /></li>";
				echo "					<li><img src='images/icon_star.png' alt='Icon' /></li>";
				echo "				</ul>";
				echo "			</div>";
				echo "			<div class='box'> " . $row['Efacebook'] . " </div>";
				echo "			<div class='box'>" . $row['Efacebook'] . "</div>";
				echo "			<div class='box'><a href='#'>" . $row['Efacebook'] . "</a></div>";
				echo "		</div>";
				echo "	<div class='clear'></div>";
				echo "</div>";
				echo "</div>";
			}
			
			mysqli_close($con);
		?>
	</div>
</body>

<div class="row">
	<div>
		<div class="profile"><img src="images/sample_today.jpg" alt="Image" /></div>
			<div class="info active">
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
</div>