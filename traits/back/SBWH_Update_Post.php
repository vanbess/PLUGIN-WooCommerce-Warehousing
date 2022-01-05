<?php

if (!trait_exists('SBWH_Update_Post')) :

    trait SBWH_Update_Post
    {

        public static function sbwh_update_post($post_id, $post)
        {

            // double check we've got the correct post type, else bail
            if (get_post_type($post) !== 'warehouse') :
                return;
            endif;

            // ***********************************
            // retrieve and update warehouse data
            // ***********************************
            isset($_POST['sbwh-email']) ? update_post_meta($post_id, '_sbwh_email', $_POST['sbwh-email']) : update_post_meta($post_id, '_sbwh_email', '');
            isset($_POST['sbwh-tel']) ? update_post_meta($post_id, '_sbwh_tel', $_POST['sbwh-tel']) : update_post_meta($post_id, '_sbwh_tel', '');
            isset($_POST['sbwh-contact']) ? update_post_meta($post_id, '_sbwh_contact', $_POST['sbwh-contact']) : update_post_meta($post_id, '_sbwh_contact', '');
            isset($_POST['sbwh-region']) ? update_post_meta($post_id, '_sbwh_region', $_POST['sbwh-region']) : update_post_meta($post_id, '_sbwh_region', '');
            isset($_POST['sbwh-address-1']) ? update_post_meta($post_id, '_sbwh_address_1', $_POST['sbwh-address-1']) : update_post_meta($post_id, '_sbwh_address_1', '');
            isset($_POST['sbwh-address-2']) ? update_post_meta($post_id, '_sbwh_address_2', $_POST['sbwh-address-2']) : update_post_meta($post_id, '_sbwh_address_2', '');
            isset($_POST['sbwh-city']) ? update_post_meta($post_id, '_sbwh_city', $_POST['sbwh-city']) : update_post_meta($post_id, '_sbwh_city', '');
            isset($_POST['sbwh-postal']) ? update_post_meta($post_id, '_sbwh_postal', $_POST['sbwh-postal']) : update_post_meta($post_id, '_sbwh_postal', '');

            // ***************************************************************
            // retrieve and update warehouse API data [future implementation]
            // ***************************************************************

            // *********************************
            // retrieve and update product data
            // *********************************
            $skus = isset($_POST['sbwh-sku']) ? $_POST['sbwh-sku'] : [];

            // if skus empty, bail early
            if (empty($skus)) :
                return;
            endif;

            // retrieve product titles and stock qtys
            $titles     = $_POST['sbwh-prod-title'];
            $stock_qtys = $_POST['sbwh-stock-qty'];

            // update associated post meta keys
            update_post_meta($post_id, '_sbwh_prod_skus', $skus);
            update_post_meta($post_id, '_sbwh_prod_titles', $titles);
            update_post_meta($post_id, '_sbwh_stock_qtys', $stock_qtys);

            // **********************************
            // retrieve and update shipping data
            // **********************************
            $countries = isset($_POST['sbwh-shipping-country']) ? $_POST['sbwh-shipping-country'] : [];

            // if shipping countries empty, bail early
            if (empty($countries)) :
                return;
            endif;

            // retrieve messages and display settings
            $messages = $_POST['sbwh-shipping-text'];
            $display  = $_POST['sbwh-frontend-display'];

            // update shipping meta
            update_post_meta($post_id, '_sbwh_ship_countries', $countries);
            update_post_meta($post_id, '_sbwh_ship_messages', $messages);
            update_post_meta($post_id, '_sbwh_ship_display', $display);
        }
    }

endif;
