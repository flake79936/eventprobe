<!--Module-->

<!--
This can be used for when the complete site is loaded.
We can load the events automatically (just like we do now with php)
but with AJAX we can call it again without having to reload the site.

See: http://stackoverflow.com/questions/4144768/javascript-ajax-call-on-page-onload
	
To auto refreash the site see:
http://stackoverflow.com/questions/17266173/ajax-auto-refresh-stats

 
$(document).ready(function() {
   // put Ajax here.
});
-->
<?PHP
	require_once("./include/membersite_config.php");
	include 'dbconnect.php';
	
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
	
	/*Start of pagination code (section)*/
	$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
	if ($page <= 0) $page = 1; //DEFAULT PAGE # 1

	$per_page = 1; // Set how many records do you want to display per page.

	$startpoint = ($page * $per_page) - $per_page;
	
	$statement = "Events WHERE EstartDate >= '".$today."'  AND UuserName = '" . $usrname . "' AND Edisplay='1' ORDER BY EstartDate ASC";
	/*End of pagination code (section)*/
	
	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);

	if(!$fgmembersite->CheckSession()){
		$fgmembersite->RedirectToURL("./index2.php");
		exit;
	}
	
	if(isset($_POST["submitted"])){
		if($fgmembersite->deleteEvent()){
			$fgmembersite->RedirectToURL("./index2.php");
		}
	}
	
	//
	$sql = "SELECT * FROM {$statement} LIMIT {$startpoint}, {$per_page};";
	$result = mysqli_query($con, $sql);
	
	$sql2 = "SELECT * FROM Events WHERE EstartDate >= '".$today."'  AND UuserName = '" . $usrname . "' AND Edisplay='1' LIMIT 1 ORDER BY EstartDate;";
	$result2 = mysqli_query($con, $sql2);
	
	$sql3 = "SELECT Upic FROM Registration WHERE UuserName = '" . $usrname . "';";
	$result3 = mysqli_query($con, $sql3);
?>

<head>
	<meta charset="utf-8"/>
	<title>Eventprobe</title>
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<link rel="stylesheet" media="all" href=""/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<!-- Adding "maximum-scale=1" fixes the Mobile Safari auto-zoom bug: http://filamentgroup.com/examples/iosScaleBug/ -->
	
	<!--STYLE-->
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/pagination.css" />

	<!--FAVICON-->
	<link rel="shortcut icon" href="favicon.ico"  />    
	
	<!-- Scripts	 -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	
	<script>
		function editEvent(str){
			window.location = "./editEvent.php?eid="+str;
		}
	</script>
	<!-- End of Scripts	-->
</head>

<div class="box">
	<h1>My Events</h1>
</div>

<div class="box">
	<!-- <div class="profile"><img src="images/profile_sample.jpg" alt="Profile" /></div> -->
	<?PHP
		/*Gets the user's uploaded image or by default puts one.*/
		while($row = mysqli_fetch_array($result3)){
			if($row['Upic'] === ""){
				echo "<div class='profile'><img src='./images/defaultUpic.png' alt='default image' height='146px' width='136px'/></div> ";
			} else {
				echo "<div class='profile'><img src='".$row['Upic']."' alt='Profile' height='146px' width='136px'/></div>";
			}
		}
	?>
	
	<?PHP
		//echo "Not Working!";
		while($row = mysqli_fetch_array($result2)){
			echo "Date: " . $row['EstartDate'] . "<br>";
			$date = date_create($row['EstartDate']);
			$EstartDate = date_format($date, 'm/d/Y');
			
			echo "Start Date: " . $EstartDate . "<br>";
			
			//day name of the date	
			$dt  = strtotime($EstartDate);
			$day = date("D", $dt);

			if ($today === $EstartDate){
				$day = "Today"; 
	?>
				<h3><strong><?= $day ?></strong></h3>
				<h3><?= $row['Evename'] ?></h3>
				<h3><strong><?= $row['EtimeStart'] ?></strong></h3>
	  <?PHP } ?>
	<?PHP } ?>
	<div class="clear"></div>
</div>

<div class="box event">
	<?PHP
		//echo "Works!";
		while($row = mysqli_fetch_array($result)){
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
	<?PHP } 
		// displaying paginaiton.
		echo pagination($statement, $per_page, $page, 'http://eventprobe.com/index2.php?');
	?>
</div>
<!--<div class="box arrow"><a href="#"><img src="images/btn_arrow_right.png"></a></div>-->
<div class="clear"></div>