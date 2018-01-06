<?php
/**
 * Plugin Name: Custom Post
 * Description: Add custom post
 * User: mauriciojovel
 * Date: 12/25/17
 * Time: 1:15 PM
 */

function initPlugin() {
    require_once( trailingslashit( plugin_dir_path(  __FILE__ ) ) . 'include/CustomTaxonomies.php' );
    require_once( trailingslashit( plugin_dir_path(  __FILE__ ) ) . 'include/CustomRole.php' );
    register_activation_hook( __FILE__, array('CustomRole', 'add_roles_on_plugin_activation') );
    register_deactivation_hook(__FILE__, array('CustomRole', 'delete_role'));
    new CustomTaxonomies();
    new CustomRole();
}

initPlugin();