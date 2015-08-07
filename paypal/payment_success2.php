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
$custom = $_POST['custom'];
$Eid = $_POST['item_number'];
$name = $_POST['item_name'];

$currency = $_POST['mc_currency'];
$trx_id = $_POST['txn_id'];
$status = $_POST['payment_status'];
$email = $_POST['receiver_email'];
$payment_fee = $_POST['payment_fee'];
$payment_gross = $_POST['payment_gross'];






$total=$payment_fee+$payment_gross;
// //inserting the payment to table

$sql = "insert into payment values ('".$Eid."','".$total."','".$currency."' ,'".$trx_id."' )";
echo $sql;
$result = mysqli_query($con, $sql);
echo$result;
// if($currency=="USD" && $amount==10){
?>

 <h2>Welcome,Your Payment was successful!</h2>
<?PHP
echo "sent--------------------------------------";
?>
<br>
<?PHP
echo $custom;
// echo $Eid;
// echo $amount;
?>
<br>
<?PHP
echo" received----------------------------------";
?>
<br>
<?PHP
echo"currency=";
echo $currency;
echo"-------";
echo"name=";
echo $name;
echo"------";
echo"trxn_id=";
echo $trx_id;
echo"------";
echo"status=";
echo $status ;
echo"------";
echo"email=";
echo $email;
// echo $payment_fee;
// echo $payment_gross;



 
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
