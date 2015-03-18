<!--Module-->

<ul>
	<?PHP
		require_once("./include/membersite_config.php");
		$city = $fgmembersite->getCity();
		if(isset($_POST["submitted"])){
			$result = $fgmembersite->searchEvent();
		}
	
		include 'dbconnect.php';

		$today = Date("Y-m-d");
		$sql = "SELECT * FROM Events WHERE EstartDate >= '".$today."' AND Ecity = '".$city."' AND Edisplay ='1' ORDER BY EstartDate LIMIT 8";
		$result = mysqli_query($con, $sql);

		$i = 0;
		while($row = mysqli_fetch_array($result)){
		//day name of the date	
		$today = date("m/d/Y");
		$dt = strtotime($row['EstartDate']);
		$day = date("l", $dt);
		if ($today===$row['EstartDate']){
		$day="Today";}
	?>
	<li>
		<a onClick="seeMoreInfo(<?= $row['Eid'] ?>);">
		<div class="info">
			<div class="box">
				<img class="btn-cross" src="images/btn_cross.png" alt="Cross" />
				<h1><?= $day ?></h1>
				<p> <?= substr($row['EstartDate'], 5, 9); ?>, <?= $row['EtimeStart'] ?></p>
				<h1><?= $row['Evename'] ?></h1>
			</div>
		</div>
		<img width="200px" height="200px" src="<?= $row['Eflyer'] ?>" alt="Image" />
		</a>
	</li>

	<?PHP $i++; } ?>
<div class="clear"></div>
</ul>