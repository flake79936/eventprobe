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
<div class="vpb_header_lebels" align="left"style="width:30%"><span style="padding-left:8px;">Event Name</span></div>
<div class="vpb_header_lebels" align="left" style="width:35%">Website</div>
<div class="vpb_header_lebels" align="left" style="width:35%">Facebook</div><br clear="all" />

<?php
include "dbconnect.php";
	$newEventID = $_GET['eid'];
// $check_user_details = mysql_query("select * from `Events`");
	$sql = "SELECT * FROM `Events` WHERE  Eid='".$newEventID."' ";

	$result = mysqli_query($con, $sql);
// $i=1;
while($row = mysqli_fetch_array($result))
// while($row = mysqli_fetch_array($check_user_details))
{
	$user_id = strip_tags($row['Eid']);
	$Evename = strip_tags($row['Evename']);
	$Ewebsite = strip_tags($row['Ewebsite']);
	$Efacebook = strip_tags($row['Efacebook']);



?>
<div id="id<?php echo $user_id; ?>" style="padding:8px;padding-top:12px;padding-bottom:12px; float:left; cursor:pointer;" class="vasplus_live_edit_area" onClick="vasplus_live_edit_area(<?php echo $user_id; ?>);" align="left">

	<div style="width:30%;float:left;">
	<span id="detail_a<?php echo $user_id; ?>" class="vasplus_live_content"><?php echo $Evename; ?></span>
	<input type="text" value="<?php echo $Evename; ?>" 
	class="vasplus_hidden_boxes" id="detail_aa<?php echo $user_id; ?>"
	 style="display:none;width:180px;" />
	</div>

	<div style="width:35%;float:left;">
	<span id="detail_b<?php echo $user_id; ?>" class="vasplus_live_content"><?php echo $Ewebsite; ?></span> 
	<input type="text" value="<?php echo $Ewebsite; ?>"  
	class="vasplus_hidden_boxes" id="detail_bb<?php echo $user_id; ?>" 
	style="display:none;width:180px;"/>
	</div>


	<div style="width:35%;float:left;">
	<span id="detail_c<?php echo $user_id; ?>" class="vasplus_live_content"><?php echo $Efacebook; ?></span> 
	<input type="text" value="<?php echo $Efacebook; ?>"  
	class="vasplus_hidden_boxes" id="detail_cc<?php echo $user_id; ?>" 
	style="display:none;width:232px;"/>
	</div>

</div><br clear="all">


<?php
// $i++;
}
?>

</div><br clear="all">
</center>





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
