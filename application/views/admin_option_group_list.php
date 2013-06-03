<?php
// views/admin_option_group_list.php

?>

<div class="row">

	<?php $this->load->view('admin_options_menu');?>

	<div class="span9">

		<table class="table table-striped table-bordered table-hover table-condensed psj-table-narrow">

		<?php 
		foreach($option_group_list as $option_group)
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