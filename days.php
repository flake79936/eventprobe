<?PHP
	require_once("./include/membersite_config.php");
	include 'dbconnect.php';
	
	$city = $fgmembersite->getCity();
	//$city= "el paso";
	
	$usrname = $fgmembersite->UsrName();
	$bool = $fgmembersite->CheckSession();
	
	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);
	
	$start = (int)(isset($_GET["st"]) ? $_GET["st"] : 0);
	$end   = (int)(isset($_GET["en"]) ? $_GET["en"] : 6);
	
	//for loop will only loop 6 arbitrary days.
	for($ai = $start; $ai <= $end; $ai++){
		//increments by 1
		$date = strtotime("+$ai day", strtotime(date("m/d/Y")));
		
		//e.g., 02/03/2015, 
		$today = date("m/d/Y", $date);
		
		//Tue, Wed, etc.
		$day = date("D", $date); 
		
		//e.g., From 02/03/2015 to 02/03
		$trimDate = substr($today, 0, 5);
		
		//converts the string date into time (e.g., 04/22/2015 -> 1429660800)
		$toDate = strtotime($today);
?>
	<div class="cell">
		<?PHP
			//checks if the session is set and if so, display the orage circles on top of the dates.
			if($bool){
				//Sub-query to show events that the user has related to the master table of the events.
				$qry = "SELECT Eid, COUNT(Eid) FROM " . $usrname . "MyEvents WHERE Eid IN (SELECT Eid FROM Events WHERE EstartDate = '" . $today . "' AND Edisplay='1')";
				$result = mysqli_query($con, $qry);
				
				if(mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_assoc($result)){
		?>
						<div class="circle" ><!--Count of how many events the user has in their list.-->
							<?= $row['COUNT(Eid)']; ?>
						</div>
			  <?PHP }
				} 
			} ?>
		<a onClick="getByDayEvent(<?= $toDate ?>);">
			<h4><?= $trimDate ?><br/><?= $day ?></h4>
		</a>
	</div>
<?PHP } ?>