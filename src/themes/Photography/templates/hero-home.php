<?php /* Template Name: Hero Home */ ?>
<?php wp_enqueue_style( 
    'home' , 
    get_template_directory_uri() . '/assets/css/home.css' , 
    array('theme'), 
    filemtime(get_template_directory() . '/assets/css/home.css') 
    ); 
?>

<?php get_header(); ?>

<?php 
    $weeks = get_categories( array(
        'taxonomy' => 'week',
        'hide_empty' => 0,
        'orderby' => 'term_id',
        'order' => 'DESC'
     ) );
    
    $lastWeek = null;
    $preLastWeek = null;
    $term = null;

    $totalWeeks = count($weeks); 
    if( $totalWeeks > 0) {
        $lastWeek = $weeks[0];
        $term = $lastWeek->slug;
        if( $totalWeeks > 1 ) {
            $preLastWeek = $weeks[1];
            $term = $preLastWeek->slug;
        }
    }

    if($term != null) {
        $args = array(
            'post_type' => 'photography',
            'post_status' => 'publish',
            'orderby' => 'publish_date',
            'order' => 'DESC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'week',
                    'field'    => 'slug',
                    'terms'    => $term,
                ),
            )/*,
            'meta_key'		=> 'is_feature',
            'meta_value'	=> true*/
        );
        
        $query = new WP_Query( $args );

        if( !$query->have_posts() ) {
            $args = array(
                'post_type' => 'photography',
                'post_status' => 'publish',
                'orderby' => 'publish_date',
                'order' => 'DESC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'week',
                        'field'    => 'slug',
                        'terms'    => $lastWeek->slug,
                    ),
                ),
            );
            $query = new WP_Query( $args );
        }

        $i = 0;
        $count = $query->post_count;
    }
?>

<?php if ( isset ( $query ) && $query->have_posts() ) : ?>
<?php   while ( $query->have_posts() ) : $query->the_post(); ?>
            <?php set_query_var( 'active', ( $i == 0 ? 'active' : '' ) ); ?>
            <?php if ( $i == 0 ) : ?>
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="50000">
                    <ol class="carousel-indicators">
                        <?php for($j = 0 ; $j < $count ; $j++ ) : ?>
                            <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $j ?>" class="<?php echo ( $j == 0 ? 'active': '' ) ?>"></li>
                        <?php endfor; ?>
                    </ol>
                    <div class="carousel-inner">
            <?php endif; ?>
<?php       get_template_part( 'template-parts/content', 'page-hero' ); ?>
            <?php if ( $i == $count - 1 ) : ?> 
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            <?php endif; ?>
            <?php $i++ ?>
<?php   endwhile; ?>

<?php   wp_reset_postdata(); ?>

<?php $query = new WP_Query( $args ); $j = 0; ?>
<?php if ( isset ( $query ) && $query->have_posts() ) : ?>
<section class="bg-white">
    <div class="container">
<?php   while ( $query->have_posts() ) : $query->the_post(); ?>
    <div class="row justify-content-around" id="comments-<?php echo $j; ?>" style="<?php echo ($j == 0 ? '' : 'display:none;') ?>">
        <?php get_template_part( 'template-parts/content', 'grade' ); ?>
    </div>
    <?php $j++; ?>
<?php   endwhile; ?>
    </div>
</section>
<?php   wp_reset_postdata(); ?>
<?php endif; ?>
<?php endif; ?>
<?php get_footer(); ?>
