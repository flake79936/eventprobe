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

<html lang="en">
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
	
	<body>
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
				
				<?PHP } ?>
			</form>
		</div>
		
		
		<div class="main">
			<div class="sidebar">
			<br>
			<br>
			<!-- <div class="btn-event"><a href=""><img src="images/btn_event.png" alt="Event" /></a></div> -->
				<ul id="accordion" class="menu">
					<!--<li>
						<h2>Dashboard</h2>
						<ul>
							<li><img src="images/music.png" alt="Music" /><a href="#">DJ Maxwell, Aug 30</a></li>
							<li><img src="images/speaker.png" alt="Speaker" /><a href="#">Speaker Event, Sep 30</a></li>
							<li><img src="images/dollar.png" alt="Dollar" /><a href="#">Sales Events, Oct 30</a></li>
						</ul>
					</li>-->
					
					<li>
						<h2>My Events</h2>
						<ul id="accordion2">
							<li>
								<h3>Upcoming</h3>
								<ul>
									<?PHP $i = 0;
										  //$count = 1;
										  $month = '';
										  
										  while($row = mysqli_fetch_array($upcoming)){ 
											/*Date format to Month/Day/Year */
											$date = date_create($row['EstartDate']);
											$EstartDate = date_format($date, 'm/d/Y');
											$Etype = $row['Etype'];
											//echo "Date: " . $EstartDate;
											
											if    (substr($EstartDate, 0, 2) === '01')$month = 'Jan';
											elseif(substr($EstartDate, 0, 2) === '02')$month = 'Feb';
											elseif(substr($EstartDate, 0, 2) === '03')$month = 'Mar';
											elseif(substr($EstartDate, 0, 2) === '04')$month = 'Apr';
											elseif(substr($EstartDate, 0, 2) === '05')$month = 'May';
											elseif(substr($EstartDate, 0, 2) === '06')$month = 'Jun';
											elseif(substr($EstartDate, 0, 2) === '07')$month = 'Jul';
											elseif(substr($EstartDate, 0, 2) === '08')$month = 'Aug';
											elseif(substr($EstartDate, 0, 2) === '09')$month = 'Sep';
											elseif(substr($EstartDate, 0, 2) === '10')$month = 'Oct';
											elseif(substr($EstartDate, 0, 2) === '11')$month = 'Nov';
											else $month = 'Dec'; 
											
											switch($Etype){
												case "Art": $Etype = "art35"; break;
												case "Concert": $Etype = "music"; break;
												case "Fair": $Etype = "fair35"; break;
												case "Social": $Etype = "weight35"; break;
												case "Sport": $Etype = "sports40"; break;
												case "Public Speaker": $Etype = "speaker"; break;
												default: $Etype = "magic35"; break;
											}
											?>
											<li>
												<img src="images/<?php echo $Etype; ?>.png" alt="<?PHP echo $Etype; ?>" />
													<a onClick="seeMoreInfo(<?= $row['Eid'] ?>);">
														<?PHP //echo $count; ?>
														<?= $row['Evename'] ?>, 
														<?= $month ?> 
														<?= substr($EstartDate, 3, 2); ?>
													</a>
											</li>
										<?PHP $i++;
											  //$count++;
										} ?>
								</ul>
							</li>
							
							<li>
								<h3>Past</h3>
								<ul>
									<?PHP $i = 0;
										  //$count = 1;
										  $month = '';
										  
										  while($row = mysqli_fetch_array($past)){
											$date = date_create($row['EstartDate']);
											$EstartDate = date_format($date, 'm/d/Y');
											$Etype = $row['Etype'];
											//echo "Date: " . $EstartDate;
												
											if    (substr($EstartDate, 0, 2) === '01')$month = 'Jan';
											elseif(substr($EstartDate, 0, 2) === '02')$month = 'Feb';
											elseif(substr($EstartDate, 0, 2) === '03')$month = 'Mar';
											elseif(substr($EstartDate, 0, 2) === '04')$month = 'Apr';
											elseif(substr($EstartDate, 0, 2) === '05')$month = 'May';
											elseif(substr($EstartDate, 0, 2) === '06')$month = 'Jun';
											elseif(substr($EstartDate, 0, 2) === '07')$month = 'Jul';
											elseif(substr($EstartDate, 0, 2) === '08')$month = 'Aug';
											elseif(substr($EstartDate, 0, 2) === '09')$month = 'Sep';
											elseif(substr($EstartDate, 0, 2) === '10')$month = 'Oct';
											elseif(substr($EstartDate, 0, 2) === '11')$month = 'Nov';
											else $month= 'Dec'; 
											
											switch($Etype){
												case "Art": $Etype = "art35"; break;
												case "Concert": $Etype = "music"; break;
												case "Fair": $Etype = "fair35"; break;
												case "Social": $Etype = "weight35"; break;
												case "Sport": $Etype = "sports40"; break;
												case "Public Speaker": $Etype = "speaker"; break;
												default: $Etype = "magic35"; break;
											}
											?>
											<li>
												<img src="images/<?php echo $Etype; ?>.png" alt="<?PHP echo $Etype; ?>" />
												<a onClick="seeMoreInfo(<?= $row['Eid'] ?>);">
													<?PHP //echo $count; ?>
													<?= $row['Evename'] ?>, 
													<?= $month ?> 
													<?= substr($EstartDate, 3, 2); ?>
												</a>
											</li>
										<?PHP $i++; 
											  //$count++; 
										} ?>
								</ul>
							</li>
						</ul>
					</li>
				</ul>
			</div><!--End of Sidebar-->
			
			<div class="content">
				<?PHP //include 'updatePic.php'; ?>
				
				<form id="eventForm" action="<?php echo $fgmembersite->GetSelfScript(); ?>" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
					<input type="hidden" name="submitted" id="submitted" value="1"/>
					
					<div><span class="error"><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
				
					<!--DASHBOARD-->
					<div class="dashboard">
						<div class="user-profile">
							<div class="update-image">
								<input id="uploadImage" type="file" name="Eflyer" onchange="PreviewImage();" />
								<br>
								<span id="eventForm_Eflyer_errorloc" class="error"></span>
							</div>
							<img id="uploadPreview" style="width: 270px; height: 250px;" />
							<!-- <img src="images/profile-img.jpg" alt="Profiles"> -->
						</div>
						
						<div class="user-menu">
							<div class="box">
								<div class="name">
									<!--<h1>DJ Maxwell</h1>-->
									<h5 for="Evename">Name of event</h5>
									<div class="type" id="Evename">
										<!--<div class="image"><img src="images/icon_location.png" /></div> -->
										<input type="text" onkeyup="textCounter(this,'charsLeftName', 85)" name="Evename" placeholder="Enter the Name Event" id="Evename" value="<?php echo $fgmembersite->SafeDisplay('Evename') ?>">
										<div style="color: red; font-size: 12pt; font-style: italic;" id="charsLeftName" value="85"> 85 Characters Max</div>
										<span id="eventForm_Evename_errorloc" class="error"></span>
									</div>
									
									<!--<div class="info">
										<div class="box"><img src="images/icon_music.png" alt="Icon" /></div>
										<div class="box"><h3>Music Event</h3></div>
										<div class="box"><a href="#"><img src="images/btn_arrow_down.png" alt="Icon" /></a></div>
										<div class="clear"></div>
									</div>-->
									
									<div class="type">
										<div class="container">
											<h5 for="Etype">Type of Event</h5>
											<select name="Etype" id="Etype">
												<option value="" disabled selected>Please Select a Type</option>
												<option value="Art">Art</option>
												<option value="Concert">Concert</option>
												<option value="Fair">Fair</option>
												<option value="Social">Social</option>
												<option value="Sport">Sport</option>
												<option value="Public Speaker">Public Speaker</option>
												<option value="Other">Other</option>
											</select><br>
											<span id="eventForm_Etype_errorloc" class="error"></span>
										</div>
										 
										<div class="type">					
											<div class="container" id="other">
												<label for="Eother">Other: </label><br>
												<input type="text" name="Eother" title="Enter Other Kind of Event" id="Eother" value="<?php echo $fgmembersite->SafeDisplay('Eother') ?>" maxlength="50"><br>
												<span id="event_Eother_errorloc" class="error"></span>
											</div>
										</div>
										
										<div class="container">
											<h5 for="Erank">Reach</h5>
											<select name="Erank" id="Erank">
												<option value="" disabled selected>Please Select a Rank</option>
												<option value="Free">Free</option>
												<option value="Paid">Paid</option>
												<option value="Premium">Premium</option>
											</select><br>
											<span id="eventForm_Erank_errorloc" class="error"></span>
										</div>
									</div>
									
									<div class="reach">
									<!--<h3>Increase your reach!</h3>
										<a href="#"><img src="images/btn_upgrade.png" alt="Upgrade" /></a>-->
									</div>
									<div class="clear"></div>
								</div>
								<div class="saved">
								<!--<div class="box"><h3>Saved</h3></div>
									<div class="box"><a href="#"><img src="images/btn_draft.png" alt="Draft" /></a></div>
									<div class="box"><a href="#"><img src="images/btn_publish.png" alt="Draft" /></a></div>-->
									<div class="clear"></div>
								</div>
							</div>
							<div class="clear"></div>
						</div>
					</div>
					<!--Dashboard-->
					
					<div class="form-wrap">
						<div class="box">
							<h5 for="Edescription">Description</h5>
							<textarea onkeyup="textCounter(this,'charsLeftText', 500)" title="Enter Your Description" rows="3" cols="30" name="Edescription" id="Edescription" value=""></textarea>
							<div style="color: red; font-size: 12pt; font-style: italic;" id="charsLeftText" value="500"> 500 Characters Max</div>
							<span id="eventForm_Edescription_errorloc" class="error"></span>
						
							<h5 for="Eaddress">Address</h5>
							<div class="location" id="Eaddress">
							   <!-- <div class="image"><img src="images/icon_location.png" /></div> -->
								<input type="text" name="Eaddress" placeholder="123 Main road" title="Enter the Address of the Event" id="Eaddress" value="" maxlength="50">
								<br>
								<span id="eventForm_Eaddress_errorloc" class="error"></span>
							</div>
						
							<div class="wrap">
								<div class="type" id="Ecity" >
									<h5 for="Ecity">City</h5>
										<input type="text" name="Ecity" placeholder="City" title="Enter the City of the Event" id="Ecity" value="" maxlength="50"><br>
									<span id="eventForm_Ecity_errorloc" class="error"></span>
								</div>
								
								<div class="type">
									<div class="container" id="Estate">
										<h5 for="Estate">State</h5>
										<select name="Estate" size="1">
											<option value="" disabled selected>Select The State</option>
											<option value="AK">AK</option>

											<option value="AL">AL</option>
											<option value="AR">AR</option>
											<option value="AZ">AZ</option>
											<option value="CA">CA</option>

											<option value="CO">CO</option>
											<option value="CT">CT</option>
											<option value="DC">DC</option>
											<option value="DE">DE</option>

											<option value="FL">FL</option>
											<option value="GA">GA</option>
											<option value="HI">HI</option>
											<option value="IA">IA</option>

											<option value="ID">ID</option>
											<option value="IL">IL</option>
											<option value="IN">IN</option>
											<option value="KS">KS</option>

											<option value="KY">KY</option>
											<option value="LA">LA</option>
											<option value="MA">MA</option>
											<option value="MD">MD</option>

											<option value="ME">ME</option>
											<option value="MI">MI</option>
											<option value="MN">MN</option>
											<option value="MO">MO</option>

											<option value="MS">MS</option>
											<option value="MT">MT</option>
											<option value="NC">NC</option>
											<option value="ND">ND</option>

											<option value="NE">NE</option>
											<option value="NH">NH</option>
											<option value="NJ">NJ</option>
											<option value="NM">NM</option>

											<option value="NV">NV</option>
											<option value="NY">NY</option>
											<option value="OH">OH</option>
											<option value="OK">OK</option>

											<option value="OR">OR</option>
											<option value="PA">PA</option>
											<option value="RI">RI</option>
											<option value="SC">SC</option>

											<option value="SD">SD</option>
											<option value="TN">TN</option>
											<option value="TX">TX</option>
											<option value="UT">UT</option>

											<option value="VA">VA</option>
											<option value="VT">VT</option>
											<option value="WA">WA</option>
											<option value="WI">WI</option>

											<option value="WV">WV</option>
											<option value="WY">WY</option>
										</select>
										<br>
										<span id="eventForm_Estate_errorloc" class="error"></span>
									</div>
								</div>
								
								<div class="type" id="Ezip">
									<h5 for="Ezip">ZIP</h5>
										<input type="text" name="Ezip" placeholder="12345" title="Enter the Zip code of the Event" id="Ezip" value="" maxlength="50"><br>
									<span id="eventForm_Ezip_errorloc" class="error"></span>
								</div>						
							</div>
						
							<div class="wrap">
								<div class="type" id="EphoneNumber" >
									<h5 for="EphoneNumber">Phone Number</h5>
										<input type='tel' name="EphoneNumber" id="EphoneNumber" pattern='\d{3}[\-]\d{3}[\-]\d{4}' title='Phone Number (Format: 999-999-9999)' maxlength="12" placeholder="999-999-9999"><br>
									<span id="eventForm_EphoneNumber_errorloc" class="error"></span>
								</div>
							</div>
							
							<div class="clear"></div>
							
							<div class="wrap">
								<!--Start Time-->
								<div class="type">
									<div class="container" id="EtimeStart">
										<div class="container" id="">
											<h5 for="EtimeStart">Start Time</h5>
											<input type="time" name="EtimeStart" placeholder="" id="EtimeStart" value="" maxlength="50"><br>
											<span id="eventForm_EtimeStart_errorloc" class="error"></span>
										</div>
									</div>
								</div>
							
								<!--End Time  -->
								<div class="type">
									<div class="container" id="EtimeEnd">
										<h5 for="EtimeEnd">End Time</h5>
										<input type="time" name="EtimeEnd" placeholder="" id="EtimeEnd" value="" maxlength="50"><br>
										<span id="eventForm_EtimeEnd_errorloc" class="error"></span>
									</div>
								</div>
							</div>
								
							<div class="clear"></div>
						
							<div class="wrap">
								<div class="type">	
									<!--Start Date picker-->
									<div class="container" id="">
										<h5 for="EstartDate">Start Date</h5>
										<input type="date" name="EstartDate" placeholder="" title="Pick Start Date" id="EstartDate" value="" maxlength="50"><br>
										<span id="eventForm_EstartDate_errorloc" class="error"></span>
									</div>
								</div>	


								<div class="type">
									<!--End Date picker-->
									<div class="container" id="">
										<h5 for="EendDate">End Date</h5>
										<input type="date" name="EendDate" placeholder="12/31/2015" title="Pick Start Date" id="EendDate" value="" maxlength="50"><br>
										<span id="eventForm_EendDate_errorloc" class="error"></span>
									</div>
								</div>	
								
								<div class="clear"></div>
								
								<div class="type" id="Ewebsite" >
									<h5 for="Ewebsite">Website</h5>
									<input type="url" name="Ewebsite"  placeholder="http://www.website.com" title="correct format: http://www.website.com" id="Ewebsite" value="<?php echo $fgmembersite->SafeDisplay('Ewebsite') ?>" maxlength="50"><br>
									<span id="event_Ewebsite_errorloc" class="error"></span>
								</div>
								
								<div class="type" id="Efacebook" >
									<h5 for="Efacebook">Facebook</h5>
									<input type="text" name="Efacebook" placeholder="https://www.facebook.com/USERNAME" id="Efacebook" value="<?php echo $fgmembersite->SafeDisplay('Efacebook') ?>" maxlength="50"><br>
									<span id="event_Efacebook_errorloc" class="error"></span>
								</div>
								
								<div class="type" id="Egoogle" >
									<h5 for="Egoogle">Google+</h5>
									<input type="text" name="Egoogle" placeholder="https://plus.google.com/USERNAME" id="Egoogle" value="<?php echo $fgmembersite->SafeDisplay('Egoogle') ?>" maxlength="50"><br>
									<span id="event_Egoogle_errorloc" class="error"></span>
								</div>
								
								<div class="type" id="Etwitter" >
									<h5 for="Etwitter">Twitter</h5>
									<input type="text" name="Etwitter" placeholder="https://twitter.com/username" id="Etwitter" value="<?php echo $fgmembersite->SafeDisplay('Etwitter') ?>" maxlength="50"><br>
									<span id="event_Etwitter_errorloc" class="error"></span>
								</div>
								
								<div class="type" id="Ehashtag">
									<h5 for="Ehashtag">Hashtag</h5>
									<input type="text" name="Ehashtag" placeholder="#hashtag" title="#hello" id="Ehashtag" value="<?php echo $fgmembersite->SafeDisplay('Ehashtag') ?>" maxlength="50"><br>
									<span id="event_Ehashtag_errorloc" class="error"></span>
								</div>
							</div>
						</div>
						<div class="clear"></div>
					</div><!--End of Form-wrap-->
						<!--Submit Button-->
					<div class="submitButton">
						<input type="submit" name="Submit" value="Create Event" />
					</div>
				</form>
				
			</div><!-- End of content -->
			
			<div class="links">
				<?PHP include './links.php'; ?>
			</div>
			
			<div class="footer">
				<?PHP include './footer.php'; ?>
			</div>
			
		</div><!-- End of Main -->
	</body>
</html>