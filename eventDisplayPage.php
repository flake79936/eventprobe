<?PHP
	require_once("./include/membersite_config.php"); 
	$newEventID = $_GET['eid'];
	//$newEventID = "124";
	include 'dbconnect.php';
	
	if($fgmembersite->CheckSession()){
		$usrname = $fgmembersite->UsrName();
	}
	
	if(isset($_POST["submitted"])){
		if($fgmembersite->deleteEvent()){
			$fgmembersite->RedirectToURL("./index.php");
		}
	}
	
	if($newEventID !== ""){
		$inDBUser = $fgmembersite->getUserFromDB($newEventID);
	}
	
	//method using the Eid to get the value of a 0 or 1.
	// denotes whether the post is able to be seen.
	if($eDisplay !== ""){
		$eDisplay = $fgmembersite->getDisplayVal($newEventID);
	}
	
	if($eDisplay === "0" && $usrname !== $inDBUser){
		$fgmembersite->RedirectToURL("./index.php");
	}
?>

<html lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
		
		<title>Eventprobe</title>
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link rel="stylesheet" media="all" href=""/>

		<!--STYLE-->
		<link rel="stylesheet" type="text/css" href="./css/header.css" />
		<link rel="stylesheet" type="text/css" href="./css/getEvent.css" />
		<link rel="stylesheet" type="text/css" href="./css/eventDisplayPage.css" />
		<link rel="stylesheet" type="text/css" href="./css/links.css" />
		<link rel="stylesheet" type="text/css" href="./css/footer.css" />

		<!--GOOGLE MAP-->
		<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.10.1.min.js"></script>
		
		<script id="twitter-wjs" src="//platform.twitter.com/widgets.js"></script>

		<script>
			function showHint(str){
				if(str.length == 0){
					document.getElementById("txtHint").innerHTML = "";
					$(".eventDisplayPage").show();
					$(".right").show();
					return;
				} else {
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
						}
					}
					xmlhttp.open("GET", "getEvent.php?q=" + str, true);
					xmlhttp.send();
				}
			}
		</script>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

		<script>
			function seeMoreInfo(str){
				window.location = "./eventDisplayPage.php?eid="+str;
			}
		</script>	

		<script>
			$(document).ready(function(){
				$("input").keydown(function(){
					$(".eventDisplayPage").hide();
				});
				
				$("#concert, #fair, #sport, #art").click(function(){
					$(".eventDisplayPage").hide();
				});
			});
		</script>
		
		<!-- Facebook share API -->
		<script>
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=861882643830735";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>
		
		<!-- Google Plus share API -->
		<script src="https://apis.google.com/js/platform.js" async defer></script>
		
		<!-- Twitter share API -->
		<script>
			!function(d,s,id){
				var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
				if(!d.getElementById(id)){
					js = d.createElement(s);
					js.id = id;
					js.src = p + '://platform.twitter.com/widgets.js';
					fjs.parentNode.insertBefore(js,fjs);
				}
			}(document, 'script', 'twitter-wjs');
		</script>
		
		<script>
			$( "li" ).hover(
				function() {
					$( this ).append( $( "<span> ***</span>" ) );
				}, function() {
					$( this ).find( "span:last" ).remove();
				}
			);
		</script>
		
		<!--FAVICON-->
		<link rel="shortcut icon" href="favicon.ico"  />
	</head>
	
	<body lang="en">
		<div class="header">
			<?PHP include './header.php';?>
		</div>
		
		<div class="eventDisplayPage">
			<form id="eventForm" action="<?php echo $fgmembersite->GetSelfScript(); ?>" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" onsubmit="return confirm('Do you wish to delete?');">
				<?PHP
					if($eDisplay === "0"){
						$qry = "SELECT * FROM Events WHERE Eid = " . $newEventID . " AND Edisplay = 0;";
					} else {
						$qry = "SELECT * FROM Events WHERE Eid = " . $newEventID . " AND Edisplay = 1;";
					}
					
					$result = mysqli_query($con, $qry);
					
					while($row = mysqli_fetch_array($result)){  
					
					$newStartTime = date("g:i a", strtotime($row['EtimeStart']));
					
						$i     = 0;
						$event = $row['Evename'];
						$Elat  = $row['Elat'];
						$Elong = $row['Elong'];
						
						/*Date format to Month/Day/Year */
						$date = date_create($row['EstartDate']);
						$EstartDate = date_format($date, 'm/d/Y');
						
						$eventArray[$i]=[$event,$Elat,$Elong];

						/**  Format phone number **/
						$formatPhone = $row['EphoneNumber'];
						$formatPhone = preg_replace("/[^0-9]/", "", $formatPhone);

						if(strlen($formatPhone) == 7)
							$formatPhone = preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $formatPhone);
						elseif(strlen($formatPhone) == 10)
							$formatPhone = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $formatPhone);
						/** End format phone number**/
				?>
				
					<div class="content">
						<input type="hidden" name="submitted" id="submitted" value="1" />
						<input type="hidden" name="Eid" id="Eid" value="<?PHP echo $newEventID; ?>" />
						<input type="hidden" name="dbUserName" id="dbUserName" value="<?PHP echo $inDBUser; ?>" />
						<input type="hidden" name="usrName" id="usrName" value="<?PHP echo $usrname; ?>" />
						
						<div><span class="error"><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
						
						<?PHP if($row['Edisplay'] === "0"){?>
							<div><span class="error">Remember to pay for your event.</span></div>
						<?PHP }?>
						
						<!--DASHBOARD-->
						<div class="dashboard">
							<div class="box">
								<div class="upper">
									<div class="upper-top">
										<div class="eNameNHashtag">
											<h1>
											<div class="eName"><?php echo $row['Evename']; ?>&nbsp;</div>
											<?PHP if($row['Ehashtag'] !== ""){ ?> 
													<div class="dash">&nbsp;-&nbsp;</div> <div class="eHash">&nbsp;<?php echo $row['Ehashtag']; ?></div>
												<?PHP } ?>
											</h1>
										</div>
										
										<div class="eDateTime">
											<h2>
												<div class="edate">
													<?PHP echo $EstartDate; ?>
												</div>
												<div class="etime">
												<?PHP echo strtoupper($newStartTime); ?>
												to
												<?PHP  echo strtoupper($row['EtimeEnd']);?>
												
												
												<!-- 
												<?PHP //echo date("g:i a", strtotime($row['EtimeStart'])); ?>
												to
												<?PHP //echo date("g:i a", strtotime($row['EtimeEnd'])); ?>
												 -->
												
												
												
												</div>
											</h2>
										</div>
										
										<div class="eDescription">
											<h4><?PHP echo $row['Edescription']; ?></h4>
										</div>
									</div>
									
									<div class="eFlyer">
									<?PHP 
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
									?>
										<img src="<?php echo $row['Eflyer']; ?>" alt="event image"/>
									</div>
								</div>
								
								<div class="lower">
									<div class="socialLinks">
										<div class="eWebsite">
											<?PHP if($row['Ewebsite'] !== ""){?>
												<a href="<?= $row['Ewebsite'] ?>" target="_blank">
													<?PHP echo $row['Ewebsite']; ?>
												</a>
											<?PHP } ?>
										</div>
										
										<div class="eFacebook">
											<?PHP if($row['Efacebook'] !== ""){ ?>
												<?PHP if($fgmembersite->CheckSession() && ($usrname === $inDBUser)){ ?>
													<a href="<?= $row['Efacebook'] ?>" target="_blank">
														<img src="images/btn_fb.png" onMouseOver="this.src='images/btn_fbColor.png'" onMouseOut="this.src='images/btn_fb.png'" alt="Facebook" />
													</a>
												<?PHP } else { ?>
													<div class="fb-share-button" data-href="http://eventprobe.com/eventDisplayPage.php?eid=<?= $newEventID ?>" data-layout="button_count"></div>
												<?PHP } ?>
											<?PHP } ?>
										</div>
										
										<div class="eTwitter">
											<?PHP if ($row['Etwitter'] !== ""){ ?>
												<?PHP if($fgmembersite->CheckSession() && ($usrname === $inDBUser)){ ?>
													<a href="<?= $row['Etwitter'] ?>" target="_blank">
														<img src="images/btn_twitter.png" onMouseOver="this.src='images/btn_twitterColor.png'" onMouseOut="this.src='images/btn_twitter.png'" alt="Twitter" />
													</a>
												<?PHP } else { ?>
													<a class="twitter-share-button" data-href="https://twitter.com/intent/tweet?url=http://eventprobe.com/eventDisplayPage.php?eid=<?= $newEventID ?>" data-via="<?= $row['Ehashtag'] ?>">Tweet</a>
												<?PHP } ?>
											<?PHP } ?>
										</div>
										
										<div class="eGoogle">
											<?PHP if ($row['Egoogle'] !== ""){ ?>
												<?PHP if($fgmembersite->CheckSession() && ($usrname === $inDBUser)){ ?>
													<a href="<?= $row['Egoogle'] ?>" target="_blank">
														<img src="images/btn_google.png" onMouseOver="this.src='images/btn_googleColor.png'" onMouseOut="this.src='images/btn_google.png'" alt="Google" />
													</a>
												<?PHP } else { ?>
													<div class="g-plus" data-action="share" data-href="https://plus.google.com/share?url=http://eventprobe.com/eventDisplayPage.php?eid=<?= $newEventID ?>" data-annotation="bubble"></div>
												<?PHP } ?>											
											<?PHP } ?>
										</div>
									</div>
									
									<div class="defaultPic">
										<img src='./images/defaultUpic.png'/>
									</div>
									
									<div class="eAdrsPhone">
										<h4>
											<div class="eAddress">
												<div class="eAdd">
													<?= $row['Eaddress'] ?>
												</div>
												<div class="eCity">
													<?= $row['Ecity'] ?>, <?= $row['Estate'] ?>&nbsp;<?= $row['Ezip'] ?>
												</div>
												<div class="ePhone">
													<?PHP echo "Phone: " . $formatPhone; ?>
												</div>
											</div>
										</h4>
									</div>
									
									<div class="eMap">
										<!-- START OF MAP SCRIPT -->
										<script type="text/javascript">
											$(document).ready(function () {
												// Define the latitude and longitude positions
												var latitude = parseFloat("<?php echo $Elat; ?>"); // Latitude get from above variable
												var longitude = parseFloat("<?php echo $Elong; ?>"); // Longitude from same
												var latlngPos = new google.maps.LatLng(latitude, longitude);
												// Set up options for the Google map
												var image = 'images/favicon.png';

												var myOptions = {
														zoom: 16,
														center: latlngPos,
														mapTypeId: google.maps.MapTypeId.ROADMAP,
														zoomControlOptions: true,
														zoomControlOptions: {
														style: google.maps.ZoomControlStyle.LARGE
														}
													};
												// Define the map 
												var eventprobe = ['images/favicon.png'];
												map = new google.maps.Map(document.getElementById("map"), myOptions);
												// Add the marker
															var marker = new google.maps.Marker({
															position: latlngPos,
															map: map,
															icon: image,
															title: "<?php echo $event; ?>"
															});
												});
										</script>
										<div id="map" style="width: 100%; height:413px; margin-top:10px; max-width:100%; min-width:250px;"></div>
										<!-- END OF MAP SCRIPT -->
									</div>
									
									<div class="button">
										<?PHP if($fgmembersite->CheckSession() && ($usrname === $inDBUser)){ ?>
											<input class="dltButton" type="image" src="./images/btn_delete.png" name="submit" value=""/> |
										<?PHP } ?>
										<?PHP if($fgmembersite->CheckSession() && ($usrname === $inDBUser)){ ?>
											<a href="./editEvent.php?eid=<?PHP echo $newEventID; ?>"><img src="./images/btn_editevent.png"></a>
										<?PHP } ?>
										<?PHP //if($eDisplay === "0"){ ?>
											<!--<a href="#"><img src="./images/checkout-logo-medium.png"></a>-->
										<?PHP //} ?>
									</div>
								</div>
							</div>
						</div><!--End of box-->
					</div> <!-- End of content -->
				<?php } ?>
			</form>
			
			<?PHP if($eDisplay === "0"){ ?>
				<form class="paypal" action="./payments.php" method="post" id="paypal_form" target="_SELF">
					<div class="dashboard">		
						<input type="hidden" name="cmd" value="_xclick" />
						<input type="hidden" name='rm' value="2"> 
						<input type="hidden" name="no_note" value="1" />
						<input type="hidden" name="lc" value="USD" />
						<input type="hidden" name="currency_code" value="USD" />
						<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
						<input type="hidden" name="first_name" value=""  />
						<input type="hidden" name="last_name" value=""  />
						<input type="hidden" name="payer_email" value=""  />
						<input type="hidden" name="item_number" value="<?php echo $newEventID; ?>" / >
						<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
					</div>
				</form>
			<?PHP }?>
		</div>
		
		<!-- SHOW SEARCH RESULTS -->
		<div class="events" id="txtHint"></div>
		
		<div class="links">
			<?PHP include './links.php'; ?>
		</div>
		
		<div class="footer">
			<?PHP include './footer.php'; ?>
		</div>
	</body>
</html>
