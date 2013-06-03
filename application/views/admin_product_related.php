<?php
// views/admin_product_images.php

//var_dump($option_group_list);
?>

<div class="row">

	<?php $this->load->view('admin_product_detail_menu');?>

	<div class="span9">

		<div>
			<?php echo validation_errors(); ?>
		</div>

		<legend>Related products</legend>

		<form method="POST" action="<?php echo base_url();?>index.php/admin_product_related/add">

			<input type="hidden" name="product_id" id="product_id" value="<?php echo $product_detail[0]->product_id;?>">
			<div id="add_form" class="input-append">

				<div id="product_option_group_droplist" class="input-append">
<?php

$options = array();
foreach($product_list as $tmp_product) {

	if($tmp_product->product_id != $product_detail[0]->product_id) {
		$options[$tmp_product->product_id] = $tmp_product->product_title;
	}

}

echo form_dropdown('related_product_id', $options, '', ' id= "related_product_id" ');

?>
				</div>			
				<input class="btn" type="submit" value="add">	

			</div>

		</form>


		<div id="product_option_group_list">
<?php 
foreach($related_list as $related) {
?>

		<div>
			<?php echo $related->product_title;?> - <a href='<?php echo base_url();?>index.php/admin_product_related/delete/product_id/<?php echo $product_detail[0]->product_id;?>/related_product_id/<?php echo $related->related_product_id;?>'>delete</a><br />
			
		</div>

<?php
}

?>
		</div>

	</div>

</div>

