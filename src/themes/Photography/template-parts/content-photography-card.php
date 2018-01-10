
<div class="card">
    <img class="card-img-top" src="<?php echo get_the_post_thumbnail_url(null, 'medium'); ?>" alt="">
    <div class="card-body text-center text-lg-left">
        <?php remove_filter ('the_content', 'wpautop'); ?>
        <p class="card-text"><?php the_content(); ?></p>
        <a href="<?php echo esc_url( get_permalink() ); ?>" class="btn btn-primary"> <?php echo __('View Photo', 'photography') ?> </a>
    </div>
</div>