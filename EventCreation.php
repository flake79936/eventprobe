<?PHP
	require_once("./include/membersite_config.php");
	if($fgmembersite->CheckSession()){
		$usrname = $fgmembersite->UsrName();  
	}

	/*This part ckecks whether there is a session or not.*/
		if(!$fgmembersite->CheckSession()){
			$fgmembersite->RedirectToURL("loginB.php");
			exit;
	}
	
	if(isset($_POST["submitted"])){
		if($fgmembersite->CreateEvent()){
			$fgmembersite->RedirectToURL("event_thank_you.php");
		}
	}
	
	include 'dbconnect.php';

	$today = Date("m/d/Y");
	$sql = "SELECT * FROM Events WHERE EstartDate < '".$today."' AND UuserName = '".$usrname."' AND Edisplay='1' ORDER BY EstartDate";
	
	$past = mysqli_query($con, $sql);
	$sql = "SELECT * FROM Events WHERE EstartDate >= '".$today."' AND UuserName = '".$usrname."' AND Edisplay='1' ORDER BY EstartDate";
	
	$upcoming = mysqli_query($con, $sql);
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
        <link rel="stylesheet" type="text/css" href="./css/main.css" />
        <link rel="stylesheet" type="text/css" href="./css/top.css" />
        <link rel="stylesheet" type="text/css" href="./css/links.css" />
        <link rel="stylesheet" type="text/css" href="./css/footer.css" />

        <!--FAVICON-->
        <link rel="shortcut icon" href="favicon.ico"  />
        
        <!--GOOGLE MAPS
        <script type="text/javascript" src="js/googleapis.js"></script>
        <script type="text/javascript" src="js/map.js"></script>-->

		<!--(Start) Scripts-->
			<script type="text/javascript" src="scripts/gen_validatorv31.js"></script>
			
			<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
			
			<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
			<script type="text/javascript" src="js/jquery-ui.js"></script>
			<script type="text/javascript" src="js/scripts.js"></script>
			
			<!--(Start) Provided by JetDevLLC-->
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
			
			<!--(Start) Counts the number of characters-->
				<script type="text/javascript">
					function textCounter(field, cnt, maxlimit) {         
						var cntfield = document.getElementById(cnt)
						if (field.value.length > maxlimit) // if too long...trim it!
							field.value = field.value.substring(0, maxlimit);
						 // otherwise, update 'characters left' counter
						else
							//cntfield.value = maxlimit - field.value.length;
							document.getElementById('charsLeft').innerHTML = maxlimit - field.value.length;
					}
				</script>
			<!--(End) Counts the number of characters-->
			
			<!--(Start) Date Pickers-->
				<script type="text/javascript">
					/*$(document).ready(function(){
						$("#EstartDate").datepicker({minDate: 0});
						$("#EendDate").datepicker({minDate: 0});
					});*/
				</script>
			<!--(End) Date Pickers-->
		<!--(End) Scripts-->
	</head>
	
	<body>
		<div class="top">
			<?PHP include './ezTop.php';?>
		
			<!--<div class="logo">
				<a href="./index.php"><img src="images/logo.png" onmouseover="this.src='images/logo.jpg'" onmouseout="this.src='images/logo.png'" alt="Logo" />
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

		<div class="main">
			<div class="sidebar">
			<br>
			<br>
			<!-- <div class="btn-event"><a href=""><img src="images/btn_event.png" alt="Event" /></a></div> -->
				<ul id="accordion" class="menu">
<!-- 
					<li>
						<h2>Dashboard</h2>
						<ul>
						
							<li><img src="images/music.png" alt="Music" /><a href="#">DJ Maxwell, Aug 30</a></li>
							<li><img src="images/speaker.png" alt="Speaker" /><a href="#">Speaker Event, Sep 30</a></li>
							<li><img src="images/dollar.png" alt="Dollar" /><a href="#">Sales Events, Oct 30</a></li>
						</ul>
					</li>
 -->
					<li>
						<h2>My Events</h2>
						<ul id="accordion2">
							<li>
								<h3>Upcoming</h3>
								<ul>
									<?PHP $i = 0;
										  $count = 1;
										while($row = mysqli_fetch_array($upcoming)){ ?>
										<?=  $month='';
										
									if    (substr($row['EstartDate'], 0, 2) ==='01')$month=  'Jan';
									elseif(substr($row['EstartDate'], 0, 2) ==='02') $month= 'Feb';
									elseif(substr($row['EstartDate'], 0, 2) ==='03')$month= 'Mar';
									elseif(substr($row['EstartDate'], 0, 2) ==='04')$month= 'Apr';
									elseif(substr($row['EstartDate'], 0, 2) ==='05')$month= 'May';
									elseif(substr($row['EstartDate'], 0, 2) ==='06')$month= 'Jun';
									elseif(substr($row['EstartDate'], 0, 2) ==='07')$month= 'Jul';
									elseif(substr($row['EstartDate'], 0, 2) ==='08')$month= 'Aug';
									elseif(substr($row['EstartDate'], 0, 2) ==='09')$month= 'Sep';
									elseif(substr($row['EstartDate'], 0, 2) ==='10')$month= 'Oct';
									elseif(substr($row['EstartDate'], 0, 2) ==='11')$month= 'Nov';
									else $month= 'Dec';?>
									<li><img src="images/music.png" alt="Music" /><a href="#"> <?PHP echo $count;?> <?= $row['Evename'] ?>, 
									<?=  $month	?> 
									<?=substr($row['EstartDate'], 3, 2);?></a></li>
									<?PHP $i++;
									      $count++; } ?>

								</ul>
							</li>
							
							<li>
								<h3>Past</h3>
								<ul>
									 <?PHP $i = 0;
									       $count = 1;
										while($row = mysqli_fetch_array($past)){ ?>
										<?=  $month='';
									if    (substr($row['EstartDate'], 0, 2) ==='01')$month=  'Jan';
									elseif(substr($row['EstartDate'], 0, 2) ==='02') $month= 'Feb';
									elseif(substr($row['EstartDate'], 0, 2) ==='03')$month= 'Mar';
									elseif(substr($row['EstartDate'], 0, 2) ==='04')$month= 'Apr';
									elseif(substr($row['EstartDate'], 0, 2) ==='05')$month= 'May';
									elseif(substr($row['EstartDate'], 0, 2) ==='06')$month= 'Jun';
									elseif(substr($row['EstartDate'], 0, 2) ==='07')$month= 'Jul';
									elseif(substr($row['EstartDate'], 0, 2) ==='08')$month= 'Aug';
									elseif(substr($row['EstartDate'], 0, 2) ==='09')$month= 'Sep';
									elseif(substr($row['EstartDate'], 0, 2) ==='10')$month= 'Oct';
									elseif(substr($row['EstartDate'], 0, 2) ==='11')$month= 'Nov';
									else $month= 'Dec';?>
									<li><img src="images/music.png" alt="Music" /><a href="#"><?PHP echo $count;?> <?= $row['Evename']?>, 
									<?=  $month
									?> 
									<?=substr($row['EstartDate'], 3, 2);?></a></li>
									<?PHP $i++; 
									      $count++; } ?>

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
										<input type="text" name="Evename" placeholder="Enter the Name Event" id="Evename" value="<?php echo $fgmembersite->SafeDisplay('Evename') ?>" maxlength="50">
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
							<textarea onkeyup="textCounter(this,'charsLeft', 500)" title="Enter Your Description" rows="3" cols="30" name="Edescription" id="Edescription" value=""></textarea>
							<div style="color: red; font-size: 12pt; font-style: italic; margin-bottom: 5px;" id="charsLeft" value="500"> 500 Characters Max</div>
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
									<input type="text" name="Ewebsite"  placeholder="http://www.website.com" title="correct format: http://www.website.com" id="Ewebsite" value="<?php echo $fgmembersite->SafeDisplay('Ewebsite') ?>" maxlength="50"><br>
									<span id="event_Ewebsite_errorloc" class="error"></span>
								</div>
								
								<div class="type" id="Efacebook" >
									<h5 for="Efacebook">Facebook</h5>
									<input type="text" name="Efacebook" placeholder="https://www.facebook.com/USERNAME" title="?" id="Efacebook" value="<?php echo $fgmembersite->SafeDisplay('Efacebook') ?>" maxlength="50"><br>
									<span id="event_Efacebook_errorloc" class="error"></span>
								</div>
								
								<div class="type" id="Egoogle" >
									<h5 for="Egoogle">Google+</h5>
									<input type="text" name="Egoogle" placeholder="https://plus.google.com/USERNAME" title="?" id="Egoogle" value="<?php echo $fgmembersite->SafeDisplay('Egoogle') ?>" maxlength="50"><br>
									<span id="event_Egoogle_errorloc" class="error"></span>
								</div>
								
								<div class="type" id="Etwitter" >
									<h5 for="Etwitter">Twitter</h5>
									<input type="text" name="Etwitter" placeholder="USERNAME" title="?" id="Etwitter" value="<?php echo $fgmembersite->SafeDisplay('Etwitter') ?>" maxlength="50"><br>
									<span id="event_Etwitter_errorloc" class="error"></span>
								</div>
								
								<div class="type" id="Ehashtag">
									<h5 for="Ehashtag">Hashtag</h5>
									<input type="text" name="Ehashtag" placeholder="USERNAME" title="#hello" id="Ehashtag" value="<?php echo $fgmembersite->SafeDisplay('Ehashtag') ?>" maxlength="50"><br>
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
				
			</div> <!-- End of content -->
			
			<div class="links">
				<?PHP include './links.php'; ?>
			</div>
			
			<div class="footer">
				<?PHP include './footer.php'; ?>
			</div>
			
		</div><!-- End of Main -->
		
		<!--This script needs to wihtin the file. 
		It is validating the form.-->
		<script type="text/javascript">
			// <![CDATA[
			var frmvalidator = new Validator("eventForm");
			frmvalidator.EnableOnPageErrorDisplay();
			frmvalidator.EnableMsgsTogether();
			
			frmvalidator.addValidation("Eflyer",       "req", "Please Insert an Image");
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