<?PHP
	require_once('rss_fetch.inc');
	//$url = $_GET['url'];
	$url = "http://www.hollywoodfl.org/support/calendar27.xml";
	$rss = fetch_rss( $url );
	
	echo "Channel Title: " . $rss->channel['title'] . "<p>";
	echo "<ul>";
	foreach ($rss->items as $item) {
		$href = $item['link'];
		$title = $item['title'];
		$desc = $item['description'];
		echo "<li><a href=$href>$title</a><br/>$desc</li>";
	}
	echo "</ul>";
?>