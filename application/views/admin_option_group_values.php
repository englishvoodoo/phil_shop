<?php
// views/admin_option_group_values.php

?>

<div class="row">

	<?php $this->load->view('admin_options_menu');?>

	<div class="span9">

		<legend><?php echo $option_group_details[0]->option_group_title;?></legend>

		<table class="table table-striped table-bordered table-hover table-condensed psj-table-narrow">

		<form name="option_value_form" method="POST" action="<?php echo base_url();?>index.php/admin_option/option_value_add">
		<input type="hidden" name="option_group_id" value="<?php echo $option_group_details[0]->option_group_id;?>">
		<tr>
			<td><input type="text" name="option_value_title" id="option_value_title"></td>
			<td><input class="btn psj-small-btn" type="submit" value="add"></td>
		</tr>

		</form>

		<?php 
		foreach($option_values_list as $option_value)
		{

			$option_value_id	= $option_value->option_value_id;
			$option_value_title	= $option_value->option_value_title;
?>
		<tr>
			<td>
				<a href='<?php echo base_url();?>index.php/admin_option/option_detail/option_id/<?php echo $option_value_id;?>'><?php echo $option_value_title;?></a>
			</td>
			<td>
				<button class="btn psj-small-btn">delete</button>
			</td>
		</tr>
<?php
		}
		?>

		</table>

	</div>

</div>