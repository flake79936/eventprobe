<ul>
            	
<!--        TESTING EVENTS              -->
            	
<!--       Connection      	 -->
   <?PHP
	require_once("./include/membersite_config.php");
	if(isset($_POST["submitted"])){
		$result = $fgmembersite->searchEvent();
	}
	
	
	$con = mysqli_connect('localhost', 'admindev', '17s_9Eyr', 'EventAdvisors');
	
	if (!$con) {
		die('Could not connect: ' . mysqli_error($con));
	}

	mysqli_select_db($con, "EventAdvisors");

// 	$sql = "SELECT * FROM Events WHERE Ecity = '";
// 	$sql .=$city;
// 	$sql .="' ORDER BY EstartDate";
// 	echo $sql;
	
$sql = "SELECT * FROM Events WHERE Ecity = 'el paso' ORDER BY EstartDate";
	$result = mysqli_query($con, $sql);

?>         	
            	
<!--       End Connection      	 -->
            	
							<?PHP
						$i = 0;
						while($row = mysqli_fetch_array($result)){ 

					?>            	
            	
            	
                	<li>
                    	<div class="info">
                        	<div class="box">
                                <a href="#" class="btn-cross"><img src="images/btn_cross.png" alt="Cross" /></a>
                                <h1>Today</h1>
                                <p><?= $row['EstartDate'] ?></p>
                                <h1><?= $row['Evename'] ?></h1>
                            </div>
                        </div>
                    	<img src="<?= $row['Eflyer'] ?>" alt="Image" />
                    </li>
                    
                    
                    
                  <?PHP $i++; } ?>  
                    
                    
<!--        TESTING EVENTS              -->
           
                    
                    <div class="clear"></div>
                </ul>
                
                