<?php

/**
 * Handles display custom shipping message for relevant products on Cart page
 */

trait SBWH_Cart_Checkout_Msg
{

    /**
     * Displays custom shipping message per product if product is found to be part of a particular warehouse
     *
     * @param  string $item_name - Product name in product list on checkout page
     * @param  array $cart_item - Data array for each cart item/product
     * @param  string $cart_item_key - unique key for each product in cart
     */
    public static function sbwh_display_ship_message_checkout($item_name, $cart_item, $cart_item_key)
    {

        // get product id
        $prod_id = $cart_item['product_id'];

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

                        if (!empty($message) && $display_settings[$country_pos] === 'yes') :

                            $message_fin = '<p class="sbwh_checkout_ship_message" style="color: #7a9c59; font-weight: 500;">'. $message . '</p>';
                            $item_name .= $message_fin;
                            return $item_name;

                        endif;
                    endif;
                endforeach;
            endif;
        endif;

    }
}
