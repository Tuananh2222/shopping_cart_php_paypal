<?php
/* 
 INIT
 Basic configuration settings
 */
//connect to database
$servername = "localhost";
$username = "root";
$password = "root";
$dbName = 'wb_shop';
$port = 8889;

$Database = mysqli_connect($servername, $username, $password, $dbName, $port);

// error reporting

mysqli_report(MYSQLI_REPORT_ERROR);
ini_set('display_errors', 1);

// set up constants
define('SITE_NAME', 'My Online Store');
define('SITE_PATH', 'http://localhost:8888/');
define('IMAGE_PATH', 'resources/images/');

define('SHOP_TAX', '0.0875');



// include objects
include('app/models/m_template.php');
include('app/models/m_categories.php');
include('app/models/m_products.php');
include('app/models/m_cart.php');

// create objects
$Template = new Template();
$Categories = new Categories($Database);
$Products = new Products($Database);
$Cart = new Cart();

session_start();

// global
$Template->setData('cart_total_items', $Cart->getTotalItems());
$Template->setData('cart_total_cost', $Cart->getTotalCost());
