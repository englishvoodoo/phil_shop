<?php
// views/admin_product_detail.php



?>

<div class="row">

	<?php //$this->load->view('admin_products_menu');?>
	<?php $this->load->view('admin_product_detail_menu');?>

	<div class="span5">

		<form name="product_form" method="POST" action="<?php echo base_url();?>index.php/admin_product/product_add">
			<fieldset>
				<legend>product detail</legend>
				<input type="hidden" name="product_id" id="product_id" value="<?php echo $product_detail[0]->product_id;?>">
				<label>Title</label>
				<input type="text" name="product_title" id="product_title" value="<?php echo $product_detail[0]->product_title;?>"><br />
				<label>Code</label>
				<input type="text" name="product_code" id="product_code" value="<?php echo $product_detail[0]->product_code;?>"><br />
				<label>Description</label>
				<textarea name="product_description" id="product_description"><?php echo $product_detail[0]->product_description;?></textarea><br />
				<label>Price</label><input type="text" name="product_price" id="product_price" value="<?php echo $product_detail[0]->product_price;?>"><br />
				
				<label>Stock</label>
				<input type="text" name="product_stock" id="product_stock" value="<?php echo $product_detail[0]->product_stock;?>"><br />
				<label>Status</label>
				<?php
$options = array(
		'1'	=> 'active',
		'0'	=> 'inactive',
		);

echo form_dropdown('product_status', $options, $product_detail[0]->product_status, ' id= "product_status" ');
				?>
				<br />
				<input type="submit" value="update product">
			</fieldset>
		</form>

	</div>

	<div class="span4">

		<div id="test_div"></div>

		<legend>categories</legend>

		<div id="product_category_droplist">
<?php		

$options = array();
foreach($all_categories as $tmp_category) {

	$options[$tmp_category->category_id] = $tmp_category->category_title;

}

echo form_dropdown('add_category_id', $options, '', ' id= "add_category_id" ');
?>
		</div>

		<button name="category_add_btn" id="category_add_btn" onclick="javascript:this.value='updating';">add</button>
	
		<div id="product_category_list">

<?php

foreach($category_list as $tmp_category) {
	
?>
			<div><?php echo $tmp_category->category_title;?> <a href="#" id="category_delete_btn" onclick="javascript:delete_product_category(<?php echo $tmp_category->category_id;?>);">delete</a></div>
<?php
}
?>

		</div>

	</div>

</div>

<script>
function reload_product_categories() {

	// reload the categories drop-list
	var loadUrl = "<?php echo base_url();?>index.php/admin_ajax/ajax/action/reload_product_category_droplist/product_id/<?php echo $product_detail[0]->product_id;?>";      
	// $("#product_category_droplist").html(ajax_load).load(loadUrl); 
	$("#product_category_droplist").load(loadUrl); 

	// reload the categories display list
	var loadUrl = "<?php echo base_url();?>index.php/admin_ajax/ajax/action/reload_product_category_list/product_id/<?php echo $product_detail[0]->product_id;?>";  
	// $("#product_category_list").html(ajax_load).load(loadUrl); 
	$("#product_category_list").load(loadUrl); 

	status_flash('record updated');

}

$("#category_add_btn").click(function(){

	// add the selected category via an ajax call
	category_id = $("#add_category_id").val();

	$.ajax({
		
		url: "<?php echo base_url();?>index.php/admin_ajax/ajax/action/add_product_category/product_id/<?php echo $product_detail[0]->product_id;?>/category_id/"+category_id,
		context: document.body

	}).done(function() {
		
		reload_product_categories();

	});

});

function delete_product_category(category_id)
{

	$.ajax({
		
		url: "<?php echo base_url();?>index.php/admin_ajax/ajax/action/delete_product_category/product_id/<?php echo $product_detail[0]->product_id;?>/category_id/"+category_id,
		context: document.body

	}).done(function() {
		
		reload_product_categories();


	});

}
</script>
