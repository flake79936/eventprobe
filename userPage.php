<?PHP	require_once("./include/membersite_config.php");
	if($fgmembersite->CheckLogin()){
		$usrname = $fgmembersite->UsrName();  
	}
?>
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
        <link rel="stylesheet" type="text/css" href="css/styleUserPage.css" />

        <!--FAVICON-->
        <link rel="shortcut icon" href="favicon.ico"  />
        
        <!--JQUERY-->
        <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>
        
        <!--GOOGLE MAPS-->
        <script type="text/javascript" src="js/googleapis.js"></script>
        <script type="text/javascript" src="js/map.js"></script>
        
	</head>
	
	<body lang="en">
    
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
                                <li><img src="images/music.png" alt="Music" /><a href="#">DJ Maxwell, Aug 30</a></li>
                                <li><img src="images/speaker.png" alt="Speaker" /><a href="#">Speaker Event, Sep 30</a></li>
                                <li><img src="images/dollar.png" alt="Dollar" /><a href="#">Sales Events, Oct 30</a></li>
                            </ul>
                        </li>
                        <li>
                            <h3>Past</h3>
                            <ul>
                                <li><img src="images/music.png" alt="Music" /><a href="#">DJ Maxwell, Aug 30</a></li>
                                <li><img src="images/speaker.png" alt="Speaker" /><a href="#">Speaker Event, Sep 30</a></li>
                                <li><img src="images/dollar.png" alt="Dollar" /><a href="#">Sales Events, Oct 30</a></li>
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
                        <a href="#"><img src="images/icon_cam.png" alt="Image" /></a>
                        <div class="clear"></div>
                    </div>
                    <img src="images/profile-img.jpg" alt="Profiles" />
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
            
            <form>
            <div class="form-wrap">
                <div class="box">
                    <h5>description</h5>
                    <textarea></textarea>
                    <h5>Location</h5>
                    <div class="location">
                        <div class="image"><img src="images/icon_location.png" /></div>
                        <input type="text" />
                        <div class="clear"></div>
                    </div>
                    <div class="wrap">
                        <div class="type">
                            <h5>Date</h5>
                            <input type="text" />
                        </div>
                        <div class="type">
                            <h5>Time</h5>
                            <input type="text" />
                        </div>
                        <div class="type">
                            <h5>Price</h5>
                            <input type="text" />
                        </div>
                        <div class="clear"></div>
                    </div>
                    <h5>Hashtag</h5>
                    <input type="text" />
                </div>
                
                <div id="googleMap" class="gmap"></div>
                <div class="clear"></div>
            </div>
            <div class="form-wrap">
                <div>
                    <h5>Share</h5>
                    <h5>Email List</h5>
                    <select>
                        <option>My Contact List</option>
                        <option>My Contact List 1</option>
                        <option>My Contact List 2</option>
                        <option>My Contact List 3</option>
                    </select>
                    <h5>Social Networks</h5>
                    <ul class="social">
                        <li>
                            <input type="checkbox" id="facebook" />
                            <label for="facebook">Facebook</label>
                            <img src="images/icon_fb.png" alt="Facebook" />
                        </li>
                        <li>
                            <input type="checkbox" id="twitter" />
                            <label for="twitter">Twitter</label>
                            <img src="images/icon_tw.png" alt="Twitter" />
                        </li>
                        <li>
                            <input type="checkbox" id="google" />
                            <label for="google">Google Plus</label>
                            <img src="images/icon_gp.png" alt="Google Plus" />
                        </li>
                        <li>
                            <input type="checkbox" id="square" />
                            <label for="square">Foursquare</label>
                            <img src="images/icon_fs.png" alt="Foursquare" />
                        </li>
                        <div class="clear"></div>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
            </form>
            
            <div class="dashboard none">
                <div class="saved">
                    <div class="box"><h3>Saved</h3></div>
                    <div class="box"><a href="#"><img src="images/btn_draft.png" alt="Draft" /></a></div>
                    <div class="box"><a href="#"><img src="images/btn_publish.png" alt="Draft" /></a></div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            
        
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="footer"></div>
		
	</body>
	
</html>