<ul>
	<?PHP
		require_once("./include/membersite_config.php");
		$city = $fgmembersite->getCity();
// 		$city="el paso";
		if(isset($_POST["submitted"])){
			$result = $fgmembersite->searchEvent();
		}
	
		
		include 'dbconnect.php';

	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);

	
		$today = Date("m/d/Y");
		$sql = "SELECT * FROM Events WHERE EstartDate >= '".$today."' AND Ecity = '".$city."' AND Edisplay='1' ORDER BY EstartDate";
		$result = mysqli_query($con, $sql);

		$i = 0;
		while($row = mysqli_fetch_array($result)){
			//day name of the date	
			$today= date("m/d/Y");
			$dt = strtotime($row['EstartDate']);
			$day = date("l", $dt);
			if ($today===$row['EstartDate']){
			$day="Today";}
		?>
		<a onClick="seeMoreInfo(<?= $row['Eid'] ?>);"><li>
			<div class="info">
				<div class="box">
					<img src="images/btn_cross.png" alt="Cross" class="btn-cross"/>
					<h1><?=$day?></h1>
					<p> <?=substr($row['EstartDate'], 0, 5);?>, <?= $row['EtimeStart'] ?></p>
					<h1><?= $row['Evename'] ?></h1>
				</div>
			</div>
			<img width="200px" height="200px" src="<?= $row['Eflyer'] ?>" alt="Image" />
		</li></a>

	<?PHP $i++; } ?>
<div class="clear"></div>
</ul>