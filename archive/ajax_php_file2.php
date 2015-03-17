<!--<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>-->

<?php
include './dbconnect.php';

$timestamp      = date('YmdHis'); //timestamp
$uploaddir      = "userPictures/"; //location to store image
$filename       = $timestamp . $_FILES['file']['name'];
$filename       = strtolower($filename); //create image name with lower case
$final_location = "$uploaddir$filename";

// if ($_POST['submit']) {
    if ((($_FILES["file"]["type"] == "image/gif") //set image you want to upload
        || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg")) && ($_FILES["file"]["size"] < 2000000)) //set image size
        {
        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
        } else {
            echo "Upload: " . $filename . "<br />";
            echo "Type: " . $_FILES["file"]["type"] . "<br />";
            echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
            echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

            move_uploaded_file($_FILES["file"]["tmp_name"], $final_location);
            echo "Stored in: " . $final_location . "<br>";
            mysql_query("INSERT INTO Registration  (Upic) VALUES ('" . $final_location . "') WHERE UuserName='robert' "); //mysql inser query

        }
    } else {
        echo "INVALID FILE";
    }
// }
?>