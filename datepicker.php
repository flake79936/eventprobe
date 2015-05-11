<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>jQuery UI Datepicker - Select a Date Range</title>
		<link rel="stylesheet" href="./css/jquery-ui.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script>
			$(function() {
				$("#from").datepicker({
					defaultDate: "+1w",
					changeMonth: true,
					numberOfMonths: 3,
					onClose: function( selectedDate ) {
						$( "#to" ).datepicker( "option", "minDate", selectedDate );
					}
				});
				
				$( "#to" ).datepicker({
					defaultDate: "+1w",
					changeMonth: true,
					numberOfMonths: 3,
					onClose: function( selectedDate ) {
						$("#from").datepicker("option", "maxDate", selectedDate );
					}
				});
			});
		</script>
	</head>
	
	<body>
		<label for="from">From</label>
		<input type="text" id="from" name="from">
		<label for="to">to</label>
		<input type="text" id="to" name="to">
	</body>
</html>