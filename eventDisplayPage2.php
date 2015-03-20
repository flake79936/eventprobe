<?PHP
	require_once("./include/membersite_config.php"); 
	//$newEventID = $_GET['eid'];
	$newEventID = "124";
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
		
		<form id="eventForm" action="<?php echo $fgmembersite->GetSelfScript(); ?>" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
			<?PHP while($row = mysqli_fetch_array($edit)){ ?>
				<div class="content">
					<input type="hidden" name="submitted" id="submitted" value="1" />
					<input type="hidden" name="Eid" id="Eid" value="<?PHP echo $_GET['eid']; ?>" />
					
					<div><span class="error"><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
				
					<!--DASHBOARD-->
					<div class="dashboard">
						<!--Upload picture-->
						<div class="user-profile">
							<div class="update-image">
								<!--added the 'value' to reflect the value from the DB based on the 'Eid' (event id)-->
								<input id="uploadImage" accept="image/*" value="<?php echo $row['Eflyer']; ?>" type="file" name="Eflyer" onchange="PreviewImage();" />
								<br>
								<span id="eventForm_Eflyer_errorloc" class="error"></span>
							</div>
							<img id="uploadPreview" src="<?php echo $row['Eflyer']; ?>" style="width: 270px; height: 250px;"/>
							<!-- <img src="images/profile-img.jpg" alt="Profiles"> -->
						</div>
							
						<div class="user-menu">
							<div class="box">
								<div class="name">
									<!--Event Name "Evename"-->
									<h5 for="Evename">Name of event</h5>
									<div class="type" id="Evename">
										<!--<div class="image"><img src="images/icon_location.png" /></div> -->
										<input type="text" onkeyup="textCounter(this,'charsLeftName', 85)" name="Evename" placeholder="Enter The Name Event" id="Evename" value="<?php echo $row['Evename']; ?>">
										<div style="color: red; font-size: 12pt; font-style: italic;" id="charsLeftName" value="85"> 85 Characters Max</div>
										<span id="eventForm_Evename_errorloc" class="error"></span>
									</div>
									
									<!--Event type "Etype"-->
									<div class="type">
										<div class="container">
											<h5 for="Etype">Type of Event</h5>
											<select name="Etype" id="Etype">
												<option value="" disabled selected>Please Select a Type</option>
												<option value="Art"     <?php echo strcasecmp($row['Etype'], "Art"    ) == 0 ? "Selected" : ""; ?>>Art</option>
												<option value="Concert" <?php echo strcasecmp($row['Etype'], "Concert") == 0 ? "Selected" : ""; ?>>Concert</option>
												<option value="Fair"    <?php echo strcasecmp($row['Etype'], "Fair"   ) == 0 ? "Selected" : ""; ?>>Fair</option>
												<option value="Social"  <?php echo strcasecmp($row['Etype'], "Social" ) == 0 ? "Selected" : ""; ?>>Social</option>
												<option value="Sport"   <?php echo strcasecmp($row['Etype'], "Sport"  ) == 0 ? "Selected" : ""; ?>>Sport</option>
												<option value="Other"   <?php echo strcasecmp($row['Etype'], "Other"  ) == 0 ? "Selected" : ""; ?>>Other</option>
											</select><br>
											<span id="eventForm_Etype_errorloc" class="error"></span>
										</div>
									</div>
									
									<!--Event other option "Eother"-->
									<div class="type">					
										<div class="container" id="other">
											<label for="Eother">Other: </label><br>
											<input type="text" name="Eother" title="Enter Other Kind of Event" id="Eother" value="<?php echo $row['Eother']; ?>" maxlength="50"><br>
											<span id="event_Eother_errorloc" class="error"></span>
										</div>
									</div>
									
									<!--Event rank "Erank"-->
									<div class="container">
										<h5 for="Erank">Reach</h5>
										<select name="Erank" id="Erank">
											<option value="" disabled selected>Please Select a Rank</option>
											<option value="Free"    <?php echo strcasecmp($row['Erank'], "Free") == 0    ? "Selected" : ""; ?>>Free</option>
											<option value="Paid"    <?php echo strcasecmp($row['Erank'], "Paid") == 0    ? "Selected" : ""; ?>>Paid</option>
											<option value="Premium" <?php echo strcasecmp($row['Erank'], "Premium") == 0 ? "Selected" : ""; ?>>Premium</option>
										</select><br>
										<span id="eventForm_Erank_errorloc" class="error"></span>
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
						<!--Dashboard-->
						
						<div class="form-wrap">
							<div class="box">
								<h5 for="Edescription">Description</h5>
								<textarea onkeyup="textCounter(this,'charsLeftText', 500)" title="Enter Your Description" rows="3" cols="30" name="Edescription" id="Edescription"><?PHP echo $row['Edescription']; ?></textarea>
								<div style="color: red; font-size: 12pt; font-style: italic;" id="charsLeftText" value="500"> 500 Characters Max</div>
								<span id="eventForm_Edescription_errorloc" class="error"></span>
							
								<h5 for="Eaddress">Address</h5>
								<div class="location" id="Eaddress">
								   <!-- <div class="image"><img src="images/icon_location.png" /></div> -->
									<input type="text" name="Eaddress" placeholder="123 Main road" title="Enter the Address of the Event" id="Eaddress" value="<?PHP echo $row['Eaddress']; ?>" maxlength="50"><br>
									<span id="eventForm_Eaddress_errorloc" class="error"></span>
								</div>
							
								<div class="wrap">
									<!--Event city "Ecity"-->
									<div class="type" id="Ecity" >
										<h5 for="Ecity">City</h5>
											<input type="text" name="Ecity" placeholder="City" title="Enter the City of the Event" id="Ecity" value="<?PHP echo $row['Ecity']; ?>" maxlength="50"><br>
										<span id="eventForm_Ecity_errorloc" class="error"></span>
									</div>
									
									<div class="type">
										<div class="container" id="Estate">
											<h5 for="Estate">State</h5>
											<select name="Estate" size="1">
												<option value="" disabled selected>Select The State</option>
												<option value="AK" <?php echo strcasecmp($row['Estate'], "AK") == 0 ? "Selected" : ""; ?>>AK</option>
												
												<option value="AL" <?php echo strcasecmp($row['Estate'], "AL") == 0 ? "Selected" : ""; ?>>AL</option>
												<option value="AR" <?php echo strcasecmp($row['Estate'], "AR") == 0 ? "Selected" : ""; ?>>AR</option>
												<option value="AZ" <?php echo strcasecmp($row['Estate'], "AZ") == 0 ? "Selected" : ""; ?>>AZ</option>
												<option value="CA" <?php echo strcasecmp($row['Estate'], "CA") == 0 ? "Selected" : ""; ?>>CA</option>
																										  
												<option value="CO" <?php echo strcasecmp($row['Estate'], "CO") == 0 ? "Selected" : ""; ?>>CO</option>
												<option value="CT" <?php echo strcasecmp($row['Estate'], "CT") == 0 ? "Selected" : ""; ?>>CT</option>
												<option value="DC" <?php echo strcasecmp($row['Estate'], "DC") == 0 ? "Selected" : ""; ?>>DC</option>
												<option value="DE" <?php echo strcasecmp($row['Estate'], "DE") == 0 ? "Selected" : ""; ?>>DE</option>
																										  
												<option value="FL" <?php echo strcasecmp($row['Estate'], "FL") == 0 ? "Selected" : ""; ?>>FL</option>
												<option value="GA" <?php echo strcasecmp($row['Estate'], "GA") == 0 ? "Selected" : ""; ?>>GA</option>
												<option value="HI" <?php echo strcasecmp($row['Estate'], "HI") == 0 ? "Selected" : ""; ?>>HI</option>
												<option value="IA" <?php echo strcasecmp($row['Estate'], "IA") == 0 ? "Selected" : ""; ?>>IA</option>
																										  
												<option value="ID" <?php echo strcasecmp($row['Estate'], "ID") == 0 ? "Selected" : ""; ?>>ID</option>
												<option value="IL" <?php echo strcasecmp($row['Estate'], "IL") == 0 ? "Selected" : ""; ?>>IL</option>
												<option value="IN" <?php echo strcasecmp($row['Estate'], "IN") == 0 ? "Selected" : ""; ?>>IN</option>
												<option value="KS" <?php echo strcasecmp($row['Estate'], "KS") == 0 ? "Selected" : ""; ?>>KS</option>
																										  
												<option value="KY" <?php echo strcasecmp($row['Estate'], "KY") == 0 ? "Selected" : ""; ?>>KY</option>
												<option value="LA" <?php echo strcasecmp($row['Estate'], "LA") == 0 ? "Selected" : ""; ?>>LA</option>
												<option value="MA" <?php echo strcasecmp($row['Estate'], "MA") == 0 ? "Selected" : ""; ?>>MA</option>
												<option value="MD" <?php echo strcasecmp($row['Estate'], "MD") == 0 ? "Selected" : ""; ?>>MD</option>
																										  
												<option value="ME" <?php echo strcasecmp($row['Estate'], "ME") == 0 ? "Selected" : ""; ?>>ME</option>
												<option value="MI" <?php echo strcasecmp($row['Estate'], "MI") == 0 ? "Selected" : ""; ?>>MI</option>
												<option value="MN" <?php echo strcasecmp($row['Estate'], "MN") == 0 ? "Selected" : ""; ?>>MN</option>
												<option value="MO" <?php echo strcasecmp($row['Estate'], "MO") == 0 ? "Selected" : ""; ?>>MO</option>
																										  
												<option value="MS" <?php echo strcasecmp($row['Estate'], "MS") == 0 ? "Selected" : ""; ?>>MS</option>
												<option value="MT" <?php echo strcasecmp($row['Estate'], "MT") == 0 ? "Selected" : ""; ?>>MT</option>
												<option value="NC" <?php echo strcasecmp($row['Estate'], "NC") == 0 ? "Selected" : ""; ?>>NC</option>
												<option value="ND" <?php echo strcasecmp($row['Estate'], "ND") == 0 ? "Selected" : ""; ?>>ND</option>
																										  
												<option value="NE" <?php echo strcasecmp($row['Estate'], "NE") == 0 ? "Selected" : ""; ?>>NE</option>
												<option value="NH" <?php echo strcasecmp($row['Estate'], "NH") == 0 ? "Selected" : ""; ?>>NH</option>
												<option value="NJ" <?php echo strcasecmp($row['Estate'], "NJ") == 0 ? "Selected" : ""; ?>>NJ</option>
												<option value="NM" <?php echo strcasecmp($row['Estate'], "NM") == 0 ? "Selected" : ""; ?>>NM</option>
																										  
												<option value="NV" <?php echo strcasecmp($row['Estate'], "NV") == 0 ? "Selected" : ""; ?>>NV</option>
												<option value="NY" <?php echo strcasecmp($row['Estate'], "NY") == 0 ? "Selected" : ""; ?>>NY</option>
												<option value="OH" <?php echo strcasecmp($row['Estate'], "OH") == 0 ? "Selected" : ""; ?>>OH</option>
												<option value="OK" <?php echo strcasecmp($row['Estate'], "OK") == 0 ? "Selected" : ""; ?>>OK</option>
																										  
												<option value="OR" <?php echo strcasecmp($row['Estate'], "OR") == 0 ? "Selected" : ""; ?>>OR</option>
												<option value="PA" <?php echo strcasecmp($row['Estate'], "PA") == 0 ? "Selected" : ""; ?>>PA</option>
												<option value="RI" <?php echo strcasecmp($row['Estate'], "RI") == 0 ? "Selected" : ""; ?>>RI</option>
												<option value="SC" <?php echo strcasecmp($row['Estate'], "SC") == 0 ? "Selected" : ""; ?>>SC</option>
																										  
												<option value="SD" <?php echo strcasecmp($row['Estate'], "SD") == 0 ? "Selected" : ""; ?>>SD</option>
												<option value="TN" <?php echo strcasecmp($row['Estate'], "TN") == 0 ? "Selected" : ""; ?>>TN</option>
												<option value="TX" <?php echo strcasecmp($row['Estate'], "TX") == 0 ? "Selected" : ""; ?>>TX</option>
												<option value="UT" <?php echo strcasecmp($row['Estate'], "UT") == 0 ? "Selected" : ""; ?>>UT</option>
																										  
												<option value="VA" <?php echo strcasecmp($row['Estate'], "VA") == 0 ? "Selected" : ""; ?>>VA</option>
												<option value="VT" <?php echo strcasecmp($row['Estate'], "VT") == 0 ? "Selected" : ""; ?>>VT</option>
												<option value="WA" <?php echo strcasecmp($row['Estate'], "WA") == 0 ? "Selected" : ""; ?>>WA</option>
												<option value="WI" <?php echo strcasecmp($row['Estate'], "WI") == 0 ? "Selected" : ""; ?>>WI</option>
																										  
												<option value="WV" <?php echo strcasecmp($row['Estate'], "WV") == 0 ? "Selected" : ""; ?>>WV</option>
												<option value="WY" <?php echo strcasecmp($row['Estate'], "WY") == 0 ? "Selected" : ""; ?>>WY</option>
											</select>
											<br>
											<span id="eventForm_Estate_errorloc" class="error"></span>
										</div>
									</div>
									
									<div class="type" id="Ezip">
										<h5 for="Ezip">ZIP</h5>
											<input type="text" name="Ezip" placeholder="12345" title="Enter the Zip code of the Event" id="Ezip" value="<?PHP echo $row['Ezip']; ?>" maxlength="50"><br>
										<span id="eventForm_Ezip_errorloc" class="error"></span>
									</div>						
								</div>
							
								<div class="wrap">
									<div class="type" id="EphoneNumber" >
										<h5 for="EphoneNumber">Phone Number</h5>
										<input type='tel' name="EphoneNumber" id="EphoneNumber" pattern='\d{3}[\-]\d{3}[\-]\d{4}' value="<?PHP echo $row['EphoneNumber']; ?>" title='Phone Number (Format: 999-999-9999)' maxlength="12" placeholder="999-999-9999"><br>
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
												<input type="time" name="EtimeStart" placeholder="" id="EtimeStart" value="<?PHP echo date("H:i", strtotime($row['EtimeStart'])); ?>" maxlength="50"><br>
												<span id="eventForm_EtimeStart_errorloc" class="error"></span>
											</div>
										</div>
									</div>
								
									<!--End Time  -->
									<div class="type">
										<div class="container" id="EtimeEnd">
											<h5 for="EtimeEnd">End Time</h5>
											<input type="time" name="EtimeEnd" placeholder="" id="EtimeEnd" value="<?PHP echo date("H:i", strtotime($row['EtimeEnd'])); ?>" maxlength="50"><br>
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
											<input type="date" name="EstartDate" placeholder="12/22/2015" title="Pick Start Date" id="EstartDate" value="<?PHP echo $row['EstartDate']; ?>" maxlength="50"><br>
											<span id="eventForm_EstartDate_errorloc" class="error"></span>
										</div>
									</div>	

									<div class="type">
										<!--End Date picker-->
										<div class="container" id="">
											<h5 for="EendDate">End Date</h5>
											<input type="date" name="EendDate" placeholder="12/31/2015" title="Pick Start Date" id="EendDate" value="<?PHP echo $row['EendDate']; ?>" maxlength="50"><br>
											<span id="eventForm_EendDate_errorloc" class="error"></span>
										</div>
									</div>	
									
									<div class="clear"></div>
									
									<div class="type" id="Ewebsite" >
										<h5 for="Ewebsite">Website</h5>
										<input type="text" name="Ewebsite" placeholder="http://www.website.com" title="correct format: http://www.website.com" id="Ewebsite" value="<?PHP echo $row['Ewebsite']; ?>" maxlength="50"><br>
										<span id="event_Ewebsite_errorloc" class="error"></span>
									</div>
									
									<div class="type" id="Efacebook" >
										<h5 for="Efacebook">Facebook</h5>
										<input type="text" name="Efacebook" placeholder="https://www.facebook.com/USERNAME" title="?" id="Efacebook" value="<?PHP echo $row['Efacebook']; ?>" maxlength="50"><br>
										<span id="event_Efacebook_errorloc" class="error"></span>
									</div>
									
									<div class="type" id="Egoogle" >
										<h5 for="Egoogle">Google+</h5>
										<input type="text" name="Egoogle" placeholder="https://plus.google.com/USERNAME" title="?" id="Egoogle" value="<?php echo $row['Egoogle'] ?>" maxlength="50"><br>
										<span id="event_Egoogle_errorloc" class="error"></span>
									</div>
									
									<div class="type" id="Etwitter" >
										<h5 for="Etwitter">Twitter</h5>
										<input type="text" name="Etwitter" placeholder="@USERNAME" title="?" id="Etwitter" value="<?php echo $row['Etwitter']; ?>" maxlength="50"><br>
										<span id="event_Etwitter_errorloc" class="error"></span>
									</div>
									
									<div class="type" id="Ehashtag">
										<h5 for="Ehashtag">Hashtag</h5>
										<input type="text" name="Ehashtag" placeholder="https://instagram.com/USERNAME" title="#hello" id="Ehashtag" value="<?php echo $row['Ehashtag']; ?>" maxlength="50"><br>
										<span id="event_Ehashtag_errorloc" class="error"></span>
									</div>
								</div>
							</div>
							<div class="clear"></div>
						</div><!--End of Form-wrap-->
						
						<!--Submit Button-->
						<div class="submitButton">
							<input type="submit" name="Submit" value="Update Event" />
						</div>
					</div> <!-- End of content -->
				
				</div>
			<?php } ?>
		</form>
		
		<div class="links">
			<?PHP include './links.php'; ?>
		</div>
		
		<div class="footer">
			<?PHP include './footer.php'; ?>
		</div>
	</body>
</html>