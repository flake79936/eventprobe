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
	
	if(isset($_POST["submitted"])){
		if($fgmembersite->updateEvent()){
			$fgmembersite->RedirectToURL("event_thank_you.php");
		}
	}

	//$today = Date("m/d/Y");
	//$sql = "SELECT * FROM Events WHERE EstartDate < '".$today."' AND UuserName = '".$usrname."' AND Edisplay='1' ORDER BY EstartDate";
	$sql = "SELECT * FROM Events WHERE Eid = '" . $_GET['eid'] . "'";
	
	$edit = mysqli_query($con, $sql);
	
	//$sql = "SELECT * FROM Events WHERE EstartDate >= '".$today."' AND UuserName = '".$usrname."' AND Edisplay='1' ORDER BY EstartDate";
	//$upcoming = mysqli_query($con, $sql);
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

		<!--(Start) Scripts-->
			<script type="text/javascript" src="scripts/gen_validatorv31.js"></script>
			
			<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
			
			<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
			<script type="text/javascript" src="js/jquery-ui.js"></script>
			<script type="text/javascript" src="js/scripts.js"></script>
			
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
			
			<?PHP while($row = mysqli_fetch_array($edit)){ ?>
				<div class="content">
					<form id="eventForm" action="<?php echo $fgmembersite->GetSelfScript(); ?>" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
						<input type="hidden" name="submitted" id="submitted" value="1"/>
						
						<div><span class="error"><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
					
						<!--DASHBOARD-->
						<div class="dashboard">
							<div class="user-profile">
								<div class="update-image">
									<!--added the 'value' to reflect the value from the DB based on the 'Eid' (event id)-->
									<input id="uploadImage" type="file" name="Eflyer" onchange="PreviewImage();" />
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
										<input type="text" name="Evename" placeholder="Enter the Name Event" id="Evename" value="<?php echo $row['Evename']; ?>" maxlength="50">
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
								<textarea onkeyup="textCounter(this,'charsLeft', 500)" title="Enter Your Description" rows="3" cols="30" name="Edescription" id="Edescription"><?PHP echo $row['Edescription']; ?></textarea>
								<div style="color: red; font-size: 12pt; font-style: italic; margin-bottom: 5px;" id="charsLeft" value="500"> 500 Characters Max</div>
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
											<input type="text" name="EphoneNumber" placeholder="1234567890" title="(e.g., " id="EphoneNumber" value="<?PHP echo $row['EphoneNumber']; ?>" maxlength="50"><br>
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
													<option value="12:00 am" <?php echo $row['EtimeStart']=="12:00 am" ? "Selected" : ""; ?>>12:00 am</option>
													
													<option value="12:30 am" <?php echo $row['EtimeStart']=="12:30 am" ? "Selected" : ""; ?>>12:30 am</option>
													<option value="1:00 am"  <?php echo $row['EtimeStart']=="1:00 am"  ? "Selected" : ""; ?>>1:00 am</option>
													<option value="1:30 am"  <?php echo $row['EtimeStart']=="1:30 am"  ? "Selected" : ""; ?>>1:30 am</option>
													<option value="2:00 am"  <?php echo $row['EtimeStart']=="2:00 am"  ? "Selected" : ""; ?>>2:00 am</option>
													                                                                   
													<option value="2:30 am"  <?php echo $row['EtimeStart']=="2:30 am"  ? "Selected" : ""; ?>>2:30 am</option>
													<option value="3:00 am"  <?php echo $row['EtimeStart']=="3:00 am"  ? "Selected" : ""; ?>>3:00 am</option>
													<option value="3:30 am"  <?php echo $row['EtimeStart']=="3:30 am"  ? "Selected" : ""; ?>>3:30 am</option>
													<option value="4:00 am"  <?php echo $row['EtimeStart']=="4:00 am"  ? "Selected" : ""; ?>>4:00 am</option>
													                                                                   
													<option value="4:30 am"  <?php echo $row['EtimeStart']=="4:30 am"  ? "Selected" : ""; ?>>4:30 am</option>
													<option value="5:00 am"  <?php echo $row['EtimeStart']=="5:00 am"  ? "Selected" : ""; ?>>5:00 am</option>
													<option value="5:30 am"  <?php echo $row['EtimeStart']=="5:30 am"  ? "Selected" : ""; ?>>5:30 am</option>
													<option value="6:00 am"  <?php echo $row['EtimeStart']=="6:00 am"  ? "Selected" : ""; ?>>6:00 am</option>
													                                                                   
													<option value="6:30 am"  <?php echo $row['EtimeStart']=="6:30 am"  ? "Selected" : ""; ?>>6:30 am</option>
													<option value="7:00 am"  <?php echo $row['EtimeStart']=="7:00 am"  ? "Selected" : ""; ?>>7:00 am</option>
													<option value="7:30 am"  <?php echo $row['EtimeStart']=="7:30 am"  ? "Selected" : ""; ?>>7:30 am</option>
													<option value="8:00 am"  <?php echo $row['EtimeStart']=="8:00 am"  ? "Selected" : ""; ?>>8:00 am</option>
													
													<option value="8:30 am"  <?php echo $row['EtimeStart']=="8:30 am"  ? "Selected" : ""; ?>>8:30 am</option>
													<option value="9:00 am"  <?php echo $row['EtimeStart']=="9:00 am"  ? "Selected" : ""; ?>>9:00 am</option>
													<option value="9:30 am"  <?php echo $row['EtimeStart']=="9:30 am"  ? "Selected" : ""; ?>>9:30 am</option>
													<option value="10:00 am" <?php echo $row['EtimeStart']=="10:00 am" ? "Selected" : ""; ?>>10:00 am</option>
													
													<option value="11:00 am" <?php echo $row['EtimeStart']=="11:00 am" ? "Selected" : ""; ?>>11:00 am</option>
													<option value="11:30 am" <?php echo $row['EtimeStart']=="11:30 am" ? "Selected" : ""; ?>>11:30 am</option>
													<option value="12:00 pm" <?php echo $row['EtimeStart']=="12:00 pm" ? "Selected" : ""; ?>>12:00 pm</option>
													<option value="12:30 pm" <?php echo $row['EtimeStart']=="12:30 pm" ? "Selected" : ""; ?>>12:30 pm</option>
													
													<option value="1:00 pm"  <?php echo $row['EtimeStart']=="1:00 pm"  ? "Selected" : ""; ?>>1:00 pm</option>
													<option value="1:30 pm"  <?php echo $row['EtimeStart']=="1:30 pm"  ? "Selected" : ""; ?>>1:30 pm</option>
													<option value="2:00 pm"  <?php echo $row['EtimeStart']=="2:00 pm"  ? "Selected" : ""; ?>>2:00 pm</option>
													                                                                   
													<option value="2:30 pm"  <?php echo $row['EtimeStart']=="2:30 pm"  ? "Selected" : ""; ?>>2:30 pm</option>
													<option value="3:00 pm"  <?php echo $row['EtimeStart']=="3:00 pm"  ? "Selected" : ""; ?>>3:00 pm</option>
													<option value="3:30 pm"  <?php echo $row['EtimeStart']=="3:30 pm"  ? "Selected" : ""; ?>>3:30 pm</option>
													<option value="4:00 pm"  <?php echo $row['EtimeStart']=="4:00 pm"  ? "Selected" : ""; ?>>4:00 pm</option>
													                                                                   
													<option value="4:30 pm"  <?php echo $row['EtimeStart']=="4:30 pm"  ? "Selected" : ""; ?>>4:30 pm</option>
													<option value="5:00 pm"  <?php echo $row['EtimeStart']=="5:00 pm"  ? "Selected" : ""; ?>>5:00 pm</option>
													<option value="5:30 pm"  <?php echo $row['EtimeStart']=="5:30 pm"  ? "Selected" : ""; ?>>5:30 pm</option>
													<option value="6:00 pm"  <?php echo $row['EtimeStart']=="6:00 pm"  ? "Selected" : ""; ?>>6:00 pm</option>
													
													<option value="6:30 pm"  <?php echo $row['EtimeStart']=="6:30 pm"  ? "Selected" : ""; ?>>6:30 pm</option>
													<option value="7:00 pm"  <?php echo $row['EtimeStart']=="7:00 pm"  ? "Selected" : ""; ?>>7:00 pm</option>
													<option value="7:30 pm"  <?php echo $row['EtimeStart']=="7:30 pm"  ? "Selected" : ""; ?>>7:30 pm</option>
													<option value="8:00 pm"  <?php echo $row['EtimeStart']=="8:00 pm"  ? "Selected" : ""; ?>>8:00 pm</option>
													                                                                   
													<option value="8:30 pm"  <?php echo $row['EtimeStart']=="8:30 pm"  ? "Selected" : ""; ?>>8:30 pm</option>
													<option value="9:00 pm"  <?php echo $row['EtimeStart']=="9:00 pm"  ? "Selected" : ""; ?>>9:00 pm</option>
													<option value="9:30 pm"  <?php echo $row['EtimeStart']=="9:30 pm"  ? "Selected" : ""; ?>>9:30 pm</option>
													<option value="10:00 pm" <?php echo $row['EtimeStart']=="10:00 pm" ? "Selected" : ""; ?>>10:00 pm</option>
													                                                                   
													<option value="11:00 pm" <?php echo $row['EtimeStart']=="11:00 pm" ? "Selected" : ""; ?>>11:00 pm</option>
													<option value="11:30 pm" <?php echo $row['EtimeStart']=="11:30 pm" ? "Selected" : ""; ?>>11:30 pm</option>
												</select>
												<span id="eventForm_EtimeStart_errorloc" class="error"></span>
											</div>
										</div>
									</div>
								
									<!--End Time  -->
									<div class="type">
										<div class="container" id="EtimeEnd">
											<h5 for="EtimeEnd">End Time</h5>
											<select name="EtimeEnd" size="1" value="<?PHP echo $row['EtimeEnd']; ?>">
												<option value="" disabled selected>Select End Time</option>
												<option value="12:00 am"<?php echo $row['EtimeEnd']=="12:00 am" ? "Selected" : ""; ?>>12:00 am</option>
												
												<option value="12:30 am"<?php echo $row['EtimeEnd']=="12:30 am" ? "Selected" : ""; ?>>12:30 am</option>
												<option value="1:00 am" <?php echo $row['EtimeEnd']=="1:00 am"  ? "Selected" : ""; ?>>1:00 am</option>
												<option value="1:30 am" <?php echo $row['EtimeEnd']=="1:30 am"  ? "Selected" : ""; ?>>1:30 am</option>
												<option value="2:00 am" <?php echo $row['EtimeEnd']=="2:00 am"  ? "Selected" : ""; ?>>2:00 am</option>
												
												<option value="2:30 am" <?php echo $row['EtimeEnd']=="2:30 am"  ? "Selected" : ""; ?>>2:30 am</option>
												<option value="3:00 am" <?php echo $row['EtimeEnd']=="3:00 am"  ? "Selected" : ""; ?>>3:00 am</option>
												<option value="3:30 am" <?php echo $row['EtimeEnd']=="3:30 am"  ? "Selected" : ""; ?>>3:30 am</option>
												<option value="4:00 am" <?php echo $row['EtimeEnd']=="4:00 am"  ? "Selected" : ""; ?>>4:00 am</option>
												
												<option value="4:30 am" <?php echo $row['EtimeEnd']=="4:30 am"  ? "Selected" : ""; ?>>4:30 am</option>
												<option value="5:00 am" <?php echo $row['EtimeEnd']=="5:00 am"  ? "Selected" : ""; ?>>5:00 am</option>
												<option value="5:30 am" <?php echo $row['EtimeEnd']=="5:30 am"  ? "Selected" : ""; ?>>5:30 am</option>
												<option value="6:00 am" <?php echo $row['EtimeEnd']=="6:00 am"  ? "Selected" : ""; ?>>6:00 am</option>
												
												<option value="6:30 am" <?php echo $row['EtimeEnd']=="6:30 am"  ? "Selected" : ""; ?>>6:30 am</option>
												<option value="7:00 am" <?php echo $row['EtimeEnd']=="7:00 am"  ? "Selected" : ""; ?>>7:00 am</option>
												<option value="7:30 am" <?php echo $row['EtimeEnd']=="7:30 am"  ? "Selected" : ""; ?>>7:30 am</option>
												<option value="8:00 am" <?php echo $row['EtimeEnd']=="8:00 am"  ? "Selected" : ""; ?>>8:00 am</option>
												
												<option value="8:30 am" <?php echo $row['EtimeEnd']=="8:30 am"  ? "Selected" : ""; ?>>8:30 am</option>
												<option value="9:00 am" <?php echo $row['EtimeEnd']=="9:00 am"  ? "Selected" : ""; ?>>9:00 am</option>
												<option value="9:30 am" <?php echo $row['EtimeEnd']=="9:30 am"  ? "Selected" : ""; ?>>9:30 am</option>
												<option value="10:00 am"<?php echo $row['EtimeEnd']=="10:00 am" ? "Selected" : ""; ?>>10:00 am</option>
												
												<option value="11:00 am"<?php echo $row['EtimeEnd']=="11:00 am" ? "Selected" : ""; ?>>11:00 am</option>
												<option value="11:30 am"<?php echo $row['EtimeEnd']=="11:30 am" ? "Selected" : ""; ?>>11:30 am</option>
												<option value="12:00 pm"<?php echo $row['EtimeEnd']=="12:00 pm" ? "Selected" : ""; ?>>12:00 pm</option>
												<option value="12:30 pm"<?php echo $row['EtimeEnd']=="12:30 pm" ? "Selected" : ""; ?>>12:30 pm</option>
												
												<option value="1:00 pm" <?php echo $row['EtimeEnd']=="1:00 pm"  ? "Selected" : ""; ?>>1:00 pm</option>
												<option value="1:30 pm" <?php echo $row['EtimeEnd']=="1:30 pm"  ? "Selected" : ""; ?>>1:30 pm</option>
												<option value="2:00 pm" <?php echo $row['EtimeEnd']=="2:00 pm"  ? "Selected" : ""; ?>>2:00 pm</option>
												
												<option value="2:30 pm" <?php echo $row['EtimeEnd']=="2:30 pm"  ? "Selected" : ""; ?>>2:30 pm</option>
												<option value="3:00 pm" <?php echo $row['EtimeEnd']=="3:00 pm"  ? "Selected" : ""; ?>>3:00 pm</option>
												<option value="3:30 pm" <?php echo $row['EtimeEnd']=="3:30 pm"  ? "Selected" : ""; ?>>3:30 pm</option>
												<option value="4:00 pm" <?php echo $row['EtimeEnd']=="4:00 pm"  ? "Selected" : ""; ?>>4:00 pm</option>
												
												<option value="4:30 pm" <?php echo $row['EtimeEnd']=="4:30 pm"  ? "Selected" : ""; ?>>4:30 pm</option>
												<option value="5:00 pm" <?php echo $row['EtimeEnd']=="5:00 pm"  ? "Selected" : ""; ?>>5:00 pm</option>
												<option value="5:30 pm" <?php echo $row['EtimeEnd']=="5:30 pm"  ? "Selected" : ""; ?>>5:30 pm</option>
												<option value="6:00 pm" <?php echo $row['EtimeEnd']=="6:00 pm"  ? "Selected" : ""; ?>>6:00 pm</option>
												
												<option value="6:30 pm" <?php echo $row['EtimeEnd']=="6:30 pm"  ? "Selected" : ""; ?>>6:30 pm</option>
												<option value="7:00 pm" <?php echo $row['EtimeEnd']=="7:00 pm"  ? "Selected" : ""; ?>>7:00 pm</option>
												<option value="7:30 pm" <?php echo $row['EtimeEnd']=="7:30 pm"  ? "Selected" : ""; ?>>7:30 pm</option>
												<option value="8:00 pm" <?php echo $row['EtimeEnd']=="8:00 pm"  ? "Selected" : ""; ?>>8:00 pm</option>
												
												<option value="8:30 pm" <?php echo $row['EtimeEnd']=="8:30 pm"  ? "Selected" : ""; ?>>8:30 pm</option>
												<option value="9:00 pm" <?php echo $row['EtimeEnd']=="9:00 pm"  ? "Selected" : ""; ?>>9:00 pm</option>
												<option value="9:30 pm" <?php echo $row['EtimeEnd']=="9:30 pm"  ? "Selected" : ""; ?>>9:30 pm</option>
												<option value="10:00 pm"<?php echo $row['EtimeEnd']=="10:00 pm" ? "Selected" : ""; ?>>10:00 pm</option>
												
												<option value="11:00 pm"<?php echo $row['EtimeEnd']=="11:00 pm" ? "Selected" : ""; ?>>11:00 pm</option>
												<option value="11:30 pm"<?php echo $row['EtimeEnd']=="11:30 pm" ? "Selected" : ""; ?>>11:30 pm</option>
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
											<input type="text" name="EstartDate" placeholder="12/22/2015" title="Pick Start Date" id="EstartDate" value="<?PHP echo $row['EstartDate']; ?>" maxlength="50"><br>
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
											<input type="text" name="EendDate" placeholder="12/31/2015" title="Pick Start Date" id="EendDate" value="<?PHP echo $row['EendDate']; ?>" maxlength="50"><br>
											<span id="eventForm_EendDate_errorloc" class="error"></span>
											<div style="display: none;" class="ui-datepicker-inline ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" style="display: block;"><div class="ui-datepicker-header ui-widget-header ui-helper-clearfix ui-corner-all"><a class="ui-datepicker-prev ui-corner-all ui-state-disabled" title="Prev"><span class="ui-icon ui-icon-circle-triangle-w">Prev</span></a><a class="ui-datepicker-next ui-corner-all" data-handler="next" data-event="click" title="Next"><span class="ui-icon ui-icon-circle-triangle-e">Next</span></a><div class="ui-datepicker-title"><span class="ui-datepicker-month">December</span>&nbsp;<span class="ui-datepicker-year">2014</span></div></div><table class="ui-datepicker-calendar"><thead><tr><th scope="col" class="ui-datepicker-week-end"><span title="Sunday">Su</span></th><th scope="col"><span title="Monday">Mo</span></th><th scope="col"><span title="Tuesday">Tu</span></th><th scope="col"><span title="Wednesday">We</span></th><th scope="col"><span title="Thursday">Th</span></th><th scope="col"><span title="Friday">Fr</span></th><th scope="col" class="ui-datepicker-week-end"><span title="Saturday">Sa</span></th></tr></thead><tbody><tr><td class=" ui-datepicker-week-end ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">&nbsp;</td><td class=" ui-datepicker-days-cell-over  ui-datepicker-current-day ui-datepicker-today" data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default ui-state-highlight ui-state-active" href="#">1</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">2</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">3</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">4</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">5</a></td><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">6</a></td></tr><tr><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">7</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">8</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">9</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">10</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">11</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">12</a></td><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">13</a></td></tr><tr><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">14</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">15</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">16</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">17</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">18</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">19</a></td><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">20</a></td></tr><tr><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">21</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">22</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">23</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">24</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">25</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">26</a></td><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">27</a></td></tr><tr><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">28</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">29</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">30</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">31</a></td><td class=" ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">&nbsp;</td><td class=" ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">&nbsp;</td><td class=" ui-datepicker-week-end ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">&nbsp;</td></tr></tbody></table></div>
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
					</form>
				</div> <!-- End of content -->
			<?php } ?>
			
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