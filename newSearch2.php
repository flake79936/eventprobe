<?PHP
 	$result = $_SESSION['search']; 
 	
?>


<div id="main_container">
			<div id='middle_box'>
				<div id="inner-mid-box">
					<?PHP
						$i = 0;
						while($row = mysqli_fetch_array($result)){ 
						
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
									<label for="radio-<?= $i?>"><?= $row['Evename'] . " " . $row['EstartDate']?></label>
									<!-- <label for="radio-<?= $i?>">Event <?= $i?></label> -->
									<div class="content">
										<p><?= $row['Evename'] ?></p>
										<p><?= $row['Eaddress'] ?></p>
										<p><?= $row['Edescription'] ?></p>
										<p><a href="<?= $row['Ewebsite'] ?>" target="_blank"><?= $row['Ewebsite'] ?></p>
										<?PHP
                                            if ($row['Efacebook']): ?>
                                            <a href="<?= $row['Efacebook'] ?>" target="_blank" >
                                            <img src="./img/icons/facebook.ico"
                                            width="20" height="20" title="Facebook"
                                            border="0" style="display:inline;"></a>
                                        <?PHP endif; ?>

                                        <?PHP
                                            if ($row['EhashTag']): ?>
										<a href="https://twitter.com/intent/tweet?button_hashtag=<?= $row['Ehashtag'] ?>"
										class="twitter-hashtag-button">Tweet#<?= $row['Ehashtag'] ?></a>
                                        <?PHP endif; ?>
										
                                        <?PHP
                                            if ($row['Etwitter']): ?>
										<a href="https://twitter.com/<?= $row['Etwitter'] ?>" class="twitter-follow-button"
										data-show-count="false" data-lang="en">Follow<?= $row['Etwitter'] ?></a>
                                        <?PHP endif; ?>


                                        <?PHP
                                            if ($row['Etwitter']): ?>
										<a href="<?= $row['Egoogle'] ?>" rel="publisher" target="_blank">
										<img src="./img/icons/googleplus.ico"
										width="20" height="20" title="google+" 
										border="0" style="display:inline;"></a>
                                        <?PHP endif; ?>
										<p><?= $row['Eother'] ?></p>
																																					
										<p><iframe
											width="300"
											height="150"
											frameborder="0" style="border:0"
											src="https://www.google.com/maps/embed/v1/place?key=AIzaSyB0uLEbR6K9fehSmaCyR4-NdWmIUaYevjY&q=<?= $street?>">
										</iframe></p>
									</div>
								</li>
							</ul>
						</div>
					<?PHP $i++; } ?>
				</div>
			</div>
		</div>