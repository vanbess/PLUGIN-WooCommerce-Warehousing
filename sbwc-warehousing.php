<?php

/**
 * Plugin Name: SBWC Warehousing
 * Description: Adds warehousing functionality to WooCommerce
 * Version: 1.0.0
 * Author: WC Bessinger
 */

// perform security check
!defined('ABSPATH') ? exit() : '';

add_action('plugins_loaded', 'sbwh_plugin_init');

function sbwh_plugin_init()
{

    // define path and URL constants
    define('SBWH_PATH', plugin_dir_path(__FILE__));
    define('SBWH_URL', plugin_dir_url(__FILE__));

    // traits
    include SBWH_PATH . 'traits/back/SBWH_AJAX.php';
    include SBWH_PATH . 'traits/back/SBWH_CPT.php';
    include SBWH_PATH . 'traits/back/SBWH_CSS.php';
    include SBWH_PATH . 'traits/back/SBWH_JS.php';
    include SBWH_PATH . 'traits/back/SBWH_Product_Data.php';
    include SBWH_PATH . 'traits/back/SBWH_Warehouse_Data.php';
    include SBWH_PATH . 'traits/back/SBWH_Update_Post.php';
    include SBWH_PATH . 'traits/back/SBWH_Countries_Shipping.php';
    include SBWH_PATH . 'traits/front/SBWH_Cart_Checkout_Msg.php';

    // classes
    include SBWH_PATH . 'classes/back/SBWH_CPT_Ops.php';
    include SBWH_PATH . 'classes/front/SBWH_Frontend.php';
}
