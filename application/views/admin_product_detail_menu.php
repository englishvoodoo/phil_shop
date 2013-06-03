<div class="span3">
	<ul class="nav nav-tabs nav-stacked">
		<li><a href="<?php echo base_url();?>index.php/admin_product/product_list">back</a></li>
		<li><a href=""><?php echo $product_detail[0]->product_title;?></a></li>
	</ul>

	<ul class="nav nav-tabs nav-stacked">
		<li><a href='<?php echo base_url();?>index.php/admin_product/product_detail/product_id/<?php echo $product_detail[0]->product_id;?>'>main</a></li>
		<!--<li><a href='<?php #echo base_url();?>index.php/admin_product/product_categories/product_id/<?php #echo $product_detail[0]->product_id;?>'>categories</a></li>-->
		<li><a href='<?php echo base_url();?>index.php/admin_product/product_options/product_id/<?php echo $product_detail[0]->product_id;?>'>options</a></li>
		<li><a href='<?php echo base_url();?>index.php/admin_product_images/index/product_id/<?php echo $product_detail[0]->product_id;?>'>images</a></li>
		<li><a href='<?php echo base_url();?>index.php/admin_product_related/index/product_id/<?php echo $product_detail[0]->product_id;?>'>related products</a></li>
		<li><a href='<?php echo base_url();?>index.php/admin_product_delivery/index/product_id/<?php echo $product_detail[0]->product_id;?>'>delivery</a></li>
	</ul>
</div>