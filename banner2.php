<!--Module-->
<?PHP
	require_once("./include/membersite_config.php");
	include 'dbconnect.php';
	
	$height = "300px";
	$width = "100%";

	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);
	
	$today = Date("m/d/Y");

	$city = $fgmembersite->getCity();
	//$city = 'el paso';

	$sql = "SELECT Eid, Eflyer, Evename, Edisplay FROM Events WHERE Ecity= '".$city."' AND  EstartDate >= '".$today."' AND Erank='Premium' AND Edisplay='1';";
	$result = mysqli_query($con, $sql);
?>

<!-- jQuery library (served from Google) -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<!-- bxSlider Javascript file -->
<script src="/js/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="/css/jquery.bxslider.css" rel="stylesheet" />

<?PHP 

?>
<ul class="bxslider" style="width: 515%; position: relative; -webkit-transition-duration: 0.5s; transition-duration: 0.5s; -webkit-transform: translate3d(-1460px, 0px, 0px);" >
	<?PHP
		while($row = mysqli_fetch_array($result)){
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