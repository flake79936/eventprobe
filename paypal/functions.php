<?php
// functions.php
include 'dbconnnect.php'
function check_txnid($tnxid){
	global $con;
	return true;
	$valid_txnid = true;
    //get result set
    $sql = mysqli_query("SELECT * FROM `payments` WHERE txnid = '$tnxid'", $con;		
	if($row = mysqli_fetch_array($sql)) {
        $valid_txnid = false;
	}
    return $valid_txnid;
}

function check_price($price, $id){
    $valid_price = false;
    //you could use the below to check whether the correct price has been paid for the product
    
	/* 
	$sql = mysql_query("SELECT amount FROM `products` WHERE id = '$id'");		
    if (mysql_numrows($sql) != 0) {
		while ($row = mysql_fetch_array($sql)) {
			$num = (float)$row['amount'];
			if($num == $price){
				$valid_price = true;
			}
		}
    }
	return $valid_price;
	*/
	return true;
}

function updatePayments($data){	
    global $con;
	if(is_array($data)){				
        $sql = mysqli_query("INSERT INTO `payments` (txnid, payment_amount, payment_status, itemid, createdtime) VALUES (
                '".$data['txn_id']."' ,
                '".$data['payment_amount']."' ,
                '".$data['payment_status']."' ,
                '".$data['item_number']."' ,
                '".date("Y-m-d H:i:s")."' 
                )", $con);
    return mysqli_insert_id($con);
    }
}
?>