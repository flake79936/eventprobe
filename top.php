<?PHP
require_once("./include/membersite_config.php");
	if($fgmembersite->CheckLogin()){
		$usrname = $fgmembersite->UsrName();  
		}
    
?>            
            
            <div class="logo"><img src="images/logo.jpg" alt="Logo" /></div>
            <div class="date">
            	<div class="box">
                	<h1>4:00 PM - Fri Sept 12</h1>
                    <div class="temp">75</div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="profile">
            	<div class="user"><img src="images/sample_profile.png" alt="Profile" /></div>
                <h2><?= $usrname?> </h2>
                <a href="#"><img src="images/btn_arrow_down_black.png" alt="Dropdown" /></a>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>