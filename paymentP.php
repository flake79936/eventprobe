<–Paypal Form starts–>
<form action=”https://www.sandbox.paypal.com/cgi-bin/webscr” method=”post” >

<!– Identify your business so that you can collect the payments. –>
<input type=”hidden” name=”business” value=”noemaildavis-facilitator@gmail.com”>

<!– Specify a Buy Now button. –>
<input type=”hidden” name=”cmd” value=”_xclick”>

<!– Specify details about the item that buyers will purchase. –>

<!-<input type=”hidden” name=”item_name” value=”<?php echo $product_name;?>”> ->
<input type=”hidden” name=”item_name” value=”Event_name>”>

<!-<input type=”hidden” name=”item_number” value=”<?php echo $product_id”>->


<input type=”hidden” name=”amount” value=”10”>
<!-<input type=”hidden” name=”amount” value=”<?php echo $product_price;?>”>->

<input type=”hidden” name=”quantity” value=”1”>
<input type=”hidden” name=”currency_code” value=”USD”>

<–Specify the Pages for Successful payment & failed Payment–>

<input type=”hidden” name=”return” value=”http://www.eventprobe.com/paypal/payment_success2.php”/>

<input type=”hidden” name=”cancel_return” value=”http://www.eventprobe.com/paypal/payment_cancel2.php”/>

<!– Display the payment button. –>
<input type=”image” name=”submit” border=”0″ src=”paypal_button.png” alt=”PayPal – The safer, easier way to pay online”>
<img alt=”” border=”0″ width=”1″ height=”1″ src=”https://www.paypalobjects.com/en_US/i/scr/pixel.gif” >

</form>

<–Paypal Form ends–>
