<!--Module-->

<?PHP
	require_once("./include/membersite_config.php");
?>



<!-- jQuery library (served from Google) -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<!-- bxSlider Javascript file -->
<script src="/js/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="/css/jquery.bxslider.css" rel="stylesheet" />


<?PHP 
	$height = "300px";
	$width = "100%";

	include 'dbconnect.php';
	require_once("./include/membersite_config.php");
	$timezone = $fgmembersite->getLocalTimeZone();

	date_default_timezone_set($timezone);
	$today = Date("m/d/Y");

 	$city = $fgmembersite->getCity();
	//$city = 'el paso';

	$sql = "SELECT Eid, Eflyer, Evename FROM Events WHERE Ecity= '".$city."' AND  EstartDate >= '".$today."' AND Erank='premium' AND Edisplay='1' ";
	$result = mysqli_query($con, $sql);
?>


<!-- 
<div class="slider">
<div class="bx-wrapper" style="max-width: 100%;">
<div class="bx-viewport" style="width: 100%; overflow: hidden; position: relative; height: 200px;">
 -->

		<ul class="bxslider" style="width: 515%; position: relative; -webkit-transition-duration: 0.5s; transition-duration: 0.5s; -webkit-transform: translate3d(-1460px, 0px, 0px);" >
			<?PHP
				$i = 0;
				while($row = mysqli_fetch_array($result)) {
					echo "<li style='float: left; list-style: none; position: relative; width: 730px;' class='bx-clone'>
						<a onClick='seeMoreInfo(".$row['Eid'].");'>
						<img src='".$row['Eflyer']."' title='".$row['Evename']."' height='".$height."' width='".$width."'/>
						</a>
					</li>";
					$i++;
				}
			?>
		</ul>
<!-- 
				<div class="bx-controls bx-has-pager bx-has-controls-direction bx-has-controls-auto">
						<div class="bx-pager bx-default-pager">
								<div class="bx-pager-item">
								<a href="" data-slide-index="0" class="bx-pager-link active">1</a>
								</div>
								<div class="bx-pager-item">
								<a href="" data-slide-index="1" class="bx-pager-link">2</a>
								</div>
									<div class="bx-pager-item">
									<a href="" data-slide-index="2" class="bx-pager-link">3</a>
									</div>
						</div>
								<div class="bx-controls-direction">
								<a class="bx-prev" href="">Prev</a>
								<a class="bx-next" href="">Next</a>
								</div>
									<div class="bx-controls-auto">
														<div class="bx-controls-auto-item">
														<a class="bx-start active" href="">Start</a>
														</div>
					
														<div class="bx-controls-auto-item">
														<a class="bx-stop" href="">Stop</a>
														</div>
									</div>
				</div>
 -->
<!-- 
		</div>
 </div>

</div>
 -->

<script type="text/javascript">
	$(document).ready(function(){
  		$('.bxslider').bxSlider({
// 		  mode: 'fade',
 		 captions: true,
  		 auto: true,
//   		autoControls: true
		});
	});
</script>
