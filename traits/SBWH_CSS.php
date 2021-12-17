<?php

/**
 * Handles all CSS for 'warehouse' metabox
 */

if (!trait_exists('SBWH_CSS')) :

    trait SBWH_CSS
    {

        /**
         * Renders stylesheet for 'warehouse' custom metabox
         *
         * @return void
         */
        public static function sbwh_css()
        { ?>

            <style>
                div#sbwh-tabs {
                    margin-bottom: 15px;
                    margin-top: 15px;
                }

                p.sbwh-instructions {
                    font-size: 14px;
                }

                div#sbwh-location-data {
                    padding-bottom: 15px;
                }

                .sbwh-prod-title {
                    min-width: 600px;
                }

                .sbwh-stock-qty {
                    width: 100px;
                }

                .sbwh-sku {
                    width: 150px;
                }

                button.button.button-primary.button-small.sbwh-add-prod {
                    width: 30px;
                    height: 30px;
                    font-size: 20px;
                    line-height: 0;
                }

                button.button.button-default.button-small.sbwh-rem-prod {
                    width: 30px;
                    height: 30px;
                    background: red;
                    border-color: red;
                    color: white;
                    font-size: 26px;
                    line-height: 0;
                }

                div#sbwh-location-data input,
                div#sbwh-location-data select {
                    min-width: 600px;
                }

                .sbwh-product-input-cont {
                    margin-bottom: 20px;
                }
            </style>

<?php }
    }

endif;
?>