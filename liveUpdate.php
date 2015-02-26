<?php 
	require_once("./include/membersite_config.php");
	if(!$fgmembersite->CheckSession()){
		$fgmembersite->RedirectToURL("loginB.php");
		exit;
	}

$action = (isset($_REQUEST['action']) && !empty($_REQUEST['action']))?$_REQUEST['action']: NULL;
if(empty($action)) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--         <link rel="stylesheet" type="text/css" href="css/top.css" /> -->
		<link rel="stylesheet" type="text/css" href="./css/updateTable.css" />
<!-- 
        <link rel="stylesheet" type="text/css" href="css/links.css" />
        <link rel="stylesheet" type="text/css" href="css/footer.css" />
 -->

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edit Event</title>

<script type="text/javascript" src="./js/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="./js/script.js"></script>
</head>

<body>

	    <div class="top">
			<?PHP //include './top.php';
			if (!$fgmembersite->CheckSession()) { ?>
			<center><h3> Please Login</h3></center>

			<?PHP } ?>

        </div>



<div id="outer_container">
<div id="loader" ><img src="./images/loader.gif"></div>
<div id="data" style="position:relative;">
<?php } ?>

<?php if(empty($action)) {?>
</div>
</div>
</body>
</html>
<?php }

if($action == 'ajax' || $action == 'update' || $action == 'delete') {
	require_once 'database.php';
	$db = new Database;
	function getTable() {
		GLOBAL $db;
		$data = '<button class="delall" >Delete Selected</button>
		<form><table width="90%" cellspacing="0" cellpadding="2" align="center" border="0" id="data_tbl">
			<thead>
			  <tr>
			    <th width="3%"><input type="checkbox" class="selall"/></th>
			    <th width="25%">Event Name</th>
			    <th width="25%">Event Address</th>
			    <th width="10%">City</th>
			    <th width="10%">State</th>
				<th width="10%">Zip</th>
				<th width="10%">Phone Number</th>
				<th width="10%">Description</th>
				<th width="10%">Website</th>
				<th width="10%">Hashtag</th>
				<th width="10%">Facebook</th>
				<th width="10%">Twitter</th>
				<th width="10%">Google+</th>												
			  </tr>
			 </thead>
			 <tbody>';
		$i = 1;
		$cls = false;
		foreach ($db->get_users() as $value) {
			$bg = ($cls = !$cls) ? '#ECEEF4' : '#FFFFFF';
			$data .='<tr style="background:'.$bg.'">
			    <td><input type="checkbox" class="selrow" value="'.$value['Eid'].'"/>
					<input type="hidden" value="'.$value['Eid'].'" name="Eid" />
				</td>
			    <td><span class="Evename">'.$value['Evename'].' </span></td>
			    <td><span class="Eaddress">'.$value['Eaddress'].'</span></td>
 			    <td><span class="Ecity">'.$value['Ecity'].'</span></td>
			    <td><span class="Estate">'.$value['Estate'].'</span></td>
				<td><span class="Ezip">'.$value['Ezip'].' </span></td>
			    <td><span class="EphoneNumber">'.$value['EphoneNumber'].'</span></td>
			    <td><span class="Edescription">'.$value['Edescription'].'</span></td>
			    <td><span class="Ewebsite">'.$value['Ewebsite'].'</span></td>
			    <td><span class="Ehashtag">'.$value['Ehashtag'].' </span></td>
			    <td><span class="Efacebook">'.$value['Efacebook'].'</span></td>
			    <td><span class="Etwitter">'.$value['Etwitter'].'</span></td>
			    <td><span class="Egoogle">'.$value['Egoogle'].'</span></td>
				<td align="center">
					<img src="./images/edit.png" class="updrow" title="Update"/>&nbsp;
					<img src="./images/delete.png" class="delrow" title="Delete"/>
				</td>
			  </tr>';
			$i++;
		}
		$data .='</tbody>
			</table></form>
			<div id="paginator">'.$db->paginate().'</div>';
		return $data;
	}

	if($action == 'ajax') {
		echo getTable();
	} else if($action == 'delete') {
			$db->delete($_REQUEST['id']);
			echo getTable();
	} else if($action == 'update') {
			unset($_REQUEST['action']);
			$db->update($_REQUEST);
	}
}
?>

<html>
	<head>
		<title>Your Events</title>
<!-- 
		<link rel="STYLESHEET" type="text/css" href="css/fg_membersite.css">
		<link href="css/accordion.css" rel="stylesheet" type="text/css" />
 -->
		<!--(Start) Provided by JetDevLLC-->
<!-- 
		<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="css/style.css"            rel="stylesheet" type="text/css" />
		<link href="css/responsive.css"       rel="stylesheet" type="text/css" />
 -->
		<link href="favicon.ico"              rel="shortcut icon"  />	
		<!--[if IE 6]>
		<style type="text/css">img, div, { behavior: url("js/iepngfix.htc") }
		</style>
		<![endif]-->
		<!--(End) Provided by JetDevLLC-->
	
		<!-- Twitter script -->
<!-- 
		<script>
			!function(d,s,id){
				var js,fjs=d.getElementsByTagName(s)[0];
				if(!d.getElementById(id)){
					js=d.createElement(s);
					js.id=id;js.src="//platform.twitter.com/widgets.js";
					fjs.parentNode.insertBefore(js,fjs);
				}
			}(document,"script","twitter-wjs");
		</script>
 -->
		<!-- End of Twitter script -->

		<!-- Hashtag script -->
<!-- 
		<script>
			!function(d,s,id){
				var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
				if(!d.getElementById(id)){
					js=d.createElement(s);
					js.id=id;js.src=p+'://platform.twitter.com/widgets.js';
					fjs.parentNode.insertBefore(js,fjs);
				}
			}(document, 'script', 'twitter-wjs');
		</script>
 -->
		<!-- End Hashtag script -->
		
		<!--(Start) Provided by JetDevLLC-->
<!-- 
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
 -->
		<!--(End) Provided by JetDevLLC-->
		<!--(End) Scripts-->
		
	</head>
	
	<body >
<!-- 
		<div class="header-wrap">
			<div class="header">
				<a class="logout-btn" href='logout.php'>Log Out</a>
				<ul class="head-social-icons">
					<!~~-<li><a class="facebook"   href="#"></a></li>
					<li><a class="twitter"    href="#"></a></li>
					<li><a class="googleplus" href="#"></a></li>~~>
					<?PHP //include 'SBar.php';?>
<!~~ 					<li>Welcome <?= $fgmembersite->UserFullName() ?>!</li> ~~>
				</ul><!~~//head-social-icons~~>

				<ul class="nav">
					<li><a href="./userPage.php">User Page</a></li>
					<li><span class="shadow">|</span></li>
					<li><a href="./EventCreation.php">Create Event</a></li>
					<li><span class="shadow">|</span></li>
					<li><a href="./searchForm.php">Search Events</a></li>
					<li><span class="shadow">|</span></li>
					<li><a href="./liveUpdate.php">Edit Events</a></li>
				</ul>
				<div class="mobile-menu-btn"><span class="icon-reorder"></span></div>
			</div><!~~//header~~>
		</div><!~~//header-wrap~~>
 -->
		
<!-- 
		<div class="mobile-menu-list">
			<ul>
				<li><a href="./EventCreation.php">createEvent</a></li>
				<li><a href="./searchForm.php">Search</a></li>
				<li><a href="#Events">Events</a></li>
			</ul>   
		</div><!~~//mobile-menu-list~~>
 -->
		</body>
<!-- 
		        <div class="links">
			<?PHP //include './links.php'; ?>
        </div>

        <div class="footer">
			<?PHP //include './footer.php'; ?>
        </div>
 -->
		</html>