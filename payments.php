<?php
	include './dbconnect.php';
	$newEventID = $_POST['item_number'];

	// Database variables
	$item_name = $con->query("SELECT Evename FROM Events WHERE Eid = ".$newEventID."")->fetch_row()[0];
	$Erank = $con->query("SELECT Erank FROM Events WHERE Eid = ".$newEventID."")->fetch_row()[0];

	($Erank=="Premium") ? $item_amount = 0.10 : $item_amount = 0.05;

	// PayPal settings
	$paypal_email = 'support@eventprobe.com';
// 	$paypal_email = 'noemaildavis-facilitator@paypal.com';
	
	$return_url = "http://www.eventprobe.com/eventDisplayPage.php?eid=".$newEventID."";
	$cancel_url = 'http://www.eventprobe.com';
	$notify_url = 'http://www.eventprobe.com/IPNS.php';

	// Include Functions
	include("functions.php");

	//Database Connection
	$link = mysqli_connect($host, $user, $pass,$db_name);
	mysql_select_db($db_name);

	// Check if paypal request or response
	if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])){
		// Firstly Append paypal account to querystring
		$querystring .= "?business=".urlencode($paypal_email)."&";	

		// Append amount& currency (£) to quersytring so it cannot be edited in html

		//The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
		$querystring .= "item_name=".urlencode($item_name)."&";
		$querystring .= "amount=".urlencode($item_amount)."&";
		$querystring .= "custom=".urlencode($paypal_email)."&";

		//loop for posted values and append to querystring
		foreach($_POST as $key => $value){
			$value = urlencode(stripslashes($value));
			$querystring .= "$key=$value&";
		}

		// Append paypal return addresses
		$querystring .= "return=".urlencode(stripslashes($return_url))."&";
		$querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
		$querystring .= "notify_url=".urlencode($notify_url);

		// Append querystring with custom field
		//$querystring .= "&custom=".USERID;

		// Redirect to paypal IPN
		header('location:https://www.paypal.com/cgi-bin/webscr'.$querystring);
// 		header('location:https://www.sandbox.paypal.com/cgi-bin/webscr'.$querystring);
		
		exit();
	} else {
		// Response from Paypal

		// read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-validate';
		foreach ($_POST as $key => $value) {
			$value = urlencode(stripslashes($value));
			$value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i','${1}%0D%0A${3}',$value);// IPN fix
			$req .= "&$key=$value";
		}

		// assign posted variables to local variables
		$data['item_name']			= $_POST['item_name'];
		$data['item_number'] 		= $_POST['item_number'];
		$data['payment_status'] 	= $_POST['payment_status'];
		$data['payment_amount'] 	= $_POST['mc_gross'];
		$data['payment_currency']	= $_POST['mc_currency'];
		$data['txn_id']				= $_POST['txn_id'];
		$data['receiver_email'] 	= $_POST['receiver_email'];
		$data['payer_email'] 		= $_POST['payer_email'];
		$data['custom'] 			= $_POST['custom'];

		// post back to PayPal system to validate
		$header  = "POST /cgi-bin/webscr HTTP/1.0\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

		$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);	

		if (!$fp) {
			// HTTP ERROR
		} else {
			$link = mysqli_connect('localhost', 'user', 'Xzr?f270', 'EventAdvisors');
			// $link = mysqli_connect($host, $user, $pass,$db_name);
			// mysql_select_db($db_name);

			function check_txnid($tnxid){
				global $link;
				// $dbName= 'EventAdvisors';
				// $link = mysqli_connect($host, $user, $pass,$dbName);
				// mysql_select_db($db_name);

				return true;
				
				$valid_txnid = true;
				//get result set
				$sql = mysqli_query( $con, "SELECT * FROM payments WHERE txnid = '".$tnxid."' ");		
				
				if($row = mysqli_fetch_array($sql)) {
					$valid_txnid = false;
				}
				return $valid_txnid;
			}

			function updatePayments($data){	
				global $link;
				if(is_array($data)){
					// 	$sql = "INSERT INTO payment ( Eid , Pamount , Pcurrency , Ptrxn_id ) VALUES ( '".$EidP."' , '".$total."' , '".$currency."' , '".$trx_id."' ) ";				
					$sql = mysqli_query($link, "INSERT INTO payment (EidP , Pamount, Pcurrency, Ptrxn_id) VALUES (
											  '".$data['item_number']."' ,
											  '".$data['payment_amount']."' ,
											  '".$data['payment_currency']."' ,
											  '".$data['txn_id']."' 
											  )");
											  
					return mysqli_insert_id($link);
				}
			}

			fputs ($fp, $header . $req);
			while (!feof($fp)) {
				$res = fgets ($fp, 1024);
				if (strcmp($res, "VERIFIED") == 0) {
					// Used for debugging
					//@mail("you@youremail.com", "PAYPAL DEBUGGING", "Verified Response<br />data = <pre>".print_r($post, true)."</pre>");

					// Validate payment (Check unique txnid & correct price)
					$valid_txnid = check_txnid($data['txn_id']);
					// 				$valid_price = check_price($data['payment_amount'], $data['item_number']);
					// PAYMENT VALIDATED & VERIFIED!
					if($valid_txnid ){				
						$orderid = updatePayments($data);		
						if($orderid){
							echo "Successful payment";
							// Payment has been made & successfully inserted into the Database								
						}else{
							echo "ERROR INSERING TO DB"; 							
							// Error inserting into DB
							// E-mail admin or alert user
						}
					}else{					
						// Payment made but data has been changed
						// E-mail admin or alert user
					}						
				} else if (strcmp ($res, "INVALID") == 0) {
					echo "INVALID";
					// PAYMENT INVALID & INVESTIGATE MANUALY! 
					// E-mail admin or alert user

					// Used for debugging
					//@mail("you@youremail.com", "PAYPAL DEBUGGING", "Invalid Response<br />data = <pre>".print_r($post, true)."</pre>");
				}
			}		
			fclose ($fp);
		}	
	}
?>