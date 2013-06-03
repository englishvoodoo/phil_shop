<?php
// views/admin_category_list.php

//var_dump($category_list);
?>

<div class="row">

	<?php $this->load->view('admin_delivery_menu');?>

	<div class="span9">

		<?php echo validation_errors(); ?>
		
		<?php echo form_open('admin_delivery/detail');?>

			<input type="hidden" name="schedule_id" id="schedule_id" value="<?php echo $schedule_id;?>">

			<fieldset>

				<label>Title</label>
				<input type="text" name="schedule_title" id="schedule_title" value="<?php echo $schedule_title;?>">
				<br />
				<input type="submit" class="btn" value="save">
			</fieldset>

		</form>

	</div>

</div>