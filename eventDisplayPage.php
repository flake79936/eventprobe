<?PHP
	require_once("./include/membersite_config.php"); 
	$newEventID = $_GET['eid'];
	//$newEventID = "124";
	include 'dbconnect.php';
	
	if(isset($_POST["submitted"])){
		if($fgmembersite->deleteEvent()){
			$fgmembersite->RedirectToURL("./index2.php");
		}
	}
	
	if($fgmembersite->CheckSession()){
		$usrname = $fgmembersite->UsrName();
	}
	if($newEventID !== ""){
		$inDBUser = $fgmembersite->getUserFromDB($newEventID);
	}
?>

<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Eventprobe</title>
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link rel="stylesheet" media="all" href=""/>
		<meta name="viewport" content="width=device-width, initial-scale=.8"/>
		<!-- Adding "maximum-scale=1" fixes the Mobile Safari auto-zoom bug: http://filamentgroup.com/examples/iosScaleBug/ -->

		<!--STYLE-->
		<link rel="stylesheet" type="text/css" href="css/top.css" />
		<link rel="stylesheet" type="text/css" href="css/eventDisplayPage.css" />
		<link rel="stylesheet" type="text/css" href="css/links.css" />
		<link rel="stylesheet" type="text/css" href="css/footer.css" />
		<link rel="stylesheet" type="text/css" href="css/search.css" />

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
	
	<body >
		<div class="search">
			<form>
				<input type="text" onkeyup="showHint(this.value)" placeholder="Search for Event"><br>
				<div style="text-align: center;">
				<a id="sport" onClick="showHint('sport');"><img alt="sport" src="./images/sports40.png"/></a> | 
				<a id="concert" onClick="showHint('concert');"><img alt="concert" src="./images/music.png"/></a> | 
				<a id="fair" onClick="showHint('fair');"><img alt="fair" src="./images/fair35.png"/></a> | 
				<a id="art" onClick="showHint('art');"><img alt="art" src="./images/art35.png"/></a>
				<a id="" onClick="showHint('');"><img alt="art" src="./images/clear.png"/></a>
				</div>
			</form>
		</div>
		
		<div class="top">
			<?PHP include './top.php';?>
		</div>
		
		<div class="eventDisplayPage">
			<form id="eventForm" action="<?php echo $fgmembersite->GetSelfScript(); ?>" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" onsubmit="return confirm('Do you wish to delete');">
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
											<img src= <?= $row['Eflyer'] ?> alt="event image"/>
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
														<img src="images/btn_fb.png" onMouseOver="this.src='images/btn_fbColor.png'" onMouseOut="this.src='images/btn_fb.png'" alt="Facebook" />
													</a>
												<?PHP } ?>
											</div>
											
											<div class="eTwitter">
												<?PHP if ($row['Etwitter'] !== ""){ ?>
													<a href="https://twitter.com/<?= $row['Etwitter'] ?>" target="_blank">
														<img src="images/btn_twitter.png" onMouseOver="this.src='images/btn_twitterColor.png'" onMouseOut="this.src='images/btn_twitter.png'" alt="Twitter" />
													</a>
												<?PHP } ?>
											</div>
											
											<div class="eGoogle">
												<?PHP if ($row['Egoogle'] !== ""){ ?>
													<a href="<?= $row['Egoogle'] ?>" target="_blank">
														<img src="images/btn_google.png" onMouseOver="this.src='images/btn_googleColor.png'" onMouseOut="this.src='images/btn_google.png'" alt="Google" />
													</a>
												<?PHP } ?>
											</div>
										</div>
									</div>
								</div>
								
								<div class="lower">
									<div class="eMap">
										<!-- START OF MAP SCRIPT -->
										<div id="map" style="width: 400px; height: 300px;"></div>
										<script type="text/javascript" language= "php">
											// Define your locations: HTML content for the info window, latitude, longitude
											var locations = <?php echo json_encode($eventArray);?>;

											// Setup the different icons and shadows
											var iconURLPrefix = 'http://maps.google.com/mapfiles/ms/icons/';

											var icons = ['images/favicon.png']
											var icons_length = icons.length;

											var shadow = {
											anchor: new google.maps.Point(15,33),
											url: iconURLPrefix + 'msmarker.shadow.png'
											};

											var map = new google.maps.Map(document.getElementById('map'), {
											zoom: 8,
											center: new google.maps.LatLng(-50.92, 120.25),
											mapTypeId: google.maps.MapTypeId.ROADMAP,
											mapTypeControl: true,
											streetViewControl: true,
											panControl: true,
											zoomControlOptions: {
											position: google.maps.ControlPosition.LEFT_BOTTOM
											}
											});

											var infowindow = new google.maps.InfoWindow({ maxWidth: 160 });

											var marker;
											var markers = new Array();

											var iconCounter = 0;

											// Add the markers and infowindows to the map
											for (var i = 0; i < locations.length; i++){  
											marker = new google.maps.Marker({
											position: new google.maps.LatLng(locations[i][1], locations[i][2]),
											map: map,
											icon : icons[iconCounter],
											shadow: shadow
											});

											markers.push(marker);

											google.maps.event.addListener(marker, 'click', (function(marker, i) {
											return function() {
											infowindow.setContent(locations[i][0]);
											infowindow.open(map, marker);
											}
											})(marker, i));

											iconCounter++;
											// We only have a limited number of possible icon colors, so we may have to restart the counter
											if(iconCounter >= icons_length){
											iconCounter = 0;
											}
											}

											function AutoCenter() {
											//  Create a new viewpoint bound
											var bounds = new google.maps.LatLngBounds();
											//  Go through each...
											$.each(markers, function (index, marker) {
											bounds.extend(marker.position);
											});
											//  Fit these bounds to the map
											map.fitBounds(bounds);
											} AutoCenter();
										</script> 
										<!-- END OF MAP SCRIPT -->
									</div>
									
									<div class="eAdrsPhone">
										<h4>
											<img src='images/favicon.png'/>&nbsp;
											<?= $row['Eaddress'] ?>, 
											<?= $row['Ecity'] ?>, 
											<?= $row['Estate'] ?>&nbsp; 
											<?= $row['Ezip'] ?><br>
											<?PHP echo "Phone: " . $row['EphoneNumber']; ?>
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