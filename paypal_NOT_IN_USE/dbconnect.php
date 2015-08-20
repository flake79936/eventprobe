<?PHP
	/*Module*/
	$con = mysqli_connect('localhost', 'user', 'Xzr?f270', 'EventAdvisors');

	if (!$con) {
		die('Could not connect: ' . mysqli_error($con));
	}

	mysqli_select_db($con, "EventAdvisors");
?>