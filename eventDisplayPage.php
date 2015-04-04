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
			$fgmembersite->RedirectToURL("./index2.php");
		}
	}
	
	if($newEventID !== ""){
		$inDBUser = $fgmembersite->getUserFromDB($newEventID);
	}
?>

<html lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=.9, maximum-scale=.9, user-scalable=0"/>
		<title>Eventprobe</title>
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link rel="stylesheet" media="all" href=""/>
		<!-- Adding "maximum-scale=.9" fixes the Mobile Safari auto-zoom bug: http://filamentgroup.com/examples/iosScaleBug/ -->

		<!--STYLE-->
		<link rel="stylesheet" type="text/css" href="css/header.css" />
		<link rel="stylesheet" type="text/css" href="css/eventDisplayPage.css" />
		<link rel="stylesheet" type="text/css" href="css/links.css" />
		<link rel="stylesheet" type="text/css" href="css/footer.css" />

		<!--GOOGLE MAP-->
		<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.10.1.min.js"></script>

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
					$qry = "SELECT * FROM Events WHERE Eid = " . $newEventID . " AND Edisplay = 1;";
					$result = mysqli_query($con, $qry);
					
					while($row = mysqli_fetch_array($result)){  
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
					
						<!--DASHBOARD-->
						<div class="dashboard">
							<div class="box">
								<div class="upper">
									<div class="eNameNHashtag">
										<h1>
										<?php echo $row['Evename']; 
											if($row['Ehashtag'] !== ""){ 
										?> 
												- <?php echo $row['Ehashtag']; ?>
											<?PHP } ?>
										</h1>
									</div>
									
									<div class="eDateTime">
										<h2><?PHP echo $EstartDate; ?>&nbsp;
										<?PHP echo date("g:i a", strtotime($row['EtimeStart'])); ?>
										to 
										<?PHP echo date("g:i a", strtotime($row['EtimeEnd'])); ?></h2>
									</div>
									
									<div class="eDescription">
										<h4><?PHP echo $row['Edescription']; ?></h4>
									</div>
									
									<div class="upperMid">
										<div class="eFlyer">
										<?PHP 
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
										?>
											<img src="<?php echo $row['Eflyer']; ?>" alt="event image"/>
										</div>
										
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
													<a href="<?= $row['Efacebook'] ?>" target="_blank">
														<img src="images/btn_fb2.png" onMouseOver="this.src='images/btn_fbColor2.png'" onMouseOut="this.src='images/btn_fb2.png'" alt="Facebook" />
													</a>
												<?PHP } ?>
											</div>
											
											<div class="eTwitter">
												<?PHP if ($row['Etwitter'] !== ""){ ?>
													<a href="https://twitter.com/<?= $row['Etwitter'] ?>" target="_blank">
														<img src="images/btn_twitter2.png" onMouseOver="this.src='images/btn_twitterColor2.png'" onMouseOut="this.src='images/btn_twitter2.png'" alt="Twitter" />
													</a>
												<?PHP } ?>
											</div>
											
											<div class="eGoogle">
												<?PHP if ($row['Egoogle'] !== ""){ ?>
													<a href="<?= $row['Egoogle'] ?>" target="_blank">
														<img src="images/btn_google2.png" onMouseOver="this.src='images/btn_googleColor2.png'" onMouseOut="this.src='images/btn_google2.png'" alt="Google" />
													</a>
												<?PHP } ?>
											</div>
										</div>
									</div>
								</div>
								
								<div class="lower">
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
										<div id="map" style="width:400px;height:300px; margin-top:10px;"></div>
										<!-- END OF MAP SCRIPT -->
									</div>
									
									<div class="eAdrsPhone">
										<h4>
											<img src='images/favicon.png'/>&nbsp;
											<?= $row['Eaddress'] ?>, 
											<?= $row['Ecity'] ?>, 
											<?= $row['Estate'] ?>&nbsp; 
											<?= $row['Ezip'] ?><br>
											<?PHP echo "Phone: " . $formatPhone; ?>
										</h4>
									</div>
									
									<div class="button">
										<?PHP if($fgmembersite->CheckSession() && ($usrname === $inDBUser)){ ?>
											<input class="dltButton" type="image" src="./images/btn_delete.png" name="submit" value=""/> |
										<?PHP } ?>
										<?PHP if($fgmembersite->CheckSession() && ($usrname === $inDBUser)){ ?>
											<a href="./editEvent.php?eid=<?PHP echo $newEventID; ?>"><img src="./images/btn_editevent.png"></a>
										<?PHP } ?>
									</div>
								</div>
							</div>
						</div><!--End of box-->
					</div> <!-- End of content -->
				<?php } ?>
			</form>
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
