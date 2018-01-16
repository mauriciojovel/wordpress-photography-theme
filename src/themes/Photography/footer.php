<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Photography
 */

?>

<footer class = "footer">
    <div class = "container py-3" >
        <div class = "row" >
            <div class = "col-sm-12 col-lg-6">
            <h3><?php _e('Info', 'photography'); ?></h3>
            <?php
                wp_nav_menu( array(
                'menu'            => 'about-menu',
                'theme_location'  => 'about-menu',
                'container'       => 'div',
                'container_id'    => 'aboutMenu',
                'container_class' => '',
                'menu_id'         => false,
                'menu_class'      => 'list-unstyled',
                'depth'           => 2
                ) );
            ?>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
