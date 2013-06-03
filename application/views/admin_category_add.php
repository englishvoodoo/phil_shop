<?php
// views/admin_category_add.php

?>

<div class="row">

	<?php $this->load->view('admin_categories_menu');?>

	<div class="span9">

		<form method="POST" name="category_form" action="<?php echo base_url();?>index.php/admin_category/category_add">

			<fieldset>
				<legend>add a category</legend>
				<label>title</label>
				<input type="text" name="category_title" id="category_title"><br />
				<input type="submit" value="create record">

			</fieldset>

		</form>

	</div>

</div>