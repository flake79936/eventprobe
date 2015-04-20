<!--Module-->
<?PHP
	require_once("./include/membersite_config.php");
	include 'dbconnect.php';
	
	if(isset($_POST["submitted"])){
		if($fgmembersite->deleteEvent()){
			$fgmembersite->RedirectToURL("./index2.php");
		}
	}
	
	$usrname = $fgmembersite->UsrName();
	
	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);
	
	$today = Date("m/d/Y"); //e.g., 02/03/2015
	$toDate = (isset($_GET["date"]) ? $_GET["date"] : strtotime($today));
	
	$newformat = date('Y-m-d');
	echo "<br>DATE: ". $newformat . "<br>";
	
	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);
	
	$pageId = (isset($_GET["pageId"]) ? $_GET["pageId"] : 0);
	echo "Page: " . $pageId . "<br>";
	
	$sql = "SELECT * FROM Events WHERE EstartDate >= '" . $newformat . "' AND UuserName = '" . $usrname . "' AND Edisplay='1' ORDER BY EstartDate ASC;";
	$result = mysqli_query($con, $sql);
	echo "<br>Query: " . $sql . "<br>";
	
	$count = mysqli_num_rows($result);
	echo "count: " . $count;
	
	if($count > 0){
		$paginationCount = $fgmembersite->getPagination($count, 2);
	}
	echo "<br/>Pagination Count: " . $paginationCount . "<br/>";
	
	
	$sql2 = "SELECT * FROM Events WHERE EstartDate >= '" . $newformat . "' AND UuserName = '" . $usrname . "' AND Edisplay='1' LIMIT 1 ORDER BY EstartDate;";
	$result2 = mysqli_query($con, $sql2);
	
	$sql3 = "SELECT Upic FROM Registration WHERE UuserName = '" . $usrname . "';";
	$result3 = mysqli_query($con, $sql3);
?>

<head>
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<link rel="stylesheet" media="all" href=""/>
	
	<!--STYLE-->
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/pag.css" />
	
	<!--Scripts-->
	<script type="text/javascript" src="./js/jquery-2.1.3.min.js"></script>
	
	<!--When edit btn is clicked, this function is triggered-->
	<script>
		function editEvent(str){
			window.location = "./editEvent.php?eid="+str;
		}
	</script>
	
	<script>
		(function($){
			$(document).ready(function(){
				$.ajaxSetup({
					cache: false,
					beforeSend: function(){
						$('.pageData').hide();
						$('.flash').show();
						$(".flash").fadeIn(400).html('Loading <img src="./images/load.gif" />');
					},
					complete: function(){
						$('.flash').hide();
						$('.pageData').show();
					},
					success: function(){
						$('.flash').hide();
						$('.pageData').show();
					}
				});
				var $container = $(".pageData");
				$container.load("./loadEvents.php?pageId=" + <?= $pageId ?> + "&date=" + <?= $toDate ?>);			
				var refreshId = setInterval(function(){
					$container.load("./loadEvents.php?pageId=" + <?= $pageId ?> + "&date=" + <?= $toDate ?>);
				}, 60000); //30k = 30 seconds
			});
		})(jQuery);
		
		function changePagination(pageId, date){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementsById("#pageData").innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET", "./loadEvents.php?pageId=" + pageId + "&date=" + date, true);
			xmlhttp.send();
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
// 		while($row = mysqli_fetch_array($result3)){
// 			if($row['Upic'] === ""){
// 				echo "<div class='profile'><img src='./images/defaultUpic.png' alt='default image'/></div> ";
// 			} else {
// 				echo "<div class='profile'><img src='".$row['Upic']."' alt='Profile' height='146px' width='136px'/></div>";
// 			}
// 		}
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

<!--<div class="box event">
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
			<li><?= $day ?>&nbsp;<?= substr($EstartDate, 0, 5);  ?></li>
			<li><?= substr($row['Evename'], 0, 12) . " ...";     ?></li> 
			<li><?= $row['EtimeStart'] ?> - <?= $row['EtimeEnd'] ?></li>
			
			<li>
			
			<?PHP				
				if($row['Eid'] !== ""){
					$inDBUser = $fgmembersite->getUserFromDB($row['Eid']);
				}
			?>
			
			<form class="myEventForm" id="eventForm" action="<?php echo $fgmembersite->GetSelfScript(); ?>" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" onsubmit="return confirm('Do you wish to delete?');">
				<input type="hidden" name="submitted" id="submitted" value="1" />
				<input type="hidden" name="Eid" id="Eid" value="<?PHP echo $row['Eid']; ?>" />
				
				<input type="hidden" name="dbUserName" id="dbUserName" value="<?PHP echo $inDBUser; ?>" />
				<input type="hidden" name="usrName" id="usrName" value="<?PHP echo $usrname; ?>" />
				
				<?PHP if($fgmembersite->CheckSession() && ($usrname === $inDBUser)){ ?>
					<input class="dltButton" type="image" src="./images/btn_delete.png" name="submit" value=""/>
				<?PHP } ?>
			</form>
			 </li>
			 
			<li><?PHP echo "<a class='myEventForm' onClick='editEvent(".$row['Eid'].")'> " ?> <img src="images/btn_editevent.png"></a></li>
		</ul>
	<?PHP } ?>
</div>-->

<div class="box event">
	<div id="pageData" class="pageData"></div>

	<?PHP if($count > 0){ ?>
		<ul class="tsc_pagination tsc_paginationC tsc_paginationC01">
			<li class="first link" id="first">
				<a onClick="changePagination(0, <?= $toDate ?>)">First</a>
			</li>
			
			<!--Displays the page numbers-->
			<?PHP for($i = 0; $i < $paginationCount; $i++){ ?>
				<li id="<?= $i."_no" ?>" class="link">
					<a onClick="changePagination(<?PHP echo ($i+1); ?>, <?= $toDate ?>)"><?PHP echo ($i+1); ?></a>
				</li>
			<?PHP } ?>
		
			<li class="last link" id="last">
				<a onClick="changePagination(<?PHP echo ($paginationCount-1); ?>, <?= $toDate ?>)">Last</a>
			</li>
			<li class="flash"></li>
		</ul>
	<?PHP } ?>
</div>

<!--<div class="box arrow"><a href="#"><img src="images/btn_arrow_right.png"></a></div>-->
<div class="clear"></div>