<?php
/**
 * Maeve functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Photography
 */

add_action( 'after_setup_theme', 'photography_setup' );
if ( ! function_exists( 'photography_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function photography_setup() {

	// Add default posts and comments RSS feed links to head.
	// add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'photography' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
}
endif;

add_action( 'init', 'register_my_menus' );
function register_my_menus() {
    register_nav_menus(
        array(
        'right-menu' => __( 'Rigth Menu', 'photograpy' )
        )
    );
}
  

/**
 * Enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', 'photography_scripts' );
function photography_scripts() {
    $themeCssPathUrl = get_template_directory_uri() . '/assets/css/main.css';
    $themeCssPath = get_template_directory() . '/assets/css/main.css';
    $jqueryPathUrl = get_template_directory_uri() . '/assets/js/jquery/jquery-3.2.1.min.js';
    $jqueryPath = get_template_directory() . '/assets/js/jquery/jquery-3.2.1.min.js';
    $bootstrapBundlePathUrl = get_template_directory_uri() . '/assets/js/bootstrap/bootstrap.bundle.min.js';
    $bootstrapBundlePath = get_template_directory() . '/assets/js/bootstrap/bootstrap.bundle.min.js';
    $themejsUrl = get_template_directory_uri() . '/assets/js/main.js';
    $themejsPath = get_template_directory() . '/assets/js/main.js';
	// We will add our jquery version
	wp_deregister_script('jquery');
	
	wp_enqueue_style( 'photography-style', get_stylesheet_uri() );
	wp_enqueue_style( 'theme', $themeCssPathUrl, array('photography-style'), filemtime($themeCssPath) );
	
	wp_enqueue_script('jquery', $jqueryPathUrl, array(), filemtime($jqueryPath), true);
    wp_enqueue_script('js-bootstrap', $bootstrapBundlePathUrl, array('jquery'), filemtime($bootstrapBundlePath), true);
    wp_enqueue_script('photography-theme-js', $themejsUrl, array('jquery', 'js-bootstrap'), filemtime($themejsPath), true);
}

// Register Custom Navigation Walker
require_once get_template_directory() . '/include/bs4navwalker.php';
require_once get_template_directory() . '/include/bs4navwalkerRight.php';

// Create your own activation plugin on: http://tgmpluginactivation.com/download/
require_once get_template_directory() . '/activation/plugins.php';

/**
 * ACF
 */

// Add custom option page
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}

// Remove admin bar
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}
