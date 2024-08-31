<?php
include('app/init.php');
$Template->setData('page_class', 'home');
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  // get products from sprecific category

  $category = $Categories->getCategories($_GET['id']);

  // check if valid
  if (!empty($category)) {
    // get category nav
    $category_nav = $Categories->get_category_nav($category['name']);
    $Template->setData('page_nav', $category_nav);

    // get all products from that category
    $cat_products = $Products->create_product_table(4, $_GET['id']);

    if (!empty($cat_products)) {
      $Template->setData('products', $cat_products);
    } else {
      $Template->setData('products', '<li>No products exist in this category</li>');
    }
    $Template->load('app/views/v_public_home.php', $category['name']);
  }
} else {
  // get all products from all categories

  //get category nav
  $category_nav = $Categories->get_category_nav('home');
  $Template->setData('page_nav', $category_nav);

  //get products
  $products = $Products->create_product_table();
  $Template->setData('products', $products);

  include $Template->load('app/views/v_public_home.php', 'Welcome!');
}
