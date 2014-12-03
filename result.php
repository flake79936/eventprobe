<?PHP
	require_once("./include/membersite_config.php");
 $result   = "";
//  $_GET['result'];
  $eventSearch   = $_GET['eventSearch'];
// echo $result;
// echo $eventSearch;


	
		$result = $fgmembersite->searchEventHelper($eventSearch);
		if ($result== null){
		echo "Sorry no results found.";
// 		sleep(3);
		$fgmembersite->RedirectToURL("searchForm.php");
		}

	


 ?>

<div id="main_container">
					<div id='middle_box'>
						<div id="inner-mid-box">
							<?PHP
								$i = 0;
								while($row = mysql_fetch_assoc($result)){ 
								
								//if the street name contains two or more words, the map will not recognize the street.
								$address = $row['Eaddress'] . ", " . $row['Ecity'] . ", " . $row['Estate'] . " " . $row['Ezip'];
								$expression = "/\s/";
								$replace = "+";

								$street = preg_replace($expression, $replace, $address);
							?>
								<div class="accordion vertical">
									<ul>
										<li>
											<input type="radio" id="radio-<?= $i?>" name="radio-accordion" checked="checked" />
											<label for="radio-<?= $i?>"><?= $row['Evename']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$row['EstartDate']?></label>
											<div class="content">
												
										<p><b>Address of Event:</b>&nbsp;<?= $row['Eaddress'] ?>, <?= $row['Ecity'] ?>, <?= $row['Estate'] ?>&nbsp; <?= $row['Ezip'] ?> </p>

										<p><b>Event Type:</b>&nbsp;<?= $row['Edescription'] ?></p>
										
										<?PHP /*if ($row['Ewebsite']) { ?>
										<p><a href="<?= $row['Ewebsite'] ?>" target="_blank"><?= $row['Ewebsite'] ?></p>
										<?PHP }*/?>
	
												<p><img src="<?= $row['Eflyer'] ?>"/></p>
												
												<?PHP if ($row['Efacebook']) { ?>
                                            	<a href="<?= $row['Efacebook'] ?>" target="_blank" >
                                            	<img src="./img/icons/facebook.ico"
                                           		width="20" height="20" title="Facebook"
                                            	border="0" style="display:inline;"></a>
												<?PHP }?>


												<?PHP if ($row['Ehashtag']) { ?>
												<a href="https://twitter.com/intent/tweet?button_hashtag=<?= $row['Ehashtag'] ?>"
												class="twitter-hashtag-button">Tweet#<?= $row['Ehashtag'] ?></a>
												<?PHP }?>
										

												<?PHP if ($row['Etwitter']) { ?>
												<a href="https://twitter.com/<?= $row['Etwitter'] ?>" class="twitter-follow-button"
												data-show-count="false" data-lang="en">Follow<?= $row['Etwitter'] ?></a>
												<?PHP }?>


												<?PHP if ($row['Egoogle']) { ?>
												<a href="<?= $row['Egoogle'] ?>" rel="publisher" target="_blank">
												<img src="./img/icons/googleplus.ico"
												width="20" height="20" title="google+" 
												border="0" style="display:inline;"></a>
												<?PHP }?>
																																						
												<p><iframe
													width="300"
													height="150"
													frameborder="0" style="border:0"
													src="https://www.google.com/maps/embed/v1/place?key=AIzaSyB0uLEbR6K9fehSmaCyR4-NdWmIUaYevjY&q=<?= $street?>">
												</iframe></p>
												
												<p><b>Website:</b>&nbsp;<?php echo $row['Ewebsite'] ?></p>
											
											</div>
										</li>
									</ul>
								</div>
							<?PHP $i++; } ?>
						</div>
					</div>
				</div>
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				<div class="box">
	<div class="title">
		<h1>Today and this Week Near You</h1>
		<a href="#"><img src="images/btn_refresh.png" alt="Refresh" /></a>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<div class="cell">&nbsp;</div>
		<div class="cell active">
			<div class="circle">1</div>
			<h4>9/20<br />TUE</h4>
		</div>
		<div class="cell">
			<div class="blank">&nbsp;</div>
			<h4>9/20<br />WED</h4>
		</div>
		<div class="cell">
			<div class="circle">1</div>
			<h4>9/20<br />TUE</h4>
		</div>
		<div class="cell">
			<div class="circle">4</div>
			<h4>9/20<br />SUN</h4>
		</div>
		<div class="cell">
			<div class="blank">&nbsp;</div>
			<h4>9/20<br />MON</h4>
		</div>
		<div class="cell">
			<div class="circle">3</div>
			<h4>9/20<br />TUE</h4>
		</div>
		<div class="cell">
			<div class="blank">&nbsp;</div>
			<h4>9/20<br />THU</h4>
		</div>
		<div class="cell">
			<div class="blank">&nbsp;</div>
			<h4>9/20<br />SUN</h4>
		</div>
		<div class="cell">
			<div class="blank">&nbsp;</div>
			<h4>9/20<br />WED</h4>
		</div>
		<div class="cell">&nbsp;</div>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<div>
			<div class="profile"><img src="images/sample_today.jpg" alt="Image" /></div>
				<div class="info active">
					<div class="box">4:30 PM - 6:000 PM</div>
					<div class="box">Muligans Happy Hour</div>
					<div class="box">
						<ul>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
						</ul>
					</div>
					<div class="box"><img src="images/icon_fb.png" alt="Facebook" /></div>
					<div class="box">more</div>
					<div class="box"><a href="#"><img src="images/btn_cross.png" alt="Icon" /></a></div>
				</div>
			<div class="clear"></div>
		</div>
		<div>
			<div class="profile"><img src="images/sample_today.jpg" alt="Image" /></div>
				<div class="info">
					<div class="box">4:30 PM - 6:000 PM</div>
					<div class="box">Muligans Happy Hour</div>
					<div class="box">
						<ul>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
						</ul>
					</div>
					<div class="box"><img src="images/icon_fb.png" alt="Facebook" /></div>
					<div class="box">more</div>
					<div class="box"><a href="#"><img src="images/btn_cross.png" alt="Icon" /></a></div>
				</div>
			<div class="clear"></div>
		</div>
		<div>
			<div class="profile"><img src="images/sample_today.jpg" alt="Image" /></div>
				<div class="info">
					<div class="box">4:30 PM - 6:000 PM</div>
					<div class="box">Muligans Happy Hour</div>
					<div class="box">
						<ul>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
							<li><img src="images/icon_star.png" alt="Icon" /></li>
						</ul>
					</div>
					<div class="box"><img src="images/icon_fb.png" alt="Facebook" /></div>
					<div class="box">more</div>
					<div class="box"><a href="#"><img src="images/btn_cross.png" alt="Icon" /></a></div>
				</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>

<div class="advertisement">
	<a href="#"><img src="images/advertisement_01.jpg" alt="Banner" /></a>
	<a href="#"><img src="images/advertisement_02.jpg" alt="Banner" /></a>
</div>
<div class="clear"></div>