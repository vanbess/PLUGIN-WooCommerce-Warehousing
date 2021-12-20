<?php

/**
 * Handles all JS/jQuery for 'warehouse' metabox
 */

if (!trait_exists('SBWH_JS')) :

    trait SBWH_JS
    {

        /**
         * Renders JS/jQuery fpr 'warehouse' custom post type metabox
         *
         * @return void
         */

        public static function sbwh_js()
        { ?>

            <script>
                jQuery(function($) {

                    // init jQuery tabs
                    $("#sbwh-tabs").tabs();

                    // *********
                    // PRODUCTS
                    // *********

                    let autocomp_data = $('#sbwh-products-cont').data('autocomplete');
                    let data_full = $('#sbwh-products-cont').data('full');

                    // setup autcomplete
                    $('.sbwh-sku').autocomplete({
                        source: autocomp_data,
                        select: function(event, ui) {

                            // set associated input value
                            let target = $(this);
                            let selected = ui.item.value;
                            target.attr('value', selected);

                            // retrieve associated product title and set title input value
                            let title = data_full[selected];
                            let decoded_title = $(this).parent().find('.sbwh-prod-title').html(title).text();
                            $(this).parent().find('.sbwh-prod-title').val(decoded_title);

                            // set stock qty input to required
                            $(this).parent().find('.sbwh-stock-qty').attr('required', true);

                        }
                    });

                    // html for inserting additional product stock fields
                    let prod_inputs = '<div class="sbwh-product-input-cont"> ';
                    prod_inputs += '<input name="sbwh-sku[]" class="sbwh-sku" type="text" placeholder="<?php _e('type to search', 'woocommerce') ?>"> ';
                    prod_inputs += '<input readonly type="text" name="sbwh-prod-title[]" class="sbwh-prod-title" step="1" min="0" placeholder="<?php _e('product title', 'woocommerce'); ?>"> '
                    prod_inputs += '<input type="number" name="sbwh-stock-qty[]" class="sbwh-stock-qty" placeholder="<?php _e('stock qty', 'woocommerce'); ?>"> ';
                    prod_inputs += '<button class="button button-primary button-small sbwh-add-prod" title="<?php _e('add product', 'woocommerce'); ?>">+</button> ';
                    prod_inputs += '<button class="button button-default button-small sbwh-rem-prod" title="<?php _e('remove product', 'woocommerce'); ?>">-</button>';
                    prod_inputs += '</div>';

                    // add product stock set
                    $(document).on('click', '.sbwh-add-prod', function(e) {
                        e.preventDefault();
                        $('#sbwh-products-cont').append(prod_inputs);
                        $('.sbwh-sku').autocomplete({
                            source: autocomp_data,
                            select: function(event, ui) {

                                // set associated input value
                                let target = $(this);
                                let selected = ui.item.value;
                                target.attr('value', selected);

                                // retrieve associated product title and set title input value
                                let title = data_full[selected];
                                let decoded_title = $(this).parent().find('.sbwh-prod-title').html(title).text();
                                $(this).parent().find('.sbwh-prod-title').val(decoded_title);

                                // set stock qty input to required
                                $(this).parent().find('.sbwh-stock-qty').attr('required', true);

                            }
                        });
                    });

                    // remove product stock set
                    $(document).on('click', '.sbwh-rem-prod', function(e) {
                        e.preventDefault();
                        $(this).parent().remove();
                    });
                    
                    // *********
                    // SHIPPING
                    // *********

                    // html for inserting additional shipping inputs
                    let ship_input = '<div class="sbwh-shipping-country-inputs">';
                    ship_input += '<div class="sbwh-shipping-country-inputs">';
                    ship_input += '<select name="sbwh-shipping-country[]" class="sbwh-shipping-country" required="">';
                    ship_input += '<option value=""><?php _e('select country...', 'woocommerce') ?></option>';

                    let countries = $('#sbwh-shipping-countries').data('countries');

                    $.each(countries, function(code, country) {
                        ship_input += '<option value="' + code + '">' + country + '</option>';
                    });

                    ship_input += '</select> ';
                    ship_input += '<input type="text" name="sbwh-shipping-text[]" class="sbwh-shipping-text" placeholder="<?php _e('enter shipping lead time text', 'woocommerce'); ?>" required=""> ';
                    ship_input += '<label for="sbwh-frontend-display"><b><?php _e('Display on front?', 'woocommerce'); ?></b></label> ';
                    ship_input += '<select name="sbwh-frontend-display[]" class="sbwh-frontend-display">';
                    ship_input += '<option value="yes"><?php _e('Yes', 'woocommerce'); ?></option>';
                    ship_input += '<option value="no"><?php _e('No', 'woocommerce'); ?></option>';
                    ship_input += '</select> ';
                    ship_input += '<button class="button button-primary button-small sbwh-add-ship" title="<?php _e('add country', 'woocommerce') ?>">+</button> ';
                    ship_input += '<button class="button button-default button-small sbwh-rem-ship" title="<?php _e('remove country', 'woocommerce') ?>">-</button>';
                    ship_input += '</div>';

                    // add shipping input set
                    $(document).on('click', '.sbwh-add-ship', function(e) {
                        e.preventDefault();

                        $('#sbwh-shipping-countries').append(ship_input);
                        $('#sbwh-shipping-countries').find('select:last-child').val('');

                    });

                    // remove shipping input set
                    $(document).on('click', '.sbwh-rem-ship', function(e) {
                        e.preventDefault();
                        $(this).parent().remove();
                    });

                });
            </script>

<?php }
    }

endif;
?>