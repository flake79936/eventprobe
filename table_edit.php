<!--<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>-->

<?php
$query_pag_data = "SELECT Evename, Edescription, Ewebsite, Ehashtag, Efacebook, Etwitter, Egoogle from Events LIMIT $start, $per_page";
$result_pag_data = mysql_query($query_pag_data) or die('MySql Error' . mysql_error());
$finaldata = "";
// Table Header
$tablehead="<tr><th>Event Name</th><th>Description</th><th>Website</th><th>Hashtag</th><th>Facebook</th><th>Twitter</th><th>Google</th><th>Edit</th></tr>";
// Table Data Loop
while($row = mysql_fetch_array($result_pag_data)) 
{
$Eid=$row['Eid'];
$Evename=htmlentities($row['Evename']);
$Edescription=htmlentities($row['Edescription']);
$Ewebsite=htmlentities($row['Ewebsite']);
$Ehashtag=htmlentities($row['Ehashtag']); 
$Efacebook=htmlentities($row['Efacebook']); 
$Etwitter=htmlentities($row['Etwitter']); 
$Egoogle=htmlentities($row['Egoogle']); 


$tabledata.="<tr id='$Eid' class='edit_tr'>

<td class='edit_td' >
<span id='one_$Eid' class='text'>$Evename</span>
<input type='text' value='$Evename' class='editbox' id='one_input_$Eid' />
</td>


<td class='edit_td' >
<span id='two_$Eid' class='text'>$Edescription</span>
<input type='text' value='$Edescription' class='editbox' id='two_input_$Eid'/>
</td>


<td class='edit_td' >
<span id='three_$Eid' class='text'>$Ewebsite $</span> 
<input type='text' value='$Ewebsite' class='editbox' id='three_input_$Eid'/>
</td>
// New record
<td class='edit_td' >
<span id='four_$Eid' class='text'>$Ehashtag $</span> 
<input type='text' value='$Ehashtag' class='editbox' id='four_input_$Eid'/>
</td>

// New record
<td class='edit_td' >
<span id='five_$Eid' class='text'>$Efacebook $</span> 
<input type='text' value='$Efacebook' class='editbox' id='five_input_$Eid'/>
</td>

// New record
<td class='edit_td' >
<span id='six_$Eid' class='text'>$Etwitter $</span> 
<input type='text' value='$Etwitter' class='editbox' id='six_input_$Eid'/>
</td>

// New record
<td class='edit_td' >
<span id='seven_$Eid' class='text'>$Egoogle $</span> 
<input type='text' value='$Egoogle' class='editbox' id='seven_input_$Eid'/>
</td>




<td><a href='#' class='delete' id='$Eid'> X </a></td>


</tr>";
}
// Loop End
$finaldata = "<table width='100%'>". $tablehead . $tabledata . "</table>";

/* Total Count for Pagination */
$query_pag_num = "SELECT COUNT(*) AS count FROM Events";
$result_pag_num = mysql_query($query_pag_num);
$row = mysql_fetch_array($result_pag_num);
$count = $row['count'];
$no_of_paginations = ceil($count / $per_page);
?>