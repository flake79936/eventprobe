<head>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/top.css" />
	<link rel="stylesheet" type="text/css" href="css/myEvents.css" />
	<link rel="stylesheet" type="text/css" href="css/banner.css" />
	<link rel="stylesheet" type="text/css" href="css/thisWeek.css" />
	<link rel="stylesheet" type="text/css" href="css/schedule.css" />
	<link rel="stylesheet" type="text/css" href="css/chart.css" />
	<link rel="stylesheet" type="text/css" href="css/app.css" />
	<link rel="stylesheet" type="text/css" href="css/links.css" />
	<link rel="stylesheet" type="text/css" href="css/footer.css" />
</head>

<?php
	//$q = intval($_GET['q']);

	$con = mysqli_connect('localhost', 'admindev', '17s_9Eyr', 'cs5339team9fa14');
	if (!$con) { die('Could not connect: ' . mysqli_error($con)); }

	mysqli_select_db($con, "cs5339team9fa14");
	
	$var = isset($_GET['q']) && $_GET['q'] != "" ? "'.*" . $_GET['q'] .".*'" : null;
	$qry = "SELECT * FROM master ";
	$qry .= $var != null ? 
			" WHERE academicyear REGEXP $var OR term REGEXP $var OR last REGEXP $var OR first REGEXP $var OR major REGEXP $var OR level REGEXP $var OR degree REGEXP $var " 
			: "";
			
	//$sql = "SELECT * FROM master WHERE id = '".$q."'";
	$result = mysqli_query($con, $qry);
	
		echo "<table border='1'>
		<tr>
		<th>master_id</th>
		<th>academicyear</th>
		<th>term</th>
		<th>last</th>
		<th>first</th>
		<th>major</th>
		<th>level</th>
		<th>degree</th>
		</tr>";

		while($row = mysqli_fetch_array($result)) {
			echo "<tr>";
			echo "<td>" . $row['master_id'] . "</td>";
			echo "<td>" . $row['academicyear'] . "</td>";
			echo "<td>" . $row['term'] . "</td>";
			echo "<td>" . $row['last'] . "</td>";
			echo "<td>" . $row['first'] . "</td>";
			echo "<td>" . $row['major'] . "</td>";
			echo "<td>" . $row['level'] . "</td>";
			echo "<td>" . $row['degree'] . "</td>";
			echo "</tr>";
		}
		echo "</table>";
		
		
	mysqli_close($con);
?>
<body>
<div class="box">
	<div class="title">
		<h1>Today and this Week Near You</h1>
		<a href="#"><img src="images/btn_refresh.png" alt="Refresh" /></a>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<div class="cell">&nbsp;</div>
		<div class="cell active">
			<div class="circle">1</div>
			<h4>9/20<br />TUE</h4>
		</div>
		<div class="cell">
			<div class="blank">&nbsp;</div>
			<h4>9/20<br />WED</h4>
		</div>
		<div class="cell">
			<div class="circle">1</div>
			<h4>9/20<br />TUE</h4>
		</div>
		<div class="cell">
			<div class="circle">4</div>
			<h4>9/20<br />SUN</h4>
		</div>
		<div class="cell">
			<div class="blank">&nbsp;</div>
			<h4>9/20<br />MON</h4>
		</div>
		<div class="cell">
			<div class="circle">3</div>
			<h4>9/20<br />TUE</h4>
		</div>
		<div class="cell">
			<div class="blank">&nbsp;</div>
			<h4>9/20<br />THU</h4>
		</div>
		<div class="cell">
			<div class="blank">&nbsp;</div>
			<h4>9/20<br />SUN</h4>
		</div>
		<div class="cell">
			<div class="blank">&nbsp;</div>
			<h4>9/20<br />WED</h4>
		</div>
		<div class="cell">&nbsp;</div>
		<div class="clear"></div>
	</div>
	
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
</div>

<div class="advertisement">
	<a href="#"><img src="images/advertisement_01.jpg" alt="Banner" /></a>
	<a href="#"><img src="images/advertisement_02.jpg" alt="Banner" /></a>
</div>
<div class="clear"></div>
</body>