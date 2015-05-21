<?PHP
	require_once("./include/membersite_config.php");
	include 'dbconnect.php';
	
	if($fgmembersite->CheckSession()){
		$usrname = $fgmembersite->UsrName();  
	}

	/*This part ckecks whether there is a session or not.*/
		if(!$fgmembersite->CheckSession()){
			$fgmembersite->RedirectToURL("login.php");
			exit;
	}
	
	if(isset($_POST["submitted"])){
		if($fgmembersite->CreateEvent()){
			$fgmembersite->redirectToEvent();
		}
	}
	
	$minDate = date("Y-m-d");
	
	$today = Date("m/d/Y");
	$sql = "SELECT * FROM Events WHERE EstartDate < '".$today."' AND UuserName = '".$usrname."' AND Edisplay='1' ORDER BY EstartDate";
	
	$past = mysqli_query($con, $sql);
	$sql = "SELECT * FROM Events WHERE EstartDate >= '".$today."' AND UuserName = '".$usrname."' AND Edisplay='1' ORDER BY EstartDate";
	
	$upcoming = mysqli_query($con, $sql);
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
        <link rel="stylesheet" type="text/css" href="./css/eventCrt.css" />
        <link rel="stylesheet" type="text/css" href="./css/header.css" />
        <link rel="stylesheet" type="text/css" href="./css/links.css" />
        <link rel="stylesheet" type="text/css" href="./css/footer.css" />
        <link rel="stylesheet" type="text/css" href="./css/jquery-ui.css" />
		
		<link rel="stylesheet" href="/resources/demos/style.css">
		
        <!--FAVICON-->
        <link rel="shortcut icon" href="favicon.ico"  />

		<!--(Start) Scripts-->
			<script type="text/javascript" src="scripts/gen_validatorv31.js"></script>
			
			<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">-->
			
			<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
			<script type="text/javascript" src="./js/jquery-ui.js"></script>
			<script type="text/javascript" src="./js/scripts.js"></script>
			<script type="text/javascript" src="./js/formatPhone.js"></script>
			
			<!--(Start) Script to show whether the event is 'Other'-->
				<script type="text/javascript">
					$(document).ready(function(){
						$(".typeOther").hide();
						$("#Etype").change(function(){
							$("#Etype option:selected").each(function(){
								if($(this).attr("value") == "Other"){
									$(".typeOther").show();
								} else {
									$(".typeOther").hide();
								}
							});
						}).change();
					});
				</script>
			<!--(End) Script to show whether the event is 'Other'-->
			
			<!--(Start) Counts the number of characters-->
				<script type="text/javascript">
					//counts for the text area tag
					function textCounter(field, cnt, maxlimit) {         
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
			
			<!--onclick it will redirect the user to the event display page, displaying the event the user clicked on.-->
			<script>
				function seeMoreInfo(str){
					window.location = "./eventDisplayPage.php?eid="+str;
				}
			</script>
			
			<script type="text/javascript">
				function checkDates(){
					//var minDate = document.getElementById("EstartDate").getAttribute("src");
					var minDate = document.getElementById("EstartDate").value;
					var maxDate = document.getElementById("EendDate").value;
					
					if(minDate > maxDate){
						alert("Your dates dont make any senses.\nCheck them again.");
					}
				}
			</script>
			
			<script>
				$(function(){
					$( "#datepicker" ).datepicker();
				});
			</script>
		<!--(End) Scripts-->
	</head>
	
	<body lang="en">
		<div class="header">
			<?PHP include './header.php';?>
		
			<!--<div class="logo">
				<a href="./index2.php"><img src="images/logo.png" onmouseover="this.src='images/logo.jpg'" onmouseout="this.src='images/logo.png'" alt="Logo" />
			</div>
			<div class="profile">
				<div class="user">
					<img src="images/profile.jpg" />
					<h2><?= $usrname?></h2>
					<a href="#"><img src="images/btn_dropdown.png" alt="Dropdown" /></a>
					<div class="clear"></div>
				</div>
				<div class="search">
					<form>
						<input type="text" placeholder="search for events" />
						<input type="image" src="images/btn_search.png" class="btn-search" />
						<div class="clear"></div>
					</form>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>-->
		</div>
		
		<div class="eventCrt">
			<div class="sidebar">
				<ul id="accordion" class="menu">
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
												<img src="./images/w65/<?php echo $Etype; ?>.png" alt="<?PHP echo $Etype; ?>" />
													<a onClick="seeMoreInfo(<?= $row['Eid'] ?>);">
														<?PHP //echo $count; ?>
														<?= substr($row['Evename'], 0, 12) . "..."; ?>, 
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
												<img src="./images/w65/<?php echo $Etype; ?>.png" alt="<?PHP echo $Etype; ?>" />
												<a onClick="seeMoreInfo(<?= $row['Eid'] ?>);">
													<?PHP //echo $count; ?>
													<?= substr($row['Evename'], 0, 12) . "..."; ?>, 
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
				<form id="eventForm" action="<?php echo $fgmembersite->GetSelfScript(); ?>" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" onsubmit="return confirm('Do you wish to delete?');">
					<input type="hidden" name="submitted" id="submitted" value="1"/>
					
					<div><span class="error"><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
					
					<div class="form-wrap">
						<div class="user-profile">
							<div class="update-image">
								<input id="uploadImage" type="file" name="Eflyer" onchange="PreviewImage();" /><br>
								<span id="eventForm_Eflyer_errorloc" class="error"></span>
							</div>
							<img id="uploadPreview" />
						</div>
						
						<div class="user-form-top">
							<div class="box-top">
								<div class="nameEvent">
									<h5 for="Evename">Name of event</h5>
									<input type="text" onkeyup="textCounter(this,'charsLeftName', 85)" name="Evename" placeholder="Enter the Name Event" id="Evename" value="<?php echo $fgmembersite->SafeDisplay('Evename') ?>">
									<div style="color: red; font-size: 12pt; font-style: italic;" id="charsLeftName" value="85"> 85 Characters Max</div>
									<span id="eventForm_Evename_errorloc" class="error"></span>
								</div>
								
								<div class="typeEvent">
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
								
								<div class="typeOther">
									<h5 for="Eother">Other</h5>
									<input type="text" name="Eother" title="Enter Other Kind of Event" id="Eother" value="<?php echo $fgmembersite->SafeDisplay('Eother') ?>" maxlength="50"><br>
									<span id="event_Eother_errorloc" class="error"></span>
								</div>
										
								<div class="adPlacement">
									<h5 for="Erank">Ad Placement</h5>
									<select name="Erank" id="Erank">
										<option value="" disabled selected>Please Select a Rank</option>
										<option value="Premium">Premium</option>
										<option value="Paid">Paid</option>
										<option value="Free">Free</option>
									</select><br>
									<span id="eventForm_Erank_errorloc" class="error"></span>
								</div>
								
								<div class="descEvent">
									<h5 for="Edescription">Description</h5>
									<textarea onkeyup="textCounter(this,'charsLeftText', 500)" title="Enter Your Description" rows="3" cols="30" name="Edescription" id="Edescription" value=""></textarea>
									<div style="color: red; font-size: 12pt; font-style: italic;" id="charsLeftText" value="500"> 500 Characters Max</div>
									<span id="eventForm_Edescription_errorloc" class="error"></span>
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
						</div>
						
						<div class="user-form-bottom">
							<div class="box-bottom">
								<div class="locEvent">
									<h5 for="Eaddress">Address</h5>
									<input type="text" name="Eaddress" placeholder="123 Main road" title="Enter the Address of the Event" id="Eaddress" value="" maxlength="50"><br>
									<span id="eventForm_Eaddress_errorloc" class="error"></span>
								</div>
								
								<div class="cityEvent">
									<h5 for="Ecity">City</h5>
									<input type="text" name="Ecity" placeholder="City" title="Enter the City of the Event" id="Ecity" value="" maxlength="50"><br>
									<span id="eventForm_Ecity_errorloc" class="error"></span>
								</div>
								
								<div class="stEvent">
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
									
								<div class="zipEvent">
									<h5 for="Ezip">ZIP</h5>
									<input type="text" name="Ezip" placeholder="12345" title="Enter the Zip code of the Event" id="Ezip" value="" maxlength="50"><br>
									<span id="eventForm_Ezip_errorloc" class="error"></span>
								</div>
							
								<div class="phoneEvent">
									<h5 for="EphoneNumber">Phone Number</h5>
									<input type='tel' name="EphoneNumber" id="EphoneNumber" title='Phone Number (Format: (999) 999-9999)' maxlength="16" placeholder="(999) 999-9999" onkeydown="javascript:backspacerDOWN(this, event);" onkeyup="javascript:backspacerUP(this, event);"><br>
									<span id="eventForm_EphoneNumber_errorloc" class="error"></span>
								</div>
								
								<!--Start Time-->
								<div class="sTimeEvent">
									<h5 for="EtimeStart">Start Time</h5>
									<input type="time" name="EtimeStart" id="EtimeStart"><br>
									<span id="eventForm_EtimeStart_errorloc" class="error"></span>
								</div>
								
								<!--End Time  -->
								<div class="eTimeEvent">
									<h5 for="EtimeEnd">End Time</h5>
									<input type="time" name="EtimeEnd" id="EtimeEnd"><br>
									<span id="eventForm_EtimeEnd_errorloc" class="error"></span>
								</div>

								<!--Start Date picker-->
								<div class="eStartDate">
									<h5 for="EstartDate">Start Date</h5>
									<input type="text" id="datepicker" name="EstartDate" min="<?PHP echo $minDate; ?>" title="Pick Start Date">
									<br>
									<span id="eventForm_EstartDate_errorloc" class="error"></span>
								</div>
								
								<!--End Date picker-->
								<!--<div class="eEndDate">
									<h5 for="EendDate">End Date</h5>
									<input onchange="checkDates();" type="date" name="EendDate" min="<?PHP echo $minDate; ?>" title="Pick Start Date" id="EendDate"><br>
									<span id="eventForm_EendDate_errorloc" class="error"></span>
								</div>-->
								
								<div class="webEvent">
									<h5 for="Ewebsite">Website</h5>
									<input type="url" name="Ewebsite" pattern="https?://.+" title="URLs only" placeholder="http://www.website.com" title="correct format: http://www.website.com" id="Ewebsite" value="<?php echo $fgmembersite->SafeDisplay('Ewebsite') ?>" maxlength="50"><br>
									<span id="event_Ewebsite_errorloc" class="error"></span>
								</div>
									
								<div class="fbEvent">
									<h5 for="Efacebook">Facebook</h5>
									<input type="url" name="Efacebook" pattern="https?://www.facebook.com/.+" title="Facebook URLs only" placeholder="https://www.facebook.com/USERNAME" id="Efacebook" value="<?php echo $fgmembersite->SafeDisplay('Efacebook') ?>" maxlength="50"><br>
									<span id="event_Efacebook_errorloc" class="error"></span>
								</div>
									
								<div class="gooEvent">
									<h5 for="Egoogle">Google+</h5>
									<input type="url" name="Egoogle" pattern="https?://plus.google.com/.+" title="Google+ URLs only" placeholder="https://plus.google.com/USERNAME" id="Egoogle" value="<?php echo $fgmembersite->SafeDisplay('Egoogle') ?>" maxlength="50"><br>
									<span id="event_Egoogle_errorloc" class="error"></span>
								</div>
									
								<div class="twEvent">
									<h5 for="Etwitter">Twitter</h5>
									<input type="text" name="Etwitter" pattern="https?://twitter.com/.+" title="Twitter URLs only" placeholder="https://twitter.com/username" id="Etwitter" value="<?php echo $fgmembersite->SafeDisplay('Etwitter') ?>" maxlength="50"><br>
									<span id="event_Etwitter_errorloc" class="error"></span>
								</div>
									
								<div class="hashEvent">
									<h5 for="Ehashtag">Hashtag</h5>
									<input type="text" name="Ehashtag" pattern="#.{1,}" title="#hello" placeholder="#hashtag" id="Ehashtag" value="<?php echo $fgmembersite->SafeDisplay('Ehashtag') ?>" maxlength="50"><br>
									<span id="event_Ehashtag_errorloc" class="error"></span>
								</div>
								<div class="clear"></div>
							</div>
						</div>
						
						<!--Submit Button-->
						<div class="submitButton">
							<input type="image" name="Submit" src="./images/btn_submit.png" value="" />
						</div>
						<div class="clear"></div>
					</div><!--End of Form-wrap-->
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
			//frmvalidator.addValidation("EtimeEnd",     "req", "Please fill in the End Time");
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