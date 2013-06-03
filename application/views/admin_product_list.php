<?php
// views/products_browse.php

?>



<div class="row">

	<?php $this->load->view('admin_products_menu');?>

	<div class="span9">

		<table class="table table-striped table-bordered table-hover table-condensed psj-table-narrow">
			<tr>
				<th>Title</th>
				<th>Code</th>
				<th>Price</th>
				<th>Stock</th>
				<th>Status</th>
				<th>&nbsp;</th>
			</tr>
<?php
foreach($products as $product) {

	$product_id = $product->true_product_id;
	$product_status = ($product->product_status == 1 ? 'active' : 'inactive'); // returns true

?>
			<tr>
				<td>
<a href='<?php echo base_url();?>index.php/admin_product/product_detail/product_id/<?php echo $product_id;?>'><?php echo $product->product_title;?><a><br />
				</td>
				<td><?php echo $product->product_code;?></td>
				<td style="text-align:right;"><?php echo number_format($product->product_price,2);?></td>
				<td><?php echo $product->product_stock;?></td>
				<td><?php echo $product_status;?></td>
				<td>
					<button class="btn psj-small-btn" onclick="javascript:location.href='<?php echo base_url();?>index.php/admin_product/product_detail/product_id/<?php echo $product_id;?>';">edit</button>
				</td>
			</tr>
<?php
}
?>
				
		</table>

	</div>

</div>