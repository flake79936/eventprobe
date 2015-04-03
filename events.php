<!--Module-->
<ul>
	<?PHP
		require_once("./include/membersite_config.php");
		$city = $fgmembersite->getCity();
		//$city = "El Paso";
		
		if(isset($_POST["submitted"])){
			$result = $fgmembersite->searchEvent();
		}

		include 'dbconnect.php';

		$today = Date("Y-m-d");
		$sql = "SELECT * FROM Events WHERE EstartDate >= '".$today."' AND Ecity = '".$city."' AND Edisplay ='1' AND (Erank='Paid' OR Erank='Premium') ORDER BY EstartDate LIMIT 8";
		$result = mysqli_query($con, $sql);

		$i = 0;
		while($row = mysqli_fetch_array($result)){
			$date = date_create($row['EstartDate']);
			$EstartDate = date_format($date, 'm/d/Y');
			
			//day name of the date	
			$today = date("m/d/Y");
			$dt = strtotime($EstartDate);
			$day = date("l", $dt);
			
			if ($today === $EstartDate){
				$day = "Today";
			}
	?>
			<li>
				<a onClick="seeMoreInfo(<?= $row['Eid'] ?>);">
					<div class="info">
						<div class="box">
							<h2><?= $day ?></h2><img class="btn-cross" src="images/btn_cross.png" alt="Cross" />
							
							<p><?= substr($EstartDate, 0, 5); ?>, <?= $row['EtimeStart'] ?></p>
							<h3><?= substr($row['Evename'], 0, 12) . " ..."; ?></h3>
						</div>
					</div>
					<?PHP 
						$type = $row['Etype'];
						if($row['Eflyer'] === ""){
							switch($type){
								case "Art":            $row['Eflyer'] = "./images/art35.png"; break;
								case "Concert":        $row['Eflyer'] = "./images/music.png"; break;
								case "Fair":           $row['Eflyer'] = "./images/fair35.png"; break;
								case "Social":         $row['Eflyer'] = "./images/weight35.png"; break;
								case "Sport":          $row['Eflyer'] = "./images/sports40.png"; break;
								case "Public Speaker": $row['Eflyer'] = "./images/speaker.png"; break;
								default:               $row['Eflyer'] = "./images/magic35.png"; break;
							}
						}
					?>
					<img width="200px" height="200px" src="<?= $row['Eflyer'] ?>" alt="Image" />
				</a>
			</li>
	<?PHP   $i++; 
		} ?>
	<div class="clear"></div>
</ul>