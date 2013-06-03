<?php
// views/shop_sidebar_left.php

?>
<div class="well sidebar-nav">

  <ul class="nav nav-list">
    <li class="nav-header">Categories</li>
<?php
foreach($category_list as $category) {

  if($category->category_title == $category_title) {

    $class = "active";

  } else {

    $class = "";

  }
?>    

      <li class="<?php echo $class;?>"><a href="<?php echo base_url();?>index.php/product/browse/category_id/<?php echo $category->category_id;?>"><?php echo $category->category_title;?></a></li>
<?php
}
?>      

              <li class="nav-header">Useful Links</li>
              <li><a href="<?php echo base_url();?>index.php/content/page/about_us">About Us</a></li>
              <li><a href="<?php echo base_url();?>index.php/content/page/contact">Contact</a></li>
              <li><a href="<?php echo base_url();?>index.php/content/page/faq">FAQs</a></li>
              <li><a href="<?php echo base_url();?>index.php/content/page/terms">Terms</a></li>
              <li><a href="<?php echo base_url();?>index.php/content/page/delivery">Delivery</a></li>
              <li><a href="<?php echo base_url();?>index.php/content/page/returns">Returns</a></li>

              <li class="nav-header">Sidebar</li>
   
</ul>

</div><!--/.well -->