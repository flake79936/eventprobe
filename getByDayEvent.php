<!--AJAX Module-->

<head>
	<!--SYTLE SHEETS-->
	<link rel="stylesheet" type="text/css" href="css/chart.css" />
	<link rel="stylesheet" type="text/css" href="css/pagination.css" />
	
	<!--SCRIPTS-->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script>
		function seeMoreInfo(str){
			window.location = "./eventDisplayPage.php?eid="+str;
		}
	</script>
</head>

<body  lang="en">
	<?php
		require_once("./include/membersite_config.php");
		include 'dbconnect.php';
		
		$timezone = $fgmembersite->getLocalTimeZone();
		date_default_timezone_set($timezone);
		
		$city = $fgmembersite->getCity();
		//$city = "El Paso";
		$usrname = $fgmembersite->UsrName();
		$newformat = date('Y-m-d', $_GET['date']);
		
		$pageId = (int)(!isset($_GET["pageId"]) ? 1 : $_GET["pageId"]);
		if ($pageId <= 0) { $pageId = 1; } //DEFAULT pageId # 1
		//echo "page var: " . $pageId . "<br>";

		$per_paging = 2; // Set how many records do you want to display per pageId.

		$startpoint = ($per_paging * $pageId) - $per_paging;
		
		$statement = "Events WHERE EstartDate = '" . $newformat . "' AND Ecity = '" . $city . "' AND Edisplay='1' AND (Erank='Free' OR Erank='Premium' OR Erank='Paid');";
		
		$qry = "SELECT * FROM {$statement} LIMIT {$startpoint}, {$per_paging};";
		$result = mysqli_query($con, $qry);
		//echo "<br>Query: " . $qry . "<br>";
		
		$bool = $fgmembersite->CheckSession();
	?>
	
	<div class="box" >
		<?PHP
			while($row = mysqli_fetch_array($result)) {		
				$formattedDate= str_replace("-","/",$row['EstartDate']);
				$formattedDate= substr($formattedDate,5,10);
				$type = $row['Etype'];
				if($row['Eflyer'] === ""){
					switch($type){
						case "Art":            $row['Eflyer'] = "./images/icon_artEventHD.png";   break;
						case "Concert":        $row['Eflyer'] = "./images/icon_concertHD.png";    break;
						case "Fair":           $row['Eflyer'] = "./images/icon_festivalHD.png";   break;
						case "Social":         $row['Eflyer'] = "./images/icon_kettleballHD.png"; break;
						case "Sport":          $row['Eflyer'] = "./images/icon_marathonHD.png";   break;
						case "Public Speaker": $row['Eflyer'] = "./images/icon_speakerHD.png";    break;
						default:               $row['Eflyer'] = "./images/icon_fireworksHD.png";  break;
					}
				}
				
				echo "<div class='row' >";
				echo "	<div><a onClick='seeMoreInfo(".$row['Eid'].");'>";
				echo "		<div class='profile'><img src='".$row['Eflyer']."' alt='Image' /></div>";
				echo "			<div class='info'>";
				echo "				<div class='text-info'>";
				echo "					<div class='ename'>" . $row['Evename'] . "</div>";
				echo "					<div class='etime'>" . $row['EtimeStart'] ." - ". $row['EtimeEnd'] . " </div>";
				echo "					<div class='ecity'>" . ucfirst($row['Ecity']).", ".strtoupper($row['Estate'])." </div>";
				echo "				</div>";
				echo "				<div class='social-icons'>";
									if ($row['Efacebook']){
				echo "					<div class='FB'> <a href=". $row['Efacebook']." target='_blank'  > <img src='images/icon_fb.png'> </a></div>";
									}				
									if ($row['Etwitter']){
				echo "					<div class='TW'> <a href=". $row['Etwitter']." target='_blank'> <img src='images/icon_twitter.png'> </a></div>";
									}
									if ($row['Egoogle']){
				echo "					<div class='Goo'> <a href=". $row['Egoogle']." target='_blank'  > <img src='images/icon_google.png'> </a></div>";
									}
									if ($row['Ehashtag']){
				echo "					<div class='Hashtag'>" . $row['Ehashtag'] . "</div>";
									}
				//echo "				<div class='box'><a onClick='seeMoreInfo(".$row['Eid'].");'>More Info</div>";
				echo "				</div>";
									if($bool){
				echo "					<div class='addButton'><a onClick='addToUserTable(".$row['Eid'].");'><img src='images/btn_cross.png' alt='Icon' /></a></div>";
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