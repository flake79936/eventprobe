<!--<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>-->

<?php
	require_once('./dbconnect.php');
	
	echo "<h1>USERNAME</h1>" . $_POST['UuserName'];
	if(isset($_POST['action']) && $_POST['action'] == 'availability'){
		$UuserName = mysqli_real_escape_string($connection, $_POST['UuserName']); // Get the username values
		$query = "SELECT UuserName FROM registration WHERE UuserName='" . $UuserName . "'";
		$res = mysqli_query($connection, $query);
		$count = mysqli_num_rows($res);
		echo $count;
	}
?>