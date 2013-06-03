<?php
// views/admin_options_main.php

//var_dump($option_group_list);
?>

<div class="row">

	<?php $this->load->view('admin_product_detail_menu');?>

	<div class="span9">

		<div>
			<?php echo validation_errors(); ?>
		</div>

		<legend>Option groups assigned to this product</legend>

		<div id="add_form" class="input-append">

			<div id="product_option_group_droplist" class="input-append">
		<?php		

$options = array();
foreach($option_group_full_list as $tmp_option_group) {

	$options[$tmp_option_group->option_group_id] = $tmp_option_group->option_group_title;

}

echo form_dropdown('add_option_group_id', $options, '', ' id= "add_option_group_id" ');
?>
			</div>

				<button class="btn" name="option_add_btn" id="option_add_btn" onclick="javascript:this.value='updating';">add</button>
			

			

		</div>

		<div id="product_option_group_list">
<?php 
foreach($option_group_list as $option_group) {
?>

		<div><?php echo $option_group->option_group_title;?> <a href='#' id='option_group_delete_btn' onclick='javascript:delete_product_option_group(<?php echo $option_group->option_group_id;?>);'>delete</a></div>

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