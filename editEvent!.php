<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="shortcut icon" href="favicon.ico"  />
  <title>Eventprobe</title>


<!-- Required header files-->
		<script type="text/javascript" src="js/1.5.2.main.js"></script>
		<script type="text/javascript" src="js/vpb_live_edit.js"></script>
		<link href="css/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="css/editTable.css" />
		<link rel="stylesheet" type="text/css" href="css/search.css" />
        <link rel="stylesheet" type="text/css" href="css/top.css" />		
        <link rel="stylesheet" type="text/css" href="css/links.css" />
        <link rel="stylesheet" type="text/css" href="css/footer.css" />
        
<!-- Scripts        -->
		<script>
			function showHint(str) {
				if (str.length == 0) {
//					document.getElementById("txtHint").innerHTML = "";
					$(".links").show();
					$(".footer").show();
	
					return;
				} else {
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
						}
					}
					xmlhttp.open("GET", "getEvent.php?q=" + str, true);
					xmlhttp.send();
				}
			}
		</script>

		<script>
			$(document).ready(function(){
				$("input").keydown(function(){
// 					$(".links").hide();
// 					$(".footer").hide();

				});
			});
		</script>
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script>
					
			function deleteEvent(str){
				window.location = "./deleteEvent.php?eid="+str;
			}
		</script>
<!-- End of Scripts -->


</head>
<body>
		<div class="search">
			<form>
				<input type="text" onkeyup="showHint(this.value)" placeholder="Search for Event">
			</form>
		</div>

    	<div class="top">
			<?PHP include './top.php';?>
        </div>
<center>
<br clear="all" />

<div style=" font-family:Verdana, Geneva, sans-serif; font-size:26px;"></div><br clear="all" /><br clear="all" />

<font style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:black;">Press the <b>Enter Key</b> on your computer keyboard to have your changes saved.</font><br clear="all" /><br clear="all" />
<br clear="all" />











<center>
<div class="vpb_main_wrapper" align="left">
<div class="vpb_header_lebels" align="left"style="width:10%">
<span style="padding-left:8px;">Event Name</span></div>
<div class="vpb_header_lebels" align="left" style="width:10%">Description</div>
<div class="vpb_header_lebels" align="left" style="width:5%">Start Date</div>
<div class="vpb_header_lebels" align="left" style="width:5%">End Date</div>
<div class="vpb_header_lebels" align="left" style="width:5%">Start Time</div>
<div class="vpb_header_lebels" align="left" style="width:5%">End Time</div>
<div class="vpb_header_lebels" align="left" style="width:10%">Phone Number</div>
<div class="vpb_header_lebels" align="left" style="width:5%">Type</div>
<div class="vpb_header_lebels" align="left" style="width:10%">Website</div>
<div class="vpb_header_lebels" align="left" style="width:10%">Hashtag</div>
<div class="vpb_header_lebels" align="left" style="width:10%">Facebook</div>
<div class="vpb_header_lebels" align="left" style="width:5%">Twitter</div>
<div class="vpb_header_lebels" align="left" style="width:10%">Google+</div>

<br clear="all" />

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
<div id="id<?php echo $user_id; ?>" style="padding:8px;padding-top:12px;padding-bottom:12px;
 float:left; cursor:pointer;" class="vasplus_live_edit_area" 
 onClick="vasplus_live_edit_area(<?php echo $user_id; ?>);" align="left">

		<div style="width:10%;float:left;">
	<span id="detail_a<?php echo $user_id; ?>" class="vasplus_live_content"><?php echo $Evename; ?></span>
	<input type="text" value="<?php echo $Evename; ?>" 
	class="vasplus_hidden_boxes" id="detail_aa<?php echo $user_id; ?>"
	 style="display:none;width:100%;" />
	</div>
	
		<div style="width:10%;float:left;">
	<div style="overflow: hidden" id="detail_b<?php echo $user_id; ?>" class="vasplus_live_content"><?php echo $Edescription; ?></div>
	<input type="text" value="<?php echo $Edescription; ?>" 
	class="vasplus_hidden_boxes" id="detail_bb<?php echo $user_id; ?>"
	 style="display:none;width:100%;" />
	</div>
	
		<div style="width:5%;float:left;">
	<span id="detail_c<?php echo $user_id; ?>" class="vasplus_live_content"><?php echo $EstartDate; ?></span>
	<input type="text" value="<?php echo $EstartDate; ?>" 
	class="vasplus_hidden_boxes" id="detail_cc<?php echo $user_id; ?>"
	 style="display:none;width:100%;" />
	</div>
	
		<div style="width:5%;float:left;">
	<span id="detail_d<?php echo $user_id; ?>" class="vasplus_live_content"><?php echo $EendDate; ?></span>
	<input type="text" value="<?php echo $EendDate; ?>" 
	class="vasplus_hidden_boxes" id="detail_dd<?php echo $user_id; ?>"
	 style="display:none;width:100%;" />
	</div>
	
	
		<div style="width:5%;float:left;">
	<span id="detail_e<?php echo $user_id; ?>" class="vasplus_live_content"><?php echo $EtimeStart; ?></span> 
	<input type="text" value="<?php echo $EtimeStart; ?>"  
	class="vasplus_hidden_boxes" id="detail_ee<?php echo $user_id; ?>" 
	style="display:none;width:100%;"/>
	</div>


	<div style="width:5%;float:left;">
	<span id="detail_f<?php echo $user_id; ?>" class="vasplus_live_content"><?php echo $EtimeEnd; ?></span> 
	<input type="text" value="<?php echo $EtimeEnd; ?>"  
	class="vasplus_hidden_boxes" id="detail_ff<?php echo $user_id; ?>" 
	style="display:none;width:100%;"/>
	</div>
	
		<div style="width:10%;float:left;">
	<div  id="detail_g<?php echo $user_id; ?>" class="vasplus_live_content"><?php echo $EphoneNumber; ?></div>
	<input type="text" value="<?php echo $EphoneNumber; ?>" 
	class="vasplus_hidden_boxes" id="detail_gg<?php echo $user_id; ?>"
	 style="display:none;width:100%;" />
	</div>
	

	
	
		<div style="width:5%;float:left;">
	<div style="overflow: hidden" id="detail_h<?php echo $user_id; ?>" class="vasplus_live_content"><?php echo $Etype; ?></div>
	<input type="text" value="<?php echo $Etype; ?>" 
	class="vasplus_hidden_boxes" id="detail_hh<?php echo $user_id; ?>"
	 style="display:none;width:100%;" />
	</div>
	
		<div style="width:10%;float:left;">
	<div style="overflow: hidden" id="detail_i<?php echo $user_id; ?>" class="vasplus_live_content"><?php echo str_pad($Ewebsite,10,"_", STR_PAD_BOTH); ?></div>
	<input type="text" value="<?php echo $Ewebsite; ?>" 
	class="vasplus_hidden_boxes" id="detail_ii<?php echo $user_id; ?>"
	 style="display:none;width:100%;" />
	</div>
	
		<div style="width:10%;float:left;">
	<div style="overflow: hidden" id="detail_j<?php echo $user_id; ?>" class="vasplus_live_content"><?php echo str_pad($Ehashtag,10,"_", STR_PAD_BOTH); ?></div>
	<input type="text" value="<?php echo $Ehashtag; ?>" 
	class="vasplus_hidden_boxes" id="detail_jj<?php echo $user_id; ?>"
	 style="display:none;width:100%;" />
	</div>
	
		<div style="width:10%;float:left;">
	<div style="overflow:hidden" id="detail_k<?php echo $user_id; ?>" class="vasplus_live_content"><?php echo str_pad($Efacebook,10,"_", STR_PAD_BOTH); ?></div>
	<input type="text" value="<?php echo $Efacebook; ?>" 
	class="vasplus_hidden_boxes" id="detail_kk<?php echo $user_id; ?>"
	 style="display:none;width:100%;" />
	</div>
	
		<div style="width:5%;float:left;">
	<div style="overflow: hidden" id="detail_l<?php echo $user_id; ?>" class="vasplus_live_content"><?php echo str_pad($Etwitter,10,"_", STR_PAD_BOTH); ?></div>
	<input type="text" value="<?php echo $Etwitter; ?>" 
	class="vasplus_hidden_boxes" id="detail_ll<?php echo $user_id; ?>"
	 style="display:none;width:100%;" />
	</div>
	
		<div style="width:10%;float:left;">
	<div style="overflow: hidden" id="detail_m<?php echo $user_id; ?>" class="vasplus_live_content"><?php echo str_pad($Egoogle,10,"_", STR_PAD_BOTH); ?></div>
	<input type="text" value="<?php echo $Egoogle; ?>" 
	class="vasplus_hidden_boxes" id="detail_mm<?php echo $user_id; ?>"
	 style="display:none;width:100%;" />
	</div>


</div><br clear="all">




</div><br clear="all">
</center>
<?PHP echo "<a onClick='deleteEvent(".$row['Eid'].")'> " ?> Delete Event</a>
<?php } ?>




<br>
<!-- 
<font style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:black;">This demonstration has no database for security reasons</font>
<p style="padding-bottom:250px;">&nbsp;</p>
 -->
</center>
		<div class="events" id="txtHint"></div>
        <div class="links">
			<?PHP include './links.php'; ?>
        </div>
        
        <div class="footer">
			<?PHP include './footer.php'; ?>
        </div>

</body>


</html>
