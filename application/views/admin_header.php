<?php
// views/admin_header.php
?>
<!DOCTYPE html> 
<html>
<head>
<!--<link href="http://localhost/phil_shop/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">-->
<link href="http://localhost/phil_shop/bootstrap/css/psj-bootstrap.css" rel="stylesheet" media="screen">
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<style>
#status_holder {
	height:30px;
}
#status_bar {
	height:28px;
	background-color: #00ff00;
	display:none;
	color:#ffffff;
}


.psj-table-narrow tr{
	height:10px;
}

.psj-small-btn {
font-size:12px;
height:20px;
line-height:12px;
}

</style>
</head>

<body>

<?php
$active_home 		= "";
$active_product 	= "";
$active_category 	= "";
$active_option 		= "";
$active_delivery 	= "";
$active_orders 		= "";
$active_customers 	= "";

$sys_area = $this->uri->segment(1);
if($sys_area == 'admin') {
	$active_home = "active";
} else {
	$tmp_array = explode("_", $sys_area);
	$sys_area = $tmp_array[0]."_".$tmp_array[1];
	switch($sys_area) {

		case "admin_product":
			$active_product = "active";
			break;

		case "admin_category":
			$active_category = "active";
			break;

		case "admin_option":
			$active_option = "active";
			break;

		case "admin_delivery":
			$active_delivery = "active";
			break;

		default :
			$active_home = "active";
			break;
	}
}
?>

<div class="container-fluid">

	<div class="navbar">
	  <div class="navbar-inner">
	    <a class="brand" href="#">Phil Shop</a>
	    <ul class="nav">
	      <li class="<?php echo $active_home;?>"><a href="#">Home</a></li>
	      <li class="<?php echo $active_product;?>"><a href='<?php echo base_url();?>index.php/admin_product/product_list'>products</a></li>
			<li class="<?php echo $active_category;?>"><a href='<?php echo base_url();?>index.php/admin_category/categories'>categories</a></li>
			<li class="<?php echo $active_option;?>"><a href='<?php echo base_url();?>index.php/admin_option/options'>options</a></li>
			<li class="<?php echo $active_delivery;?>"><a href='<?php echo base_url();?>index.php/admin_delivery/index'>delivery</a></li>
			<li class="<?php echo $active_orders;?>"><a href='<?php echo base_url();?>index.php/admin/orders'>orders</a></li>
			<li class="<?php echo $active_customers;?>"><a href='<?php echo base_url();?>index.php/admin/customers'>customers</a></li>
	    </ul>
	  </div>
	</div>

	<div class="row" id="status_holder">
		<div id="status_bar" class="row pagination-centered">
		
				[status_bar]
		</div>
	</div>


