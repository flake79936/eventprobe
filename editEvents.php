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
			//echo "before thank you";
			$fgmembersite->RedirectToURL("event_thank_you.php");
			//echo "after thank you";
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
						$("select").change(function(){
							$("select option:selected").each(function(){
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
					$(document).ready(function(){
						$("#EstartDate").datepicker({minDate: 0});
						$("#EendDate").datepicker({minDate: 0});
					});
				</script>
			<!--(End) Date Pickers-->
		<!--(End) Scripts-->
		
		
<!-- Retrieve info from database		 -->
		<?php
include "dbconnect.php";
	$newEventID = $_GET['eid'];
// $check_user_details = mysql_query("select * from `Events`");
	$sql = "SELECT * FROM `Events` WHERE  Eid='".$newEventID."' AND Edisplay='1' ";

	$result = mysqli_query($con, $sql);
// $i=1;
while($row = mysqli_fetch_array($result))
// while($row = mysqli_fetch_array($check_user_details))
{
	$user_id = strip_tags($row['Eid']);
		$Eid = strip_tags($row['Eid']);
	
	$Evename = strip_tags($row['Evename']);
	$EstartDate = strip_tags($row['EstartDate']);
	$EendDate = strip_tags($row['EendDate']);
	$EphoneNumber = strip_tags($row['EphoneNumber']);
	$Edescription = strip_tags($row['Edescription']);
	$Etype = strip_tags($row['Etype']);
	$Ewebsite = strip_tags($row['Ewebsite']);
	$Ehashtag = strip_tags($row['Ehashtag']);
	$Efacebook = strip_tags($row['Efacebook']);
	$Etwitter = strip_tags($row['Etwitter']);
	$Egoogle = strip_tags($row['Egoogle']);
	$EtimeStart = strip_tags($row['EtimeStart']);
	$EtimeEnd = strip_tags($row['EtimeEnd']);




?>
<!-- 	End Retrieval	 -->
		
	</head>
	
	<body>
		<div class="top">
			<?PHP include "./top.php"; ?>

		</div>

		<div class="main">
<!-- 			<div class="sidebar"> -->
			<br>
			<br>

				<ul id="accordion" class="menu">

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
								

									 <div class="type">
										<div class="container" id="">
											<h5 for="Etype">Type of Event</h5>
											<h5>
												<select name="Etype">
													<option>Please Select One</option>
													<option value="Art">Art</option>
													<option value="Concert">Concert</option>
													<option value="Fair">Fair</option>
													<option value="Festival">Festival</option>
													<option value="Social">Sport</option>
													<option value="Other">Other</option>
												</select>
											</h5>
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
										<input type="text" name="EphoneNumber" placeholder="1234567890" title="(e.g., " id="EphoneNumber" value="" maxlength="50"><br>
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
											<select name="EtimeStart" size="1">
												<option value="" disabled selected>Select Start Time</option>
												<option value="12:00 am">12:00 am</option>

												<option value="12:30 am">12:30 am</option>
												<option value="1:00 am">1:00 am</option>
												<option value="1:30 am">1:30 am</option>
												<option value="2:00 am">2:00 am</option>

												<option value="2:30 am">2:30 am</option>
												<option value="3:00 am">3:00 am</option>
												<option value="3:30 am">3:30 am</option>
												<option value="4:00 am">4:00 am</option>

												<option value="4:30 am">4:30 am</option>
												<option value="5:00 am">5:00 am</option>
												<option value="5:30 am">5:30 am</option>
												<option value="6:00 am">6:00 am</option>

												<option value="6:30 am">6:30 am</option>
												<option value="7:00 am">7:00 am</option>
												<option value="7:30 am">7:30 am</option>
												<option value="8:00 am">8:00 am</option>

												<option value="8:30 am">8:30 am</option>
												<option value="9:00 am">9:00 am</option>
												<option value="9:30 am">9:30 am</option>
												<option value="10:00 am">10:00 am</option>

												<option value="11:00 am">11:00 am</option>
												<option value="11:30 am">11:30 am</option>
												<option value="12:00 pm">12:00 pm</option>
												<option value="12:30 pm">12:30 pm</option>

												<option value="1:00 pm">1:00 pm</option>
												<option value="1:30 pm">1:30 pm</option>
												<option value="2:00 pm">2:00 pm</option>

												<option value="2:30 pm">2:30 pm</option>
												<option value="3:00 pm">3:00 pm</option>
												<option value="3:30 pm">3:30 pm</option>
												<option value="4:00 pm">4:00 pm</option>

												<option value="4:30 pm">4:30 pm</option>
												<option value="5:00 pm">5:00 pm</option>
												<option value="5:30 pm">5:30 pm</option>
												<option value="6:00 pm">6:00 pm</option>

												<option value="6:30 pm">6:30 pm</option>
												<option value="7:00 pm">7:00 pm</option>
												<option value="7:30 pm">7:30 pm</option>
												<option value="8:00 pm">8:00 pm</option>

												<option value="8:30 pm">8:30 pm</option>
												<option value="9:00 pm">9:00 pm</option>
												<option value="9:30 pm">9:30 pm</option>
												<option value="10:00 pm">10:00 pm</option>

												<option value="11:00 pm">11:00 pm</option>
												<option value="11:30 pm">11:30 pm</option>
											</select>
											<span id="eventForm_EtimeStart_errorloc" class="error"></span>
										</div>
									</div>
								</div>
							
								<!--End Time  -->
								<div class="type">
									<div class="container" id="EtimeEnd">
										<h5 for="EtimeEnd">End Time</h5>
										<select name="EtimeEnd" size="1">
											<option value="" disabled selected>Select End Time</option>
											<option value="12:00 am">12:00 am</option>

											<option value="12:30 am">12:30 am</option>
											<option value="1:00 am">1:00 am</option>
											<option value="1:30 am">1:30 am</option>
											<option value="2:00 am">2:00 am</option>

											<option value="2:30 am">2:30 am</option>
											<option value="3:00 am">3:00 am</option>
											<option value="3:30 am">3:30 am</option>
											<option value="4:00 am">4:00 am</option>

											<option value="4:30 am">4:30 am</option>
											<option value="5:00 am">5:00 am</option>
											<option value="5:30 am">5:30 am</option>
											<option value="6:00 am">6:00 am</option>

											<option value="6:30 am">6:30 am</option>
											<option value="7:00 am">7:00 am</option>
											<option value="7:30 am">7:30 am</option>
											<option value="8:00 am">8:00 am</option>

											<option value="8:30 am">8:30 am</option>
											<option value="9:00 am">9:00 am</option>
											<option value="9:30 am">9:30 am</option>
											<option value="10:00 am">10:00 am</option>

											<option value="11:00 am">11:00 am</option>
											<option value="11:30 am">11:30 am</option>
											<option value="12:00 pm">12:00 pm</option>
											<option value="12:30 pm">12:30 pm</option>

											<option value="1:00 pm">1:00 pm</option>
											<option value="1:30 pm">1:30 pm</option>
											<option value="2:00 pm">2:00 pm</option>

											<option value="2:30 pm">2:30 pm</option>
											<option value="3:00 pm">3:00 pm</option>
											<option value="3:30 pm">3:30 pm</option>
											<option value="4:00 pm">4:00 pm</option>

											<option value="4:30 pm">4:30 pm</option>
											<option value="5:00 pm">5:00 pm</option>
											<option value="5:30 pm">5:30 pm</option>
											<option value="6:00 pm">6:00 pm</option>

											<option value="6:30 pm">6:30 pm</option>
											<option value="7:00 pm">7:00 pm</option>
											<option value="7:30 pm">7:30 pm</option>
											<option value="8:00 pm">8:00 pm</option>

											<option value="8:30 pm">8:30 pm</option>
											<option value="9:00 pm">9:00 pm</option>
											<option value="9:30 pm">9:30 pm</option>
											<option value="10:00 pm">10:00 pm</option>

											<option value="11:00 pm">11:00 pm</option>
											<option value="11:30 pm">11:30 pm</option>
										</select>
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
										<input type="text" name="EstartDate" placeholder="12/22/2015" title="Pick Start Date" id="EstartDate" value="" maxlength="50"><br>
										<span id="eventForm_EstartDate_errorloc" class="error"></span>
										
										<div style="display: none" class="ui-datepicker-inline ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" style="display: block;">
											<div class="ui-datepicker-header ui-widget-header ui-helper-clearfix ui-corner-all">
												<a class="ui-datepicker-prev ui-corner-all ui-state-disabled" title="Prev">
													<span class="ui-icon ui-icon-circle-triangle-w">Prev</span>
												</a>
												<a class="ui-datepicker-next ui-corner-all" data-handler="next" data-event="click" title="Next">
													<span class="ui-icon ui-icon-circle-triangle-e">Next</span>
												</a>
												<div class="ui-datepicker-title">
													<span class="ui-datepicker-month">December</span>&nbsp;
													<span class="ui-datepicker-year">2014</span>
												</div>
											</div>
											<table class="ui-datepicker-calendar">
												<thead>
													<tr>
														<th scope="col" class="ui-datepicker-week-end">
															<span title="Sunday">Su</span>
														</th>
														<th scope="col">
															<span title="Monday">Mo</span>
														</th>
														<th scope="col">
															<span title="Tuesday">Tu</span>
														</th>
														<th scope="col">
															<span title="Wednesday">We</span>
														</th>
														<th scope="col">
															<span title="Thursday">Th</span>
														</th>
														<th scope="col">
															<span title="Friday">Fr</span>
														</th>
														<th scope="col" class="ui-datepicker-week-end">
															<span title="Saturday">Sa</span>
														</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td class=" ui-datepicker-week-end ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">&nbsp;</td>
														<td class=" ui-datepicker-days-cell-over  ui-datepicker-current-day ui-datepicker-today" data-handler="selectDay" data-event="click" data-month="11" data-year="2014">
															<a class="ui-state-default ui-state-highlight ui-state-active ui-state-hover" href="#">1</a>
														</td>
														<td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014">
														<a class="ui-state-default" href="#">2</a>
														</td>
														<td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014">
														<a class="ui-state-default" href="#">3</a>
														</td>
														<td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014">
														<a class="ui-state-default" href="#">4</a>
														</td>
														<td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014">
														<a class="ui-state-default" href="#">5</a>
														</td>
														<td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014">
														<a class="ui-state-default" href="#">6</a>
														</td>
														</tr>
														<tr>
														<td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014">
														<a class="ui-state-default" href="#">7</a>
														</td>
														<td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">8</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">9</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">10</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">11</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">12</a></td><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">13</a></td></tr><tr><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">14</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">15</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">16</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">17</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">18</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">19</a></td><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">20</a></td></tr><tr><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">21</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">22</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">23</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">24</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">25</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">26</a></td><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">27</a></td></tr><tr><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">28</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">29</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">30</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">31</a></td><td class=" ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">&nbsp;</td><td class=" ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">&nbsp;</td><td class=" ui-datepicker-week-end ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">&nbsp;</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>	


								<div class="type">
									<!--End Date picker-->
									<div class="container" id="">
										<h5 for="EendDate">End Date</h5>
										<input type="text" name="EendDate" placeholder="12/31/2015" title="Pick Start Date" id="EendDate" value="" maxlength="50"><br>
										<span id="eventForm_EendDate_errorloc" class="error"></span>
										<div style="display: none;" class="ui-datepicker-inline ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" style="display: block;"><div class="ui-datepicker-header ui-widget-header ui-helper-clearfix ui-corner-all"><a class="ui-datepicker-prev ui-corner-all ui-state-disabled" title="Prev"><span class="ui-icon ui-icon-circle-triangle-w">Prev</span></a><a class="ui-datepicker-next ui-corner-all" data-handler="next" data-event="click" title="Next"><span class="ui-icon ui-icon-circle-triangle-e">Next</span></a><div class="ui-datepicker-title"><span class="ui-datepicker-month">December</span>&nbsp;<span class="ui-datepicker-year">2014</span></div></div><table class="ui-datepicker-calendar"><thead><tr><th scope="col" class="ui-datepicker-week-end"><span title="Sunday">Su</span></th><th scope="col"><span title="Monday">Mo</span></th><th scope="col"><span title="Tuesday">Tu</span></th><th scope="col"><span title="Wednesday">We</span></th><th scope="col"><span title="Thursday">Th</span></th><th scope="col"><span title="Friday">Fr</span></th><th scope="col" class="ui-datepicker-week-end"><span title="Saturday">Sa</span></th></tr></thead><tbody><tr><td class=" ui-datepicker-week-end ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">&nbsp;</td><td class=" ui-datepicker-days-cell-over  ui-datepicker-current-day ui-datepicker-today" data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default ui-state-highlight ui-state-active" href="#">1</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">2</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">3</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">4</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">5</a></td><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">6</a></td></tr><tr><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">7</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">8</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">9</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">10</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">11</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">12</a></td><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">13</a></td></tr><tr><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">14</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">15</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">16</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">17</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">18</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">19</a></td><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">20</a></td></tr><tr><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">21</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">22</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">23</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">24</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">25</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">26</a></td><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">27</a></td></tr><tr><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">28</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">29</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">30</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">31</a></td><td class=" ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">&nbsp;</td><td class=" ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">&nbsp;</td><td class=" ui-datepicker-week-end ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">&nbsp;</td></tr></tbody></table></div>
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
									<input type="text" name="Etwitter" placeholder="@USERNAME" title="?" id="Etwitter" value="<?php echo $fgmembersite->SafeDisplay('Etwitter') ?>" maxlength="50"><br>
									<span id="event_Etwitter_errorloc" class="error"></span>
								</div>
								
								<div class="type" id="Ehashtag" />
									<h5 for="Ehashtag">Hashtag</h5>
									<input type="text" name="Ehashtag" placeholder="https://instagram.com/USERNAME" title="#hello" id="Ehashtag" value="<?php echo $fgmembersite->SafeDisplay('Ehashtag') ?>" maxlength="50"><br>
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