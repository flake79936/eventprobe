<?php
	include 'dbconnect.php';

// $timestamp      = time(); //timestamp
// $uploaddir      = "eventFlyers/"; //location to store image
// $filename       = $timestamp . $_FILES['file']['name'];
// $filename       = strtolower($filename); //create image name with lower case
// $final_location = "$uploaddir$filename";

$pic   = $_POST['Eflyer'];

echo $pic


mysql_query("UPDATE Events SET image (image) VALUES ('" . $final_location . "')"); //mysql inser query




// if ($_POST['submit']) {
//     if ((($_FILES["file"]["type"] == "image/gif") //set image you want to upload
//         || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg")) && ($_FILES["file"]["size"] < 2000000)) //set image size
//         {
//         if ($_FILES["file"]["error"] > 0) {
//             echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
//         } else {
//             echo "Upload: " . $filename . "<br />";
//             echo "Type: " . $_FILES["file"]["type"] . "<br />";
//             echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
//             echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
// 
//             move_uploaded_file($_FILES["file"]["tmp_name"], $final_location);
//             echo "Stored in: " . $final_location . "<br>";
//             
// 
//         }
//     } else {
//         echo "INVALID FILE";
//     }
// }
?>