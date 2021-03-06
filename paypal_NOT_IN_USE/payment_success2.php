<?PHP 
include './dbconnect.php';
?>
<!doctype html>
<html>
<head>

		<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
		<title>Eventprobe Payment</title>
		
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link rel="stylesheet" media="all" href=""/>
        
        <!--STYLE-->
        <link rel="stylesheet" type="text/css" href="/css/style.css" />
        <link rel="stylesheet" type="text/css" href="/css/header.css" />
        <link rel="stylesheet" type="text/css" href="/css/links.css" />
        <link rel="stylesheet" type="text/css" href="/css/footer.css" />

        <!--FAVICON-->
        <link rel="shortcut icon" href="./favicon.ico"  />

	
</head>

	<body lang="en">
		<div class="header">
			<?PHP include '/header.php'; ?>
		</div>
		
		<div class="clear"></div>
		


<?php
$paypal_email = 'Noemaildavis-facilitator@gmail.com';
$original_currency="USD";
$completed="Completed";


//Getting payment details from paypal
$custom = $_POST['custom'];
$EidP = $_POST['item_number'];
$name = $_POST['item_name'];
$currency = $_POST['mc_currency'];
$trx_id = $_POST['txn_id'];
$status = $_POST['payment_status'];
$email = $_POST['receiver_email'];
$payment_fee = $_POST['payment_fee'];
$payment_gross = $_POST['payment_gross'];


$unique="SELECT *  FROM payment WHERE PtrxN_id= ".$trx_id."";
$zero= 0;


$result = mysqli_query($con,$unique);
$num_rows = mysql_num_rows($result);


$total=$payment_gross;

 if ($total==0.50){
$ErankP= "Premium";
 }else{
$ErankP= "Paid";
 }

$item_name = $con->query("SELECT Evename FROM Events WHERE Eid = ".$EidP."")->fetch_row()[0];
$Erank= $con->query("SELECT Erank FROM Events WHERE Eid = ".$EidP."")->fetch_row()[0];

//logic to confirm dvalues from paypal
if($Erank==$ErankP	&& $custom==$paypal_email	&& 	$name==$item_name	&&	$currency==$original_currency && $status==$completed){
  	
//if everything checks addn it to database and update Edisplay on Events table.

$sql2="UPDATE Events SET Edisplay=1 WHERE Eid=".$EidP."";

if (mysqli_query($con, $sql2)) {

    echo "Your event is now Posted";
	?>
	<br>
	<?PHP
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
    ?>
    <h2>The Event could not be posted</h2><br>
    <?PHP
}

$sql = "INSERT INTO payment ( Eid , Pamount , Pcurrency , Ptrxn_id ) VALUES ( '".$EidP."' , '".$total."' , '".$currency."' , '".$trx_id."' ) ";

if (mysqli_query($con, $sql)) {
    echo "Thank you for your Payment";
    ?>
    <br>
    <?PHP
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
    ?>
    <h2>The Payment failed</h2><br>
    <?PHP
}

mysqli_close($con);

 }

?>
		<!--Section where events will show when user types on the search bar-->
		<!--<div class="events" id="txtHint"></div>-->
		<div class="clear"></div>

		<!--Links  Section-->
		<div class="links">
			<?PHP include '/links.php'; ?>
		</div>

		<!--Footer Section-->
		<div class="footer">
			<?PHP include '/footer.php'; ?>
		</div>
	</body>

</html>
