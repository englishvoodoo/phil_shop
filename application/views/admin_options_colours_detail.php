<?php
// views/admin_options_colours_detail.php
?>

<div class="row">

	<?php $this->load->view('admin_options_colours_menu');?>

	<div class="span9">

		<div>
			<?php echo validation_errors(); ?>
		</div>

		<form name="colour_form" method="POST" action="<?php echo base_url();?>index.php/admin/options_colours_add">
		<input type="hidden" name="colour_id" value="<?php echo $colour_details[0]->colour_id;?>">
		<fieldset>
		<legend>Colour detail</legend>
		<label>Title</label>
		<input type="text" name="colour_title" id="colour_title" value="<?php echo $colour_details[0]->colour_title;?>">
		<input type="submit" value="update">
		</fieldset>
		</form>

	</div>

</div>