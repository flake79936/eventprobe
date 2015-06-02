<!--Module-->
<?PHP
	require_once("./include/membersite_config.php");
	include 'dbconnect.php';
	
	$height = "300px";
	$width = "100%";

	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);
	
	$today = Date("Y-m-d");

// 	$city = $fgmembersite->getCity();
$city= $_SESSION["city"];
	//$city = 'el paso';

	$sql = "SELECT Eid, Ebanner, Evename, Edisplay, Etype FROM Events WHERE Ecity= '".$city."' AND  EstartDate >= '".$today."' AND Erank='Premium' AND Edisplay='1';";
	$sql2 = "SELECT COUNT(*) AS' premiumEvents'num' FROM Events WHERE Ecity= '".$city."' ";
	
	$result = mysqli_query($con, $sql);
	$result2= mysqli_query($con, $sql2);
	
	
//	$query = "SELECT COUNT(*) as `num` FROM {$query}";
//			$row = mysqli_fetch_array(mysqli_query($con, $query));
//			$total = $row['num'];
//			$adjacents = "2";
?>

<!-- jQuery library (served from Google) -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- bxSlider Javascript file -->
<script src="./js/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="/css/jquery.bxslider.css" rel="stylesheet" />

<ul class="bxslider" style="width: 515%; position: relative; -webkit-transition-duration: 0.5s; transition-duration: 0.5s; -webkit-transform: translate3d(-1460px, 0px, 0px);" >
	<?PHP
		while($row = mysqli_fetch_array($result)){
			$type = $row['Etype'];
			if($row['Ebanner'] === ""){
				switch($type){
					case "Art":            $row['Ebanner'] = "./images/icon_artEventHD.png";   break;
					case "Concert":        $row['Ebanner'] = "./images/icon_concertHD.png";    break;
					case "Fair":           $row['Ebanner'] = "./images/icon_festivalHD.png";   break;
					case "Social":         $row['Ebanner'] = "./images/icon_kettleballHD.png"; break;
					case "Sport":          $row['Ebanner'] = "./images/icon_marathonHD.png";   break;
					case "Public Speaker": $row['Ebanner'] = "./images/icon_speakerHD.png";    break;
					default:               $row['Ebanner'] = "./images/icon_fireworksHD.png";  break;
				}
			}
			
			echo "<li style='float: left; list-style: none; position: relative;' class='bx-clone'>
				<a onClick='seeMoreInfo(".$row['Eid'].");'>
					<img src='".$row['Ebanner']."' title='".$row['Evename']."' height='".$height."' width='".$width."'/>
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