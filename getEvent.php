<head>
	<link rel="stylesheet" type="text/css" href="css/getEvent.css" />
</head>

<body>
<?php
	//$q = intval($_GET['q']);

$con = mysqli_connect('localhost', 'admindev', '17s_9Eyr', 'Eventadvisors');
if (!$con) { die('Could not connect: ' . mysqli_error($con)); }
mysqli_select_db($con, "Eventadvisors");
$today = Date("m/d/Y");

	$var = isset($_GET['q']) && $_GET['q'] != "" ? "'.*" . $_GET['q'] .".*'" : null;
	$qry = "SELECT * FROM Events ";
	$qry .= $var != null ? 
			" WHERE (Evename REGEXP $var OR EtimeStart REGEXP $var OR EtimeEnd REGEXP $var OR Efacebook REGEXP $var) AND EstartDate >='".$today."' " 
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
				echo "			<div class='box'>" .  $row['EtimeStart'] ." - ". $row['EtimeEnd'] . "</div>";
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