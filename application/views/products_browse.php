<?php
// views/products_browse.php
?>
<h3>products_browse.php</h3>

<div id="admin_products_nav">

	<ul>
		<li><a href='<?php echo base_url();?>index.php/admin/product_add'>add product</a></li>
		<li>list products</li>
	</ul>

</div>

<?php
var_dump($product_list);
?>