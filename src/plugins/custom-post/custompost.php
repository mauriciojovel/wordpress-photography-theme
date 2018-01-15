<?php
/**
 * Plugin Name: Photography Role
 * Description: Add Photography Role to wordpress
 * Author: Mauricio Jovel
 * Text Domain: photography-role
 * Domain Path: /languages
 * User: mauriciojovel
 * Date: 12/25/17
 * Time: 1:15 PM
 */


/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function photography_role_load_textdomain() {
  load_plugin_textdomain( 'photography-role', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
}
add_action( 'plugins_loaded', 'photography_role_load_textdomain' );

function initPlugin() {
    require_once( trailingslashit( plugin_dir_path(  __FILE__ ) ) . 'include/CustomTaxonomies.php' );
    require_once( trailingslashit( plugin_dir_path(  __FILE__ ) ) . 'include/CustomRole.php' );
    register_activation_hook( __FILE__, array('CustomRole', 'add_roles_on_plugin_activation') );
    register_deactivation_hook(__FILE__, array('CustomRole', 'delete_role'));
    new CustomTaxonomies();
    new CustomRole();
}

initPlugin();