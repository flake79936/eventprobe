<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>

<?php
	include_once('./db.php');
	if(isset($_POST['action']) && $_POST['action'] == 'availability'){
		$UuserName = mysqli_real_escape_string($connection, $_POST['UuserName']); // Get the username values
		$query = "SELECT UuserName FROM registration WHERE UuserName='" . $UuserName . "'";
		$res = mysqli_query($connection, $query);
		$count = mysqli_num_rows($res);
		echo $count;
	}
?>