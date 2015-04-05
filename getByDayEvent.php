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
		
		$city = $fgmembersite->getCity();
		//$city = "El Paso";
		$usrname = $fgmembersite->UsrName();
		$newformat = date('Y-m-d', $_GET['date']);
		
		// Pagination Function
		function pagination($query, $per_paging, $paging, $url){
			global $con;
			
			$query = "SELECT COUNT(*) as `num` FROM {$query}";
			$row = mysqli_fetch_array(mysqli_query($con, $query));
			$total = $row['num'];
			$adjacents = "2"; 
			 
			$prevlabel = "&lsaquo; Prev";
			$nextlabel = "Next &rsaquo;";
			$lastlabel = "Last &rsaquo;&rsaquo;";
			 
			$paging = ($paging == 0 ? 1 : $paging);  
			$start = ($paging - 1) * $per_paging;                               
			 
			$prev = $paging - 1;                          
			$next = $paging + 1;
			 
			$lastpaging = ceil($total/$per_paging);
			 
			$lpm1 = $lastpaging - 1; // //last paging minus 1
			 
			$pagination = "";
			if($lastpaging > 1){   
				$pagination .= "<ul class='pagination'>";
				$pagination .= "<li class='paging_info'>paging {$paging} of {$lastpaging}</li>";
					 
					if ($paging > 1) $pagination.= "<li><a href='{$url}paging={$prev}'>{$prevlabel}</a></li>";
					 
				if ($lastpaging < 7 + ($adjacents * 2)){   
					for ($counter = 1; $counter <= $lastpaging; $counter++){
						if ($counter == $paging)
							$pagination.= "<li><a class='current'>{$counter}</a></li>";
						else
							$pagination.= "<li><a href='{$url}paging={$counter}'>{$counter}</a></li>";                    
					}
				 
				} elseif($lastpaging > 5 + ($adjacents * 2)){
					 
					if($paging < 1 + ($adjacents * 2)) {
						 
						for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
							if ($counter == $paging)
								$pagination.= "<li><a class='current'>{$counter}</a></li>";
							else
								$pagination.= "<li><a href='{$url}paging={$counter}'>{$counter}</a></li>";                    
						}
						$pagination.= "<li>...</li>";
						$pagination.= "<li><a href='{$url}paging={$lpm1}'>{$lpm1}</a></li>";
						$pagination.= "<li><a href='{$url}paging={$lastpaging}'>{$lastpaging}</a></li>";  
							 
					} elseif($lastpaging - ($adjacents * 2) > $paging && $paging > ($adjacents * 2)) {
						 
						$pagination.= "<li><a href='{$url}paging=1'>1</a></li>";
						$pagination.= "<li><a href='{$url}paging=2'>2</a></li>";
						$pagination.= "<li>...</li>";
						for ($counter = $paging - $adjacents; $counter <= $paging + $adjacents; $counter++) {
							if ($counter == $paging)
								$pagination.= "<li><a class='current'>{$counter}</a></li>";
							else
								$pagination.= "<li><a href='{$url}paging={$counter}'>{$counter}</a></li>";                    
						}
						$pagination.= "<li>..</li>";
						$pagination.= "<li><a href='{$url}paging={$lpm1}'>{$lpm1}</a></li>";
						$pagination.= "<li><a href='{$url}paging={$lastpaging}'>{$lastpaging}</a></li>";      
						 
					} else {
						 
						$pagination.= "<li><a href='{$url}paging=1'>1</a></li>";
						$pagination.= "<li><a href='{$url}paging=2'>2</a></li>";
						$pagination.= "<li>..</li>";
						for ($counter = $lastpaging - (2 + ($adjacents * 2)); $counter <= $lastpaging; $counter++) {
							if ($counter == $paging)
								$pagination.= "<li><a class='current'>{$counter}</a></li>";
							else
								$pagination.= "<li><a href='{$url}paging={$counter}'>{$counter}</a></li>";                    
						}
					}
				}
				 
					if ($paging < $counter - 1) {
						$pagination.= "<li><a href='{$url}paging={$next}'>{$nextlabel}</a></li>";
						$pagination.= "<li><a href='{$url}paging=$lastpaging'>{$lastlabel}</a></li>";
					}
				 
				$pagination.= "</ul>";        
			}
			 
			return $pagination;
		}
		
		/*Start of pagination code (section)*/
		$paging = (int)(!isset($_GET["paging"]) ? 1 : $_GET["paging"]);
		if ($paging <= 0) $paging = 1; //DEFAULT paging # 1

		$per_paging = 1; // Set how many records do you want to display per paging.

		$startpoint = ($paging * $per_paging) - $per_paging;
		
		$statement = "Events WHERE EstartDate = '".$newformat."' AND Ecity = '" . $city . "' AND Edisplay='1' AND (Erank='Free' OR Erank='Premium' OR Erank='Paid') ";
		/*End of pagination code (section)*/
		
		$timezone = $fgmembersite->getLocalTimeZone();
		date_default_timezone_set($timezone);
		
		$qry = "SELECT * FROM {$statement} LIMIT {$startpoint}, {$per_paging};";
		$result = mysqli_query($con, $qry);
		
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
						case "Art":            $row['Eflyer'] = "./images/art35.png"; break;
						case "Concert":        $row['Eflyer'] = "./images/music.png"; break;
						case "Fair":           $row['Eflyer'] = "./images/fair35.png"; break;
						case "Social":         $row['Eflyer'] = "./images/weight35.png"; break;
						case "Sport":          $row['Eflyer'] = "./images/sports40.png"; break;
						case "Public Speaker": $row['Eflyer'] = "./images/speaker.png"; break;
						default:               $row['Eflyer'] = "./images/magic35.png"; break;
					}
				}
				
				//echo "Inside the Today " . $row['EstartDate'];
				echo "<div class='row' >";
				echo "	<div><a onClick='seeMoreInfo(".$row['Eid'].");'>";
				echo "		<div class='profile'><img src='".$row['Eflyer']."' alt='Image' /></div>";
				echo "			<div class='info'>";
				//echo "				<div class='left'>";
				//echo "				<div class='box'>" . $row['EtimeStart'] ." - ". $row['EtimeEnd'] . "&nbsp;&nbsp;&nbsp;".$formattedDate."&nbsp;&nbsp;&nbsp;".ucfirst($row['Ecity'])."&nbsp;&nbsp;&nbsp;".strtoupper($row['Estate'])." </div>";
				echo "					<div class='etime'>" . $row['EtimeStart'] ." - ". $row['EtimeEnd'] . " </div>";
				echo "					<div class='ecity'>" . ucfirst($row['Ecity']).", ".strtoupper($row['Estate'])." </div>";
				echo "					<div class='ename'>" . $row['Evename'] . "</div>";
				if ($row['Efacebook']){
				echo "					<div class='FB'> <a href=". $row['Efacebook']." target='_blank'  > <img src='images/icon_fb.png'> </a></div>";
				}				
				if ($row['Etwitter']){
				echo "					<div class='TW'> <a href=https://twitter.com/". $row['Etwitter']." target='_blank'  > <img src='images/btn_twitter.png'> </a></div>";
				}
				if ($row['Egoogle']){
				echo "					<div class='Goo'> <a href=". $row['Egoogle']." target='_blank'  > <img src='images/btn_google.png'> </a></div>";
				}
				if ($row['Ehashtag']){
				echo "					<div class='Hashtag'><a href=https://instagram.com/" . $row['Ehashtag'] . " target='_blank'  > <img src='images/icon_instagram2.png'> </a></div>";
				}
				//echo "				<div class='box'><a onClick='seeMoreInfo(".$row['Eid'].");'>More Info</div>";
				//echo "				</div>";
				//echo "				<div class='right'>";
				if($bool){
				echo "					<div class='addButton'><a onClick='addToUserTable(".$row['Eid'].");'><img src='images/btn_cross.png' alt='Icon' /></a></div>";
				}
				//echo "				</div>";
				echo "			</div>";
				echo "		<div class='clear'></div>";
				echo "	</a></div>";
				echo "</div>";
				
				//echo pagination($statement, $per_paging, $paging, 'http://eventprobe.com/index2.php?');
			}
			mysqli_close($con);
		?>
	</div>
</body>