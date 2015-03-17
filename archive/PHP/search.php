<?PHP
	require_once("./include/membersite_config.php");
 	if(!$fgmembersite->CheckSession()){
 		$fgmembersite->RedirectToURL("login.php");
 		exit;
 	}
 	
	//capture search term and remove spaces at its both ends if the is any
	 $searchTerm = trim($_GET['Search']);

	//check whether the name parsed is empty
	if($searchTerm == ""){
		echo "No events found, Please try again.";
		exit();
	}

	//$con = mysqli_connect('localhost', 'JetDevSQL', 'DevTeamSQL!!12', 'EventAdvisor');

	/*if (!$con) {
		die('Could not connect: ' . mysqli_error($con));
	}*/

	//mysqli_select_db($con, "EventAdvisor");

	// 	$sql = "SELECT Evename, Edescription, Etype, Eaddress, Ecity, Estate, Ezip FROM Events WHERE UuserName = '" . $usrname . "'";
	$sql = "SELECT * FROM Events WHERE Ecity LIKE '" . $searchTerm . "' UNION ALL 
	SELECT * FROM Events WHERE Estate LIKE '" . $searchTerm . "' UNION ALL
	SELECT * FROM Events WHERE Evename LIKE '" . $searchTerm . "' UNION ALL
	SELECT * FROM Events WHERE Ezip LIKE '" . $searchTerm . "'UNION ALL
	SELECT * FROM Events WHERE EphoneNumber LIKE '" . $searchTerm . "'UNION ALL
	SELECT * FROM Events WHERE Edescription LIKE '" . $searchTerm . "' UNION ALL 
	SELECT * FROM Events WHERE Etype LIKE '" . $searchTerm . "' UNION ALL
	SELECT * FROM Events WHERE Ehashtag  LIKE '" . $searchTerm . "'ORDER BY EstartDate";

	$result = mysqli_query($con, $sql);
?>

<html>
	<head>
		<link rel="STYLESHEET" type="text/css" href="css/fg_membersite.css">
		<link href="css/accordion.css" rel="stylesheet" type="text/css" />
		
		<!-- Script -->
		<script>
			function goBack() {
				window.history.back()
			}
		</script>
		<!-- End of Script		 -->

		<!-- Twitter script -->
		<script>
			!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];
			if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";
			fjs.parentNode.insertBefore(js,fjs);}}
			(document,"script","twitter-wjs");
		</script>
		<!-- End of Twitter script -->

		<!-- Hashtag script -->
		<script>
			!function(d,s,id){
				var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
				if(!d.getElementById(id)){
					js=d.createElement(s);
					js.id=id;js.src=p+'://platform.twitter.com/widgets.js';
					fjs.parentNode.insertBefore(js,fjs);
				}
			}(document, 'script', 'twitter-wjs');
		</script>
		<!-- End Hashtag script -->
		
		<!--(Start) Provided by JetDevLLC-->
		<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="css/style.css"            rel="stylesheet" type="text/css" />
		<link href="css/responsive.css"       rel="stylesheet" type="text/css" />
		<link href="favicon.ico"              rel="shortcut icon"  />	
		<!--[if IE 6]>
		<style type="text/css">img, div, { behavior: url("js/iepngfix.htc") }
		</style>
		<![endif]-->
		<!--(End) Provided by JetDevLLC-->
		<!--(End) Style Sheets-->
		
		<!--(Start) Provided by JetDevLLC-->
		<script src="js/jquery-1.9.0.min.js" type="text/javascript"></script>
		<script src="js/iepngfix_tilebg.js"  type="text/javascript"></script>
		<script src="js/scrollTo.js"         type="text/javascript"></script>
		<script src="js/global.js"           type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".mobile-menu-list").hide();
				$('.mobile-menu-btn').click(function(){
					$(this).toggleClass("active");
					$(".mobile-menu-list").slideToggle(200);
				});
			});
		</script>
		<!--(End) Provided by JetDevLLC-->
		<!--(End) Scripts-->
	</head>
	
	<body>
		<div class="header-wrap">
			<div class="header">
				<a class="logout-btn" href='logout.php'>Log Out</a>
				<ul class="head-social-icons">
					<!---<li><a class="facebook"   href="#"></a></li>
					<li><a class="twitter"    href="#"></a></li>
					<li><a class="googleplus" href="#"></a></li>-->
					<li>Welcome Back! <?= $fgmembersite->UserFullName() ?>!</li>
				</ul><!--//head-social-icons-->

				<ul class="nav">
					<li><a href="./EventCreation.php">Create Event</a></li>
					<li><span class="shadow">|</span></li>
					<li><a href="./searchForm.php">Search</a></li>
					<!--<li><a id="findstadarena-nav" href="#findstadarena">Find a Stadium/Arena</a></li>-->
					<!--<li><a id="emaildeals-nav" href="#emaildeals">Email Deals</a></li>-->
					<li><span class="shadow">|</span></li>
					<li><a href="./eventAccor.php">Your Events</a></li>
					<li><span class="shadow">|</span></li>
					<li><a href="#events">Events</a></li>
				</ul>
				<div class="mobile-menu-btn"><span class="icon-reorder"></span></div>
			</div><!--//header-->
		</div><!--//header-wrap-->
		
		<div class="mobile-menu-list">
			<ul>
				<li><a href="./EventCreation.php">createEvent</a></li>
				<li><a href="./searchForm.php">Search</a></li>
				<li><a class="mobile-nav" href="#Events">Events</a></li>
			</ul>   
		</div><!--//mobile-menu-list-->
		
		<div id="main_container">
			<div id='middle_box'>
				<div id="inner-mid-box">
					<?PHP
						$i = 0;
						while($row = mysqli_fetch_array($result)){ 
						
						//if the street name contains two or more words, the map will not recognize the street.
						$address = $row['Eaddress'] . ", " . $row['Ecity'] . ", " . $row['Estate'] . " " . $row['Ezip'];
						$expression = "/\s/";
						$replace = "+";

						$street = preg_replace($expression, $replace, $address);
					?>
						<div class="accordion vertical">
							<ul>
								<li>
									<input type="radio" id="radio-<?= $i?>" name="radio-accordion" checked="checked" />
									<label for="radio-<?= $i?>"><?= $row['Evename'] . " " . $row['EstartDate']?></label>
									<!-- <label for="radio-<?= $i?>">Event <?= $i?></label> -->
									<div class="content">
										<p><?= $row['Evename'] ?></p>
										<p><?= $row['Eaddress'] ?></p>
										<p><?= $row['Edescription'] ?></p>
										<p><a href="<?= $row['Ewebsite'] ?>" target="_blank"><?= $row['Ewebsite'] ?></p>
										<?PHP
                                            if ($row['Efacebook']): ?>
                                            <a href="<?= $row['Efacebook'] ?>" target="_blank" >
                                            <img src="./img/icons/facebook.ico"
                                            width="20" height="20" title="Facebook"
                                            border="0" style="display:inline;"></a>
                                        <?PHP endif; ?>

                                        <?PHP
                                            if ($row['EhashTag']): ?>
										<a href="https://twitter.com/intent/tweet?button_hashtag=<?= $row['Ehashtag'] ?>"
										class="twitter-hashtag-button">Tweet#<?= $row['Ehashtag'] ?></a>
                                        <?PHP endif; ?>
										
                                        <?PHP
                                            if ($row['Etwitter']): ?>
										<a href="https://twitter.com/<?= $row['Etwitter'] ?>" class="twitter-follow-button"
										data-show-count="false" data-lang="en">Follow<?= $row['Etwitter'] ?></a>
                                        <?PHP endif; ?>


                                        <?PHP
                                            if ($row['Etwitter']): ?>
										<a href="<?= $row['Egoogle'] ?>" rel="publisher" target="_blank">
										<img src="./img/icons/googleplus.ico"
										width="20" height="20" title="google+" 
										border="0" style="display:inline;"></a>
                                        <?PHP endif; ?>
										<p><?= $row['Eother'] ?></p>
																																					
										<p><iframe
											width="300"
											height="150"
											frameborder="0" style="border:0"
											src="https://www.google.com/maps/embed/v1/place?key=AIzaSyB0uLEbR6K9fehSmaCyR4-NdWmIUaYevjY&q=<?= $street?>">
										</iframe></p>
									</div>
								</li>
							</ul>
						</div>
					<?PHP $i++; } ?>
				</div>
			</div>
		</div>
	</body>
</html>
<?PHP mysqli_close($con)?>