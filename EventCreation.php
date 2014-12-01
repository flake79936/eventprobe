
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
                
                
        	</div> <!--Dashboard-->
        	
        	
        	
        	
        	
       
        		
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
						

					
        		</div> <!-- User Profle -->
        
        
        		<div class="form-wrap" id='fg_membersite' >
        			<div class="box">

				<form id="event" action="<?php echo $fgmembersite->GetSelfScript(); ?>" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
					<input type="hidden" name="submitted" id="submitted" value="1"/>

<!-- 
					<div class="short_explanation">* required fields</div>
					<input type="text" class="spmhidip" name="<?php echo $fgmembersite->GetSpamTrapInputName(); ?>" />
 -->

					<div><span class="error"><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
					
					<!--Event Name-->
					<div class="container" id="eventName">
						<label for="Evename">* Event Name: </label><br/>
						<input type="text" name="Evename" title="Enter the Event Name" id="Evename" value="<?php echo $fgmembersite->SafeDisplay('Evename') ?>" maxlength="50" /><br/>
						<span id="event_Evename_errorloc" class="error"></span>
					</div>
					
					<!--Upload Picture-->
					<div class="container" id="eventPic">
						<label for="Eflyer" >* Picture of Event:</label><br/>
						<input type="file" name="Eflyer" id="Eflyer" title="512 kB max" value="<?php echo $fgmembersite->SafeDisplay('Eflyer') ?>" maxlength="50" /><br/>
						<span id="event_Eflyer_errorloc" class="error"></span>
					</div>
				
					<!--Start Date picker-->
					<div class="container" id="">
						<label for="EstartDate">* Start date: </label><br/>
						<input type="text" name="EstartDate" title="Pick Start Date" id="EstartDate" value="<?php echo $fgmembersite->SafeDisplay("EstartDate") ?>" maxlength="50" /><br/>
						<span id="event_EstartDate_errorloc" class="error"></span>
					</div>
					
					<!--End Date picker-->
					<div class="container" id="">
						<label for="EendDate">* End date: </label><br/>
						<input type="text" name="EendDate" title="Pick Start Date" id="EendDate" value="<?php echo $fgmembersite->SafeDisplay("EendDate") ?>" maxlength="50" /><br/>
						<span id="event_EendDate_errorloc" class="error"></span>
					</div>
				
					<!--Start Time-->
					<div class="container" id="">
						<label for="EtimeStart">* StartTime: </label><br/>
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
					
					<!--End Time  -->
					
					<div class="container" id="">
						<label for="EtimeEnd">* End Time: </label><br/>
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
					
					<!--Address-->
					<div class="container" id="">
						<label for="Eaddress">* Address: </label><br/>
						<input type="text" name="Eaddress" title="Enter the Address of the Event"id="Eaddress" value="<?php echo $fgmembersite->SafeDisplay("Eaddress") ?>" maxlength="50" /><br/>
						<span id="event_Eaddress_errorloc" class="error"></span>
					</div>
					
					<!--City-->
					<div class="container" id="">
						<label for="Ecity">* City: </label><br/>
						<input type="text" name="Ecity" title="Enter the City of the Event"id="Ecity" value="<?php echo $fgmembersite->SafeDisplay("Ecity") ?>" maxlength="50" /><br/>
						<span id="event_Ecity_errorloc" class="error"></span>
					</div>
				
					<!--State-->
					
					<div class="container" id="">
						<label for="Estate">* State: </label><br/>
						<select name="Estate" size="1">
						<option>Please Select The State</option>
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
					

					
					<!--Zip-->
					<div class="container" id="">
						<label for="Ezip">* Zip: </label><br/>
						<input type="text" name="Ezip" title="Enter the Zip code of the Event" id="Ezip" value="<?php echo $fgmembersite->SafeDisplay("Ezip") ?>" maxlength="50" /><br/>
						<span id="event_Ezip_errorloc" class="error"></span>
					</div>
				
					<!--Phone-->
					<div class="container" id="">
						<label for="EphoneNumber">* Phone number: </label><br/>
						<input type="text" name="EphoneNumber" title="(e.g., " id="EphoneNumber" value="<?php echo $fgmembersite->SafeDisplay("EphoneNumber") ?>" maxlength="50" /><br/>
						<span id="event_EphoneNumber_errorloc" class="error"></span>
					</div>
				
					<!--Type of Event-->
					<div class="container" id="">
						<label for="Etype">Type of Event*: </label><br/>
						<select name="Etype">
						 <option>Please Select One</option>
						 <option value="Concert">Concert</option>
						 <option value="Fair">Fair</option>
						 <option value="Art">Art</option>
						 <option value="Social">Social</option>
						 <option value="Other">Other</option>
						</select>
					</div>
					
					<!--Description-->
					<div class="container" id="other">
						<label for="Eother">Other: </label><br/>
						<input type="text" name="Eother" title="Enter Other Kind of Event" id="Eother" value="<?php echo $fgmembersite->SafeDisplay("Eother") ?>" maxlength="50" /><br/>
						<span id="event_Eother_errorloc" class="error"></span>
					</div>
					
					<!--Other 'option'-->
					<div class="container" id="">
						<label for="Edescription">* Description of the Event: </label><br/>
						<textarea onKeyUp="textCounter(this,'charsLeft', 500)" title="Enter Your Description" rows="3" cols="30" name="Edescription" id="Edescription" value="<?php echo $fgmembersite->SafeDisplay("Edescription") ?>"></textarea>
						<div style="color: red; font-size: 12pt; font-style: italic;" id="charsLeft" value="500"> 500 Characters Max</div>
						<span id="event_Edescription_errorloc" class="error"></span>
					</div>
					
					<!--hastags-->
					<div class="container" id="">
						<label for="Ehashtag">Hastags: </label><br/>
						<input type="text" name="Ehashtag" title="Enter Hashtag" id="Ehashtag" value="<?php echo $fgmembersite->SafeDisplay("Ehashtag") ?>" maxlength="50" /><br/>
						<span id="event_Ehashtag_errorloc" class="error"></span>
					</div>
					
					<!--website-->
					<div class="container" id="">
						<label for="Ewebsite">Website*: </label><br/>
						<input type="text" name="Ewebsite" title="correct format: http://www.website.com" id="Ewebsite" value="<?php echo $fgmembersite->SafeDisplay("Ewebsite") ?>" maxlength="50" /><br/>
						<span id="event_Ewebsite_errorloc" class="error"></span>
					</div>
				
					<!--Facebook-->
					<div class="container" id="">
						<label for="Efacebook">FaceBook: </label><br/>
						<input type="text" name="Efacebook" title="correct format: http://www.facebook.com/USERNAME where the USERNAME should be replaced with your facebook username"
						 id="Efacebook" value="<?php echo $fgmembersite->SafeDisplay("Efacebook") ?>" maxlength="50" /><br/>
						<span id="event_Efacebook_errorloc" class="error"></span>
					</div>
					
					<!--twitter-->
					<div class="container" id="">
						<label for="Etwitter">Twitter: </label><br/>
						<input type="text" name="Etwitter" title="Do not include the @ symbol" id="Etwitter" value="<?php echo $fgmembersite->SafeDisplay("Etwitter") ?>" maxlength="50" /><br/>
						<span id="event_Etwitter_errorloc" class="error"></span>
					</div>
					
					<!--google+-->
					<div class="container" id="">
						<label for="Egoogle">Google+: </label><br/>
						<input type="text" name="Egoogle" title="Enter Google+ Username " id="Egoogle" value="<?php echo $fgmembersite->SafeDisplay("Egoogle") ?>" maxlength="50" /><br/>
						<span id="event_Egoogle_errorloc" class="error"></span>
					</div>
				
					<!--Submit Button-->
					<div>
						<input id="submitButton" type="submit" name="Submit" value="Create Event" />
					</div>
				</form>
		
		</div>
        
        </div>
        
        
        
        
        
        
        
        
        
        
        
        </div> <!-- End content -->
        
    </div>  <!-- Main -->









		
<!-- 
		<div id='fg_membersite' align="center">

				<form id="event" action="<?php echo $fgmembersite->GetSelfScript(); ?>" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
					<input type="hidden" name="submitted" id="submitted" value="1"/>

<!~~ 
					<div class="short_explanation">* required fields</div>
					<input type="text" class="spmhidip" name="<?php echo $fgmembersite->GetSpamTrapInputName(); ?>" />
 ~~>

					<div><span class="error"><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
					
					<!~~Event Name~~>
					<div class="container" id="eventName">
						<label for="Evename">* Event Name: </label><br/>
						<input type="text" name="Evename" title="Enter the Event Name" id="Evename" value="<?php echo $fgmembersite->SafeDisplay('Evename') ?>" maxlength="50" /><br/>
						<span id="event_Evename_errorloc" class="error"></span>
					</div>
					
					<!~~Upload Picture~~>
					<div class="container" id="eventPic">
						<label for="Eflyer" >* Picture of Event:</label><br/>
						<input type="file" name="Eflyer" id="Eflyer" title="512 kB max" value="<?php echo $fgmembersite->SafeDisplay('Eflyer') ?>" maxlength="50" /><br/>
						<span id="event_Eflyer_errorloc" class="error"></span>
					</div>
				
					<!~~Start Date picker~~>
					<div class="container" id="">
						<label for="EstartDate">* Start date: </label><br/>
						<input type="text" name="EstartDate" title="Pick Start Date" id="EstartDate" value="<?php echo $fgmembersite->SafeDisplay("EstartDate") ?>" maxlength="50" /><br/>
						<span id="event_EstartDate_errorloc" class="error"></span>
					</div>
					
					<!~~End Date picker~~>
					<div class="container" id="">
						<label for="EendDate">* End date: </label><br/>
						<input type="text" name="EendDate" title="Pick Start Date" id="EendDate" value="<?php echo $fgmembersite->SafeDisplay("EendDate") ?>" maxlength="50" /><br/>
						<span id="event_EendDate_errorloc" class="error"></span>
					</div>
				
					<!~~Start Time~~>
					<div class="container" id="">
						<label for="EtimeStart">* StartTime: </label><br/>
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
					
					<!~~End Time  ~~>
					
					<div class="container" id="">
						<label for="EtimeEnd">* End Time: </label><br/>
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
					
					<!~~Address~~>
					<div class="container" id="">
						<label for="Eaddress">* Address: </label><br/>
						<input type="text" name="Eaddress" title="Enter the Address of the Event"id="Eaddress" value="<?php echo $fgmembersite->SafeDisplay("Eaddress") ?>" maxlength="50" /><br/>
						<span id="event_Eaddress_errorloc" class="error"></span>
					</div>
					
					<!~~City~~>
					<div class="container" id="">
						<label for="Ecity">* City: </label><br/>
						<input type="text" name="Ecity" title="Enter the City of the Event"id="Ecity" value="<?php echo $fgmembersite->SafeDisplay("Ecity") ?>" maxlength="50" /><br/>
						<span id="event_Ecity_errorloc" class="error"></span>
					</div>
				
					<!~~State~~>
					
					<div class="container" id="">
						<label for="Estate">* State: </label><br/>
						<select name="Estate" size="1">
						<option>Please Select The State</option>
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
					

					
					<!~~Zip~~>
					<div class="container" id="">
						<label for="Ezip">* Zip: </label><br/>
						<input type="text" name="Ezip" title="Enter the Zip code of the Event" id="Ezip" value="<?php echo $fgmembersite->SafeDisplay("Ezip") ?>" maxlength="50" /><br/>
						<span id="event_Ezip_errorloc" class="error"></span>
					</div>
				
					<!~~Phone~~>
					<div class="container" id="">
						<label for="EphoneNumber">* Phone number: </label><br/>
						<input type="text" name="EphoneNumber" title="(e.g., " id="EphoneNumber" value="<?php echo $fgmembersite->SafeDisplay("EphoneNumber") ?>" maxlength="50" /><br/>
						<span id="event_EphoneNumber_errorloc" class="error"></span>
					</div>
				
					<!~~Type of Event~~>
					<div class="container" id="">
						<label for="Etype">Type of Event*: </label><br/>
						<select name="Etype">
						 <option>Please Select One</option>
						 <option value="Concert">Concert</option>
						 <option value="Fair">Fair</option>
						 <option value="Art">Art</option>
						 <option value="Social">Social</option>
						 <option value="Other">Other</option>
						</select>
					</div>
					
					<!~~Description~~>
					<div class="container" id="other">
						<label for="Eother">Other: </label><br/>
						<input type="text" name="Eother" title="Enter Other Kind of Event" id="Eother" value="<?php echo $fgmembersite->SafeDisplay("Eother") ?>" maxlength="50" /><br/>
						<span id="event_Eother_errorloc" class="error"></span>
					</div>
					
					<!~~Other 'option'~~>
					<div class="container" id="">
						<label for="Edescription">* Description of the Event: </label><br/>
						<textarea onKeyUp="textCounter(this,'charsLeft', 500)" title="Enter Your Description" rows="3" cols="30" name="Edescription" id="Edescription" value="<?php echo $fgmembersite->SafeDisplay("Edescription") ?>"></textarea>
						<div style="color: red; font-size: 12pt; font-style: italic;" id="charsLeft" value="500"> 500 Characters Max</div>
						<span id="event_Edescription_errorloc" class="error"></span>
					</div>
					
					<!~~hastags~~>
					<div class="container" id="">
						<label for="Ehashtag">Hastags: </label><br/>
						<input type="text" name="Ehashtag" title="Enter Hashtag" id="Ehashtag" value="<?php echo $fgmembersite->SafeDisplay("Ehashtag") ?>" maxlength="50" /><br/>
						<span id="event_Ehashtag_errorloc" class="error"></span>
					</div>
					
					<!~~website~~>
					<div class="container" id="">
						<label for="Ewebsite">Website*: </label><br/>
						<input type="text" name="Ewebsite" title="correct format: http://www.website.com" id="Ewebsite" value="<?php echo $fgmembersite->SafeDisplay("Ewebsite") ?>" maxlength="50" /><br/>
						<span id="event_Ewebsite_errorloc" class="error"></span>
					</div>
				
					<!~~Facebook~~>
					<div class="container" id="">
						<label for="Efacebook">FaceBook: </label><br/>
						<input type="text" name="Efacebook" title="correct format: http://www.facebook.com/USERNAME where the USERNAME should be replaced with your facebook username"
						 id="Efacebook" value="<?php echo $fgmembersite->SafeDisplay("Efacebook") ?>" maxlength="50" /><br/>
						<span id="event_Efacebook_errorloc" class="error"></span>
					</div>
					
					<!~~twitter~~>
					<div class="container" id="">
						<label for="Etwitter">Twitter: </label><br/>
						<input type="text" name="Etwitter" title="Do not include the @ symbol" id="Etwitter" value="<?php echo $fgmembersite->SafeDisplay("Etwitter") ?>" maxlength="50" /><br/>
						<span id="event_Etwitter_errorloc" class="error"></span>
					</div>
					
					<!~~google+~~>
					<div class="container" id="">
						<label for="Egoogle">Google+: </label><br/>
						<input type="text" name="Egoogle" title="Enter Google+ Username " id="Egoogle" value="<?php echo $fgmembersite->SafeDisplay("Egoogle") ?>" maxlength="50" /><br/>
						<span id="event_Egoogle_errorloc" class="error"></span>
					</div>
				
					<!~~Submit Button~~>
					<div>
						<input id="submitButton" type="submit" name="Submit" value="Create Event" />
					</div>
				</form>
		
		</div>
 -->
		
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