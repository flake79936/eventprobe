<!--Module-->
<?PHP
	require_once("./include/membersite_config.php");
	include 'dbconnect.php';
	
	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);
	
	$usrname = $fgmembersite->UsrName();
	
	$newformat = date('Y-m-d');
	//echo "<br>DATE: ". $newformat . "<br>";
	
	//$pageId = (isset($_GET["myEventPageId"]) ? $_GET["myEventPageId"] : 0);
	//echo "Page: " . $pageId . "<br>";
	
	//$sql = "SELECT * FROM Events WHERE EstartDate >= '" . $newformat . "' AND UuserName = '" . $usrname . "' AND Edisplay='1' ORDER BY EstartDate ASC;";
	//$result = mysqli_query($con, $sql);
	//echo "<br>Query: " . $sql . "<br>";
	
	//$count = mysqli_num_rows($result);
	//echo "count: " . $count;
	
	//if($count > 0){
	//	$paginationCount = $fgmembersite->getPagination($count, 5);
	//}
	//echo "<br/>Pagination Count: " . $paginationCount . "<br/>";
	
	//$sql2 = "SELECT * FROM Events WHERE EstartDate >= '" . $newformat . "' AND UuserName = '" . $usrname . "' AND Edisplay='1' LIMIT 1 ORDER BY EstartDate;";
	//$result2 = mysqli_query($con, $sql2);
	
	//$sql3 = "SELECT Upic FROM Registration WHERE UuserName = '" . $usrname . "';";
	//$result3 = mysqli_query($con, $sql3);
?>

<head>
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<link rel="stylesheet" media="all" href=""/>
	
	<!--STYLE-->
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	
	<!--Scripts-->
	<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
	
	<!--When edit btn is clicked, this function is triggered-->
	<script>
		//I ran out of meaningful names for 'start' and 'end'
		//s -> start
		var s = 0;
		
		//e -> end
		var e = 5;
		
		var interval = 5;
		
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
				$myEventsContainer.load("loadEvents.php");
				
				//var refreshId = setInterval(function(){
				//	$myEventsContainer.load("loadEvents.php");
				//}, 60000); //30k = 30 seconds
			});
		})(jQuery);
		
		function prevTen(){
			if(s > 0){
				s -= interval;
				e -= interval;
				
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						//document.getElementById("myEventsData").innerHTML = xmlhttp.responseText;
						document.getElementById("myEventsData").innerHTML = "reverse";
					}
				}
				xmlhttp.open("GET", "loadEvents.php?s=" + s, true);
			}
		}
		
		function nextTen(){
			s = e;
			e += interval;
			
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("myEventsData").innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET", "loadEvents.php?s=" + s, true);
			xmlhttp.send();
		}
	</script>
	
	<script>
		function editEvent(str){
			window.location = "./editEvent.php?eid="+str;
		}
	</script>
	
	<script>
	function deleteEvent(eid){
		var success = confirm("You Sure You Want To Delete The Event?");
		
		if (success == true) {
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
					//alert("Your Event Has Been Deleted.");
				}
			});
			var $myEventsContainer = $("#myEventsData");
			$myEventsContainer.load("loadEvents.php?success=" + success + "&eid=" + eid);
		}
	}
</script>
	<!-- End of Scripts	-->
</head>

<div class="box">
	<h1>My Events</h1>
</div>

<!--<div class="box"></div>-->

<div class="box-events">
	<div class="a-row">
		<div class="box-left">
			<a onClick='prevTen();'>
				<img src='./images/icon_ctrl_left.png' alt='Icon'/>
			</a>
		</div>
		
		<div class="box-right">
			<a onClick='nextTen();'>
				<img src='./images/icon_ctrl_right.png' alt='Icon' />
			</a>
		</div>
	</div>
	
	<div id="myEventsData" class="myEventsData"></div>
	<img src="./images/loading.gif" id="myEventsDataLoading" alt="loading" style="display:none;" />
	
	<div class="clear"></div>
</div>

<!--<div class="box arrow"><a href="#"><img src="images/btn_arrow_right.png"></a></div>-->
<div class="clear"></div>