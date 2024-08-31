<?php
include('app/init.php');
$Template->setData('page_class', 'shoppingcart');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  //check if adding a valid item
  if (!$Products->product_exists($_GET['id'])) {
    $Template->setAlert('Invalid Item');
    $Template->redirect(SITE_PATH . 'cart.php');
  }
  //add item to cart
  if (isset($_GET['num']) && is_numeric($_GET['num'])) {
    $Cart->add($_GET['id'], $_GET['num']);
    $Template->setAlert('Item have been added to cart');
  } else {
    $Cart->add($_GET['id']);
    $Template->setAlert('Item has been added to cart');
  }
  $Template->redirect(SITE_PATH . 'cart.php');
}
if (isset($_GET['empty'])) {
  $Cart->empty_cart();
  $Template->setData('cart_total_items', 0);
  $Template->setData('cart_total_cost', '0.00');
  $Template->setAlert('Cart has been emptied');
  $Template->redirect(SITE_PATH . 'cart.php');
}

if (isset($_POST['update'])) {
  // get all ids of products in cart
  $ids = $Cart->get_ids();

  // make sure we have ids to work with
  if ($ids != NULL) {
    foreach ($ids as $id) {
      if (is_numeric($_POST['product' . $id])) {
        $Cart->update($id, $_POST['product' . $id]);
      }
    }
  }
  $Template->setData('cart_total_items', $Cart->getTotalItems());
  $Template->setData('cart_total_cost', $Cart->getTotalCost());
  // add alert
  $Template->setAlert('Number of items in the cart updated!');
}

// Get the total amount from the cart
$totalAmount = $Cart->getTotalCost();
$Template->setData('total_amount', $totalAmount);

//get cart items
$display = $Cart->create_cart();
$Template->setData('cart_rows', $display);

//get category nav
$category_nav = $Categories->get_category_nav('');
$Template->setData('page_nav', $category_nav);

$Template->load('app/views/v_public_cart.php', 'Shopping Cart!');
