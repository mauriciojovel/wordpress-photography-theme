<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Photography
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
          <?php echo get_bloginfo('name') ?>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#rightNavBar" aria-controls="rightNavBar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php
            wp_nav_menu( array(
              'menu'            => 'right-menu',
              'theme_location'  => 'right-menu',
              'container'       => 'div',
              'container_id'    => 'rightNavBar',
              'container_class' => 'collapse navbar-collapse',
              'menu_id'         => false,
              'menu_class'      => 'navbar-nav mr-auto',
              'depth'           => 2,
              'fallback_cb'     => 'bs4navwalker::fallback',
              'walker'          => new bs4navwalker()
            ) );
        ?>
    </nav>
