<?php
include_once('db.php');

$image = mysqli_real_escape_string($connection,$_POST['image']);
$title = mysqli_real_escape_string($connection,$_POST['title']);
$desc = mysqli_real_escape_string($connection,$_POST['desc']);

$query  = "INSERT INTO `images`(`title`,`desc`,`image`) VALUES ('".$title."', '".$desc."', '".$image."')";
mysqli_query($connection,$query);

header("location: index.php");
?>