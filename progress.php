<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>jQuery UI Progressbar - Custom Label</title>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
		<link rel="stylesheet" href="/resources/demos/style.css">
		
		<style>
			.ui-progressbar { position: relative; }
			.progress-label {
				position:    absolute;
				left:        50%;
				top:         4px;
				font-weight: bold;
				text-shadow: 1px 1px 0 #fff;
			}
		</style>
		
		<script>
			$(function(){
			var progressbar = $( "#progressbar" ),
			progressLabel = $( ".progress-label" );

			progressbar.progressbar({
			value: false,
			change: function() {
			progressLabel.text( progressbar.progressbar( "value" ) + "%" );
			},
			complete: function() {
			progressLabel.text( "Complete!" );
			}
			});

			function progress() {
			var val = progressbar.progressbar( "value" ) || 0;

			progressbar.progressbar( "value", val + 2 );

			if ( val < 99 ) {
			setTimeout( progress, 80 );
			}
			}

			setTimeout( progress, 2000 );
			});
		</script>
	</head>
	
	<body>
		<div id="progressbar"><div class="progress-label">Loading...</div></div>
	</body>
</html>