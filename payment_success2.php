<?PHP 
include 'dbconnect.php'?>
<!DOCTYPE html><html>
<head>
<title>Payment Successful!</title>
</head>
<body>

<?php

//Getting payment details from paypal

$amount = $_GET[‘amt’];
$currency = $_GET[‘mc_currency’];
$trx_id = $_GET[‘txn_id’];
$status = $_GET[‘payment_status’];
$email = $_GET[‘receiver_email’];
$payment_fee = $_GET[‘payment_fee’];
$payment_gross = $_GET[‘payment_gross’];



$invoice = mt_rand();

//inserting the payment to table

$insert_payment = “insert into payments (amount,customer_id,product_id,trx_id,currency,payment_date) values (‘$amount’,’$c_id’,’$pro_id’,’$trx_id’,’$currency’,NOW())”;

$run_payment = mysqli_query($con,$insert_payment);

if($currency=="USD" && $amount==10){

echo “<h2>Welcome,Your Payment was successful!</h2>”;


}
else {

echo “<h2>Welcome Guest, Payment was failed</h2><br>”;
echo “<a href=’http://www.eventprobe.com’>Go Back to eventprobe</a>”;

}

?>
</body>
</html>
