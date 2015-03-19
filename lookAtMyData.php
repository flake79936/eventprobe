<?PHP
	include 'dbconnect.php';
	$qry = "SELECT * FROM Events";
	$result = mysqli_query($con, $qry);
	
	while($row = mysqli_fetch_array($result)){ 
		echo $row['Eid'] . ": " . $row['UuserName'] . ": " . $row['Edisplay'] . "<br>";
	}
?>