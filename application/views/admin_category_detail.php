<?php
// views/admin_category_detail.php

?>

<div class="row">

	<?php $this->load->view('admin_categories_menu');?>

	<div class="span9">

		<form method="POST" name="category_form" action="<?php echo base_url();?>index.php/admin_category/category_detail/category_id/<?php echo $category_detail[0]->category_id;?>">

			<fieldset>
				<legend>category detail</legend>
				<label>title</label>
				<input type="text" name="category_title" id="category_title" value="<?php echo $category_detail[0]->category_title;?>"><br />
				
				<label>description</label>
				<textarea name="category_desc" id="category_desc"><?php echo $category_detail[0]->category_desc;?></textarea>
				<br /><input type="submit" value="update record">

			</fieldset>

		</form>

	</div>

</div>