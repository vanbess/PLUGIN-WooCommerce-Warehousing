<?php

/**
 * Handles frontend display of custom shipping lead time messages as defined in warehouse CPT
 * Displays message under Add To Cart button on product single
 */

if (!class_exists('SBWH_Frontend')) :

    class SBWH_Frontend
    {

        use SBWH_Cart_Checkout_Msg;
 
        /**
         * Class init
         *
         * @return void
         */
        public static function init()
        {
            // checkout page mod
            add_filter('woocommerce_cart_item_name', [__CLASS__, 'sbwh_display_ship_message_checkout'], 10, 3);

            // product single mod
            add_action('woocommerce_after_add_to_cart_button', [__CLASS__, 'sbwh_display_ship_msg']);
        }

        /**
         * Message display
         *
         * @return void
         */
        public static function sbwh_display_ship_msg()
        {
            // retrieve product id
            global $post;
            $prod_id = $post->ID;

            // retrieve current user country
            $user_country_code = $_SERVER['HTTP_CF_IPCOUNTRY'];

            // retrieve product skus for either simple of variable product, depending on what we're viewing on the front
            $pskus = [];

            // retrieve product object and type
            $prod_obj = wc_get_product($prod_id);
            $prod_type = $prod_obj->get_type();

            // if variable product
            if ($prod_type === 'variable') :

                $children = $prod_obj->get_children();

                foreach ($children as $cid) :
                    $child_obj = wc_get_product($cid);
                    $pskus[] = $child_obj->get_sku();
                endforeach;

            // if simple product
            elseif ($prod_type === 'simple') :
                $pskus[] = $prod_obj->get_sku();
            endif;

            // retrieve warehouse skus for all warehouses
            $wh_skus = self::sbwh_query_warehouses();

            // check if product $pskus is in $wh_skus and return wh_id if found
            $final_wh_id = '';

            // holds matching skus between $pskus and $wh_skus; used for displaying shipping message when variation is clicked
            $matching_skus = [];

            // loop to find matching warehouse skus in $pskus
            foreach ($wh_skus as $whid => $wh_sku_arr) :
                foreach ($wh_sku_arr as $wh_sku) :
                    if (in_array($wh_sku, $pskus)) :
                        $final_wh_id = $whid;
                        $matching_skus[] = $wh_sku;
                    endif;
                endforeach;
            endforeach;

            // if matching skus found, retrieve product ids
            $matching_ids = [];
            if (!empty($matching_skus)) :
                foreach ($matching_skus as $msku) :
                    $matching_ids[] = wc_get_product_id_by_sku($msku);
                endforeach;
            endif;

            // if $final_wh_id exists, retrieve country code array, retrieve warehouse countries array
            if (!empty($final_wh_id)) :

                // if shipping countries array exists
                if (get_post_meta($final_wh_id, '_sbwh_ship_countries', true)) :

                    $country_arr = get_post_meta($final_wh_id, '_sbwh_ship_countries', true);

                    foreach ($country_arr as $index => $code) :
                        if ($code === $user_country_code) :

                            // retrieve country position in $country_arr - used to reference message and display settings for country below
                            $country_pos = $index;

                            // retrieve messages and display settings
                            $messages = get_post_meta($final_wh_id, '_sbwh_ship_messages', true);
                            $display_settings = get_post_meta($final_wh_id, '_sbwh_ship_display', true);

                            // check if message is present in $messages; if true, check whether messages is to be displayed; if true, display message
                            $message = $messages[$country_pos];

                            if (!empty($message) && $display_settings[$country_pos] === 'yes') : ?>
                                <input type="hidden" id="sbwh-prod-type" value="<?php echo $prod_type; ?>">
                                <input type="hidden" id="sbwh-message-pids" value="<?php echo implode(',', $matching_ids); ?>">
                                <p id="sbwh-shipping-msg" style="display: none; color: black; font-weight: bold; text-align: center; margin-bottom: 15px; letter-spacing: 0.5px;">
                                    <?php echo $message; ?>
                                </p>
                            <?php endif; ?>

            <?php endif;
                    endforeach;
                endif;
            endif;

            // frontend js
            wp_enqueue_script('sbwh-frontend-js', self::sbwh_frontend_js(), ['jquery'], false, true);
        }

        /**
         * Frontend JS
         *
         * @return void
         */
        public static function sbwh_frontend_js()
        { ?>
            <script>
                jQuery(document).ready(function($) {

                    // show simple product message on page load finish, if present
                    let prod_type = $('#sbwh-prod-type').val();

                    if (prod_type === 'simple') {
                        $('#sbwh-shipping-msg').show();
                        return;
                    }

                    // show variable product shipping message on variation select, if present
                    $('table.variations select').on('change', function() {

                        setTimeout(function() {

                            let sbwh_pids = $('#sbwh-message-pids').val();
                            let selected = $('.variation_id').val();
                            let search = sbwh_pids.search(selected);
                            let out_of_stock = $('.single_add_to_cart_button').hasClass('wc-variation-is-unavailable');

                            if (search >= 0 && out_of_stock === false) {
                                $('#sbwh-shipping-msg').show();
                            } else {
                                $('#sbwh-shipping-msg').hide();
                            }

                        }, 20);

                    });
                });
            </script>
<?php }

        /**
         * Query warehouse posts
         *
         * @return array $shipping_data - shipping data as/if defined for warehouse post and specific user country
         */
        private static function sbwh_query_warehouses()
        {

            $wh_ids = [];
            $wh_skus = [];

            $wh_query = new WP_Query(
                [
                    'post_type'     => 'warehouse',
                    'post_per_page' => -1,
                    'post_status'   => 'publish',
                    'fields'        => 'ids',
                ]
            );

            if ($wh_query->have_posts()) :
                $wh_ids = $wh_query->posts;

                foreach ($wh_ids as $id) :
                    if (get_post_meta($id, '_sbwh_prod_skus', true)) :
                        $wh_skus[$id] = get_post_meta($id, '_sbwh_prod_skus', true);
                    endif;
                endforeach;

            endif;

            // return $wh_ids;
            return $wh_skus;
        }
    }

endif;

SBWH_Frontend::init();
