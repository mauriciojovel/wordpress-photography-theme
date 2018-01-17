<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Photography
 */

?>

<?php
	while ( have_posts() ) : the_post();

//Adding the Open Graph in the Language Attributes
function add_opengraph_doctype( $output ) {
    return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'add_opengraph_doctype');

//Lets add Open Graph Meta Info
function insert_fb_in_head() {
    global $post;
    echo '<meta property="og:url"           content="' . get_permalink() . '"/>';
    echo '<meta property="og:type"          content="article"/>';
    echo '<meta property="og:title"         content="' . get_the_title() . '"/>';
	echo '<meta property="og:description"   content="'. get_the_content(null, false) .'"/>';
	$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
    echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
    echo "
    ";
}
add_action( 'wp_head', 'insert_fb_in_head', 5 );
get_header(); 

	
		get_template_part( 'template-parts/content', 'photography' );

	
get_footer();

endwhile;
?>
