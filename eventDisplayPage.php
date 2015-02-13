<?PHP	require_once("./include/membersite_config.php"); 
// 	$newEventID = $_GET['eid'];
	$newEventID = "35";
	include 'dbconnect.php';
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
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/top.css" />
        <link rel="stylesheet" type="text/css" href="css/app.css" />
        <link rel="stylesheet" type="text/css" href="css/links.css" />
        <link rel="stylesheet" type="text/css" href="css/footer.css" />

        <!--FAVICON-->
        <link rel="shortcut icon" href="favicon.ico"  />
	</head>
	
	<body lang="en">
    	<div class="top">
			<?PHP include './top.php';?>
        </div>
        
        <?PHP
  		$qry = "SELECT * FROM Events WHERE Eid = '".$newEventID."' ;";
		$result = mysqli_query($con, $qry);   
		
		while($row = mysqli_fetch_array($result)) {   
        
        ?>
				<div class="app">		

		
							<div class="left">

							<h2> <?= $row['Evename'] ?> - <?= $row['Ehashtag'] ?></h2>
							<h4><?= $row['EstartDate'] ?> <?= $row['EtimeStart'] ?> to <?= $row['EtimeEnd'] ?> </h4>
							<div img src= <?= $row['Eflyer'] ?> height="300px" width="873px" >
							test
														
							</div><!-- End of left-->
							
							
							</div>
							
							

							<div class="right">

								Right

							<div class="clear"></div>



							</div><!-- End of Right -->  
							
							
						<?PHP	}?>

        
        <div class="links">
			<?PHP include './links.php'; ?>
        </div>
        
        <div class="footer">
			<?PHP include './footer.php'; ?>
        </div>
	</body>
</html>