<?php
/**
 * User: mauriciojovel
 * Date: 12/25/17
 * Time: 1:10 PM
 */

class CustomTaxonomies
{


    /**
     * CustomTaxonomies constructor.
     */
    public function __construct() {
        add_action( 'init', array($this, 'register_my_taxes_week') );
        add_action( 'init', array($this, 'register_my_cpts_photography') );
    }

    function register_my_taxes_week()
    {

        /**
         * Taxonomy: Weeks.
         */

        $labels = array(
            "name" => __("Weeks", 'photography-role'),
            "singular_name" => __("Week", 'photography-role'),
        );

        $args = array(
            "label" => __("Weeks", 'photography-role'),
            "labels" => $labels,
            "public" => true,
            "hierarchical" => true,
            "show_ui" => true,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "query_var" => true,
            "rewrite" => array('slug' => 'week', 'with_front' => true,),
            "show_admin_column" => false,
            "show_in_rest" => false,
            "rest_base" => "",
            "show_in_quick_edit" => true,
            "capabilities" => array(
                "manage_terms" => "manage_weeks",
                "edit_terms" => "manage_weeks",
                "delete_terms" => "manage_weeks",
                "assign_terms" => "edit_photographies"
            )
        );
        register_taxonomy("week", array('photography'), $args);
    }

    function register_my_cpts_photography() {

        /**
         * Post Type: Photographies.
         */

        $labels = array(
            "name" => __( "Photographies", 'photography-role' ),
            "singular_name" => __( 'photography', 'photography-role' ),
            "featured_image" => __( "Week Photography", 'photography-role' ),
            "set_featured_image" => __( "Set Week Photography", 'photography-role' ),
            "remove_featured_image" => __( "Remove Week Photography", 'photography-role' ),
            "use_featured_image" => __( "Use Week Photography", 'photography-role' ),
        );

        $args = array(
            "label" => __( "Photographies", 'photography-role' ),
            "labels" => $labels,
            "description" => "",
            "public" => true,
            "publicly_queryable" => true,
            "show_ui" => true,
            "show_in_rest" => false,
            "rest_base" => "",
            "has_archive" => false,
            "show_in_menu" => true,
            "exclude_from_search" => false,
            "capability_type" => array('photography', "photographies"),
            "map_meta_cap" => true,
            "hierarchical" => false,
            "rewrite" => array( "slug" => 'photography', "with_front" => true ),
            "query_var" => true,
            "supports" => array( "title", "editor", "thumbnail", "comments", "post-templates" ),
            "taxonomies" => array('week')
        );

        register_post_type( 'photography', $args );
    }

}