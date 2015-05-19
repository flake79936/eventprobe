<!--Module-->
<ul>
	<?PHP
		require_once("./include/membersite_config.php");
		include 'dbconnect.php';
		
		$timezone = $fgmembersite->getLocalTimeZone();
		date_default_timezone_set($timezone);
		
// 		$city = $fgmembersite->getCity();
		$city= $_SESSION["city"];
// 		echo $_SESSION["city"];
		//$city = "El Paso";
		
		if(isset($_POST["submitted"])){
			$result = $fgmembersite->searchEvent();
		}
		
		$newformat = date('Y-m-d');
		
		$start = (int)(isset($_GET["st"]) ? $_GET["st"] : 0);
		$end   = 8;

		//$startpoint = ($end * $start) - $end;
		
		//please do not add a semicolon at the end of this line, inside of the double quotes.
		$statement = "Events WHERE EstartDate >= '" . $newformat . "' AND Ecity = '" . $city . "' AND Edisplay='1' AND (Erank='Paid' OR Erank='Premium')  ORDER BY EstartDate ASC, EtimeStart ";
		
		$sql = "SELECT * FROM {$statement}  LIMIT {$start}, {$end};";
		$result = mysqli_query($con, $sql);
		
		
		
		$qry = "SELECT COUNT(*) FROM Events WHERE EstartDate >= '" . $newformat . "' AND Ecity = '" . $city . "' AND Edisplay='1' AND (Erank='Paid' OR Erank='Premium') ;";
		$result2 = mysqli_query($con, $qry);
						
						if(mysqli_num_rows($result2) < 1){
						// There is no event, do something							
							}
				
		
		
		
		
		
		$i = 0;
		while($row = mysqli_fetch_array($result)){
		
		$newStartTime =date("g:i a", strtotime($row['EtimeStart']));
		
			$date = date_create($row['EstartDate']);
			$EstartDate = date_format($date, 'm/d/Y');
			
			//day name of the date	
			$today = date("Y-m-d");
			$dt = strtotime($EstartDate);
			$day = date("l", $dt);
			
			if ($today === $EstartDate){
				$day = "Today";
			}
	?>
			<li>
				<div class="schedule">
					<a onClick="seeMoreInfo(<?= $row['Eid'] ?>);">
						<div class="info">
							<div class="box">
								<h2><?= $day ?></h2><img class="btn-cross" src="images/btn_cross.png" alt="Cross" />
								<p><?= substr($EstartDate, 0, 5); ?><br> <?= $newStartTime ?></p>
								<h3><?= substr($row['Evename'], 0, 12) . " ..."; ?></h3>
							</div>
						</div>
						<?PHP 
							$type = $row['Etype'];
							if($row['Eflyer'] === ""){
								switch($type){
									case "Art":            $row['Eflyer'] = "./images/h200/icon_artEventHD.png";   break;
									case "Concert":        $row['Eflyer'] = "./images/h200/icon_concertHD.png";    break;
									case "Fair":           $row['Eflyer'] = "./images/h200/icon_festivalHD.png";   break;
									case "Social":         $row['Eflyer'] = "./images/h200/icon_kettleballHD.png"; break;
									case "Sport":          $row['Eflyer'] = "./images/h200/icon_marathonHD.png";   break;
									case "Public Speaker": $row['Eflyer'] = "./images/h200/icon_speakerHD.png";    break;
									default:               $row['Eflyer'] = "./images/h200/icon_fireworksHD.png";  break;
								}
							}
						?>
						<img width="200px" height="200px" src="<?= $row['Eflyer'] ?>" alt="Image" />
					</a>
				</div>
			</li>
	<?PHP   $i++; 
		} ?>
	<div class="clear"></div>
</ul>
