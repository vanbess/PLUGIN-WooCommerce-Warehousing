<?php

/**
 * Displays warehouse product data fields
 */

if (!trait_exists('SBWH_Product_Data')) :

    trait SBWH_Product_Data
    {

        /**
         * Renders product data input HTML
         *
         * @return void
         */
        private static function sbwh_render_product_data()
        {
            global $post;

            // retrieve product sku => title array
            $sku_title_arr = self::query_products();

            // sort array by key
            ksort($sku_title_arr);

            // retrieve $sku_title_arr array keys for autocomplete
            $skus = array_keys($sku_title_arr);

            // retrieve existing product data
            $prod_skus       = get_post_meta($post->ID, '_sbwh_prod_skus', true);
            $prod_titles     = get_post_meta($post->ID, '_sbwh_prod_titles', true);
            $prod_stock_qtys = get_post_meta($post->ID, '_sbwh_stock_qtys', true);

?>
            <!-- products out container -->
            <div id="sbwh-products-cont" data-autocomplete="<?php echo htmlspecialchars(json_encode($skus), ENT_QUOTES, 'UTF-8'); ?>" data-full="<?php echo htmlentities2(json_encode($sku_title_arr)); ?>">

                <p class="sbwh-instructions">
                    <i><b><?php _e('Add warehouse products manually below, OR fetch warehouse products at the bottom of this tab if you have API credentials for warehouse stock database', 'woocommerce'); ?></b></i>
                </p>

                <?php foreach ($prod_skus as $index => $sku) : ?>

                    <!-- individual product container -->
                    <div class="sbwh-product-input-cont">

                        <!-- sku input -->
                        <input name="sbwh-sku[]" class="sbwh-sku" type="text" placeholder="<?php _e('type to search', 'woocommerce') ?>" value="<?php echo $sku; ?>">

                        <!-- product title -->
                        <input readonly type="text" name="sbwh-prod-title[]" class="sbwh-prod-title" placeholder="<?php _e('product title', 'woocommerce'); ?>" value="<?php echo $prod_titles[$index]; ?>">

                        <!-- stock qty -->
                        <input type="number" name="sbwh-stock-qty[]" class="sbwh-stock-qty" step="1" min="0" placeholder="<?php _e('stock qty', 'woocommerce'); ?>" value="<?php echo $prod_stock_qtys[$index]; ?>">

                        <!-- add product input set -->
                        <button class="button button-primary button-small sbwh-add-prod" title="<?php _e('add product', 'woocommerce'); ?>">+</button>

                        <!-- remove product input set -->
                        <button class="button button-default button-small sbwh-rem-prod" title="<?php _e('remove product', 'woocommerce'); ?>">-</button>
                    </div>

                <?php endforeach; ?>

                <!-- individual product container -->
                <div class="sbwh-product-input-cont">

                    <!-- sku input -->
                    <input name="sbwh-sku[]" class="sbwh-sku" type="text" placeholder="<?php _e('type to search', 'woocommerce') ?>">

                    <!-- product title -->
                    <input readonly type="text" name="sbwh-prod-title[]" class="sbwh-prod-title" placeholder="<?php _e('product title', 'woocommerce'); ?>">

                    <!-- stock qty -->
                    <input type="number" name="sbwh-stock-qty[]" class="sbwh-stock-qty" step="1" min="0"  placeholder="<?php _e('stock qty', 'woocommerce'); ?>">

                    <!-- add product input set -->
                    <button class="button button-primary button-small sbwh-add-prod" title="<?php _e('add product', 'woocommerce'); ?>">+</button>

                    <!-- remove product input set -->
                    <button class="button button-default button-small sbwh-rem-prod" title="<?php _e('remove product', 'woocommerce'); ?>">-</button>
                </div>
            </div>

            <hr>

            <!-- warehouse api data - for future api use in chronjob to update stock qtys at a given time interval -->
            <div id="sbwh-api-data">
                <p class="sbwh-instructions">
                    <i><b><?php _e('Enter warehouse API data below to enable periodic stock count updates and/or retrieve current warehouse stock levels', 'woocommerce'); ?></b></i>
                </p>

                <p>
                    API dets will go here
                </p>

                <button id="sbwh-fetch-products" class="button button-primary button-large" title="<?php _e('fetch warehouse products now', 'woocommerce'); ?>">
                    <?php _e('Fetch Warehouse Products', 'woocommerce'); ?>
                </button>

            </div>

<?php }

        /**
         * Queries all published products and returns sku => product title array for use in select2 dropdown
         *
         * @return array $sku_title_arr - array containing sku => product title key value pairs
         */
        private static function query_products()
        {

            // query all products
            $prod_ids = wc_get_products([
                'status' => 'publish',
                'limit'  => -1,
                'return' => 'ids'
            ]);

            // array which will hold product sku => title pairs
            $sku_title_arr = [];

            // loop through returned product ids
            foreach ($prod_ids as $pid) :

                // retrieve product object, type, sku and title
                $prod_obj   = wc_get_product($pid);
                $prod_type  = $prod_obj->get_type();
                $prod_sku   = get_post_meta($pid, '_sku', true);
                $prod_title = get_the_title($pid);

                // if variable product, retrieve children
                if ($prod_type === 'variable') :

                    $children = $prod_obj->get_children();

                    // loop through children and push required data to $sku_title_arr
                    foreach ($children as $cid) :

                        // retrieve child object sku and title
                        $child_sku   = get_post_meta($cid, '_sku', true);
                        $child_title = get_the_title($cid);

                        if ($child_sku) :
                            $sku_title_arr[$child_sku] = $child_title;
                        endif;
                    endforeach;

                // if simple product, push required dat to $sku_title_arr
                elseif ($prod_type === 'simple') :
                    if ($prod_sku) :
                        $sku_title_arr[$prod_sku] = $prod_title;
                    endif;
                endif;

            endforeach;

            // return $sku_title_arr
            return $sku_title_arr;
        }
    }

endif;
