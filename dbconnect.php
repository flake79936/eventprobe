<!--<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>-->

<?PHP
	$con = mysqli_connect('localhost', 'user', 'Xzr?f270', 'EventAdvisors');

	if (!$con) {
		die('Could not connect: ' . mysqli_error($con));
	}

	mysqli_select_db($con, "EventAdvisors");
?>