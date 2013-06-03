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

		<legend>Delivery schedules</legend>

		<form method="POST" action="<?php echo base_url();?>index.php/admin_product_delivery/add">

			<input type="hidden" name="product_id" id="product_id" value="<?php echo $product_detail[0]->product_id;?>">
			<div id="add_form" class="input-append">

				<div id="product_option_group_droplist" class="input-append">
<?php

$options = array();
foreach($full_schedule_list as $schedule) {

	$options[$schedule->schedule_id] = $schedule->schedule_title;

}

echo form_dropdown('schedule_id', $options, '', ' id= "schedule_id" ');

?>
				</div>			
				<input class="btn" type="submit" value="add">	

			</div>

		</form>


		<div id="product_option_group_list">
<?php 
foreach($schedule_list as $schedule) {
?>

		<div>
			<?php echo $schedule->schedule_title;?> - <a href='<?php echo base_url();?>index.php/admin_product_delivery/delete/product_id/<?php echo $product_detail[0]->product_id;?>/schedule_id/<?php echo $related->schedule_id;?>'>delete</a><br />
			
		</div>

<?php
}

?>
		</div>

	</div>

</div>

