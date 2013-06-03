<?php
// views/admin_option_list.php

?>

<div class="row">

	<?php $this->load->view('admin_options_menu');?>

	<div class="span9">

		<legend><?php echo $option_details[0]->option_title;?></legend>

		<table class="table table-striped table-bordered table-hover table-condensed psj-table-narrow">

		<form name="option_value_form" method="POST" action="<?php echo base_url();?>index.php/admin_option/option_group_add">
		<input type="hidden" name="option_id" value="<?php echo $option_details[0]->option_id;?>">
		<tr>
			<td><input type="text" name="option_group_title" id="option_group_title"></td>
			<td><input class="btn psj-small-btn" type="submit" value="add"></td>
		</tr>

		</form>

		<?php 
		foreach($option_groups_list as $option_group)
		{

			$option_group_id	= $option_group->option_group_id;
			$option_group_title	= $option_group->option_group_title;
?>
		<tr>
			<td>
				<a href='<?php echo base_url();?>index.php/admin_option/option_detail/option_id/<?php echo $option_group_id;?>'><?php echo $option_group_title;?></a>
			</td>
			<td>
				<a href="<?php echo base_url();?>index.php/admin_option/option_group_values/option_group_id/<?php echo $option_group_id;?>"><button class="btn psj-small-btn">view options</button></a>
			</td>
		</tr>
<?php
		}
		?>

		</table>

	</div>

</div>