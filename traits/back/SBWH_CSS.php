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

                button.button.button-primary.button-small.sbwh-add-prod,
                button.button.button-primary.button-small.sbwh-add-ship {
                    width: 30px;
                    height: 30px;
                    font-size: 20px;
                    line-height: 0;
                }

                button.button.button-default.button-small.sbwh-rem-prod,
                button.button.button-default.button-small.sbwh-rem-ship {
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

                .sbwh-product-input-cont,
                .sbwh-shipping-country-inputs {
                    margin-bottom: 20px;
                }

                input.sbwh-shipping-text {
                    min-width: 50%;
                    margin-right: 15px;
                }

                .sbwh-shipping-country-inputs>label {
                    font-size: 14px;
                    position: relative;
                    top: 2px;
                }

                input.sbwh-frontend-display {
                    width: 30px;
                    height: 30px;
                    text-indent: 7px;
                    line-height: 3.2;
                    margin-left: 5px;
                }

                p.sbwh-instructions.sbwh-warning {
                    text-align: center;
                    background: #ff00001f;
                    padding: 5px;
                }

                p#sbwh-shipping-msg {
                    color: #50575e;
                    font-weight: bold;
                    text-align: center;
                    margin-bottom: 15px;
                    text-shadow: 0px 1px 2px #00000042;
                    letter-spacing: 0.5px;
                }
            </style>

<?php }
    }

endif;
?>