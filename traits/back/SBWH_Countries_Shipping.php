<?php

/**
 * Handles selection of countries warehouse ships to, along with shipping times
 */
if (!trait_exists('SBWH_Countries_Shipping')) :

    trait SBWH_Countries_Shipping
    {

        /**
         * Renders warehouse country selection and shipping message
         *
         * @return void
         */
        public static function sbwh_render_countries_shipping()
        {

            global $post;

            // retrieve countries SHIPPING list - used for generating country/region dropdown options
            $wc_countries   = new WC_Countries;
            $ship_countries = $wc_countries->get_shipping_countries();

            // retrieve existing shipping meta
            $countries = get_post_meta($post->ID, '_sbwh_ship_countries', true);
            $messages  = get_post_meta($post->ID, '_sbwh_ship_messages', true);
            $display   = get_post_meta($post->ID, '_sbwh_ship_display', true);

?>

            <div id="sbwh-shipping-countries" data-countries="<?php echo htmlspecialchars(json_encode($ship_countries)); ?>">

                <p class="sbwh-instructions">
                    <i><b><?php _e('Add countries to which this warehouse ships below, with shipping time message for each and whether to display message on frontend or not if country is detected', 'woocommerce'); ?></b></i>
                </p>

                <?php if ($countries && !empty($countries)) : ?>
                    <?php foreach ($countries as $index => $sel_code) :

                        // display options array for building display options dropdown
                        $display_opts = ['yes', 'no'];

                    ?>
                        <!-- inputs container -->
                        <div class="sbwh-shipping-country-inputs">

                            <!-- select country -->
                            <select name="sbwh-shipping-country[]" class="sbwh-shipping-country" required>
                                <option value=""><?php _e('select country...', 'woocommerce'); ?></option>
                                <?php foreach ($ship_countries as $code => $name) : ?>
                                    <?php if ($countries[$index] === $code) : ?>
                                        <option value="<?php echo $code; ?>" selected><?php echo $name; ?></option>
                                    <?php else : ?>
                                        <option value="<?php echo $code; ?>"><?php echo $name; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                            <!-- shipping message for display on frontend -->
                            <input type="text" name="sbwh-shipping-text[]" class="sbwh-shipping-text" placeholder="<?php _e('enter shipping lead time text', 'woocommerce'); ?>" required value="<?php echo $messages[$index]; ?>">

                            <!-- whether or not to display -->
                            <label for="sbwh-frontend-display"><b><?php _e('Display on front?', 'woocommerce'); ?></b></label>
                            <select name="sbwh-frontend-display[]" class="sbwh-frontend-display">
                                <?php foreach ($display_opts as $opt) : ?>
                                    <?php if ($display[$index] === $opt) : ?>
                                        <option value="<?php echo $opt; ?>" selected><?php _e(ucfirst($opt), 'woocommerce'); ?></option>
                                    <?php else : ?>
                                        <option value="<?php echo $opt; ?>"><?php _e(ucfirst($opt), 'woocommerce'); ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                            <!-- add shipping input set -->
                            <button class="button button-primary button-small sbwh-add-ship" title="<?php _e('add country', 'woocommerce'); ?>">+</button>

                            <!-- remove shipping input set -->
                            <button class="button button-default button-small sbwh-rem-ship" title="<?php _e('remove country', 'woocommerce'); ?>">-</button>

                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <?php if (!$countries && empty($countries)) : ?>

                    <!-- inputs container -->
                    <div class="sbwh-shipping-country-inputs">

                        <!-- select country -->
                        <select name="sbwh-shipping-country[]" class="sbwh-shipping-country" required>
                            <option value=""><?php _e('select country...', 'woocommerce'); ?></option>
                            <?php foreach ($ship_countries as $code => $name) : ?>
                                <option value="<?php echo $code; ?>"><?php echo $name; ?></option>
                            <?php endforeach; ?>
                        </select>

                        <!-- shipping message for display on frontend -->
                        <input type="text" name="sbwh-shipping-text[]" class="sbwh-shipping-text" placeholder="<?php _e('enter shipping lead time text', 'woocommerce'); ?>" required>

                        <!-- whether or not to display -->
                        <label for="sbwh-frontend-display"><b><?php _e('Display on front?', 'woocommerce'); ?></b></label>
                        <select name="sbwh-frontend-display[]" class="sbwh-frontend-display">
                            <option value="yes"><?php _e('Yes', 'woocommerce'); ?></option>
                            <option value="no"><?php _e('No', 'woocommerce'); ?></option>
                        </select>

                        <!-- add shipping input set -->
                        <button class="button button-primary button-small sbwh-add-ship" title="<?php _e('add country', 'woocommerce'); ?>">+</button>

                        <!-- remove shipping input set -->
                        <button class="button button-default button-small sbwh-rem-ship" title="<?php _e('remove country', 'woocommerce'); ?>">-</button>

                    </div>
                <?php endif; ?>

            </div>

<?php }
    }

endif;

?>