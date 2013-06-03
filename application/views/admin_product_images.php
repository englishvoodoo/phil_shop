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

		<legend>Product images</legend>

		<?php echo form_open_multipart('admin_product_images/do_upload');?>
		<input type="hidden" name="product_id" value="<?php echo $product_detail[0]->product_id;?>">
		
		<div id="add_form" class="input-append">

			<fieldset>

				<label>Image type</label>
				<select name="image_type" id="image_type">
					<option value="1">main</option>
					<option value="2">thumbnail</option>
				</select><br />

				<label>Alt text</label>
				<input type="text" name="image_alt" id="image_alt"><br />

				<input type="file" name="userfile" id="userfile"><br />

				<input type="submit" value="add image">

			</fieldset>

		</div>

		</form>

		<div id="product_option_group_list">
<?php 
foreach($image_list as $image) {
?>

		<div>
			<?php echo $image->image_src;?> - <a href='<?php echo base_url();?>index.php/admin_product_images/delete/product_id/<?php echo $product_detail[0]->product_id;?>/image_id/<?php echo $image->image_id;?>'>delete</a><br />
			<img src="http://localhost/phil_shop/product_images/<?php echo $product_detail[0]->product_id;?>/<?php echo $image->image_src;?>">
			<br /><br />
		</div>

<?php
}

?>
		</div>

	</div>

</div>

<script>
function reload_product_options() {

	// reload the option groups drop-list
	var loadUrl = "<?php echo base_url();?>index.php/admin_ajax/ajax/action/reload_product_option_group_droplist/product_id/<?php echo $product_detail[0]->product_id;?>";      
	// $("#product_category_droplist").html(ajax_load).load(loadUrl); 
	$("#product_option_group_droplist").load(loadUrl); 


	// reload the option groups display list
	var loadUrl = "<?php echo base_url();?>index.php/admin_ajax/ajax/action/reload_product_option_group_list/product_id/<?php echo $product_detail[0]->product_id;?>";  
	// $("#product_category_list").html(ajax_load).load(loadUrl); 
	$("#product_option_group_list").load(loadUrl); 

	status_flash('record updated');

}

$("#option_add_btn").click(function(){

	// add the selected category via an ajax call
	option_group_id = $("#add_option_group_id").val();

	$.ajax({
		
		url: "<?php echo base_url();?>index.php/admin_ajax/ajax/action/add_product_option_group/product_id/<?php echo $product_detail[0]->product_id;?>/option_group_id/"+option_group_id,
		context: document.body

	}).done(function() {
		
		reload_product_options();

	});

});

function delete_product_option_group(option_group_id)
{

	$.ajax({
		
		url: "<?php echo base_url();?>index.php/admin_ajax/ajax/action/delete_product_option_group/product_id/<?php echo $product_detail[0]->product_id;?>/option_group_id/"+option_group_id,
		context: document.body

	}).done(function() {
		
		reload_product_options();


	});

}
</script>