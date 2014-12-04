<?PHP
	require_once("./include/membersite_config.php");
 $result   = "";
//  $_GET['result'];
  $eventSearch   = $_GET['eventSearch'];
// echo $result;
// echo $eventSearch;


	
		$result = $fgmembersite->searchEventHelper($eventSearch);
		if ($result== null){
		echo "Sorry no results found.";
// 		sleep(3);
		$fgmembersite->RedirectToURL("searchForm.php");
		}

	


 ?>
<html>
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
        <link rel="stylesheet" type="text/css" href="css/top.css" />
        <link rel="stylesheet" type="text/css" href="css/myEvents.css" />
        <link rel="stylesheet" type="text/css" href="css/banner.css" />
        <link rel="stylesheet" type="text/css" href="css/thisWeek.css" />
        <link rel="stylesheet" type="text/css" href="css/schedule.css" />
        <link rel="stylesheet" type="text/css" href="css/chart.css" />
        <link rel="stylesheet" type="text/css" href="css/app.css" />
        <link rel="stylesheet" type="text/css" href="css/links.css" />
        <link rel="stylesheet" type="text/css" href="css/footer.css" />

        <!--FAVICON-->
        <link rel="shortcut icon" href="favicon.ico"  />

        
	</head>


<!-- 
<div id="main_container">
					<div id='middle_box'>
						<div id="inner-mid-box">
 -->
 		<h1>Today and this Week Near You</h1>
		<a href="#"><img src="images/btn_refresh.png" alt="Refresh" /></a>
		<div class="clear"></div>
 			<div class="chart">												
				<div class="row">
							<?PHP
								$i = 0;
								echo "test";
								while($row = mysql_fetch_assoc($result)){ 
								$dt = strtotime($row['EstartDate']);
								$day = date("D", $dt);
								?>
								

	
					<div class="cell">&nbsp;</div>
						<div class="cell active">
						<div class="circle">1</div>
						<h4><?=substr($row['EstartDate'], 0, 5);?><br /><?= $day ?></h4>
					</div>
										

							<?PHP $i++;	 }  ?>
				</div>										
			</div>	

				
				
				
<!-- 
				
				
				
				
				
				
				
				
				
				
				
				
				
				<div class="box">
	<div class="title">
		<h1>Today and this Week Near You</h1>
		<a href="#"><img src="images/btn_refresh.png" alt="Refresh" /></a>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<div class="cell">&nbsp;</div>
		<div class="cell active">
			<div class="circle">1</div>
			<h4>9/20<br />TUE</h4>
		</div>
		<div class="cell">
			<div class="blank">&nbsp;</div>
			<h4>9/20<br />WED</h4>
		</div>
		<div class="cell">
			<div class="circle">1</div>
			<h4>9/20<br />TUE</h4>
		</div>
		<div class="cell">
			<div class="circle">4</div>
			<h4>9/20<br />SUN</h4>
		</div>
		<div class="cell">
			<div class="blank">&nbsp;</div>
			<h4>9/20<br />MON</h4>
		</div>
		<div class="cell">
			<div class="circle">3</div>
			<h4>9/20<br />TUE</h4>
		</div>
		<div class="cell">
			<div class="blank">&nbsp;</div>
			<h4>9/20<br />THU</h4>
		</div>
		<div class="cell">
			<div class="blank">&nbsp;</div>
			<h4>9/20<br />SUN</h4>
		</div>
		<div class="cell">
			<div class="blank">&nbsp;</div>
			<h4>9/20<br />WED</h4>
		</div>
		<div class="cell">&nbsp;</div>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<div>
			<div class="profile"><img src="images/sample_today.jpg" alt="Image" /></div>
				<div class="info active">
					<div class="box">4:30 PM - 6:000 PM</div>
					<div class="box">Muligans Happy Hour</div>
					<div class="box">
						<ul>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
						</ul>
					</div>
					<div class="box"><img src="images/icon_fb.png" alt="Facebook" /></div>
					<div class="box">more</div>
					<div class="box"><a href="#"><img src="images/btn_cross.png" alt="Icon" /></a></div>
				</div>
			<div class="clear"></div>
		</div>
		<div>
			<div class="profile"><img src="images/sample_today.jpg" alt="Image" /></div>
				<div class="info">
					<div class="box">4:30 PM - 6:000 PM</div>
					<div class="box">Muligans Happy Hour</div>
					<div class="box">
						<ul>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
						</ul>
					</div>
					<div class="box"><img src="images/icon_fb.png" alt="Facebook" /></div>
					<div class="box">more</div>
					<div class="box"><a href="#"><img src="images/btn_cross.png" alt="Icon" /></a></div>
				</div>
			<div class="clear"></div>
		</div>
		<div>
			<div class="profile"><img src="images/sample_today.jpg" alt="Image" /></div>
				<div class="info">
					<div class="box">4:30 PM - 6:000 PM</div>
					<div class="box">Muligans Happy Hour</div>
					<div class="box">
						<ul>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
						</ul>
					</div>
					<div class="box"><img src="images/icon_fb.png" alt="Facebook" /></div>
					<div class="box">more</div>
					<div class="box"><a href="#"><img src="images/btn_cross.png" alt="Icon" /></a></div>
				</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>

<div class="advertisement">
	<a href="#"><img src="images/advertisement_01.jpg" alt="Banner" /></a>
	<a href="#"><img src="images/advertisement_02.jpg" alt="Banner" /></a>
</div>
<div class="clear"></div>
 -->