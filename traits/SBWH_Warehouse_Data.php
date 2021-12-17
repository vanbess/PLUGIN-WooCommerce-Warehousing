<?php

/**
 * Displays warehouse data fields
 */

if (!trait_exists('SBWH_Warehouse_Data')) :

    trait SBWH_Warehouse_Data
    {

        /**
         * Renders warehouse data input HTML
         *
         * @return void
         */
        public static function sbwh_render_warehouse_data()
        {

            global $post, $post_data;

            // retrieve countries list - used for generating country/region dropdown options
            $wc_countries = new WC_Countries;
            $countries    = $wc_countries->get_countries();

            // retrieve existing warehouse data
            $email     = get_post_meta($post->ID, '_sbwh_email', true);
            $tel       = get_post_meta($post->ID, '_sbwh_tel', true);
            $contact   = get_post_meta($post->ID, '_sbwh_contact', true);
            $region    = get_post_meta($post->ID, '_sbwh_region', true);
            $address_1 = get_post_meta($post->ID, '_sbwh_address_1', true);
            $address_2 = get_post_meta($post->ID, '_sbwh_address_2', true);
            $city      = get_post_meta($post->ID, '_sbwh_city', true);
            $postal    = get_post_meta($post->ID, '_sbwh_postal', true);
?>

            <!-- warehouse location data -->
            <div id="sbwh-location-data">
                <p class="sbwh-instructions">
                    <i><b><?php _e('Enter warehouse location and contact data below', 'woocommerce'); ?></b></i>
                </p>

                <!-- email -->
                <p>
                    <input type="email" name="sbwh-email" id="sbwh-email" placeholder="<?php _e('email address (optional)', 'woocommerce'); ?>" value="<?php echo $email; ?>">
                </p>

                <!-- telephone -->
                <p>
                    <input type="tel" name="sbwh-tel" id="sbwh-tel" placeholder="<?php _e('phone number (optional)', 'woocommerce'); ?>" value="<?php echo $tel; ?>">
                </p>

                <!-- contact person -->
                <p>
                    <input type="text" name="sbwh-contact" id="sbwh-contact" placeholder="<?php _e('contact person (optional)', 'woocommerce'); ?>" value="<?php echo $contact; ?>">
                </p>

                <!-- region select -->
                <p>
                    <select name="sbwh-region" id="sbwh-region" required>
                        <option value=""><?php _e('select country or region*', 'woocommerce'); ?></option>
                        <?php foreach ($countries as $code => $name) : ?>
                            <?php if ($code === $region) : ?>
                                <option value="<?php echo $code; ?>" selected><?php echo $name; ?></option>
                            <?php else : ?>
                                <option value="<?php echo $code; ?>"><?php echo $name; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </p>

                <!-- address line 1 -->
                <p>
                    <input type="text" name="sbwh-address-1" id="sbwh-address-1" placeholder="<?php _e('address line 1*', 'woocommerce'); ?>" required value="<?php echo $address_1; ?>">
                </p>

                <!-- address line 2 -->
                <p>
                    <input type="text" name="sbwh-address-2" id="sbwh-address-2" placeholder="<?php _e('address line 2*', 'woocommerce'); ?>" required value="<?php echo $address_2; ?>">
                </p>

                <!-- town/city -->
                <p>
                    <input type="text" name="sbwh-city" id="sbwh-city" placeholder="<?php _e('city/town*', 'woocommerce'); ?>" required value="<?php echo $city; ?>">
                </p>

                <!-- postal code -->
                <p>
                    <input type="text" name="sbwh-postal" id="sbwh-postal" placeholder="<?php _e('postal code*', 'woocommerce'); ?>" required value="<?php echo $postal; ?>">
                </p>

            </div>


<?php }
    }

endif;
