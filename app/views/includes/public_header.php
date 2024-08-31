<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="resources/css/style.css" type="text/css" media="all">
    <title><?php $this->getData('page_title');?></title>
  </head>

<body class="<?php $this->getData('page_class');?>">
  <div id="wrapper">
    <div class="secondarynav">
      <strong>
        <?php 
          $items = $this->getData('cart_total_items', FALSE);
          $price = $this->getData('cart_total_cost', FALSE);

          if($items == 1)
          {
            echo $items.' item ($'. $price.') in cart';
          }
          else
          {
            echo $items.' items ($'. $price.') in cart';
          }
        ?>
        </strong> &nbsp;| &nbsp;
      <a href="<?php echo SITE_PATH; ?> cart.php">Shopping Cart</a>
    </div>
    <h1><?php echo SITE_NAME; ?></h1>
    <ul class="nav">
      <?php $this->getData('page_nav'); ?>
    </ul>
