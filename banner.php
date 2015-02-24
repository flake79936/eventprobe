<?PHP
	require_once("./include/membersite_config.php");
?>

<link type="text/css" href="./css/jquery.bbslider.css" rel="stylesheet" media="screen" />
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="./js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="./js/jquery.bbslider.min.js"></script>

<?PHP 
	$height = "300px";
	$width = "873px";

	include 'dbconnect.php';
	require_once("./include/membersite_config.php");
	$timezone = $fgmembersite->getLocalTimeZone();

	date_default_timezone_set($timezone);
	$today = Date("m/d/Y");

 	$city = $fgmembersite->getCity();
// 	$city='el paso';

	$sql = "SELECT Eflyer, Evename FROM Events WHERE Ecity= '".$city."' AND  EstartDate >= '".$today."' AND Erank='Premium' ";
	$result = mysqli_query($con, $sql);
?>

<div class="bbslider-wrapper" id="auto" height="300px" width="873px" >
	<?PHP
		$i = 0;
		while($row = mysqli_fetch_array($result)) {
			echo '<div><img src="'.$row['Eflyer'].'" alt="'.$row['Evename'].'" height="'.$height.'" width="'.$width.'"/></div>';
			$i++;
		}
	?>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#auto').bbslider({
			auto: true,
			timer:4000,
			loop:true
		});
	});
</script>