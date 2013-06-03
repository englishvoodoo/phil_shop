<?php
// views/home.php
?>

<?php 
if($category_title) {
?>
<div class="span12 well">
	<h3><?php echo $category_title;?></h3>
	<p><?php echo $category_desc;?></p>
</div>
<?php 
}
?>

<?php
$cnt = 0;
foreach($product_list as $product) {

	//var_dump($product);exit();

	$product_id = $product->true_product_id;

	$cnt ++;

	if($cnt == 1) {
		// write out the row start
		echo "<div class='row-fluid'>";
	}

?>
	<div class="span4">
		<h3><?php echo $product->product_title;?></h2>
		<?php
		if($product->image_type == 2) {
		//if(1 == 2) {
		$image_path = "http://localhost/phil_shop/product_images/".$product_id."/".$product->image_src;
		?>
		<p><img src='<?php echo $image_path;?>'></p>
		<?php
		}
		?>
		<p><?php echo $product->product_description;?></p>
		<p>Code : <?php echo $product->product_code;?></p>
		<p>Price : &pound;<?php echo number_format($product->product_price,2);?></p>
		<p><a class="btn" href="<?php echo base_url();?>index.php/product/detail/product_id/<?php echo $product_id;?>">View details &raquo;</a></p>
		
		
	</div><!--/span-->
<?php


	if($cnt == 3) {
		// write out the row end
		echo "</div><!--/row-->";
		echo "<div class='span12'><hr /></div>";

		$cnt = 0;
	}

	//var_dump($product);

}

// close the row if we haven't already
if($cnt != 3) {

	echo "</div><!--/row-->";
}
?>

