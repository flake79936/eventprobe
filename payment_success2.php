<?PHP  include './dbconnect.php'; ?>

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
		<link rel="stylesheet" type="text/css" href="./css/style.css" />
		<link rel="stylesheet" type="text/css" href="./css/header.css" />
		<link rel="stylesheet" type="text/css" href="./css/links.css" />
		<link rel="stylesheet" type="text/css" href="./css/footer.css" />

		<!--FAVICON-->
		<link rel="shortcut icon" href="./favicon.ico"  />
	</head>

	<body lang="en">
		<div class="header">
			<?PHP include './header.php'; ?>
		</div>

		<div class="clear"></div>
		
		<?php
			$paypal_email      = "Noemaildavis-facilitator@gmail.com";
			$original_currency = "USD";
			$completed         = "Completed";

			//Getting payment details from paypal
			if (isset($_POST['custom'])) { $custom = $_POST['custom']; }
			if (isset($_POST['item_number'])) { $EidP = $_POST['item_number']; } else { $EidP = $_GET['item_number']; }
			if (isset($_POST['item_name'])) { $name = $_POST['item_name']; }
			if (isset($_POST['mc_currency'])) { $currency = $_POST['mc_currency']; } else { $currency = $_GET['cc']; }
			if (isset($_POST['payment_status'])) { $status = $_POST['payment_status']; } else { $status = $_GET['st']; }
			if (isset($_POST['receiver_email'])) { $email = $_POST['receiver_email']; } else { $email = $_GET['cm']; }
			if (isset($_POST['payment_fee'])) {$payment_fee = $_POST['payment_fee'];}
			if (isset($_POST['payment_gross'])) {$payment_gross = $_POST['payment_gross'];}else{$payment_gross = $_GET['amt'];}
			if (isset($_POST['txn_id'])) {$trx_id = $_POST['txn_id'];}else{$trx_id = $_GET['tx'];}

			// $custom = $_POST['custom'];
			// $EidP = $_POST['item_number'];
			// $name = $_POST['item_name'];
			// $currency = $_POST['mc_currency'];
			// $trx_id = $_POST['txn_id'];
			// $status = $_POST['payment_status'];
			// $email = $_POST['receiver_email'];
			// $payment_fee = $_POST['payment_fee'];
			// $payment_gross = $_POST['payment_gross'];

			$total = $payment_gross;

			($total == 0.50) ? $ErankP= "Premium" : $ErankP= "Paid";

			$item_name = $con->query("SELECT Evename FROM Events WHERE Eid = ".$EidP."")->fetch_row()[0];
			$Erank     = $con->query("SELECT Erank FROM Events WHERE Eid = ".$EidP."")->fetch_row()[0];

			//logic to confirm dvalues from paypal
			if($Erank == $ErankP && $custom == $paypal_email && $name == $item_name && $currency == $original_currency && $status == $completed){
				//if everything checks addn it to database and update Edisplay on Events table.

				$sql2="UPDATE Events SET Edisplay=1 WHERE Eid=".$EidP."";

				if (mysqli_query($con, $sql2)) {
					echo "Your event is now Posted";
					echo "<br>";
				} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($con);
					echo "<h2>The Event could not be posted</h2><br>";
				}
			
				$sql = "INSERT INTO payment ( Eid , Pamount , Pcurrency , Ptrxn_id ) VALUES ( '".$EidP."' , '".$total."' , '".$currency."' , '".$trx_id."' ) ";

				if (mysqli_query($con, $sql)) {
					echo "Thank you for your payment. Your transaction has been completed, and a receipt for your purchase has been emailed to you. You may log into your account at www.sandbox.paypal.com/us to view details of this transaction.";
					echo "<br>";
				} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($con);
					echo "<h2>The Payment failed</h2><br>";
				}
				mysqli_close($con);
			}
		?>
		
		<!--Section where events will show when user types on the search bar-->
		<!--<div class="events" id="txtHint"></div>-->
		<div class="clear"></div>

		<!--Links  Section-->
		<div class="links">
			<?PHP include './links.php'; ?>
		</div>

		<!--Footer Section-->
		<div class="footer">
			<?PHP include './footer.php'; ?>
		</div>
	</body>
</html>