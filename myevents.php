<!--Module-->
<?PHP
	require_once("./include/membersite_config.php");
	include 'dbconnect.php';
	
	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);
	
	$usrname = $fgmembersite->UsrName();
	
	if(isset($_POST["submitted"])){
		if($fgmembersite->deleteEvent()){
			$fgmembersite->RedirectToURL("./index2.php");
		}
	}
	
	$newformat = date('Y-m-d');
	//echo "<br>DATE: ". $newformat . "<br>";
	
	$pageId = (isset($_GET["myEventPageId"]) ? $_GET["myEventPageId"] : 0);
	//echo "Page: " . $pageId . "<br>";
	
	$sql = "SELECT * FROM Events WHERE EstartDate >= '" . $newformat . "' AND UuserName = '" . $usrname . "' AND Edisplay='1' ORDER BY EstartDate ASC;";
	$result = mysqli_query($con, $sql);
	//echo "<br>Query: " . $sql . "<br>";
	
	$count = mysqli_num_rows($result);
	//echo "count: " . $count;
	
	if($count > 0){
		$paginationCount = $fgmembersite->getPagination($count, 5);
	}
	//echo "<br/>Pagination Count: " . $paginationCount . "<br/>";
	
	$sql2 = "SELECT * FROM Events WHERE EstartDate >= '" . $newformat . "' AND UuserName = '" . $usrname . "' AND Edisplay='1' LIMIT 1 ORDER BY EstartDate;";
	$result2 = mysqli_query($con, $sql2);
	
	$sql3 = "SELECT Upic FROM Registration WHERE UuserName = '" . $usrname . "';";
	$result3 = mysqli_query($con, $sql3);
?>

<head>
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<link rel="stylesheet" media="all" href=""/>
	
	<!--STYLE-->
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/pag.css" />
	
	<!--Scripts-->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	
	<!--When edit btn is clicked, this function is triggered-->
	<script>
		function editEvent(str){
			window.location = "./editEvent.php?eid="+str;
		}
	</script>
	
	<script>
		(function($){
			$(document).ready(function(){
				$.ajaxSetup({
					cache: false,
					beforeSend: function(){
						$('#myEventsDataLoading').show();
						$('#myEventsData').hide();
					},
					complete: function(){
						$('#myEventsDataLoading').hide();
						$('#myEventsData').show();
					},
					success: function(){
						$('#myEventsDataLoading').hide();
						$('#myEventsData').show();
					}
				});
				var $myEventsContainer = $("#myEventsData");
				$myEventsContainer.load("loadEvents.php?myEventPageId=0");
				
				var refreshId = setInterval(function(){
					$myEventsContainer.load("loadEvents.php?myEventPageId=0");
				}, 60000); //30k = 30 seconds
			});
		})(jQuery);
		
		function changePagination(myEventPageId){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementsById("myEventsData").innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET", "loadEvents.php?myEventPageId=" + myEventPageId, true);
			xmlhttp.send();
		}
	</script>
	<!-- End of Scripts	-->
</head>

<div class="box">
	<h1>My Events</h1>
</div>

<div class="box"></div>

<div class="box event">
	<img src="./images/loading.gif" id="myEventsDataLoading" alt="loading" style="display:none;" />
	<div id="myEventsData" class="myEventsData"></div>

	<?PHP if($count > 0){ ?>
		<ul class="tsc_pagination tsc_paginationC tsc_paginationC01">
			<li class="first link" id="first">
				<a onClick="changePagination(0)">First</a>
			</li>
			
			<!--Displays the page numbers-->
			<?PHP for($i = 0; $i < $paginationCount; $i++){ ?>
				<li id="<?= ($i+1)."_no" ?>" class="link">
					<a onClick="changePagination(<?PHP echo ($i+1); ?>)"><?PHP echo ($i+1); ?></a>
				</li>
			<?PHP } ?>
		
			<li class="last link" id="last">
				<a onClick="changePagination(<?PHP echo $paginationCount; ?>)">Last</a>
			</li>
		</ul>
	<?PHP } ?>
</div>

<!--<div class="box arrow"><a href="#"><img src="images/btn_arrow_right.png"></a></div>-->
<div class="clear"></div>