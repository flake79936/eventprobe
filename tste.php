<html>
	<head>
		<title>Auto Refresh Div Content Demo | jQuery4u</title>
		<!-- For ease i'm just using a JQuery version hosted by JQuery- you can download any version and link to it locally -->
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script>
			(function($){
				$(document).ready(function(){
					$.ajaxSetup({
						cache: false,
						beforeSend: function(){
							$('#content').hide();
							$('#loading').show();
						},
						complete: function(){
							$('#loading').hide();
							$('#content').show();
						},
						success: function(){
							$('#loading').hide();
							$('#content').show();
						}
					});
					var $container = $("#content");
					//$container.load("rss-feed-data.php");
					$container.load("getByDayEvent.php?date=03/04/2015");
					var refreshId = setInterval(function(){
						$container.load("getByDayEvent.php?date=03/04/2015");
					}, 60000);
				});
			})(jQuery);
		</script>
	</head>
	
	<body>
		<div id="wrapper">
			<div id="content"></div>
			<img src="loading.gif" id="loading" alt="loading" style="display:none;" />
		</div>
	</body>
</html>