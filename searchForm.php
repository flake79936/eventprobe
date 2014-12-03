<!---This PHP file is being used only for those users who are registered in the system.
	-All other users will not be using this Search Form.
	-There will be another form for users whom are not registered to search for events.-->

<?PHP
	require_once("./include/membersite_config.php");
	//assuming the user is registered
// 	if(!$fgmembersite->CheckLogin()){
// 		$fgmembersite->RedirectToURL("index.php");
// 		exit;
// 	}
	
// 	if(isset($_POST["submitted"])){
// 		$result = $fgmembersite->searchEvent();
// // 		header("Location: result.php?result=$result");
// 	}
?>

<!-- 
<html dir="ltr" lang="en-US" >
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="favicon.ico" rel="shortcut icon"  />
		<title>Search Event</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<meta name="format-detection" content="telephone=no" />
		<meta name="format-detection" content="email=no" />
				<link rel="stylesheet" media="all" href=""/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
 -->
		<!-- Adding "maximum-scale=1" fixes the Mobile Safari auto-zoom bug: http://filamentgroup.com/examples/iosScaleBug/ -->
        
        <!--STYLE-->
<!-- 
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/top.css" />
        <link rel="stylesheet" type="text/css" href="css/myEvents.css" />
        <link rel="stylesheet" type="text/css" href="css/banner.css" />
        <link rel="stylesheet" type="text/css" href="css/thisWeek.css" />
        <link rel="stylesheet" type="text/css" href="css/schedule.css" />
        <link rel="stylesheet" type="text/css" href="css/chart.css" />
        <link rel="stylesheet" type="text/css" href="css/app.css" />
        <link rel="stylesheet" type="text/css" href="css/links.css" />
        <link rel="stylesheet" type="text/css" href="css/footer.css" />

		
		
		
 -->
		
		
		
	
	
		
<!-- 		<div id='fg_membersite' align="center"> -->
<!-- 			<fieldset align="left"> -->

				<form id='search' action='result.php' method='GET' accept-charset='UTF-8'>
						<input type='hidden' name='submitted' id='submitted' value='1'/>
						
						<div>
							<span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span>
						</div>
						
					<!-- 	<div class='container'> -->

							<input type='text' name='eventSearch' title="Search" id='eventSearch' value='<?php echo $fgmembersite->SafeDisplay('eventSearch') ?>' maxlength="50" />
<!-- 							<br/> -->
							<span id='search_eventSearch_errorloc' class='error'></span>
<!-- 						</div> -->
						
						<input id="submitButton" type="submit" name="Submit" value="Search" />
				</form>
<!-- 			</fieldset> -->
<!-- 		</div> -->
		
	<!-- 
	<?php
				if(isset($_POST["submitted"])){ ?>
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
			<?PHP } else {
				 echo "";
				} ?>
 -->
<!-- 	</body> -->
	
	<!--This script needs to wihtin the file. 
		It is validating the form.-->
	<script type="text/javascript">
		// <![CDATA[
		var frmvalidator = new Validator("search");
		frmvalidator.EnableOnPageErrorDisplay();
		frmvalidator.EnableMsgsTogether();
		
		frmvalidator.addValidation("eventSearch", "req", "Search Field is Empty!");
		// ]]>
	</script>
</html>