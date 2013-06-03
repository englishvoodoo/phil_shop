<?php
// views/shop_header.php
?>
<!DOCTYPE html> 
<html>
<head>
	<meta charset="utf-8">
    <title>Phil Shop</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
<!--<link href="http://localhost/phil_shop/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">-->
<link href="http://localhost/phil_shop/bootstrap/css/psj-bootstrap.css" rel="stylesheet" media="screen">
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }

      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
      }
    </style>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../assets/ico/favicon.png">
</head>

<body>





	<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">Phil Shop</a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              Logged in as <a href="#" class="navbar-link">Username</a>
            </p>
            <ul class="nav">
              <li class="active"><a href="<?php echo base_url();?>">Home</a></li>
              <li><a href="<?php echo base_url();?>index.php/product/browse">browse products</a></li>
              <li><a href="<?php echo base_url();?>index.php/cart">shopping cart</a></li>
              <li><a href="<?php echo base_url();?>index.php/content/page/about_us">about us</a></li>
              <li><a href="<?php echo base_url();?>index.php/content/page/contact">contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

<div class="container-fluid">
	<div class="row-fluid">
    
        <div class="span3">

        	<?php $this->load->view('shop_sidebar_left'); ?>
          
        </div><!--/span-->

        <div class="span9">


