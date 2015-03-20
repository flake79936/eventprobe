<!--AJAX Module-->
<?PHP
	require_once("./include/membersite_config.php"); 
	$newEventID = $_GET['eid'];
	// 	$newEventID = "35";
	include 'dbconnect.php';
	
	if(isset($_POST["submitted"])){
		if($fgmembersite->deleteEvent()){
			$fgmembersite->RedirectToURL("./index2.php");
		}
	}
	
	if($fgmembersite->CheckSession()){
		$usrname = $fgmembersite->UsrName();
	}
	
	$inDBUser = $fgmembersite->getUserInDB($newEventID);
?>

<!doctype html>
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

	<body lang="en">
		<div class="search">
			<form>
				<input type="text" onkeyup="showHint(this.value)" placeholder="Search for Event"><br>
				<a id="sport" onClick="showHint('sport');"><img alt="sport" src="./images/sports40.png"/></a> | 
				<a id="concert" onClick="showHint('concert');"><img alt="concert" src="./images/music.png"/></a> | 
				<a id="fair" onClick="showHint('fair');"><img alt="fair" src="./images/fair35.png"/></a> | 
				<a id="art" onClick="showHint('art');"><img alt="art" src="./images/art35.png"/></a>
				<a id="" onClick="showHint('');"><img alt="art" src="./images/clear.png"/></a>
			</form>
		</div>

		<div class="top">
			<?PHP include './top.php';?>
		</div>
		
		<div class="eventDisplayPage">
			<form id="eventForm" action="<?php echo $fgmembersite->GetSelfScript(); ?>" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
				<input type="hidden" name="submitted" id="submitted" value="1"/>
				<input type="hidden" name="Eid" id="Eid" value="<?PHP echo $newEventID; ?>"/>
						
				<div><span class="error"><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
				<table width="1108" border="0">
				
				<?PHP
					$qry = "SELECT * FROM Events WHERE Eid = '".$newEventID."' AND Edisplay='1';";
					$result = mysqli_query($con, $qry);
					
					while($row = mysqli_fetch_array($result)){  
						$i = 0 ;
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
				
						<tr>
							<td width="400"><h1><?= $row['Evename'] ?></h1></td>
							<td width="21">&nbsp;</td>
							<td width="88"><h1><?= $row['Ehashtag'] ?></h1></td>
							<td width="86">&nbsp;</td>
							<td width="491">&nbsp;</td>
						</tr>
						<tr>
							<td><h2><?PHP echo $EstartDate; ?><br><?= $row['EtimeStart'] ?> to <?= $row['EtimeEnd'] ?> </h2></td>
							<td>&nbsp;</td>
							<td colspan="7"><h4><?= $row['Edescription'] ?></h4></td>
						</tr>
						<tr>
							<td rowspan="13"><img src= <?= $row['Eflyer'] ?> width="400px" height="300px"  ></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td><a href="<?= $row['Ewebsite'] ?>" target="_blank"><?= $row['Ewebsite'] ?> </a></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td><?PHP if ($row['Efacebook']){ ?>
									<a href="<?= $row['Efacebook'] ?>" target="_blank">
										<img src="images/btn_fb.png" onMouseOver="this.src='images/btn_fbColor.png'" onMouseOut="this.src='images/btn_fb.png'" alt="Facebook" />
									</a>
								<?PHP } ?></td>
							<td><?PHP if ($row['Etwitter']){ ?>
									<a href="https://twitter.com/<?= $row['Etwitter'] ?>" target="_blank">
										<img src="images/btn_twitter.png" onMouseOver="this.src='images/btn_twitterColor.png'" onMouseOut="this.src='images/btn_twitter.png'" alt="Twitter" />
									</a>
								<?PHP } ?></td>
							<td><?PHP if ($row['Egoogle']){ ?>
									<a href="<?= $row['Egoogle'] ?>" target="_blank">
										<img src="images/btn_google.png" onMouseOver="this.src='images/btn_googleColor.png'" onMouseOut="this.src='images/btn_google.png'" alt="Google" />
									</a>
								<?PHP } ?></td>
								<td><?PHP if ($row['Ehashtag']){ ?>
									<a href="https://instagram.com/<?= $row['Ehashtag'] ?>" target="_blank">
										<img src="images/icon_instagram2.png" onMouseOver="this.src='images/icon_instagram2.png'" onMouseOut="this.src='images/icon_instagram2.png'" alt="Hashtag" />
									</a>
								<?PHP } ?></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
						<td rowspan="14"><!-- START OF MAP SCRIPT -->
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
											zoom: 12,
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
									<!-- END OF MAP SCRIPT --></td>
						  <td>&nbsp;</td>
						  <td colspan="5"><h4><img src='images/favicon.png'>&nbsp;<?= $row['Eaddress'] ?>, <?= $row['Ecity'] ?>, <?= $row['Estate'] ?>, <?= $row['Ezip'] ?> </h4></td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td colspan="5"><h4>Phone: <?= $formatPhone?> </h4></td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td></td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td></td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td></td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td></td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<?PHP if($fgmembersite->CheckSession() && ($usrname === $inDBUser)){ ?>
									<input type="submit" name="submit" value="Delete Event"/>
								<?PHP } ?>
							</td>
							<td></td>
							<td>
								<?PHP if($fgmembersite->CheckSession() && ($usrname === $inDBUser)){ ?>
									<a href="./editEvent.php?eid=<?PHP echo $newEventID; ?>"><img src="./images/btn_editevent.png"></a>
								<?PHP } ?>
							</td>
						</tr>
				<?PHP } ?>
				</table>
			</form>
		</div>
		<br/>
		
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