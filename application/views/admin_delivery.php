<?php
// views/admin_category_list.php

//var_dump($category_list);
?>

<div class="row">

	<?php $this->load->view('admin_delivery_menu');?>

	<div class="span9">

		<table class="table table-striped table-bordered table-hover table-condensed psj-table-narrow">

		<?php 
		foreach($schedule_list as $schedule)
		{

			$schedule_id	= $schedule->schedule_id;
			$schedule_title	= $schedule->schedule_title;
?>
			<tr>
				<td>
					<a href='<?php echo base_url();?>index.php/admin_delivery/detail/schedule_id/<?php echo $schedule_id;?>'><?php echo $schedule_title;?></a>
				</td>
			
				<td><a href="<?php echo base_url();?>index.php/admin_delivery/detail/schedule_id/<?php echo $schedule_id;?>"><button class="btn psj-small-btn">details</button></td>
			</tr>	
<?php
		}
		?>

		</table>

	</div>

</div>