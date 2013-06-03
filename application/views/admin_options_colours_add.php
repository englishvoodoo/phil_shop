<?php
// views/admin_options_colours.php
?>

<div class="row">

	<?php $this->load->view('admin_options_colours_menu');?>

	<div class="span9">

		<div>
			<?php echo validation_errors(); ?>
		</div>

		<form name="colour_form" method="POST" action="<?php echo base_url();?>index.php/admin/options_colours_add">
		<fieldset>
		<legend>Add a colour</legend>
		<label>Title</label>
		<input type="text" name="colour_title" id="colour_title" value="<?php echo set_value('colour_title');?>">
		<input type="submit" value="add">
		</fieldset>
		</form>

	</div>

</div>