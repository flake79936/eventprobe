<!--Map Section-->
<?PHP
	require_once("./include/membersite_config.php");
	include 'dbconnect.php';
	
	$city = $fgmembersite->getCity();
	//$city= "el paso";
	
	$usrname = $fgmembersite->UsrName();
	$bool = $fgmembersite->CheckSession();
	
	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);
	
	$today = Date("m/d/Y"); //e.g., 02/03/2015
	//echo "Today: " . $today . "<br>";
	
	$toDate = (isset($_GET["eventDate"]) ? $_GET["eventDate"] : strtotime($today));
	//echo "toDate: " . $toDate . "<br>";
	
	$newformat = date('Y-m-d');
	//echo "NewFormat: " . $newformat . "<br>";
	
	$pageId = (isset($_GET["eventPageId"]) ? $_GET["eventPageId"] : 0);
	//echo "Page: " . $pageId . "<br>";
	
	$sql = "SELECT * FROM Events WHERE EstartDate = '" . $newformat . "' AND Ecity = '" . $city . "' AND Edisplay='1' AND (Erank='Paid' OR Erank='Premium') ORDER BY EstartDate ASC;";
	$result = mysqli_query($con, $sql);
	$count = mysqli_num_rows($result);
	//echo "<br>Query: " . $sql . "<br>";
	//echo "count: " . $count;

	if($count > 0){
		$paginationCount = $fgmembersite->getPagination($count, 8);
	}
	
	//echo "<br/>Pagination Count: " . $paginationCount . "<br/>";
?>

<script>
	function getMidEvents(pageId) {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("middleEvents").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET", "./events.php?eventPageId=" + pageId, true);
		xmlhttp.send();
	}
</script>


<!--Map-->
<div class="map">
	<iframe src="./map.php"></iframe>
</div>

<!--Today Section-->
<div class="today">
	<?PHP //include './events.php'; ?>
	<div class="middleEvents" id="middleEvents"></div>
	
	<!--Displays the previous, #'s, and next buttons-->
	<?PHP if($count > 0){ ?>
		<ul class="tsc_pagination tsc_paginationC tsc_paginationC01">
			<li class="first link" id="first">
				<a onClick="getMidEvents(0)">First</a>
			</li>
			
			<!--Displays the page numbers-->
			<?PHP for($i = 0; $i < $paginationCount; $i++){ ?>
				<li id="<?= $i."_no" ?>" class="link">
					<a onClick="getMidEvents(<?PHP echo ($i+1); ?>)"><?PHP echo ($i+1); ?></a>
				</li>
			<?PHP } ?>
		
			<li class="last link" id="last">
				<a onClick="getMidEvents(<?PHP echo $paginationCount; ?>)">Last</a>
			</li>
		</ul>
	<?PHP } ?>
</div>

<div class="clear"></div>