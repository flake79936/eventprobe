<!--AJAX Module-->
<?PHP	
	require_once("./include/membersite_config.php");
	include 'dbconnect.php';

	$timezone = $fgmembersite->getLocalTimeZone();
	date_default_timezone_set($timezone);
?>
<html >
	<head>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
		
		<link rel="stylesheet" type="text/css" href="css/getEvent.css" />
		<link rel="stylesheet" type="text/css" href="css/header.css" />
		<link rel="stylesheet" type="text/css" href="css/links.css" />
		<link rel="stylesheet" type="text/css" href="css/footer.css" />
		
		<script>
			/* User types in search bar, this will send an HTTP request on the 
			 * background to search the DB and get the result based on what the 
			 * user typed
			 */
			function showHint(str) {
				if (str.length === 0){
					document.getElementById("txtHint").innerHTML = "";
					$(".my-events").show();
					$(".this-week").show();
					$(".schedule").show();
					$(".chart").show();
					$(".app").show();
					return;
				} else {
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
						}
					};
					xmlhttp.open("GET", "./getEvent.php?q=" + str, true);
					xmlhttp.send();
				}
			}
			
			function seeMoreInfo(str){
				window.location = "./eventDisplayPage.php?eid="+str;
			}
		</script>
		
		<script>
		//this method is used with the four icons that are placed on the header.
			function queryShows(str){
				switch(str){
					case "sport":   window.location = "./getEvent.php?sp="  + str; break;
					case "concert": window.location = "./getEvent.php?con=" + str; break;
					case "fair":    window.location = "./getEvent.php?fr="  + str; break;
					case "art":     window.location = "./getEvent.php?art=" + str; break;
					default:        window.location = "./getEvent.php?clrX="+ str; break;
				}
			}
		</script>
	</head>

	<body lang="en">
		<?php include_once("analyticstracking.php") ?>
	
		<div class="header">
			<?PHP include './header.php';?>
		</div>
		
		<div class="events">
			<?php
				$newformat = date('Y-m-d');
				
				//echo $_POST['qry'] . " {query post  }<br>";
				//echo $_GET['sp']   . " {sport post  }<br>";
				//echo $_GET['con']  . " {concert post}<br>";
				//echo $_GET['fr']   . " {fair post   }<br>";
				//echo $_GET['art']  . " {art post    }<br>";
				//echo $_GET['clrX'] . " {clearX post }<br>";
				
				if(isset($_POST['qry']) && $_POST['qry'] != ""){ $var = $_POST['qry']; }
				if(isset($_GET['sp'])   && $_GET['sp'] != "")  { $var = $_GET['sp']; }
				if(isset($_GET['con'])  && $_GET['con'] != "") { $var = $_GET['con']; }
				if(isset($_GET['fr'])   && $_GET['fr'] != "")  { $var = $_GET['fr']; }
				if(isset($_GET['art'])  && $_GET['art'] != "") { $var = $_GET['art']; }
				if(isset($_GET['clrX']) && $_GET['clrX'] != ""){ $var = $_GET['clrX']; }
				
				//echo $var . " variable <br>";
				
				
			function state_abbr($name, $get = 'abbr') {
			//make sure the state name has correct capitalization:
				if($get != 'name') {
				$name = strtolower($name);
				$name = ucwords($name);
				}else{
				$name = strtoupper($name);
				}
					$states = array(
					'Alabama'=>'AL',
					'Alaska'=>'AK',
					'Arizona'=>'AZ',
					'Arkansas'=>'AR',
					'California'=>'CA',
					'Colorado'=>'CO',
					'Connecticut'=>'CT',
					'Delaware'=>'DE',
					'Florida'=>'FL',
					'Georgia'=>'GA',
					'Hawaii'=>'HI',
					'Idaho'=>'ID',
					'Illinois'=>'IL',
					'Indiana'=>'IN',
					'Iowa'=>'IA',
					'Kansas'=>'KS',
					'Kentucky'=>'KY',
					'Louisiana'=>'LA',
					'Maine'=>'ME',
					'Maryland'=>'MD',
					'Massachusetts'=>'MA',
					'Michigan'=>'MI',
					'Minnesota'=>'MN',
					'Mississippi'=>'MS',
					'Missouri'=>'MO',
					'Montana'=>'MT',
					'Nebraska'=>'NE',
					'Nevada'=>'NV',
					'New Hampshire'=>'NH',
					'New Jersey'=>'NJ',
					'New Mexico'=>'NM',
					'New York'=>'NY',
					'North Carolina'=>'NC',
					'North Dakota'=>'ND',
					'Ohio'=>'OH',
					'Oklahoma'=>'OK',
					'Oregon'=>'OR',
					'Pennsylvania'=>'PA',
					'Rhode Island'=>'RI',
					'South Carolina'=>'SC',
					'South Dakota'=>'SD',
					'Tennessee'=>'TN',
					'Texas'=>'TX',
					'Utah'=>'UT',
					'Vermont'=>'VT',
					'Virginia'=>'VA',
					'Washington'=>'WA',
					'West Virginia'=>'WV',
					'Wisconsin'=>'WI',
					'Wyoming'=>'WY'
					);
				if($get == 'name') {
				// in this case $name is actually the abbreviation of the state name and you want the full name
			$states = array_flip($states);
				}

			return $states[$name];
			}
				$state=$var;
				$var = state_abbr($state);
				
				$var = "'.*" . $var . ".*'";
				$qry = "SELECT * FROM Events ";
				$qry .= $var != null ? 
						" WHERE (EstartDate REGEXP $var OR Etype REGEXP $var OR Ezip REGEXP $var OR Ecity REGEXP $var OR Estate REGEXP $var OR Evename REGEXP $var OR EtimeStart REGEXP $var OR EtimeEnd REGEXP $var OR Efacebook REGEXP $var OR Erank REGEXP $var) 
						AND EstartDate >='".$newformat."' AND Edisplay ='1' ORDER BY EstartDate, EtimeStart;" 
						: "WHERE EstartDate >='".$newformat."' AND Edisplay ='1' ORDER BY EstartDate, EtimeStart";
						
				//echo $qry . " query <br>";
				
				$result = mysqli_query($con, $qry);
			?>
			<div class="box">
				<div class="title">
					<h1>.:: Your Results ::.</h1>
					<!--To refresh, we can create a method in fg_membersite-->
					<!--<a href="#"><img src="images/btn_refresh.png" alt="Refresh" /></a>-->
					<div class="clear"></div>
				</div>
				
				<?PHP
					while($row = mysqli_fetch_array($result)) {
						$newStartTime = date("g:i a", strtotime($row['EtimeStart']));
						
						$date = date_create($row['EstartDate']);
						$EstartDate = date_format($date, 'm/d/Y');
						
						$type = $row['Etype'];
						if($row['Eflyer'] === ""){
							switch($type){
								case "Art":            $row['Eflyer'] = "./images/icon_artEventHD.png";   break;
								case "Concert":        $row['Eflyer'] = "./images/icon_concertHD.png";    break;
								case "Fair":           $row['Eflyer'] = "./images/icon_festivalHD.png";   break;
								case "Social":         $row['Eflyer'] = "./images/icon_kettleballHD.png"; break;
								case "Sport":          $row['Eflyer'] = "./images/icon_marathonHD.png";   break;
								case "Public Speaker": $row['Eflyer'] = "./images/icon_speakerHD.png";    break;
								default:               $row['Eflyer'] = "./images/icon_fireworksHD.png";  break;
							}
						}
						
						//echo "Inside the Today " . $row['EstartDate'];
						echo "<div class='row'>";
						echo "	<div><a onClick='seeMoreInfo(".$row['Eid'].");'>";
						echo "		<div class='profile'><img src='".$row['Eflyer']."' alt='Image' /></div>";
						echo "			<div class='info'>";
						echo "				<div class='text-info'>";
						//echo "					<div class='box'>" . $row['EtimeStart'] ." - ". $row['EtimeEnd'] . "</div>";
						echo "					<div class='ename'>" . $row['Evename'] . "</div>";
						echo "					<div class='etime'>" . $EstartDate . " </div>";
						echo "					<div class='etime'>" . $newStartTime ." - ". $row['EtimeEnd'] . " </div>";
						echo "					<div class='ecity'>" . ucfirst($row['Ecity']) . ", " . strtoupper($row['Estate']) . " </div>";
						echo "				</div>";
						echo "				<div class='social-icons'>";
											if ($row['Efacebook']){
						echo "					<div class='FB'> <a href=". $row['Efacebook']." target='_blank'  > <img src='images/icon_fb.png'> </div>";
											}
											if ($row['Etwitter']){
						echo "					<div class='TW'> <a href=https://twitter.com/". $row['Etwitter']." target='_blank'> <img src='images/icon_twitter.png'> </a></div>";
											}
											if ($row['Egoogle']){
						echo "					<div class='Goo'> <a href=". $row['Egoogle']." target='_blank'  > <img src='images/icon_google.png'> </a></div>";
											}
											if ($row['Ehashtag']){
						echo "					<div class='Hashtag'>" . $row['Ehashtag'] . "</div>";
											}
						echo "				</div>";
						//echo "				<div class='more'>More Info</div>";

						echo "			</div>";
						echo "		<div class='clear'></div>";
						echo "	</a></div>";
						echo "</div>";
					}
				?>
			</div>
		</div>
		
		<div class="links">
			<?PHP include './links.php'; ?>
		</div>
		
		<div class="footer">
			<?PHP include './footer.php'; ?>
		</div>
	</body>
</html>