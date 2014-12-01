<?PHP	require_once("./include/membersite_config.php");
	if($fgmembersite->CheckLogin()){
		$usrname = $fgmembersite->UsrName();  
	}

	/*This part ckecks whether there is a session or not.*/
		if(!$fgmembersite->CheckLogin()){
			$fgmembersite->RedirectToURL("index.php");
			exit;
	}
	
	if(isset($_POST["submitted"])){
		if($fgmembersite->CreateEvent()){
			$fgmembersite->RedirectToURL("event_thank_you.php");
		}
	}
	
	
	include 'dbconnect.php';

		$today = Date("m/d/Y");
		$sql = "SELECT * FROM Events WHERE EstartDate < '".$today."' AND UuserName = '".$usrname."' ORDER BY EstartDate";
		$past = mysqli_query($con, $sql);
		$sql = "SELECT * FROM Events WHERE EstartDate >= '".$today."' AND UuserName = '".$usrname."' ORDER BY EstartDate";
		$upcoming = mysqli_query($con, $sql);
?>
<html lang="en">
	<head>
	
<!-- 	 -->
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
        <link rel="stylesheet" type="text/css" href="css/styleUserPage.css" />

        <!--FAVICON-->
        <link rel="shortcut icon" href="favicon.ico"  />
        
        <!--JQUERY-->
        <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>
					
		
		
			<!--(Start) Script to show whether the event is 'Other'-->
				<script type="text/javascript">
					$(document).ready(function(){
						$("#other").hide();
						$("select").change(function(){
							$("select option:selected").each(function(){
								if($(this).attr("value") === "Other"){
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
        
        <!--GOOGLE MAPS-->
        <script type="text/javascript" src="js/googleapis.js"></script>
        <script type="text/javascript" src="js/map.js"></script>
        
	</head>
	
<!-- 	 -->

		
		<!--(Start) Scripts-->
			<script type="text/javascript" src="scripts/gen_validatorv31.js"></script>
			
			<script src="scripts/pwdwidget.js" type="text/javascript"></script>
			<script src="//code.jquery.com/jquery-1.10.2.js"></script>
			<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
			
			<!--(Start) Provided by JetDevLLC-->
				<script src="js/jquery-1.9.0.min.js" type="text/javascript"></script>
				<script src="js/iepngfix_tilebg.js"  type="text/javascript"></script>
				<script src="js/scrollTo.js"         type="text/javascript"></script>
				<script src="js/global.js"           type="text/javascript"></script>
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
			
			<!--(Start) Tooltip Scripts-->
<!-- 
				<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
				<link rel="stylesheet" href="/resources/demos/styleEdit.css">
 -->
<!-- 
				<script src="//code.jquery.com/jquery-1.10.2.js"></script>
				<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
				<script type="text/javascript">
					$(function(){
						$(document).tooltip();
					});
				</script>
 -->
			<!--(End) Tooltip Scripts-->
			
			<!--(Start) Script to show whether the event is 'Other'-->
				<script type="text/javascript">
					$(document).ready(function(){
						$("#other").hide();
						$("select").change(function(){
							$("select option:selected").each(function(){
								if($(this).attr("value") === "Other"){
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
	</head>
	
	<body>
	
	
	<div class="top">
        <div class="logo"><img src="images/logo.png" alt="Logo" /></div>
        <div class="profile">
            <div class="user">
                <img src="images/profile.jpg" />
                <h2><?= $usrname?></h2>
                <a href="#"><img src="images/btn_dropdown.png" alt="Dropdown" /></a>
                <div class="clear"></div>
            </div>
            <div class="search">
                <form>
                    <input type="text" value="search for events" />
                    <input type="image" src="images/btn_search.png" class="btn-search" />
                    <div class="clear"></div>
                </form>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>


    <div class="main">
        <div class="sidebar">
            <div class="btn-event"><a href=""><img src="images/btn_event.png" alt="Event" /></a></div>
            <ul id="accordion" class="menu">
                <li>
                    <h2>Dashboard</h2>
                    <ul>
					
                        <li><img src="images/music.png" alt="Music" /><a href="#">DJ Maxwell, Aug 30</a></li>
                        <li><img src="images/speaker.png" alt="Speaker" /><a href="#">Speaker Event, Sep 30</a></li>
                        <li><img src="images/dollar.png" alt="Dollar" /><a href="#">Sales Events, Oct 30</a></li>
                    </ul>
                </li>
                <li>
                    <h2>My Events</h2>
                    <ul id="accordion2">
                        <li>
                            <h3>Upcoming</h3>
                            <ul>
                                <?PHP $i = 0;
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
                                <li><img src="images/music.png" alt="Music" /><a href="#"><?= $row['Evename'] ?>, 
								<?=  $month
								?> 
								<?=substr($row['EstartDate'], 3, 2);?></a></li>
								<?PHP $i++; } ?>
                            </ul>
                        </li>
						
                        <li>
                            <h3>Past</h3>
                            <ul>
								 <?PHP $i = 0;
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
                                <li><img src="images/music.png" alt="Music" /><a href="#"><?= $row['Evename'] ?>, 
								<?=  $month
								?> 
								<?=substr($row['EstartDate'], 3, 2);?></a></li>
								<?PHP $i++; } ?>

                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        	<div class="content">
				
				
				<!--DASHBOARD-->
				<div class="dashboard">
					<div class="user-profile">
						<div class="update-image">
							<h5>Update Image</h5>
							<input type="file" name="Eflyer" id="Eflyer" title="512 kB max" value="<?php echo $fgmembersite->SafeDisplay('Eflyer') ?>" maxlength="50" img src="images/icon_cam.png" alt="Image"/>
							<div class="clear"></div>
						</div>
						<img src="images/profile-img.jpg" alt="Profiles">
					</div>
					
					<div class="user-menu">
						<div>
							<div class="name">
								<h1>DJ Maxwell</h1>
								<div class="info">
									<div class="box"><img src="images/icon_music.png" alt="Icon" /></div>
									<div class="box"><h3>Music Event</h3></div>
									<div class="box"><a href="#"><img src="images/btn_arrow_down.png" alt="Icon" /></a></div>
									<div class="clear"></div>
								</div>
							</div>
							<div class="reach">
								<h3>Increase your reach!</h3>
								<a href="#"><img src="images/btn_upgrade.png" alt="Upgrade" /></a>
							</div>
							<div class="clear"></div>
						</div>
						<div class="saved">
							<div class="box"><h3>Saved</h3></div>
							<div class="box"><a href="#"><img src="images/btn_draft.png" alt="Draft" /></a></div>
							<div class="box"><a href="#"><img src="images/btn_publish.png" alt="Draft" /></a></div>
							<div class="clear"></div>
						</div>
					</div>
					<div class="clear"></div>
					
					
				</div>
			<!--Dashboard-->
        	
        	
        	
        	
        	
       
        		
<!-- 
        		
        		<div class="user-profile">
                    <div class="update-image">
                        <h5>Update Image</h5>
                        <input type="file" name="Eflyer" id="Eflyer" title="512 kB max" value="<?php echo $fgmembersite->SafeDisplay('Eflyer') ?>" maxlength="50" img src="images/icon_cam.png" alt="Image"/>
                        <div class="clear"></div>
                    </div>
                    <img src="images/profile-img.jpg" alt="Profiles">
                </div>
        		
 -->
        		
<!-- 
        		
        			<div class="update-image">
        				<div class="container" id="eventPic">
						<label for="Eflyer" >Event Image <img src="images/icon_cam.png" alt="Image"></label><br/>
						<input type="file" name="Eflyer" id="Eflyer" title="512 kB max" value="<?php echo $fgmembersite->SafeDisplay('Eflyer') ?>" maxlength="50" /><br/>
						<span id="event_Eflyer_errorloc" class="error"></span>
						</div>
						
					<div class="clear"></div>
						
					</div> <!~~ Update image ~~>	
 -->
					<div class="form-wrap">
			
               		 <div class="box">
					
					<h5 for="EveName">Name of event</h5>
                    <div class="type" id="Evename">
                       <!-- <div class="image"><img src="images/icon_location.png" /></div> -->
                        <input type="text" name="EveName" title="Enter the Name of the Event" id="EveName" value="" maxlength="50">
                        <div class="clear"></div>
                    </div>
					
								
                    	<h5 for="Edescription">description</h5>
                    	<textarea onkeyup="textCounter(this,'charsLeft', 500)" title="Enter Your Description" rows="3" cols="30" name="Edescription" id="Edescription" value=""></textarea>
						<div style="color: red; font-size: 12pt; font-style: italic;" id="charsLeft" value="500"> 500 Characters Max</div>
						<span id="event_Edescription_errorloc" class="error"></span>
					
					

						
					
					
                    <h5 for="Eaddress">Address</h5>
                    <div class="location" id="Eaddress">
                       <!-- <div class="image"><img src="images/icon_location.png" /></div> -->
                        <input type="text" name="Eaddress" title="Enter the Address of the Event" id="Eaddress" value="" maxlength="50">
                        <div class="clear"></div>
                    </div>
					
					
					<div class="wrap">
						<div class="type" id="Ecity">
							<h5 for="Ecity">City</h5>
								<input type="text" name="Ecity" title="Enter the City of the Event" id="Ecity" value="" maxlength="50"><br>
							<span id="event_Ecity_errorloc" class="error"></span>
						</div>
						
						
					<div class="type">
						<div class="container" id="Estate">
							<h5 for="Estate">State: </h5><br>
							<select name="Estate" size="1">
							<option>Select The State</option>
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
							</div>
					</div>

					
											
					<div class="type" id="Ezip">
						<h5 for="Ezip">ZIP</h5>
							<input type="text" name="Ezip" title="Enter the Zip code of the Event" id="Ezip" value="" maxlength="50"><br>
						<span id="event_Ezip_errorloc" class="error"></span>
					</div>
					
					
					</div>
					

					<div class="wrap">	
										
					<div class="type" id="EphoneNumber">
						<h5 for="EphoneNumber">Phone Number</h5>
							<input type="text" name="EphoneNumber" title="(e.g., " id="EphoneNumber" value="" maxlength="50"><br>
						<span id="event_EphoneNumber_errorloc" class="error"></span>
					</div>
					
					
					<div class="type">
						<div class="container" id="Etype">
							<h5 for="Etype">Type of Event</h5><h5>
							<select name="Etype">
							 <option>Please Select One</option>
							 <option value="Concert">Concert</option>
						 	<option value="Fair">Fair</option>
						 	<option value="Art">Art</option>
						 	<option value="Social">Social</option>
						 	<option value="Other">Other</option>
							</select>
						</h5></div>	
					</div>	


					<div class="type">					
						<div class="container" id="Eother">
							<label for="Eother">Other: </label><br>
							<input type="text" name="Eother" title="Enter Other Kind of Event" id="Eother" value="" maxlength="50"><br>
							<span id="event_Eother_errorloc" class="error"></span>
						</div>
					</div>

					
					
					</div>
					
					<div class="clear"></div>
					 
					 
					 
					 
                    <div class="wrap">

                        
                    <!--Start Time-->
                    <div class="type">
                    	<div class="container" id="EtimeStart">
							<div class="container" id="">
							<h5 for="EtimeStart">StartTime </h5><br>
						<select name="EtimeStart" size="1">
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
						</div>
					</div>
						
						
					</div>	
					
					<!--End Time  -->
					<div class="type">
						<div class="container" id="EtimeEnd">
							<h5 for="EtimeEnd">End Time </h5><br>
							<select name="EtimeEnd" size="1">
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
						</div>
					</div>
					
                     </div>
						
					<div class="clear"></div>	
						
					
					
					<div class="wrap">
						
					<div class="type">	
					<!--Start Date picker-->
						<div class="container hasDatepicker" id="EstartDate">
							<h5 for="EstartDate">Start date: </h5><br>
							<input type="text" name="EstartDate" title="Pick Start Date" id="EstartDate" value="" maxlength="50"><br>
							<span id="event_EstartDate_errorloc" class="error"></span>
						<div class="ui-datepicker-inline ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" style="display: block;"><div class="ui-datepicker-header ui-widget-header ui-helper-clearfix ui-corner-all"><a class="ui-datepicker-prev ui-corner-all ui-state-disabled" title="Prev"><span class="ui-icon ui-icon-circle-triangle-w">Prev</span></a><a class="ui-datepicker-next ui-corner-all" data-handler="next" data-event="click" title="Next"><span class="ui-icon ui-icon-circle-triangle-e">Next</span></a><div class="ui-datepicker-title"><span class="ui-datepicker-month">December</span>&nbsp;<span class="ui-datepicker-year">2014</span></div></div><table class="ui-datepicker-calendar"><thead><tr><th scope="col" class="ui-datepicker-week-end"><span title="Sunday">Su</span></th><th scope="col"><span title="Monday">Mo</span></th><th scope="col"><span title="Tuesday">Tu</span></th><th scope="col"><span title="Wednesday">We</span></th><th scope="col"><span title="Thursday">Th</span></th><th scope="col"><span title="Friday">Fr</span></th><th scope="col" class="ui-datepicker-week-end"><span title="Saturday">Sa</span></th></tr></thead><tbody><tr><td class=" ui-datepicker-week-end ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">&nbsp;</td><td class=" ui-datepicker-days-cell-over  ui-datepicker-current-day ui-datepicker-today" data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default ui-state-highlight ui-state-active ui-state-hover" href="#">1</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">2</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">3</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">4</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">5</a></td><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">6</a></td></tr><tr><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">7</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">8</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">9</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">10</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">11</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">12</a></td><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">13</a></td></tr><tr><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">14</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">15</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">16</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">17</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">18</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">19</a></td><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">20</a></td></tr><tr><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">21</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">22</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">23</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">24</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">25</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">26</a></td><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">27</a></td></tr><tr><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">28</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">29</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">30</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">31</a></td><td class=" ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">&nbsp;</td><td class=" ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">&nbsp;</td><td class=" ui-datepicker-week-end ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">&nbsp;</td></tr></tbody></table></div></div>
					</div>	
					
					
					<div class="type">
					<!--End Date picker-->
					<div class="container hasDatepicker" id="EendDate">
						<h5 for="EendDate">End date: </h5><br>
						<input type="text" name="EendDate" title="Pick Start Date" id="EendDate" value="" maxlength="50"><br>
						<span id="event_EendDate_errorloc" class="error"></span>
					<div class="ui-datepicker-inline ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" style="display: block;"><div class="ui-datepicker-header ui-widget-header ui-helper-clearfix ui-corner-all"><a class="ui-datepicker-prev ui-corner-all ui-state-disabled" title="Prev"><span class="ui-icon ui-icon-circle-triangle-w">Prev</span></a><a class="ui-datepicker-next ui-corner-all" data-handler="next" data-event="click" title="Next"><span class="ui-icon ui-icon-circle-triangle-e">Next</span></a><div class="ui-datepicker-title"><span class="ui-datepicker-month">December</span>&nbsp;<span class="ui-datepicker-year">2014</span></div></div><table class="ui-datepicker-calendar"><thead><tr><th scope="col" class="ui-datepicker-week-end"><span title="Sunday">Su</span></th><th scope="col"><span title="Monday">Mo</span></th><th scope="col"><span title="Tuesday">Tu</span></th><th scope="col"><span title="Wednesday">We</span></th><th scope="col"><span title="Thursday">Th</span></th><th scope="col"><span title="Friday">Fr</span></th><th scope="col" class="ui-datepicker-week-end"><span title="Saturday">Sa</span></th></tr></thead><tbody><tr><td class=" ui-datepicker-week-end ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">&nbsp;</td><td class=" ui-datepicker-days-cell-over  ui-datepicker-current-day ui-datepicker-today" data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default ui-state-highlight ui-state-active" href="#">1</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">2</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">3</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">4</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">5</a></td><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">6</a></td></tr><tr><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">7</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">8</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">9</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">10</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">11</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">12</a></td><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">13</a></td></tr><tr><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">14</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">15</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">16</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">17</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">18</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">19</a></td><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">20</a></td></tr><tr><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">21</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">22</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">23</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">24</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">25</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">26</a></td><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">27</a></td></tr><tr><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">28</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">29</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">30</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="11" data-year="2014"><a class="ui-state-default" href="#">31</a></td><td class=" ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">&nbsp;</td><td class=" ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">&nbsp;</td><td class=" ui-datepicker-week-end ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">&nbsp;</td></tr></tbody></table></div></div>	

						
						
					</div>	
						
                        <div class="clear"></div>
                        
                        
                    	<div class="type" id="Ewebsite">
                            <h5 for="Ewebsite">Website</h5>
                            <input type="text" name="Ewebsite" title="correct format: http://www.website.com" id="Ewebsite" value="" maxlength="50"><br>
							<span id="event_Ewebsite_errorloc" class="error"></span>
                        </div>    
                        
                        
                        
                        
                    </div>
                    <h5>Hashtag</h5>
                    <input type="text">
                </div>
                
                <div id="googleMap" class="gmap" style="position: relative; overflow: hidden; -webkit-transform: translateZ(0px); background-color: rgb(229, 227, 223);"><div class="gm-style" style="position: absolute; left: 0px; top: 0px; overflow: hidden; width: 100%; height: 100%; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; overflow: hidden; width: 100%; height: 100%; z-index: 0; cursor: url(https://maps.gstatic.com/mapfiles/openhand_8_8.cur) 8 8, default;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1; width: 100%; transform-origin: 0px 0px 0px; transform: matrix(1, 0, 0, 1, 0, 0);"><div style="-webkit-transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 100; width: 100%;"><div style="position: absolute; left: 0px; top: 0px; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1;"><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 127px; top: 17px;"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: -129px; top: 17px;"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 127px; top: -239px;"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 127px; top: 273px;"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 383px; top: 17px;"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: -129px; top: -239px;"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: -129px; top: 273px;"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 383px; top: -239px;"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 383px; top: 273px;"></div></div></div></div><div style="-webkit-transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 101; width: 100%;"></div><div style="-webkit-transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 102; width: 100%;"></div><div style="-webkit-transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 103; width: 100%;"></div><div style="position: absolute; z-index: 0; left: 0px; top: 0px;"><div style="overflow: hidden; width: 338px; height: 338px;"></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1;"><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 383px; top: -239px; opacity: 1; transition: opacity 200ms ease-out; -webkit-transition: opacity 200ms ease-out;"><img src="https://mts0.googleapis.com/vt?pb=!1m4!1m3!1i13!2i1298!3i2802!2m3!1e0!2sm!3i274000000!3m9!2sen-US!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!4e0!20m1!1b1" draggable="false" style="width: 256px; height: 256px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; -webkit-transform: translateZ(0px);"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 127px; top: 17px; opacity: 1; transition: opacity 200ms ease-out; -webkit-transition: opacity 200ms ease-out;"><img src="https://mts1.googleapis.com/vt?pb=!1m4!1m3!1i13!2i1297!3i2803!2m3!1e0!2sm!3i274000000!3m9!2sen-US!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!4e0!20m1!1b1" draggable="false" style="width: 256px; height: 256px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; -webkit-transform: translateZ(0px);"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: -129px; top: 17px; opacity: 1; transition: opacity 200ms ease-out; -webkit-transition: opacity 200ms ease-out;"><img src="https://mts0.googleapis.com/vt?pb=!1m4!1m3!1i13!2i1296!3i2803!2m3!1e0!2sm!3i274000000!3m9!2sen-US!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!4e0!20m1!1b1" draggable="false" style="width: 256px; height: 256px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; -webkit-transform: translateZ(0px);"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 127px; top: -239px; opacity: 1; transition: opacity 200ms ease-out; -webkit-transition: opacity 200ms ease-out;"><img src="https://mts1.googleapis.com/vt?pb=!1m4!1m3!1i13!2i1297!3i2802!2m3!1e0!2sm!3i274000000!3m9!2sen-US!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!4e0!20m1!1b1" draggable="false" style="width: 256px; height: 256px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; -webkit-transform: translateZ(0px);"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 127px; top: 273px; opacity: 1; transition: opacity 200ms ease-out; -webkit-transition: opacity 200ms ease-out;"><img src="https://mts1.googleapis.com/vt?pb=!1m4!1m3!1i13!2i1297!3i2804!2m3!1e0!2sm!3i274000000!3m9!2sen-US!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!4e0!20m1!1b1" draggable="false" style="width: 256px; height: 256px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; -webkit-transform: translateZ(0px);"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: -129px; top: 273px; opacity: 1; transition: opacity 200ms ease-out; -webkit-transition: opacity 200ms ease-out;"><img src="https://mts0.googleapis.com/vt?pb=!1m4!1m3!1i13!2i1296!3i2804!2m3!1e0!2sm!3i274000000!3m9!2sen-US!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!4e0!20m1!1b1" draggable="false" style="width: 256px; height: 256px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; -webkit-transform: translateZ(0px);"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: -129px; top: -239px; opacity: 1; transition: opacity 200ms ease-out; -webkit-transition: opacity 200ms ease-out;"><img src="https://mts0.googleapis.com/vt?pb=!1m4!1m3!1i13!2i1296!3i2802!2m3!1e0!2sm!3i274000000!3m9!2sen-US!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!4e0!20m1!1b1" draggable="false" style="width: 256px; height: 256px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; -webkit-transform: translateZ(0px);"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 383px; top: 17px; opacity: 1; transition: opacity 200ms ease-out; -webkit-transition: opacity 200ms ease-out;"><img src="https://mts0.googleapis.com/vt?pb=!1m4!1m3!1i13!2i1298!3i2803!2m3!1e0!2sm!3i274000000!3m9!2sen-US!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!4e0!20m1!1b1" draggable="false" style="width: 256px; height: 256px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; -webkit-transform: translateZ(0px);"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 383px; top: 273px; opacity: 1; transition: opacity 200ms ease-out; -webkit-transition: opacity 200ms ease-out;"><img src="https://mts0.googleapis.com/vt?pb=!1m4!1m3!1i13!2i1298!3i2804!2m3!1e0!2sm!3i274000000!3m9!2sen-US!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!4e0!20m1!1b1" draggable="false" style="width: 256px; height: 256px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; -webkit-transform: translateZ(0px);"></div></div></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 2; width: 100%; height: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 3; width: 100%; transform-origin: 0px 0px 0px; transform: matrix(1, 0, 0, 1, 0, 0);"><div style="-webkit-transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 104; width: 100%;"></div><div style="-webkit-transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 105; width: 100%;"></div><div style="-webkit-transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 106; width: 100%;"></div><div style="-webkit-transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 107; width: 100%;"></div></div></div><div style="margin-left: 5px; margin-right: 5px; z-index: 1000000; position: absolute; left: 0px; bottom: 0px;"><a target="_blank" href="http://maps.google.com/maps?ll=49.280418,-122.997181&amp;z=13&amp;t=m&amp;hl=en-US&amp;gl=US&amp;mapclient=apiv3" title="Click to see this area on Google Maps" style="position: static; overflow: visible; float: none; display: inline;"><div style="width: 62px; height: 26px; cursor: pointer;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/google_white2.png" draggable="false" style="position: absolute; left: 0px; top: 0px; width: 62px; height: 26px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px;"></div></a></div><div class="gmnoprint" style="z-index: 1000001; position: absolute; right: 155px; bottom: 0px; width: 12px;"><div draggable="false" class="gm-style-cc" style="-webkit-user-select: none;"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="width: auto; height: 100%; margin-left: 1px; background-color: rgb(245, 245, 245);"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right;"><a style="color: rgb(68, 68, 68); text-decoration: none; cursor: pointer; display: none;">Map Data</a><span style="display: none;"></span></div></div></div><div style="padding: 15px 21px; border: 1px solid rgb(171, 171, 171); font-family: Roboto, Arial, sans-serif; color: rgb(34, 34, 34); -webkit-box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 16px; box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 16px; z-index: 10000002; display: none; width: 256px; height: 148px; position: absolute; left: 10px; top: 70px; background-color: white;"><div style="padding: 0px 0px 10px; font-size: 16px;">Map Data</div><div style="font-size: 13px;"></div><div style="width: 13px; height: 13px; overflow: hidden; position: absolute; opacity: 0.7; right: 12px; top: 12px; z-index: 10000; cursor: pointer;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/mapcnt3.png" draggable="false" style="position: absolute; left: -2px; top: -336px; width: 59px; height: 492px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px;"></div></div><div class="gmnoscreen" style="position: absolute; right: 0px; bottom: 0px;"><div style="font-family: Roboto, Arial, sans-serif; font-size: 11px; color: rgb(68, 68, 68); direction: ltr; text-align: right; background-color: rgb(245, 245, 245);"></div></div><div class="gmnoprint gm-style-cc" draggable="false" style="z-index: 1000001; position: absolute; -webkit-user-select: none; right: 0px; bottom: 0px;"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="width: auto; height: 100%; margin-left: 1px; background-color: rgb(245, 245, 245);"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right;"><a href="http://www.google.com/intl/en-US_US/help/terms_maps.html" target="_blank" style="text-decoration: none; cursor: pointer; color: rgb(68, 68, 68);">Terms of Use</a></div></div><div draggable="false" class="gm-style-cc" style="-webkit-user-select: none; display: none; position: absolute; right: 0px; bottom: 0px;"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="width: auto; height: 100%; margin-left: 1px; background-color: rgb(245, 245, 245);"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right;"><a target="_new" title="Report errors in the road map or imagery to Google" href="http://maps.google.com/maps?ll=49.280418,-122.997181&amp;z=13&amp;t=m&amp;hl=en-US&amp;gl=US&amp;mapclient=apiv3&amp;skstate=action:mps_dialog$apiref:1&amp;output=classic" style="font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); text-decoration: none; position: relative;">Report a map error</a></div></div><div class="gmnoprint" draggable="false" controlwidth="20" controlheight="39" style="margin: 5px; -webkit-user-select: none; position: absolute; left: 0px; top: 0px;"><div class="gmnoprint" controlwidth="20" controlheight="39" style="position: absolute; left: 0px; top: 0px;"><div style="width: 20px; height: 39px; overflow: hidden; position: absolute;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/mapcnt3.png" draggable="false" style="position: absolute; left: -39px; top: -401px; width: 59px; height: 492px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px;"></div><div title="Zoom in" style="position: absolute; left: 0px; top: 2px; width: 20px; height: 17px; cursor: pointer;"></div><div title="Zoom out" style="position: absolute; left: 0px; top: 19px; width: 20px; height: 17px; cursor: pointer;"></div></div></div><div draggable="false" class="gm-style-cc" style="-webkit-user-select: none; position: absolute; right: 72px; bottom: 0px;"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="width: auto; height: 100%; margin-left: 1px; background-color: rgb(245, 245, 245);"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right;"><span>500 m&nbsp;</span><div style="position: relative; display: inline-block; height: 8px; bottom: -1px; width: 40px;"><div style="width: 100%; height: 4px; position: absolute; bottom: 0px; left: 0px; background-color: rgb(255, 255, 255);"></div><div style="position: absolute; left: 0px; top: 0px; width: 4px; height: 8px; background-color: rgb(255, 255, 255);"></div><div style="width: 4px; height: 8px; position: absolute; bottom: 0px; right: 0px; background-color: rgb(255, 255, 255);"></div><div style="position: absolute; height: 2px; bottom: 1px; right: 1px; left: 1px; background-color: rgb(102, 102, 102);"></div><div style="position: absolute; left: 1px; top: 1px; width: 2px; height: 6px; background-color: rgb(102, 102, 102);"></div><div style="width: 2px; height: 6px; position: absolute; bottom: 1px; right: 1px; background-color: rgb(102, 102, 102);"></div></div></div></div></div></div>
                <div class="clear"></div>
            </div>
					
        		</div> <!-- User Profle -->
        
		
        </div> <!-- End content -->
        
    </div>  <!-- Main -->

		
		<!--This script needs to wihtin the file. 
		It is validating the form.-->
		<script type="text/javascript">
			// <![CDATA[
			var frmvalidator = new Validator("event");
			frmvalidator.EnableOnPageErrorDisplay();
			frmvalidator.EnableMsgsTogether();
			
			frmvalidator.addValidation("Evename",      "req", "Please fill in Event Name");
			frmvalidator.addValidation("Eaddress",     "req", "Please fill in address");
			frmvalidator.addValidation("Ecity",        "req", "Please fill in City");
			frmvalidator.addValidation("Estate",       "req", "Please fill in State");
			frmvalidator.addValidation("Ezip",         "req", "Please fill in Zip code");
			frmvalidator.addValidation("EphoneNumber", "req", "Please fill in Phone Number");
			frmvalidator.addValidation("EstartDate",   "req", "Please Select a Start Date");
			frmvalidator.addValidation("EendDate",     "req", "Please Select an End Date");
			frmvalidator.addValidation("Etype",        "req", "Please fill in Type of Event");
			frmvalidator.addValidation("Edescription", "req", "Please fill in Description");
			frmvalidator.addValidation("Ewebsite",     "req", "Please fill in Your Website");
			frmvalidator.addValidation("Eflyer",       "req", "Please Insert Picture");
			frmvalidator.addValidation("EtimeStart",   "req", "Please fill in the Start Time");
			frmvalidator.addValidation("EtimeEnd",     "req", "Please fill in the End Time");
			
			
			// ]]>
		</script>
	</body>
</html>