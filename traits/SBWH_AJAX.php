<?php

/**
 * Handles AJAX for plugin
 */

if (!trait_exists('SBWH_AJAX')) :

    trait SBWH_AJAX
    {

        /**
         * Function which handles all AJAX calls made from 'warehouse' custom post type metabox
         *
         * @return void
         */
        public static function sbwh_ajax()
        {
            check_ajax_referer('sbwh perform ajax');

            wp_die();
        }
    }

endif;
