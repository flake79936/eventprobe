<ul>
	<?PHP
		require_once("./include/membersite_config.php");
		$city2 = $fgmembersite->getCity();
		if(isset($_POST["submitted"])){
			$result = $fgmembersite->searchEvent();
		}

// 		
// 		if(!isset($_SESSION['city2'])){
// 			echo"not set";
// 			}
// 			else{
// 		$city2 = $_SESSION['city2'];}
// 		
		
include 'dbconnect.php';

		$today = Date("m/d/Y");
		$sql = "SELECT * FROM Events WHERE EstartDate >= '".$today."' AND Ecity = '".$city2."' ORDER BY EstartDate";
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
	<li>
		<div class="info">
			<div class="box">
				<a href="#" class="btn-cross"><img src="images/btn_cross.png" alt="Cross" /></a>
				<h1><?=$day?></h1>
				<p> <?=substr($row['EstartDate'], 0, 5);?>, <?= $row['EtimeStart'] ?></p>
				<h1><?= $row['Evename'] ?></h1>
			</div>
		</div>
		<img width="200px" height="200px" src="<?= $row['Eflyer'] ?>" alt="Image" />
	</li>

	<?PHP $i++; } ?>
<div class="clear"></div>
</ul>