<head>
	<link rel="stylesheet" type="text/css" href="css/getEvent.css" />
</head>

<body>
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
			echo "	<div class='profile'><img src='images/sample_today.jpg' alt='Image' /> " . $row['master_id'] . "</div>";
			echo "		<div class='info'>";
			echo "			<div class='box'>" . $row['academicyear'] . "</div>";
			echo "			<div class='box'>" . $row['first'] . " " . $row['last'] . "</div>";
			echo "			<div class='box'>";
			echo "				<ul>";
			echo "					<li><img src='images/icon_star.png' alt='Icon' /></li>";
			echo "					<li><img src='images/icon_star.png' alt='Icon' /></li>";
			echo "					<li><img src='images/icon_star.png' alt='Icon' /></li>";
			echo "					<li><img src='images/icon_star.png' alt='Icon' /></li>";
			echo "					<li><img src='images/icon_star.png' alt='Icon' /></li>";
			echo "				</ul>";
			echo "			</div>";
			echo "			<div class='box'> " . $row['major'] . " </div>";
			echo "			<div class='box'>" . $row['level'] . "</div>";
			echo "			<div class='box'><a href='#'>" . $row['degree'] . "</a></div>";
			echo "		</div>";
			echo "	<div class='clear'></div>";
			echo "</div>";
			echo "</div>";
		}
		
	mysqli_close($con);
?>
</div>
</body>