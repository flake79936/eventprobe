<?PHP 
include './dbconnect.php';
?>
<!DOCTYPE html><html>
<head>
<title>Payment Successful!</title>
</head>
<body>

<?php

//Getting payment details from paypal
$custom = $_GET['custom'];
$Eid = $_GET['item_number'];
$amount = $_GET['amt'];
$currency = $_GET['mc_currency'];
$trx_id = $_GET['tx'];
$status = $_GET['payment_status'];
$email = $_GET['receiver_email'];
$payment_fee = $_GET['payment_fee'];
$payment_gross = $_GET['payment_gross'];




$total=$payment_fee+$payment_gross;
//inserting the payment to table

$sql = "insert into payment values ('".$Eid."','".$total."','".$currency."' ,'".$trx_id."' ";
echo $sql;
$result = mysqli_query($con, $sql);
echo$result;
// if($currency=="USD" && $amount==10){
?>

 <h2>Welcome,Your Payment was successful!</h2>
<?PHP
echo "start";
echo $Eid;
echo $amount;
echo $currency;
echo $trx_id;
echo $status ;
echo $email;
echo $payment_fee;
echo $payment_gross;
echo $custome;
echo "end";


 
?>
<?PHP
// }
// else {
?>
<h2>Welcome Guest, Payment was failed</h2><br>
<a href="http://www.eventprobe.com">Go Back to eventprobe</a>
<?PHP
// }

?>
</body>
</html>
