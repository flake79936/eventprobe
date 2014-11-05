<?PHP	require_once("./include/membersite_config.php"); ?>
<!doctype html>
<html>
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
        <link rel="stylesheet" type="text/css" href="css/style.css" />

        <!--FAVICON-->
        <link rel="shortcut icon" href="favicon.ico"  />
        
         <script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
			<script language="Javascript"> 
			var city = geoplugin_city();
			</script>
			
			  <?PHP $city = "<script>document.write(city)</script>";
// 			  echo $city;
			  ?>
        
	</head>
	
	<body lang="en">
    	<div class="top">
    	
    	<?PHP 
    	include './top.php'; 
    	?>
<!-- 
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
                <h2>Ed Smith</h2>
                <a href="#"><img src="images/btn_arrow_down_black.png" alt="Dropdown" /></a>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
 -->
        </div>
        
<!-- start My events      -->
<?PHP        if($fgmembersite->CheckLogin()){?>
<?PHP include './myevents.php'; ?>
<?PHP }?>

<!-- end My events -->
        
        <div class="banner">
                <img src="images/banner.jpg" alt="Banner" /></div>
        
        <div class="this-week">
        	<div class="box"><a href="#"><img src="images/btn_arrow_left.png" alt="Arrow" /></a></div>
            <div class="box title"><h2>This week near you</h2></div>
            <div class="box"><a href="#"><img src="images/btn_arrow_right.png" alt="Arrow" /></a></div>
            <div class="clear"></div>
        </div>
        
        <div class="schedule">
        	<div class="map">
        	<iframe src="./geo.php" height="390px" width="390px"></iframe>
<!-- 				<?PHP include('./geo.php'); ?> -->
				<!--<img src="images/map.jpg" alt="Map" />-->
        	        </div>
            <div class="today">
<!--             <iframe src="./geo2.php" height="380px" width="700px"></iframe> -->
				<?PHP include './events.php'; ?>
            </div>
            
            
            
            <div class="clear"></div>
        </div>
        
        <div class="chart">
        	<div class="box">
            	<div class="title">
                	<h1>Today and this Week Near You</h1>
                    <a href="#"><img src="images/btn_refresh.png" alt="Refresh" /></a>
                    <div class="clear"></div>
                </div>
                
                <div class="row">
                	<div class="cell">&nbsp;</div>
                	<div class="cell active">
                    	<div class="circle">1</div>
                        <h4>9/20<br />TUE</h4>
                    </div>
                    <div class="cell">
                    	<div class="blank">&nbsp;</div>
                        <h4>9/20<br />WED</h4>
                    </div>
                    <div class="cell">
                    	<div class="circle">1</div>
                        <h4>9/20<br />TUE</h4>
                    </div>
                    <div class="cell">
                    	<div class="circle">4</div>
                        <h4>9/20<br />SUN</h4>
                    </div>
                    <div class="cell">
                    	<div class="blank">&nbsp;</div>
                        <h4>9/20<br />MON</h4>
                    </div>
                    <div class="cell">
                    	<div class="circle">3</div>
                        <h4>9/20<br />TUE</h4>
                    </div>
                    <div class="cell">
                    	<div class="blank">&nbsp;</div>
                        <h4>9/20<br />THU</h4>
                    </div>
                    <div class="cell">
                    	<div class="blank">&nbsp;</div>
                        <h4>9/20<br />SUN</h4>
                    </div>
                    <div class="cell">
                    	<div class="blank">&nbsp;</div>
                        <h4>9/20<br />WED</h4>
                    </div>
                    <div class="cell">&nbsp;</div>
                    <div class="clear"></div>
                </div>
                
                <div class="row">
                	<div>
                    	<div class="profile"><img src="images/sample_today.jpg" alt="Image" /></div>
                            <div class="info active">
                                <div class="box">4:30 PM - 6:000 PM</div>
                                <div class="box">Muligans Happy Hour</div>
                                <div class="box">
                                	<ul>
                                    	<li><img src="images/icon_star.png" alt="Icon" /></li>
                                        <li><img src="images/icon_star.png" alt="Icon" /></li>
                                        <li><img src="images/icon_star.png" alt="Icon" /></li>
                                        <li><img src="images/icon_star.png" alt="Icon" /></li>
                                        <li><img src="images/icon_star.png" alt="Icon" /></li>
                                    </ul>
                                </div>
                                <div class="box"><img src="images/icon_fb.png" alt="Facebook" /></div>
                                <div class="box">more</div>
                                <div class="box"><a href="#"><img src="images/btn_cross.png" alt="Icon" /></a></div>
                            </div>
                        <div class="clear"></div>
                    </div>
                    <div>
                    	<div class="profile"><img src="images/sample_today.jpg" alt="Image" /></div>
                            <div class="info">
                                <div class="box">4:30 PM - 6:000 PM</div>
                                <div class="box">Muligans Happy Hour</div>
                                <div class="box">
                                	<ul>
                                    	<li><img src="images/icon_star.png" alt="Icon" /></li>
                                        <li><img src="images/icon_star.png" alt="Icon" /></li>
                                        <li><img src="images/icon_star.png" alt="Icon" /></li>
                                        <li><img src="images/icon_star.png" alt="Icon" /></li>
                                        <li><img src="images/icon_star.png" alt="Icon" /></li>
                                    </ul>
                                </div>
                                <div class="box"><img src="images/icon_fb.png" alt="Facebook" /></div>
                                <div class="box">more</div>
                                <div class="box"><a href="#"><img src="images/btn_cross.png" alt="Icon" /></a></div>
                            </div>
                        <div class="clear"></div>
                    </div>
                    <div>
                    	<div class="profile"><img src="images/sample_today.jpg" alt="Image" /></div>
                            <div class="info">
                                <div class="box">4:30 PM - 6:000 PM</div>
                                <div class="box">Muligans Happy Hour</div>
                                <div class="box">
                                	<ul>
                                    	<li><img src="images/icon_star.png" alt="Icon" /></li>
                                        <li><img src="images/icon_star.png" alt="Icon" /></li>
                                        <li><img src="images/icon_star.png" alt="Icon" /></li>
                                        <li><img src="images/icon_star.png" alt="Icon" /></li>
                                        <li><img src="images/icon_star.png" alt="Icon" /></li>
                                    </ul>
                                </div>
                                <div class="box"><img src="images/icon_fb.png" alt="Facebook" /></div>
                                <div class="box">more</div>
                                <div class="box"><a href="#"><img src="images/btn_cross.png" alt="Icon" /></a></div>
                            </div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                
            </div>
            
            <div class="advertisement">
            	<a href="#"><img src="images/advertisement_01.jpg" alt="Banner" /></a>
                <a href="#"><img src="images/advertisement_02.jpg" alt="Banner" /></a>
            </div>
            <div class="clear"></div>
        </div>
        
        <div class="app">
        	<div class="left">
            	<div class="user">
                    <div class="box">
                        <img src="images/sample_profile_01.png" alt="Image" />
                        <h3>Kim Pomeroy</h3>
                    </div>
                    <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit."</p>
                    <div class="clear"></div>
                </div>
                <div class="user">
                	<div class="box">
                        <img src="images/sample_profile_02.png" alt="Image" />
                        <h3>Eylie Edie</h3>
                    </div>
                    <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit."</p>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="right">
            	<div class="image"><img src="images/app.png" alt="Download App" /></div>
                <div class="mobile">
                	<h1>Download the App</h1>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        
        <div class="links">
        	<ul>
            	<li><h3>Libero</h3></li>
            	<li><a href="#">Lorem ipsum dolor</a></li>
                <li><a href="#">Etiam in congue</a></li>
                <li><a href="#">Tortor</a></li>
                <li><a href="#">Donec</a></li>
                <li><a href="#">Consequat aliquam</a></li>
            </ul>
            <ul>
            	<li><h3>Libero</h3></li>
            	<li><a href="#">Lorem ipsum dolor</a></li>
                <li><a href="#">Etiam in congue</a></li>
                <li><a href="#">Tortor</a></li>
                <li><a href="#">Donec</a></li>
                <li><a href="#">Consequat aliquam</a></li>
            </ul>
            <ul>
            	<li><h3>Libero</h3></li>
            	<li><a href="#">Lorem ipsum dolor</a></li>
                <li><a href="#">Etiam in congue</a></li>
                <li><a href="#">Tortor</a></li>
                <li><a href="#">Donec</a></li>
                <li><a href="#">Consequat aliquam</a></li>
            </ul>
            <ul>
            	<li><h3>Libero</h3></li>
            	<li><a href="#">Lorem ipsum dolor</a></li>
                <li><a href="#">Etiam in congue</a></li>
                <li><a href="#">Tortor</a></li>
                <li><a href="#">Donec</a></li>
                <li><a href="#">Consequat aliquam</a></li>
            </ul>
            <div class="clear"></div>
        </div>
        
        <div class="footer">
            <ul class="social">
                <li><a href="#"><img src="images/btn_google.png" alt="Google" /></a></li>
                <li><a href="#"><img src="images/btn_twitter.png" alt="Twitter" /></a></li>
                <li><a href="#"><img src="images/btn_fb.png" alt="Facebook" /></a></li>
                <li><a href="#"><img src="images/btn_pin.png" alt="Pinterest" /></a></li>
            </ul>
            <div class="footer-logo"><img src="images/footer-logo.png" alt="Logo" /></div>
			<div class="clear"></div>
        </div>
    
	</body>
	
</html>