<?php
// views/admin_category_list.php

//var_dump($category_list);
?>

<div class="row">

	<?php $this->load->view('admin_categories_menu');?>

	<div class="span9">

		<table class="table table-striped table-bordered table-hover table-condensed psj-table-narrow">

		<?php 
		foreach($category_list as $category)
		{

			$category_id	= $category->category_id;
			$category_title	= $category->category_title;
?>
			<tr>
				<td>
					<a href='<?php echo base_url();?>index.php/admin_category/category_detail/category_id/<?php echo $category_id;?>'><?php echo $category_title;?></a>
				</td>
			
				<td><a href="<?php echo base_url();?>index.php/admin_category/category_detail/category_id/<?php echo $category_id;?>"><button class="btn psj-small-btn">details</button></td>
			</tr>	
<?php
		}
		?>

		</table>

	</div>

</div>