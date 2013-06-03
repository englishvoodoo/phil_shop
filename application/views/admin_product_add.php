<?php
// views/admin_product_add.php
?>

<div class="row">

	<?php $this->load->view('admin_products_menu');?>

	<div class="span9">

		<div>
			<?php echo validation_errors(); ?>
		</div>

		<form name="product_form" method="POST" action="<?php echo base_url();?>index.php/admin_product/product_add">

		<fieldset>
			<legend>add product</legend>
			<label>Title</label>
			<input type="text" name="product_title" id="product_title" value="<?php echo set_value('product_title');?>"><br />
			<label>Description</label>
			<textarea name="product_description" id="product_description"><?php echo set_value('product_description');?></textarea><br />
			<label>Price</label><input type="text" name="product_price" id="product_price" value="<?php echo set_value('product_price');?>"><br />
			<input type="submit" value="create product">

		</fieldset>

		</form>

	</div>

</div>