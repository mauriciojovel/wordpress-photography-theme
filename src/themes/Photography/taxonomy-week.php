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
                    Weeks
                </h2>
                <ul class="list-group">
                    <li class="list-group-item text-center text-lg-left">
                        <a href="#">Week 1</a>
                    </li>
                    <li class="list-group-item text-center text-lg-left">
                        <a href="#">Week 2</a>
                    </li>
                </ul>
            </div>
        </div>
        
    </section>
	
	
<?php
get_footer();
