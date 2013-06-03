<?php
// views/admin_option_list.php

?>

<div class="row">

	<?php $this->load->view('admin_options_menu');?>

	<div class="span9">

		<table class="table table-striped table-bordered table-hover table-condensed psj-table-narrow">

		<?php 
		foreach($option_list as $option)
		{

			$option_id		= $option->option_id;
			$option_title	= $option->option_title;
			$option_type_id	= $option->option_type_id;
?>
		<tr>
			<td>
				<a href='<?php echo base_url();?>index.php/admin_option/option_detail/option_id/<?php echo $option_id;?>'><?php echo $option_title;?></a>
			</td>
			<td>
				<?php
				if($option_type_id == 1) {
				?>
				<a href="<?php echo base_url();?>index.php/admin_option/option_detail_groups/option_id/<?php echo $option_id;?>"><button class="btn psj-small-btn">view groups</button></a>
				<?php
			} else {
				?>
				&nbsp;
				<?php
			}
			?>
			</td>
		</tr>
<?php
		}
		?>

		</table>

	</div>

</div>