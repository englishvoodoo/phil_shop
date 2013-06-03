<?php
// views/shop_product_detail.php
?>

<div class="row-fluid">
        	
  <div class="span4">

    <h2><?php echo $product_details[0]->product_title;?></h2>
    <?php
if($product_images) {
$image_path = "http://localhost/phil_shop/product_images/".$product_details[0]->product_id."/".$product_images[0]->image_src;
?>
    <p><img src='<?php echo $image_path;?>'></p>
<?php
}
?>
    <p class="lead"><?php echo $product_details[0]->product_description;?></p>
    <p>Code : <?php echo $product_details[0]->product_code;?></p>
    <p>Price : &pound;<?php echo $product_details[0]->product_price;?></p>
    <p>Quantity : <input type="text" class="input-mini" name="quantity" id="quantity" value="1"></p>
    <p><a class="btn" onclick="javascript:add_to_cart();" href="#">Add to cart</a></p>

  </div><!--/span-->
            
  <div class="span4">

    <h2>Options</h2>
    <p>
<?php
foreach($product_options as $option_group) {

     echo "<p><strong>".$option_group['option_group_legend']."</strong></p>";

     $option_value_array = $option_group['detail'];

     $options = array();

     $options[0] = "Please select";
     foreach($option_value_array as $option_value) {

       $options[$option_value['option_value_id']] = $option_value['option_value_title'];

     }

     echo "<p>";
     echo form_dropdown('option_'.$option_group['option_group_id'], $options, '', ' id="option_'.$option_group['option_group_id'].'" ');
     echo "</p>";

}
?>    


    </p>
  

  </div><!--/span-->
            
  <div class="span4">
  
    <h3>product info panel</h3>
    <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              	
  </div><!--/span-->
          	
</div><!--/row-->

<div class="row-fluid">

  <div class="span4">
    <hr />
  </div>

</div>

<div class="row-fluid">

  <div class="span12">
    <h4>Related products</h4>
  </div>

</div>

<div class="row-fluid">
<?php
//var_dump($related_products);
foreach($related_products as $related) {

  //var_dump($related);

  $image_type = $related->image_type;
  $image_src  = $related->image_src;

  if($image_src) {
    

    $image_path = "http://localhost/phil_shop/product_images/".$related->product_id."/".$image_src;

    
  }
?>
  <div class="span4">
    <a href="<?php echo base_url();?>index.php/product/detail/product_id/<?php echo $related->product_id;?>">
    <h4><?php echo $related->product_title;?></h4>
<?php
  if($image_type == '2') {
    //echo "<BR>:::".$image_path;
?>
  <br /><img src="<?php echo $image_path;?>">
<?php
  }
?>    
    <p>Price : &pound;<?php echo number_format($related->product_price,2);?></p>
    </a>
  </div>

<?php
}
?>  

</div>  

        
<script>

function add_to_cart() {

  add_flag = true;

  // do we have any options without values?
  // build up the options string at the same time

  options_str = '';

<?php
foreach($product_options as $option_group) {
     $option_field = "option_".$option_group['option_group_id'];
?>
  var option_field = $("#<?php echo $option_field;?>");

  options_str += "<?php echo $option_field;?>_"+option_field.val()+"-";

  //alert(option_field.val());
  if(option_field.val() == 0) {
    add_flag = false;
  }
<?php
}
?> 

  if(!add_flag) {
  
    alert("Please select your options");
    return false;
  
  } else {

    //alert(options_str);
    //return false;

    // get the quantity - default to 1
    var quantity = $("#quantity").val();
    if(quantity == '') {
      quantity = 1;
    }

    //if(!$("#quantity").isNumeric()) {

    if(!$.isNumeric($("#quantity").val())) {
      
      alert("Please enter a numeric value");

      $("#quantity").val('');
      $("#quantity").focus();

      return false;

    }

    if(options_str == '') {
      options_str = "___";
    }

    var add_location = '<?php echo base_url();?>index.php/cart/add/product_id/<?php echo $product_details[0]->product_id;?>/options/'+options_str+'/quantity/'+quantity;

    location.href = add_location;

  }

}
</script>  
