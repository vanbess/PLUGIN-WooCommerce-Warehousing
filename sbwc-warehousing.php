<?php

/**
 * Plugin Name: SBWC Warehousing
 * Description: Adds warehousing functionality to WooCommerce
 * Version: 1.0.0
 * Author: WC Bessinger
 */

// perform security check
!defined('ABSPATH') ? exit() : '';

// define path and URL constants
define('SBWH_PATH', plugin_dir_path(__FILE__));
define('SBWH_URL', plugin_dir_url(__FILE__));

// traits
include SBWH_PATH . 'traits/SBWH_AJAX.php';
include SBWH_PATH . 'traits/SBWH_CPT.php';
include SBWH_PATH . 'traits/SBWH_CSS.php';
include SBWH_PATH . 'traits/SBWH_JS.php';
include SBWH_PATH . 'traits/SBWH_Product_Data.php';
include SBWH_PATH . 'traits/SBWH_Warehouse_Data.php';
include SBWH_PATH . 'traits/SBWH_Update_Post.php';
include SBWH_PATH . 'traits/SBWH_Countries_Shipping.php';

// classes
include SBWH_PATH . 'classes/SBWH_CPT_Ops.php';
include SBWH_PATH . 'classes/SBWH_Frontend.php';
