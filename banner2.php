<!--Module-->
<?PHP
	require_once("./include/membersite_config.php");
	include 'dbconnect.php';
	
	$height = "300px";
	$width = "100%";

	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);
	
	$today = Date("Y-m-d");

	$city = $fgmembersite->getCity();
	//$city = 'el paso';

	$sql = "SELECT Eid, Eflyer, Evename, Edisplay, Etype FROM Events WHERE Ecity= '".$city."' AND  EstartDate >= '".$today."' AND Erank='Premium' AND Edisplay='1';";
	$result = mysqli_query($con, $sql);
?>

<!-- jQuery library (served from Google) -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<!-- bxSlider Javascript file -->
<script src="/js/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="/css/jquery.bxslider.css" rel="stylesheet" />

<ul class="bxslider" style="width: 515%; position: relative; -webkit-transition-duration: 0.5s; transition-duration: 0.5s; -webkit-transform: translate3d(-1460px, 0px, 0px);" >
	<?PHP
		while($row = mysqli_fetch_array($result)){
			$type = $row['Etype'];
			if($row['Eflyer'] === ""){
				switch($type){
					case "Art":            $row['Eflyer'] = "./images/art35.png"; break;
					case "Concert":        $row['Eflyer'] = "./images/music.png"; break;
					case "Fair":           $row['Eflyer'] = "./images/fair35.png"; break;
					case "Social":         $row['Eflyer'] = "./images/weight35.png"; break;
					case "Sport":          $row['Eflyer'] = "./images/sports40.png"; break;
					case "Public Speaker": $row['Eflyer'] = "./images/speaker.png"; break;
					default:               $row['Eflyer'] = "./images/magic35.png"; break;
				}
			}
			
			echo "<li style='float: left; list-style: none; position: relative;' class='bx-clone'>
				<a onClick='seeMoreInfo(".$row['Eid'].");'>
					<img src='".$row['Eflyer']."' title='".$row['Evename']."' height='".$height."' width='".$width."'/>
				</a>
			</li>";
		}
	?>
</ul>

<script type="text/javascript">
	$(document).ready(function(){
		$('.bxslider').bxSlider({
			//mode: 'fade',
			captions: true,
			auto: true/*,
			autoControls: true*/
		});
	});
</script>