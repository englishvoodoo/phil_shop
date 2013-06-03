<?php
// views/admin_option_detail.php

?>

<div class="row">

	<?php $this->load->view('admin_options_menu');?>

	<div class="span9">

		<legend>Top level option</legend>

		<?php 
		if($this->session->flashdata('msg')) {
		?>
		<p class="well text-success"><?php echo $this->session->flashdata('msg'); ?></p>
		<?php
		}
		?>
		
		<?php echo validation_errors(); ?>

		<?php echo form_open('admin_option/option_detail');?>

			<input type="hidden" name="option_id" id="option_id" value="<?php echo $option_id;?>">

			<fieldset>
				<label>option type</label>
								<?php
$options = array(
		'1'	=> 'user selection',
		'2'	=> 'static',
		);

echo form_dropdown('option_type_id', $options, $option_type_id, ' id= "option_type_id" ');
				?>
				<br />

				<label>title</label>
				<input type="text" name="option_title" id="option_title" value="<?php echo $option_title;?>"><br />

				<input type="submit" class="btn" value="save">

			</fieldset>

		</form>

	</div>

</div>