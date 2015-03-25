<!--AJAX Module-->

<head>
	<link rel="stylesheet" type="text/css" href="css/chart.css" />

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/pagination.css" />

	<script>
		function seeMoreInfo(str){
			window.location = "./eventDisplayPage.php?eid="+str;
		}
	</script>
</head>

<body>
	<?php
		require_once("./include/membersite_config.php");
		include 'dbconnect.php';
		
		$city = $fgmembersite->getCity();
		//$city = "El Paso";
		$usrname = $fgmembersite->UsrName();
		$toDay = $_GET['date'];
		$newformat = date('Y-m-d', $toDay);
		
		// Pagination Function
		function pagination($query, $per_page, $page, $toDay, $url){
			global $con;
			
			$query = "SELECT COUNT(*) as `num` FROM {$query}";
			$row = mysqli_fetch_array(mysqli_query($con, $query));
			$total = $row['num'];
			$adjacents = "2"; 
			 
			$prevlabel = "&lsaquo; Prev";
			$nextlabel = "Next &rsaquo;";
			$lastlabel = "Last &rsaquo;&rsaquo;";
			 
			$page = ($page == 0 ? 1 : $page);  
			$start = ($page - 1) * $per_page;                               
			 
			$prev = $page - 1;                          
			$next = $page + 1;
			 
			$lastpage = ceil($total/$per_page);
			 
			$lpm1 = $lastpage - 1; // //last page minus 1
			 
			$pagination = "";
			if($lastpage > 1){   
				$pagination .= "<ul class='pagination'>";
				$pagination .= "<li class='page_info'>Page {$page} of {$lastpage}</li>";
					 
					if ($page > 1) $pagination.= "<li><a href='{$url}date={$toDay}&page={$prev}'>{$prevlabel}</a></li>";
					 
				if ($lastpage < 7 + ($adjacents * 2)){   
					for ($counter = 1; $counter <= $lastpage; $counter++){
						if ($counter == $page)
							$pagination.= "<li><a class='current'>{$counter}</a></li>";
						else
							$pagination.= "<li><a href='{$url}date={$toDay}&page={$counter}'>{$counter}</a></li>";                    
					}
				 
				} elseif($lastpage > 5 + ($adjacents * 2)){
					 
					if($page < 1 + ($adjacents * 2)) {
						 
						for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
							if ($counter == $page)
								$pagination.= "<li><a class='current'>{$counter}</a></li>";
							else
								$pagination.= "<li><a href='{$url}date={$toDay}&page={$counter}'>{$counter}</a></li>";                    
						}
						$pagination.= "<li>...</li>";
						$pagination.= "<li><a href='{$url}date={$toDay}&page={$lpm1}'>{$lpm1}</a></li>";
						$pagination.= "<li><a href='{$url}date={$toDay}&page={$lastpage}'>{$lastpage}</a></li>";  
							 
					} elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
						 
						$pagination.= "<li><a href='{$url}date={$toDay}&page=1'>1</a></li>";
						$pagination.= "<li><a href='{$url}date={$toDay}&page=2'>2</a></li>";
						$pagination.= "<li>...</li>";
						for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
							if ($counter == $page)
								$pagination.= "<li><a class='current'>{$counter}</a></li>";
							else
								$pagination.= "<li><a href='{$url}date={$toDay}&page={$counter}'>{$counter}</a></li>";                    
						}
						$pagination.= "<li>..</li>";
						$pagination.= "<li><a href='{$url}date={$toDay}&page={$lpm1}'>{$lpm1}</a></li>";
						$pagination.= "<li><a href='{$url}date={$toDay}&page={$lastpage}'>{$lastpage}</a></li>";      
						 
					} else {
						 
						$pagination.= "<li><a href='{$url}date={$toDay}&page=1'>1</a></li>";
						$pagination.= "<li><a href='{$url}date={$toDay}&page=2'>2</a></li>";
						$pagination.= "<li>..</li>";
						for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
							if ($counter == $page)
								$pagination.= "<li><a class='current'>{$counter}</a></li>";
							else
								$pagination.= "<li><a href='{$url}date={$toDay}&page={$counter}'>{$counter}</a></li>";                    
						}
					}
				}
				 
				if ($page < $counter - 1) {
					$pagination.= "<li><a href='{$url}date={$toDay}&page={$next}'>{$nextlabel}</a></li>";
					$pagination.= "<li><a href='{$url}date={$toDay}&page=$lastpage'>{$lastlabel}</a></li>";
				}				 
				$pagination.= "</ul>";        
			}
			return $pagination;
		}
		
		/*Start of pagination code (section)*/
		$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
		if ($page <= 0) $page = 1; //DEFAULT PAGE # 1

		$per_page = 1; // Set how many records do you want to display per page.

		$startpoint = ($page * $per_page) - $per_page;
		
		$statement = "Events WHERE EstartDate = '".$newformat."' AND Ecity = '" . $city . "' AND Edisplay='1' AND (Erank='Free' OR Erank='Premium') ";
		/*End of pagination code (section)*/
		
		$timezone = $fgmembersite->getLocalTimeZone();
		date_default_timezone_set($timezone);
		
		$qry = "SELECT * FROM {$statement} LIMIT {$startpoint}, {$per_page};";
		$result = mysqli_query($con, $qry);
		
		$bool = $fgmembersite->CheckSession();
	?>
	
	<div class="box" >
		<?PHP
			while($row = mysqli_fetch_array($result)) {
				//echo "Inside the Today " . $row['EstartDate'];
				echo "<div class='row' >";
				echo "	<div><a onClick='seeMoreInfo(".$row['Eid'].");'>";
				echo "		<div class='profile'><img src='".$row['Eflyer']."' alt='Image' /></div>";
				echo "			<div class='info'>";
				echo "				<div class='box'>" . $row['EtimeStart'] ." - ". $row['EtimeEnd'] . "&nbsp;&nbsp;&nbsp;".ucfirst($row['Ecity'])."</div>";
				echo "				<div class='box'>" . $row['Evename'] . "</div>";
				if ($row['Efacebook']){
				echo "				<div class='box'> <a href=". $row['Efacebook']." target='_blank'  > <img src='images/icon_fb.png'> </a></div>";
				}				
				if ($row['Etwitter']){
				echo "				<div class='box'> <a href=https://twitter.com/". $row['Etwitter']." target='_blank'  > <img src='images/btn_twitter.png'> </a></div>";
				}
				if ($row['Egoogle']){
				echo "				<div class='box'> <a href=". $row['Egoogle']." target='_blank'  > <img src='images/btn_google.png'> </a></div>";
				}
				if ($row['Ehashtag']){
				echo "				<div class='box'><a href=https://instagram.com/" . $row['Ehashtag'] . " target='_blank'  > <img src='images/icon_instagram2.png'> </a></div>";
				}
				echo "				<div class='box'><a onClick='seeMoreInfo(".$row['Eid'].");'>More Info</div>";
				if($bool){
				echo "				<div class='box'><a onClick='addToUserTable(".$row['Eid'].");'><img src='images/btn_cross.png' alt='Icon' /></a></div>";
				}
				echo "			</div>";
				echo "		<div class='clear'></div>";
				echo "	</a></div>";
				echo "</div>";
				
				echo pagination($statement, $per_page, $page, $toDay, 'http://eventprobe.com/index2.php?');
			}
			mysqli_close($con);
		?>
	</div>
</body>