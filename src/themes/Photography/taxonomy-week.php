<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Photography
 */
$weeks = get_categories( array(
	'taxonomy' => 'week',
	'hide_empty' => 0,
	'orderby' => 'term_id',
	'order' => 'DESC'
 ) );

//Adding the Open Graph in the Language Attributes
function add_opengraph_doctype( $output ) {
    return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'add_opengraph_doctype');

//Lets add Open Graph Meta Info
function insert_fb_in_head() {
    global $post;
    echo '<meta property="og:url"           content="' . get_term_link( get_queried_object()->term_id, 'week' ) . '"/>';
    echo '<meta property="og:type"          content="article"/>';
    echo '<meta property="og:title"         content="' . single_cat_title( '', false ) . '"/>';
    echo '<meta property="og:description"   content="'.str_replace('<br />', PHP_EOL, substr(category_description(), 3, strlen( category_description() ) - 8 )).'"/>';
    // if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
    //     $default_image="http://example.com/image.jpg"; //replace this with a default image on your server or an image in your media library
    //     echo '<meta property="og:image" content="' . $default_image . '"/>';
    // } else{
    //     $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
    //     echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
    // }
    echo "
    ";
}
add_action( 'wp_head', 'insert_fb_in_head', 5 );

get_header(); ?>
	
	<?php $description = explode( '<br />', substr(category_description(), 3, strlen( category_description() ) - 8 ) ); ?>
	<section class="container py-5">
        <div class="row">
            <div class="col-sm-12 col-lg-10">
                <h1 class="text-center text-lg-left"><?php echo single_cat_title( '', false ); ?></h1>
                <h2 class="text-center text-lg-left"><?php echo $description[0] ?></h2>
                <p class="text-center text-lg-left">
					<?php echo $description[1] ?>
                </p>
                <div class="card-columns">
					<?php
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/content', 'photography-card' );
						endwhile; 
					?>
				</div>
            </div>
            <div class="col-sm-12 col-lg-2">
                <h2 class="text-center text-lg-left">
                    <?php echo __('Weeks', 'photography'); ?>
                </h2>
                <div class="list-group">
					<?php foreach( $weeks as $week ): ?>
                        <a class="list-group-item text-center text-lg-left <?php echo ( $week->name == single_cat_title( '', false ) ? 'active' : '' ); ?>" href="<?php echo esc_url( get_term_link( $week->term_id, 'week' ) ) ?>"><?php echo $week->name ?> </a>
					<?php endforeach ; ?>
                </div>
            </div>
        </div>
        
    </section>
	
	
<?php
get_footer();
