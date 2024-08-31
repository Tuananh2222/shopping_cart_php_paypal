<?php
include('app/init.php');
$Template->setData('page_class', 'product');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  //show product

  $product = $Products->get($_GET['id']);

  if (! empty($product)) {
    // pass product data to view
    $Template->setData('prod_id', $_GET['id']);
    $Template->setData('prod_name', $product['name']);
    $Template->setData('prod_description', $product['description']);

    $Template->setData('prod_price', $product['price']);
    $Template->setData('prod_image', IMAGE_PATH . $product['image']);

    // create category nav
    $category_nav = $Categories->get_category_nav($product['category_name']);
    $Template->setData('page_nav', $category_nav);

    //display view
    $Template->load('app/views/v_public_product.php', $product['name']);
  } else {
    //error message
    $Template->redirect(SITE_PATH);
  }
} else {
  //error message
  $Template->redirect(SITE_PATH);
}
