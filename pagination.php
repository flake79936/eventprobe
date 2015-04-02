<?php
	require_once("./include/membersite_config.php");
	include './dbconnect.php';
	
	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);
	
	$usrname = $fgmembersite->UsrName();
	
	$today = Date("Y-m-d"); //should format to 2000-12-31
	
	// Pagination Function
	function pagination($query, $per_page, $page, $url){
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
				 
				if ($page > 1) $pagination.= "<li><a href='{$url}page={$prev}'>{$prevlabel}</a></li>";
				 
			if ($lastpage < 7 + ($adjacents * 2)){   
				for ($counter = 1; $counter <= $lastpage; $counter++){
					if ($counter == $page)
						$pagination.= "<li><a class='current'>{$counter}</a></li>";
					else
						$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
				}
			 
			} elseif($lastpage > 5 + ($adjacents * 2)){
				 
				if($page < 1 + ($adjacents * 2)) {
					 
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
						if ($counter == $page)
							$pagination.= "<li><a class='current'>{$counter}</a></li>";
						else
							$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
					}
					$pagination.= "<li>...</li>";
					$pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
					$pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";  
						 
				} elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
					 
					$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
					$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
					$pagination.= "<li>...</li>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
						if ($counter == $page)
							$pagination.= "<li><a class='current'>{$counter}</a></li>";
						else
							$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
					}
					$pagination.= "<li>..</li>";
					$pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
					$pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";      
					 
				} else {
					 
					$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
					$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
					$pagination.= "<li>..</li>";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
						if ($counter == $page)
							$pagination.= "<li><a class='current'>{$counter}</a></li>";
						else
							$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
					}
				}
			}
			 
				if ($page < $counter - 1) {
					$pagination.= "<li><a href='{$url}page={$next}'>{$nextlabel}</a></li>";
					$pagination.= "<li><a href='{$url}page=$lastpage'>{$lastlabel}</a></li>";
				}
			 
			$pagination.= "</ul>";        
		}
		 
		return $pagination;
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Pagination - OTallu.com</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/header.css" />
        <link rel="stylesheet" type="text/css" href="css/search.css" />
        <link rel="stylesheet" type="text/css" href="css/myEvents.css" />
        <link rel="stylesheet" type="text/css" href="css/banner.css" />
        <link rel="stylesheet" type="text/css" href="css/thisWeek.css" />
        <link rel="stylesheet" type="text/css" href="css/schedule.css" />
        <link rel="stylesheet" type="text/css" href="css/app.css" />
        <link rel="stylesheet" type="text/css" href="css/links.css" />
        <link rel="stylesheet" type="text/css" href="css/footer.css" />

		<!-- Scripts	 -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		
		<style type="text/css">
		/* For this page only */
		body { font-family:Arial, Helvetica, sans-serif; font-size:13px; }
		.wrap { text-align:center; line-height:21px; padding:20px; }

		/* For pagination function. */
		ul.pagination {
			text-align:center;
			color:#829994;
		}
		ul.pagination li {
			display:inline;
			padding:0 3px;
		}
		ul.pagination a {
			color:#0d7963;
			display:inline-block;
			padding:5px 10px;
			border:1px solid #cde0dc;
			text-decoration:none;
		}
		ul.pagination a:hover,
		ul.pagination a.current {
			background:#0d7963;
			color:#fff;
		}
		</style>
	</head>
	
	<body>
		<?php
			$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
			if ($page <= 0) $page = 1; //DEFAULT PAGE # 1

			$per_page = 1; // Set how many records do you want to display per page.

			$startpoint = ($page * $per_page) - $per_page;
			
			$statement = "Events WHERE EstartDate >= '".$today."'  AND UuserName = '" . $usrname . "' AND Edisplay='1' ORDER BY EstartDate ASC";

			$sql = "SELECT * FROM {$statement} LIMIT {$startpoint}, {$per_page};";
			$results = mysqli_query($con, $sql);

			if (mysqli_num_rows($results) != 0) {
				// displaying records.
				while ($row = mysqli_fetch_array($results)) {
					//day name of the date
					$date = date_create($row['EstartDate']);
					$EstartDate = date_format($date, 'm/d/Y');

					$today = date("m/d/Y");
					$dt    = strtotime($EstartDate);
					$day   = date("D", $dt);

					if ($today === $EstartDate){
						$day = "Today";
					}
		?>
					<ul>
						<li><?= $day ?>&nbsp;<?= substr($EstartDate, 0, 5); ?></li>
						<li><?= $row['Evename'] ?></li> 
						<li><?= $row['EtimeStart'] ?> - <?= $row['EtimeEnd'] ?></li>
						
						<li>
						
						<?PHP				
							if($row['Eid'] !== ""){
								$inDBUser = $fgmembersite->getUserFromDB($row['Eid']);
							}
						?>
						
						<form id="eventForm" action="<?php echo $fgmembersite->GetSelfScript(); ?>" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" onsubmit="return confirm('Do you wish to delete?');">
							<input type="hidden" name="submitted" id="submitted" value="1" />
							<input type="hidden" name="Eid" id="Eid" value="<?PHP echo $row['Eid']; ?>" />
							
							<input type="hidden" name="dbUserName" id="dbUserName" value="<?PHP echo $inDBUser; ?>" />
							<input type="hidden" name="usrName" id="usrName" value="<?PHP echo $usrname; ?>" />
							
							<?PHP if($fgmembersite->CheckSession() && ($usrname === $inDBUser)){ ?>
								<input class="dltButton" type="image" src="./images/btn_delete.png" name="submit" value=""/> |
							<?PHP } ?>
						</form>
						 </li>
						 
						<li><?PHP echo "<a onClick='editEvent(".$row['Eid'].")'> " ?> <img src="images/btn_editevent.png"></a></li>
					</ul>
		<?php
				}
			} else {
				 echo "No records are found.";
			}

			// displaying paginaiton.
			echo pagination($statement, $per_page, $page, 'http://eventprobe.com/pagination.php?');
		?>
	</body>
</html>