<?php
// views/shop_cart.php

//var_dump($this->cart->contents());
?>

<legend>Shopping Cart</legend>

<p><a href="<?php echo base_url();?>index.php/cart/checkout"><button class="btn">Go to Checkout</button></a></p>


<form name="cart_form" id="cart_form" method="POST" action="<?php echo base_url();?>index.php/cart/update">

<table class="table table-striped table-bordered table-condensed">

<tr>

	<th>Quantity</th>
	<th>Description</th>
	<th>Options</th>
	<th>Price</th>
	<th>Line Total</th>
	<th>&nbsp;</th>

</tr>

<?php 
$i = 1; 
$cart_total = 0;

foreach ($cart_lines as $items): 

	if($items['quantity'] > 0) {

		$line_total = $items['price'] * $items['quantity'];
?>

<tr>

	<td>
		<input class="input-small"  type="text" name="<?php echo $i.'_qty';?>" id="<?php echo $i.'_qty';?>" value="<?php echo $items['quantity'];?>">
	</td>

	<td>
		<?php echo $items['name']; ?>
	</td>

	<td>
		<?php
		if(isset($items['options'])) {

			//var_dump($items['options']);

			$options_str = "";
			
			foreach($items['options'] as $option) {
				
				#echo "<BR>key:".$key;#." - value:".$value;
				//var_dump($option);
				$id 	= $option['id'];
				$value 	= $option['value'];

				//echo "<BR>id:".$id." - value:".$value;

				$OptionGroup = new OptionGroup();
				$OptionGroup->setId($id);
				$option_group_details = $OptionGroup->getDetails();
				$option_group_legend = $option_group_details[0]->option_group_legend;

				$options_str .= "<strong>".$option_group_legend." : </strong>";

				$OptionValue = new OptionValue();
				$OptionValue->setId($value);
				$option_value_details = $OptionValue->getDetails();
				$option_value_title = $option_value_details[0]->option_value_title;

				$options_str .= " ".$option_value_title." / ";

			}

			$options_str = substr($options_str,0,strlen($options_str)-3);

			echo $options_str;
		} else {

			echo "<BR>---";
		}
		?>
	</td>

	<td>
		<?php echo $this->cart->format_number($items['price']); ?>
	</td>

	<td>
		&pound;<?php echo $this->cart->format_number($line_total); ?>
	</td>

	<td>
		<a href="#" onclick="javascript:remove_line(<?php echo $i;?>);" class="btn"><i class="icon-remove-sign"></i></a>
	</td>

</tr>

<?php 
	$i++; 

	$cart_total += $line_total;
?>

<?php 
	}

endforeach; 
?>
<script>
function remove_line(num) {

	if(confirm("Remove this item from the cart?")) {
	
		tmp_element = $("#"+num+"_qty");
		
		var line_qty = tmp_element.val('0');

		$("#cart_form").submit();
	
	}


}
</script>
<tr>

	<td colspan="4" align="right">Total</td>

	<td>&pound;<?php echo $this->cart->format_number($cart_total); ?></td>

	<td>&nbsp;</td>

</tr>

<tr>

	<td colspan="6">
		<input type="submit" class="btn" value="Update Cart">
		
	</td>

</tr>

</table>

</form>

