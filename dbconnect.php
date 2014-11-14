<?PHP	$con = mysqli_connect('localhost', 'admindev', '17s_9Eyr', 'EventAdvisors');

		if (!$con) {
			die('Could not connect: ' . mysqli_error($con));
		}

		mysqli_select_db($con, "EventAdvisors");
?>