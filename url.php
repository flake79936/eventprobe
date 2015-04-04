
<?php
/**
 * Grabs and returns the URL of current page.
 * @param   none
 * @return  URL of current page
 */
function grabCurrentURL(){
	if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
		$url = "https://";
	}else{
		$url = "http://";
	}
	$url .= $_SERVER['SERVER_NAME'];
	if($_SERVER['SERVER_PORT'] != 80){
		$url .= ":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	}else{
		$url .= $_SERVER["REQUEST_URI"];	
	}
	return $url;
}
$test=grabCurrentURL();
 
	 $mystring = (string)$test;
	
	$findme   = 'url.php';
	$pos = strpos($test, $findme);
	
if(!$pos !== true){
echo "test";
}
else {
echo "not found";
}

?>