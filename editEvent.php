<?PHP
	require_once("./include/membersite_config.php");
	include 'dbconnect.php';
	
	/*This part ckecks whether there is a session or not.*/
	if(!$fgmembersite->CheckSession()){
		$fgmembersite->RedirectToURL("loginB.php");
		exit;
	}
	
	if($fgmembersite->CheckSession()){
		$usrname = $fgmembersite->UsrName();  
	}
	
	$editSQL = "SELECT * FROM Events WHERE Eid = '" . $_GET['eid'] . "'"; //works fine
	$edit = mysqli_query($con, $editSQL);
	
	$today = Date("m/d/Y");
	$upcomingSQL = "SELECT * FROM Events WHERE EstartDate >= '".$today."' AND UuserName = '".$usrname."' AND Edisplay='1' ORDER BY EstartDate";
	$upcoming = mysqli_query($con, $upcomingSQL);
	
	$pastSQL = "SELECT * FROM Events WHERE EstartDate < '".$today."' AND UuserName = '".$usrname."' AND Edisplay='1' ORDER BY EstartDate";
	$past = mysqli_query($con, $pastSQL);
	
	if(isset($_POST["submitted"])){
		if($fgmembersite->updateEvent()){
			//we should be redirecting the user once they have submitted the edited event.
			$fgmembersite->redirectToEvent();
		}
	}
?>

<html lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
		
		<title>Eventprobe</title>
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link rel="stylesheet" media="all" href=""/>
		<!-- Adding "maximum-scale=1" fixes the Mobile Safari auto-zoom bug: http://filamentgroup.com/examples/iosScaleBug/ -->
        
        <!--STYLE-->
        <link rel="stylesheet" type="text/css" href="./css/editEvent.css" />
        <link rel="stylesheet" type="text/css" href="./css/header.css" />
        <link rel="stylesheet" type="text/css" href="./css/links.css" />
        <link rel="stylesheet" type="text/css" href="./css/footer.css" />

        <!--FAVICON-->
        <link rel="shortcut icon" href="favicon.ico"  />

		<!--(Start) Scripts-->
			<script type="text/javascript" src="scripts/gen_validatorv31.js"></script>
			
			<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
			
			<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
			<script type="text/javascript" src="js/jquery-ui.js"></script>
			<script type="text/javascript" src="js/scripts.js"></script>
			<script type="text/javascript" src="js/formatPhone.js"></script>
			
			<!--(Start) Counts the number of characters-->
				<script type="text/javascript">
					function textCounter(field, cnt, maxlimit){
						var cntfield = document.getElementById(cnt)
						if (field.value.length > maxlimit) // if too long...trim it!
							field.value = field.value.substring(0, maxlimit);
						// otherwise, update 'characters left' counter
						else
							//cntfield.value = maxlimit - field.value.length;
							document.getElementById(cnt).innerHTML = maxlimit - field.value.length;
					}
				</script>
			<!--(End) Counts the number of characters-->
			
			<!--(Start) Script to show whether the event is 'Other'-->
				<script type="text/javascript">
					$(document).ready(function(){
						$("#other").hide();
						$("#Etype").change(function(){
							$("#Etype option:selected").each(function(){
								if($(this).attr("value") == "Other"){
									$("#other").show();
								} else {
									$("#other").hide();
								}
							});
						}).change();
					});
				</script>
			<!--(End) Script to show whether the event is 'Other'-->

			<!--Redirects the user to the edit page.-->
			<script>
				function editInfo(str){
					window.location = "./editEvent.php?eid="+str;
				}
			</script>
		<!--(End) Scripts-->
	</head>
	
	<body lang="en">
		<div class="header">
			<?PHP include './header.php';?>
		</div>

		<div class="editEvent">
			<div class="sidebar">
			<br><br>
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
										  $count = 1;
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
												case "Art":            $Etype = "icon_artEvent"  ; break;
												case "Concert":        $Etype = "icon_concert"   ; break;
												case "Fair":           $Etype = "icon_festival"  ; break;
												case "Social":         $Etype = "icon_kettleball"; break;
												case "Sport":          $Etype = "icon_marathon"  ; break;
												case "Public Speaker": $Etype = "icon_speaker"   ; break;
												default:               $Etype = "icon_fireworks" ; break;
											}
											?>
											<li>
												<img src="images/<?php echo $Etype; ?>.png" alt="<?PHP echo $Etype; ?>" />
												<a onClick="editInfo(<?= $row['Eid'] ?>);">
													<?PHP //echo $count; ?>
													<?= substr($row['Evename'], 0, 12) . "..."; ?>,
													<?= $month ?> 
													<?= substr($EstartDate, 3, 2); ?>
												</a>
											</li>
										<?PHP $i++;
											  $count++;
										} ?>
								</ul>
							</li>
							
							<li>
								<h3>Past</h3>
								<ul>
									<?PHP $i = 0;
										  $count = 1;
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
												case "Art":            $Etype = "icon_artEvent"  ; break;
												case "Concert":        $Etype = "icon_concert"   ; break;
												case "Fair":           $Etype = "icon_festival"  ; break;
												case "Social":         $Etype = "icon_kettleball"; break;
												case "Sport":          $Etype = "icon_marathon"  ; break;
												case "Public Speaker": $Etype = "icon_speaker"   ; break;
												default:               $Etype = "icon_fireworks" ; break;
											}
											?>
											<li>
												<img src="images/<?php echo $Etype; ?>.png" alt="<?PHP echo $Etype; ?>" />
												<a onClick="seeMoreInfo(<?= $row['Eid'] ?>);">
													<?PHP //echo $count; ?>
													<?= substr($row['Evename'], 0, 12) . "..."; ?>,
													<?= $month ?> 
													<?= substr($EstartDate, 3, 2); ?>
												</a>
											</li>
										<?PHP $i++; 
											  $count++; 
										} ?>
								</ul>
							</li>
						</ul>
					</li>
				</ul>
			</div><!--End of Sidebar-->
			
			<div class="content">
				<form id="eventForm" action="<?php echo $fgmembersite->GetSelfScript(); ?>" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" onsubmit="return confirm('Do you wish to delete?');">
					<?PHP while($row = mysqli_fetch_array($edit)){ ?>
						<input type="hidden" name="submitted" id="submitted" value="1" />
						<input type="hidden" name="Eid" id="Eid" value="<?PHP echo $_GET['eid']; ?>" />
						
						<div><span class="error"><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
					
						<div class="form-wrap">
							<!--Upload picture-->
							<div class="user-profile">
								<div class="update-image">
									<!--added the 'value' to reflect the value from the DB based on the 'Eid' (event id)-->
									<?PHP 
										$type = $row['Etype'];
										if($row['Eflyer'] === ""){
											switch($type){
												case "Art":            $row['Eflyer'] = "./images/icon_artEventHD.png"; break;
												case "Concert":        $row['Eflyer'] = "./images/icon_concertHD.png"; break;
												case "Fair":           $row['Eflyer'] = "./images/icon_festivalHD.png"; break;
												case "Social":         $row['Eflyer'] = "./images/icon_kettleballHD.png"; break;
												case "Sport":          $row['Eflyer'] = "./images/icon_marathonHD.png"; break;
												case "Public Speaker": $row['Eflyer'] = "./images/icon_speakerHD.png"; break;
												default:               $row['Eflyer'] = "./images/icon_fireworksHD.png"; break;
											}
										}
									?>
									<input id="uploadImage" accept="image/*" value="<?php echo $row['Eflyer']; ?>" type="file" name="Eflyer" onchange="PreviewImage();" /><br>
									<span id="eventForm_Eflyer_errorloc" class="error"></span>
								</div>
								<img id="uploadPreview" src="<?php echo $row['Eflyer']; ?>" style="width: 270px; height: 250px;"/>
								<!-- <img src="images/profile-img.jpg" alt="Profiles"> -->
							</div>
								
							<div class="user-form-top">
								<div class="box-top">
									<div class="nameEvent">
										<!--Event Name "Evename"-->
										<h5 for="Evename">Name of event</h5>
										<!--<div class="image"><img src="images/icon_location.png" /></div> -->
										<input type="text" onkeyup="textCounter(this, 'charsLeftName', 85)" name="Evename" placeholder="Enter The Name Event" id="Evename" value="<?php echo $row['Evename']; ?>">
										<div style="color: red; font-size: 12pt; font-style: italic;" id="charsLeftName" value="85"> 85 Characters Max</div>
										<span id="eventForm_Evename_errorloc" class="error"></span>
									</div>
									
									<!--Event type "Etype"-->
									<div class="typeEvent">
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
									
									<!--Event other option "Eother"-->
									<div class="typeOther">
										<label for="Eother">Other: </label><br>
										<input type="text" name="Eother" title="Enter Other Kind of Event" id="Eother" value="<?php echo $row['Eother']; ?>" maxlength="50"><br>
										<span id="event_Eother_errorloc" class="error"></span>
									</div>
										
									<!--Event rank "Erank"-->
									<div class="adPlacement">
										<h5 for="Erank">Ad Placement</h5>
										<select name="Erank" id="Erank">
											<option value="" disabled selected>Please Select a Rank</option>
											<option value="Free"    <?php echo strcasecmp($row['Erank'], "Premium") == 0    ? "Selected" : ""; ?>>Premium</option>
											<option value="Paid"    <?php echo strcasecmp($row['Erank'], "Paid") == 0    ? "Selected" : ""; ?>>Paid</option>
											<option value="Premium" <?php echo strcasecmp($row['Erank'], "Free") == 0 ? "Selected" : ""; ?>>Free</option>
										</select><br>
										<span id="eventForm_Erank_errorloc" class="error"></span>
									</div>
										
									<div class="reach">
									<!--<h3>Increase your reach!</h3>
										<a href="#"><img src="images/btn_upgrade.png" alt="Upgrade" /></a>-->
									</div>
										
									<div class="clear"></div>
									
									<div class="saved">
									<!--<div class="box"><h3>Saved</h3></div>
										<div class="box"><a href="#"><img src="images/btn_draft.png" alt="Draft" /></a></div>
										<div class="box"><a href="#"><img src="images/btn_publish.png" alt="Draft" /></a></div>-->
										<div class="clear"></div>
									</div>
								</div>
								<div class="clear"></div>
							</div>
							
							<div class="user-form-bottom">
								<div class="box-bottom">
									<div class="descEvent">
										<h5 for="Edescription">Description</h5>
										<textarea onkeyup="textCounter(this,'charsLeftText', 500)" title="Enter Your Description" rows="3" cols="30" name="Edescription" id="Edescription"><?PHP echo $row['Edescription']; ?></textarea>
										<div style="color: red; font-size: 12pt; font-style: italic;" id="charsLeftText" value="500"> 500 Characters Max</div>
										<span id="eventForm_Edescription_errorloc" class="error"></span>
									</div>
								
									<div class="locEvent">
										<h5 for="Eaddress">Address</h5>
										<input type="text" name="Eaddress" placeholder="123 Main road" title="Enter the Address of the Event" id="Eaddress" value="<?PHP echo $row['Eaddress']; ?>" maxlength="50"><br>
										<span id="eventForm_Eaddress_errorloc" class="error"></span>
									</div>
									
									<div class="cityEvent">
										<h5 for="Ecity">City</h5>
										<input type="text" name="Ecity" placeholder="City" title="Enter the City of the Event" id="Ecity" value="<?PHP echo $row['Ecity']; ?>" maxlength="50"><br>
										<span id="eventForm_Ecity_errorloc" class="error"></span>
									</div>
										
									<div class="stEvent">
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
										
									<div class="zipEvent">
										<h5 for="Ezip">ZIP</h5>
										<input type="text" name="Ezip" placeholder="12345" title="Enter the Zip code of the Event" id="Ezip" value="<?PHP echo $row['Ezip']; ?>" maxlength="50"><br>
										<span id="eventForm_Ezip_errorloc" class="error"></span>
									</div>
									
									<div class="phoneEvent">
										<h5 for="EphoneNumber">Phone Number</h5>
										<input type='tel' name="EphoneNumber" id="EphoneNumber"  value="<?PHP echo $row['EphoneNumber']; ?>" title='Phone Number (Format: (999) 999-9999)' maxlength="16" placeholder="(999) 999-9999" onkeydown="javascript:backspacerDOWN(this, event);" onkeyup="javascript:backspacerUP(this, event);"><br> 
										<span id="eventForm_EphoneNumber_errorloc" class="error"></span>
									</div>
									
									<!--Start Time-->
									<div class="sTimeEvent">
										<h5 for="EtimeStart">Start Time</h5>
										<input type="time" name="EtimeStart" placeholder="" id="EtimeStart" value="<?PHP echo date("H:i", strtotime($row['EtimeStart'])); ?>" maxlength="50"><br>
										<span id="eventForm_EtimeStart_errorloc" class="error"></span>
									</div>
								
									<!--End Time-->
									<div class="eTimeEvent">
										<h5 for="EtimeEnd">End Time</h5>
										<input type="time" name="EtimeEnd" placeholder="" id="EtimeEnd" value="<?PHP echo date("H:i", strtotime($row['EtimeEnd'])); ?>" maxlength="50"><br>
										<span id="eventForm_EtimeEnd_errorloc" class="error"></span>
									</div>
									
									<div class="eStartDate">
										<h5 for="EstartDate">Start Date</h5>
										<input type="date" name="EstartDate" placeholder="12/22/2015" title="Pick Start Date" id="EstartDate" value="<?PHP echo $row['EstartDate']; ?>" maxlength="50"><br>
										<span id="eventForm_EstartDate_errorloc" class="error"></span>
									</div>	

									<!--End Date picker-->
									<div class="eEndDate">
										<h5 for="EendDate">End Date</h5>
										<input type="date" name="EendDate" placeholder="12/31/2015" title="Pick Start Date" id="EendDate" value="<?PHP echo $row['EendDate']; ?>" maxlength="50"><br>
										<span id="eventForm_EendDate_errorloc" class="error"></span>
									</div>
									
									<div class="webEvent">
										<h5 for="Ewebsite">Website</h5>
										<input type="text" name="Ewebsite" placeholder="http://www.website.com" title="correct format: http://www.website.com" id="Ewebsite" value="<?PHP echo $row['Ewebsite']; ?>" maxlength="50"><br>
										<span id="event_Ewebsite_errorloc" class="error"></span>
									</div>
									
									<div class="fbEvent">
										<h5 for="Efacebook">Facebook</h5>
										<input type="text" name="Efacebook" placeholder="https://www.facebook.com/USERNAME" title="?" id="Efacebook" value="<?PHP echo $row['Efacebook']; ?>" maxlength="50"><br>
										<span id="event_Efacebook_errorloc" class="error"></span>
									</div>
									
									<div class="gooEvent">
										<h5 for="Egoogle">Google+</h5>
										<input type="text" name="Egoogle" placeholder="https://plus.google.com/USERNAME" title="?" id="Egoogle" value="<?php echo $row['Egoogle'] ?>" maxlength="50"><br>
										<span id="event_Egoogle_errorloc" class="error"></span>
									</div>
									
									<div class="twEvent">
										<h5 for="Etwitter">Twitter</h5>
										<input type="text" name="Etwitter" placeholder="@USERNAME" title="?" id="Etwitter" value="<?php echo $row['Etwitter']; ?>" maxlength="50"><br>
										<span id="event_Etwitter_errorloc" class="error"></span>
									</div>
									
									<div class="hashEvent">
										<h5 for="Ehashtag">Hashtag</h5>
										<input type="text" name="Ehashtag" placeholder="https://instagram.com/USERNAME" title="#hello" id="Ehashtag" value="<?php echo $row['Ehashtag']; ?>" maxlength="50"><br>
										<span id="event_Ehashtag_errorloc" class="error"></span>
									</div>
								</div>
								<div class="clear"></div>
							</div><!--End of Form-wrap-->

							<!--Submit Button-->
							<div class="submitButton">
								<input type="image" name="Submit" src="./images/btn_update.png" value="" />
							</div>
						<div class="clear"></div>
						</div> <!-- End of content -->
					<?php } ?>
				</form>
			</div> <!-- End of content -->
		</div><!-- End of Main -->
		
		<div class="links">
			<?PHP include './links.php'; ?>
		</div>
		
		<div class="footer">
			<?PHP include './footer.php'; ?>
		</div>
		
		<!--This script needs to wihtin the file. 
		It is validating the form.-->
		<script type="text/javascript">
			// <![CDATA[
			var frmvalidator = new Validator("eventForm");
			frmvalidator.EnableOnPageErrorDisplay();
			frmvalidator.EnableMsgsTogether();
			
			//frmvalidator.addValidation("Eflyer",       "req", "Please Insert an Image");
			frmvalidator.addValidation("Evename",      "req", "Please fill in Event Name");
			frmvalidator.addValidation("Etype",        "req", "Please fill in Type of Event");
			frmvalidator.addValidation("Erank",        "req", "Please fill in the Rank");
			frmvalidator.addValidation("Edescription", "req", "Please fill in Description");
			frmvalidator.addValidation("Eaddress",     "req", "Please fill in address");
			frmvalidator.addValidation("Ecity",        "req", "Please fill in City");
			frmvalidator.addValidation("Estate",       "req", "Please fill in State");
			frmvalidator.addValidation("Ezip",         "req", "Please fill in Zip code");
			frmvalidator.addValidation("EphoneNumber", "req", "Please fill in Phone Number");
			frmvalidator.addValidation("EtimeStart",   "req", "Please fill in the Start Time");
			frmvalidator.addValidation("EtimeEnd",     "req", "Please fill in the End Time");
			frmvalidator.addValidation("EstartDate",   "req", "Please Select a Start Date");
			frmvalidator.addValidation("EendDate",     "req", "Please Select an End Date");
			// ]]>
		</script>
		
		<script type="text/javascript">
    		function PreviewImage() {
       		var oFReader = new FileReader();
        	oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

       		oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        		};
   			 };
		</script>
	</body>
</html>