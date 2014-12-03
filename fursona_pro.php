<?PHP
	if($action == "item"){
		$body = $_GET['body']; 
		if($body == "male") { 
			$img="http://www.ichumon.com/images/fursona/male_body.png"; 
		} elseif($body == "female")  { 
			$img="http://www.ichumon.com/images/fursona/female_body.png"; 
		} else { 
			echo"Invalid"; 
		} 
		$im = imagecreatefrompng("$img"); 
		imagesavealpha( $im , true ); 
		header("Content-type: image/png"); 
		imagepng($im, "images/user_fursona/random.png"); 
		imagedestroy($im); 
		echo"<img src='images/user_fursona/random.png'>";
	}
?>