<?php include_once("config.php"); ?>

<h2 align="center">Test Products</h2>
<table class="procut_item" border="0" cellpadding="4">
	<tr>
		<td width="70%"><h4>Product 1</h4>(product description)</td>
		<td width="30%">
			<form method="post" action="process.php">
				<input type="hidden" name="itemname" value="Product 1" /> 
				<input type="hidden" name="itemnumber" value="10000" /> 
				<input type="hidden" name="itemdesc" value="product description." /> 
				<input type="hidden" name="itemprice" value="225.00" />
					Quantity: 
					<select name="itemQty">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
					</select> 
				<input class="dw_button" type="submit" name="submitbutt" value="Buy (225.00 <?php echo $PayPalCurrencyCode; ?>)" />
			</form>
		</td>
	</tr>
</table>