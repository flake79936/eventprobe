<html>
<!-- Paypal Form starts -->
<!-- <form action=”https://www.sandbox.paypal.com/cgi-bin/webscr” method=”post” > -->
<form id="eventForm" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" >


<!--  Identify your business so that you can collect the payments.  -->

<input type="hidden" name="business" value="noemaildavis-facilitator@gmail.com"/>

<!-- Specify a Buy Now button. -->

<input type="hidden" name="cmd" value="_xclick"/>

<!-- Specify details about the item that buyers will purchase. -->

<!-- <input type=”hidden” name=”item_name” value=”<?php echo $product_name;?>”>  -->
<input type="hidden" name="item_name" value="event name"/>
<input type="hidden" name="custom" value="custom111"/>

<!-- <input type=”hidden” name=”item_number” value=”<?php echo $Eid; ?>"> -->


<input type="hidden" name="amount" value="10"/>
<!-- <input type=”hidden” name=”amount” value=”<?php echo $product_price;?>”> -->

<input type="hidden" name="quantity" value="1"/>
<input type="hidden" name="currency_code" value="USD"/>

<!-- Specify the Pages for Successful payment & failed Payment -->

<input type="hidden" name="return" value="http://www.eventprobe.com/paypal/payment_success2.php"/>

<input type="hidden" name="cancel_return" value="http://www.eventprobe.com/paypal/payment_cancel2.php"/>

<!-- Display the payment button. -->
//<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
//<input type="hidden" name="cmd" value="_s-xclick">
//<input type="hidden" name="hosted_button_id" value="E7MAQRDBEPSPE">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>


</form>
</html>
<!-- Paypal Form ends-->
