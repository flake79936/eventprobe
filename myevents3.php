<?PHP
	require_once("./include/membersite_config.php");
	if(!$fgmembersite->CheckLogin()){
		$fgmembersite->RedirectToURL("login.php");
		exit;
	}
?>	 
 
 
 
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
	</head>
	
<?PHP

	require_once("./include/membersite_config.php");
		$usrname = $fgmembersite->UsrName();
	$con = mysqli_connect('localhost', 'admindev', '17s_9Eyr', 'EventAdvisors');
	
	if (!$con) {
		die('Could not connect: ' . mysqli_error($con));
	}

	mysqli_select_db($con, "EventAdvisors");

	
$sql = "SELECT * FROM Events WHERE UuserName = '" . $usrname . "' ORDER BY EstartDate";
$result = mysqli_query($con, $sql);
$result2 = mysqli_query($con, $sql);


?> 

<div class="my-events">
        	<div class="box">

            	<h1>My Events</h1>
            </div>
            <div class="box">
            	<div class="profile"><img src="images/profile_sample.jpg" alt="Profile" /></div>
            	        	
        	     <?PHP  			
     					$i = 0;
						while($row = mysqli_fetch_array($result2)){
						
						//day name of the date	
						$today= date("m/d/Y");
						$dt = strtotime($row['EstartDate']);
						$day = date("D", $dt);
						if ($today===$row['EstartDate']){
							$day="Today";?>
							
                <h3><strong><?= $day ?></strong></h3>
                <h3><?= $row['Evename'] ?></h3>
                <h3><strong><?= $row['EtimeStart'] ?></strong></h3>
                         <?   }?>
              <?PHP $i++; } ?>
                <div class="clear"></div>
            </div>

            
            
             <div class="box event">
             
     <?PHP  		
     					$i = 0;
						while($row = mysqli_fetch_array($result)){
						
						//day name of the date	
						$today= date("m/d/Y");
						$dt = strtotime($row['EstartDate']);
						$day = date("D", $dt);
						if ($today===$row['EstartDate']){
							$day="Today";}
	?>
    
            	<ul>
                	<li><?= $day ?> <?=substr($row['EstartDate'], 0, 5);?></li>
                    <li><?= $row['Evename'] ?></li>
                    <li><?= $row['EtimeStart'] ?>-<?= $row['EtimeEnd'] ?></li>
                </ul>
                  <?PHP $i++; } ?>  
                  
                  
            </div>
            <div class="box arrow"><a href="#"><img src="images/btn_arrow_right.png"></a></div>
            <div class="clear"></div>
</div>