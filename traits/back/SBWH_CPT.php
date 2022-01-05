<?php

/**
 * Registers custom post type 'warehouse'
 */

if (!trait_exists('SBWH_CPT')) :

    trait SBWH_CPT
    {

        /**
         * Register custom post type 'warehouse'
         *
         * @return void
         */
        public static function sbwh_register_cpt()
        {

            $labels = [
                "name"                     => __("Warehouses", "woocommerce"),
                "singular_name"            => __("Warehouse", "woocommerce"),
                "menu_name"                => __("Warehouses", "woocommerce"),
                "all_items"                => __("All Warehouses", "woocommerce"),
                "add_new"                  => __("Add new", "woocommerce"),
                "add_new_item"             => __("Add new Warehouse", "woocommerce"),
                "edit_item"                => __("Edit Warehouse", "woocommerce"),
                "new_item"                 => __("New Warehouse", "woocommerce"),
                "view_item"                => __("View Warehouse", "woocommerce"),
                "view_items"               => __("View Warehouses", "woocommerce"),
                "search_items"             => __("Search Warehouses", "woocommerce"),
                "not_found"                => __("No Warehouses found", "woocommerce"),
                "not_found_in_trash"       => __("No Warehouses found in trash", "woocommerce"),
                "parent"                   => __("Parent Warehouse: ", "woocommerce"),
                "featured_image"           => __("Featured image for this Warehouse", "woocommerce"),
                "set_featured_image"       => __("Set featured image for this Warehouse", "woocommerce"),
                "remove_featured_image"    => __("Remove featured image for this Warehouse", "woocommerce"),
                "use_featured_image"       => __("Use as featured image for this Warehouse", "woocommerce"),
                "archives"                 => __("Warehouse archives", "woocommerce"),
                "insert_into_item"         => __("Insert into Warehouse", "woocommerce"),
                "uploaded_to_this_item"    => __("Upload to this Warehouse", "woocommerce"),
                "filter_items_list"        => __("Filter Warehouses list", "woocommerce"),
                "items_list_navigation"    => __("Warehouses list navigation", "woocommerce"),
                "items_list"               => __("Warehouses list", "woocommerce"),
                "attributes"               => __("Warehouses attributes", "woocommerce"),
                "name_admin_bar"           => __("Warehouse", "woocommerce"),
                "item_published"           => __("Warehouse published", "woocommerce"),
                "item_published_privately" => __("Warehouse published privately.", "woocommerce"),
                "item_reverted_to_draft"   => __("Warehouse reverted to draft.", "woocommerce"),
                "item_scheduled"           => __("Warehouse scheduled", "woocommerce"),
                "item_updated"             => __("Warehouse updated.", "woocommerce"),
                "parent_item_colon"        => __("Parent Warehouse:", "woocommerce"),
            ];

            $args = [
                "label"                 => __("Warehouses", "woocommerce"),
                "labels"                => $labels,
                "description"           => "",
                "public"                => true,
                "publicly_queryable"    => true,
                "show_ui"               => true,
                "show_in_rest"          => true,
                "rest_base"             => "",
                "rest_controller_class" => "WP_REST_Posts_Controller",
                "has_archive"           => false,
                "show_in_menu"          => true,
                "show_in_nav_menus"     => true,
                "delete_with_user"      => false,
                "exclude_from_search"   => false,
                "capability_type"       => "post",
                "map_meta_cap"          => true,
                "hierarchical"          => false,
                "rewrite"               => ["slug" => "warehouse", "with_front" => false],
                "query_var"             => true,
                "menu_position"         => 5,
                "menu_icon"             => "dashicons-admin-multisite",
                "supports"              => ["title"],
                "show_in_graphql"       => false,
            ];

            register_post_type("warehouse", $args);
        }
    }

endif;
