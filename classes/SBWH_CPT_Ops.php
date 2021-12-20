<?php

/**
 * Core functions file for 'warehouse' custom post type
 */

if (!class_exists('SBWH_CPT_Ops')) :

    class SBWH_CPT_Ops
    {
        /**
         * Traits
         */
        use SBWH_AJAX,
            SBWH_CSS,
            SBWH_CPT,
            SBWH_JS,
            SBWH_Warehouse_Data,
            SBWH_Product_Data,
            SBWH_Update_Post,
            SBWH_Countries_Shipping;

        /**
         * Class init
         *
         * @return void
         */
        public static function init()
        {
            // register custom post type
            add_action('init', [__CLASS__, 'sbwh_register_cpt']);

            // register scripts
            add_action('admin_footer', [__CLASS__, 'sbwh_scripts']);

            // add metabox to 'warehouse' custom post type
            add_action('admin_init', [__CLASS__, 'sbwh_register_metabox']);

            // register ajax function
            add_action('wp_ajax_nopriv_sbwh_ajax', [__CLASS__, 'sbwh_ajax']);
            add_action('wp_ajax_sbwh_ajax', [__CLASS__, 'sbwh_ajax']);

            // save/update post meta
            add_action('save_post', [__CLASS__, 'sbwh_update_post'], 10, 2);
        }


        /**
         * Register CSS and JS scripts
         *
         * @return void
         */
        public static function sbwh_scripts()
        {
            wp_register_style('sbwh-css', self::sbwh_css());
            wp_register_script('sbwh-js', self::sbwh_js(), ['jquery-core', 'jquery-ui-tabs', 'jquery-ui-autocomplete'], false, true);
        }

        /**
         * Register 'warehouse' post type metabox
         *
         * @return void
         */
        public static function sbwh_register_metabox()
        {
            add_meta_box('sbwh-meta', __('Warehouse Data', 'woocommerce'), [__CLASS__, 'sbwh_metabox_html'], 'warehouse', 'normal', 'default');
        }

        /**
         * Callback function to render 'warehouse' post type metabox html
         *
         * @return void
         */
        public static function sbwh_metabox_html()
        { ?>

            <div id="sbwh-tabs">

                <!-- tab links -->
                <ul>
                    <li>
                        <a href="#sbwh-tabs-1">
                            <?php _e('Warehouse Details', 'woocommerce'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="#sbwh-tabs-2">
                            <?php _e('Warehouse Stock', 'woocommerce'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="#sbwh-tabs-3">
                            <?php _e('Countries & Shipping Times', 'woocommerce'); ?>
                        </a>
                    </li>
                </ul>

                <!-- warehouse location data -->
                <div id="sbwh-tabs-1">
                    <?php self::sbwh_render_warehouse_data(); ?>
                </div>

                <!-- warehouse product data -->
                <div id="sbwh-tabs-2">
                    <?php self::sbwh_render_product_data(); ?>
                </div>

                <!-- warehouse product data -->
                <div id="sbwh-tabs-3">
                    <?php self::sbwh_render_countries_shipping(); ?>
                </div>

            </div>

<?php
            // enqueue css and js
            wp_enqueue_style('sbwh-css');
            wp_enqueue_script('sbwh-js');
        }
    }

endif;

SBWH_CPT_Ops::init();
