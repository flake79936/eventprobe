<?PHP
	require_once("./include/membersite_config.php");
	include 'dbconnect.php';
	
	/*This part ckecks whether there is a session or not.*/
	if(!$fgmembersite->CheckSession()){
		$fgmembersite->RedirectToURL("login.php");
		exit;
	}
	
	if($fgmembersite->CheckSession()){
		$usrname = $fgmembersite->UsrName();  
	}
	
	$editSQL = "SELECT * FROM Events WHERE Eid = '" . $_GET['eid'] . "'"; //works fine
	$edit = mysqli_query($con, $editSQL);
	
	$minDate = date("Y-m-d");
	
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
		
        <!--STYLE-->
        <link rel="stylesheet" type="text/css" href="./css/editEvent.css" />
        <link rel="stylesheet" type="text/css" href="./css/header.css" />
        <link rel="stylesheet" type="text/css" href="./css/links.css" />
        <link rel="stylesheet" type="text/css" href="./css/footer.css" />
        <link rel="stylesheet" type="text/css" href="./css/jquery-ui.css" />

        <!--FAVICON-->
        <link rel="shortcut icon" href="favicon.ico"/>
		
		<!--(Start) Scripts-->
		<script type="text/javascript" src="scripts/gen_validatorv31.js"></script>
		
		<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">-->
		
		<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
		<script type="text/javascript" src="./js/jquery-ui.js"></script>
		<script type="text/javascript" src="./js/scripts.js"></script>
		<script type="text/javascript" src="./js/formatPhone.js"></script>
		
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
					
					// shows/hides the "upload image" input box
					$(".user-banner").hide();
					$(".payPalBtn").hide();
					$("#Erank").change(function(){
						$("#Erank option:selected").each(function(){
							if($(this).attr("value") == "Premium"){
								//should show only 
								// the banner image input box
								// the paypal buttons
								$(".user-banner").show();
								$(".payPalBtn").show();
								$(".submitButton").hide();
							} else {
								$(".user-banner").hide();
								$(".payPalBtn").hide();
								$(".submitButton").show();
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
		
		<script>
			$(function(){
				$( "#datepicker" ).datepicker({ minDate: 0, maxDate: "+1M +10D" });
			});
		</script>
	<!--(End) Scripts-->
	</head>
	
	<body lang="en">
		<?php include_once("analyticstracking.php") ?>
	
	
		<div class="header">
			<?PHP include './header.php';?>
		</div>

		<div class="editEvent">
			<div class="sidebar">
			<br><br>
				<ul id="accordion" class="menu">	
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
												<img src="./images/w65/<?php echo $Etype; ?>.png" alt="<?PHP echo $Etype; ?>" />
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
												<img src="./images/w65/<?php echo $Etype; ?>.png" alt="<?PHP echo $Etype; ?>" />
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
								<h5>Flyer</h5>
								<img id="uploadPreview" src="<?php echo $row['Eflyer']; ?>"/>
							</div>
								
							<div class="user-form-top">
								<div class="box-top">
									<div class="nameEvent">
										<!--Event Name "Evename"-->
										<h5 for="Evename">Name of event</h5>
										<div><?php echo $row['Evename']; ?></div>
									</div>
									
									<!--Event type "Etype"-->
									<div class="typeEvent">
										<h5 for="Etype">Type of Event</h5>
										<div><?php echo $row['Etype']; ?></div>
									</div>
									
									<!--Event other option "Eother"-->
									<div class="typeOther">
										<label for="Eother">Other: </label><br>
										<div><?php echo $row['Eother']; ?></div>
									</div>
										
									<!--Event rank "Erank"-->
									<div class="adPlacement">
										<h5 for="Erank">Ad Placement</h5>
										<select name="Erank" id="Erank" disabled>
											<option value="" disabled selected>Please Select a Rank</option>
											<option value="Premium" <?php echo strcasecmp($row['Erank'], "Premium") == 0 ? "Selected" : ""; ?>>Premium</option>
											<option value="Paid"    <?php echo strcasecmp($row['Erank'], "Paid")    == 0 ? "Selected" : ""; ?>>Paid</option>
											<option value="Free"    <?php echo strcasecmp($row['Erank'], "Free")    == 0 ? "Selected" : ""; ?>>Free</option>
										</select><br>
										<span id="eventForm_Erank_errorloc" class="error"></span>
									</div>
									
									<div class="descEvent">
										<h5 for="Edescription">Description</h5>
										<div><?PHP echo $row['Edescription']; ?></div>
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
								
									<div class="user-banner">
										<h5>Banner Image</h5>
										<img id="uploadBanner" src="<?php echo $row['Ebanner']; ?>"/>
									</div>
									
									<div class="locEvent">
										<h5 for="Eaddress">Address</h5>
										<div><?PHP echo $row['Eaddress']; ?></div>
									</div>
									
									<div class="cityEvent">
										<h5 for="Ecity">City</h5>
										<div><?PHP echo $row['Ecity']; ?></div>
									</div>
										
									<div class="stEvent">
										<h5 for="Estate">State</h5>
										<div><?php echo $row['Estate']; ?></div>
									</div>
										
									<div class="zipEvent">
										<h5 for="Ezip">ZIP</h5>
										<div><?PHP echo $row['Ezip']; ?></div>
									</div>
									
									<div class="phoneEvent">
										<h5 for="EphoneNumber">Phone Number</h5>
										<div><?PHP echo $row['EphoneNumber']; ?></div>
									</div>
									
									<div class="eStartDate">
										<h5 for="EstartDate">Start Date</h5>
										<div><?PHP echo $row['EstartDate']; ?></div>
									</div>
									
									<!--Start Time-->
									<div class="sTimeEvent">
										<h5 for="EtimeStart">Start Time</h5>
										<div><?PHP echo date("H:i", strtotime($row['EtimeStart'])); ?></div>
									</div>
								
									<!--End Time-->
									<div class="eTimeEvent">
										<h5 for="EtimeEnd">End Time</h5>
										<div><?PHP echo date("H:i", strtotime($row['EtimeEnd'])); ?></div>
									</div>
									
									<!--End Date picker-->
<!-- 
									<div class="eEndDate">
										<h5 for="EendDate">End Date</h5>
										<input type="date" name="EendDate" placeholder="12/31/2015" title="Pick Start Date" id="EendDate" value="<?PHP echo $row['EendDate']; ?>" maxlength="50"><br>
										<span id="eventForm_EendDate_errorloc" class="error"></span>
									</div>
 -->
									
									<div class="webEvent">
										<h5 for="Ewebsite">Website</h5>
										<div><?PHP echo $row['Ewebsite']; ?></div>
									</div>
									
									<div class="fbEvent">
										<h5 for="Efacebook">Facebook</h5>
										<div><?PHP echo $row['Efacebook']; ?></div>
									</div>
									
									<div class="gooEvent">
										<h5 for="Egoogle">Google+</h5>
										<div><?php echo $row['Egoogle'] ?></div>
									</div>
									
									<div class="twEvent">
										<h5 for="Etwitter">Twitter</h5>
										<div><?php echo $row['Etwitter']; ?></div>
									</div>
									
									<div class="hashEvent">
										<h5 for="Ehashtag">Hashtag</h5>
										<div><?php echo $row['Ehashtag']; ?></div>
									</div>
								</div>
								<div class="clear"></div>
							</div><!--End of Form-wrap-->

							<!--Submit Button-->
							<div class="submitButton">
								<input type="image" name="Submit" src="./images/btn_update.png" value="" />
							</div>
							
							<div class="payPalBtn">
								<input type="image" name="submit" src="./images/checkout-logo-medium.png" alt="Check out with PayPal" />
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
			}
		</script>
		
		<script type="text/javascript">
			function banImage(){
				var oFReaderz = new FileReader();
				oFReaderz.readAsDataURL(document.getElementById("bannerImage").files[0]);

				oFReaderz.onload = function (oFREventz){
					document.getElementById("uploadBanner").src = oFREventz.target.result;
				};
				
				/*This portion is not functional yet
				var img = new Image();

				img.onload = function(){
				  var height = img.height;
				  var width = img.width;

				  if(){
					  //todo
				  }
				};
				This portion is not functional yet*/
   			}
		</script>
	</body>
</html>