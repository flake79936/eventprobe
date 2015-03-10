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
	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);

	?>

<?PHP

	if(!$fgmembersite->CheckSession()){
		$fgmembersite->RedirectToURL("./index.php");
		exit;
	}
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
	
<?PHP
	require_once("./include/membersite_config.php");
	$usrname = $fgmembersite->UsrName();
	
	include 'dbconnect.php';
?>

<?PHP
	$today = Date("m/d/Y");
	
	$sql = "SELECT * FROM Events WHERE EstartDate >= '".$today."'  AND UuserName = '" . $usrname . "' AND Edisplay='1' ORDER BY EstartDate";
	$sql2 = "SELECT * FROM Events WHERE EstartDate >= '".$today."'  AND UuserName = '" . $usrname . "' AND Edisplay='1' LIMIT 1 ORDER BY EstartDate";
	$result = mysqli_query($con, $sql);
	$result2 = mysqli_query($con, $sql2);
?> 

<div class="box">
	<h1>My Events</h1>
</div>

<div class="box">
	<div class="profile"><img src="images/profile_sample.jpg" alt="Profile" /></div>
	<?PHP  			
		$i = 0;
		while($row = mysqli_fetch_array($result2)){
			//day name of the date	
			$dt    = strtotime($row['EstartDate']);
			$day   = date("D", $dt);
			
			if ($today === $row['EstartDate']){
			$day = "Today"; 
	?>
			<h3><strong><?= $day ?></strong></h3>
			<h3><?= $row['Evename'] ?></h3>
			<h3><strong><?= $row['EtimeStart'] ?></strong></h3>
		<?PHP } ?>
	<?PHP $i++; } ?>
	<div class="clear"></div>
</div>

<div class="box event">
	<?PHP  		
		$i = 0;
		while($row = mysqli_fetch_array($result)){
			//day name of the date	
			$today = date("m/d/Y");
			$dt    = strtotime($row['EstartDate']);
			$day   = date("D", $dt);
			if ($today === $row['EstartDate']){
				$day = "Today";
			}
	?>
		<ul>
			<li><?= $day ?>&nbsp;<?= substr($row['EstartDate'], 0, 5); ?></li>
			<li><?= $row['Evename'] ?></li> 
			<li><?= $row['EtimeStart'] ?> - <?= $row['EtimeEnd'] ?></li>
			<li><?PHP echo "<a onClick='editEvent(".$row['Eid'].")'> " ?> Edit Event</a></li>
		</ul>
	<?PHP $i++; } ?>
</div>
<div class="box arrow"><a href="#"><img src="images/btn_arrow_right.png"></a></div>
<div class="clear"></div>