<?php
	//$q = intval($_GET['q']);

	$con = mysqli_connect('localhost', 'root', '', 'cs5339team9fa14');
	if (!$con) { die('Could not connect: ' . mysqli_error($con)); }

	mysqli_select_db($con, "cs5339team9fa14");
	
	$var = isset($_GET['q']) && $_GET['q'] != "" ? "'.*" . $_GET['q'] .".*'" : null;
	$qry = "SELECT * FROM master ";
	$qry .= $var != null ? 
			" WHERE academicyear REGEXP $var or term REGEXP $var or last REGEXP $var or first REGEXP $var or major REGEXP $var or level REGEXP $var or degree REGEXP $var " 
			: "";
			
	//$sql = "SELECT * FROM master WHERE id = '".$q."'";
	$result = mysqli_query($con, $qry);
	
		echo "<table border='1'>
		<tr>
		<th>master_id</th>
		<th>academicyear</th>
		<th>term</th>
		<th>last</th>
		<th>first</th>
		<th>major</th>
		<th>level</th>
		<th>degree</th>
		</tr>";

		while($row = mysqli_fetch_array($result)) {
			echo "<tr>";
			echo "<td>" . $row['master_id'] . "</td>";
			echo "<td>" . $row['academicyear'] . "</td>";
			echo "<td>" . $row['term'] . "</td>";
			echo "<td>" . $row['last'] . "</td>";
			echo "<td>" . $row['first'] . "</td>";
			echo "<td>" . $row['major'] . "</td>";
			echo "<td>" . $row['level'] . "</td>";
			echo "<td>" . $row['degree'] . "</td>";
			echo "</tr>";
		}
		echo "</table>";
	mysqli_close($con);
?>