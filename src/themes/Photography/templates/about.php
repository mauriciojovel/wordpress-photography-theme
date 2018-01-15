<?php /* Template Name: About us */ ?>
<?php 
    $args = array(
        'role' => 'photographer',
        'fields' => array('ID', 'display_name', 'user_login'),
        'orderby' => 'display_name',
        'order' => 'ASC'
    );

    $photographers = get_users( $args );
?>
<?php get_header(); ?>
<?php if( count( $photographers ) > 0 ): ?>
<div class = "py-2" >
    <h1 class = "text-center" > <?php _e('Our Photographers', 'photography') ?></h1>

    <div class="d-flex flex-wrap justify-content-around">
        <?php foreach( $photographers as $photographer ): ?>
            <?php set_query_var( 'user', $photographer ); ?>
            <?php set_query_var( 'background', '' ); ?>
            <?php get_template_part( 'template-parts/content', 'profile-card' ); ?>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>


<?php 
    $args2 = array(
        'role' => 'judge',
        'fields' => array('ID', 'display_name', 'user_login'),
        'orderby' => 'display_name',
        'order' => 'ASC'
    );

    $judges = get_users( $args2 );
?>
<?php if( count( $judges ) > 0 ): ?>
<div class = "py-2 bg-primary text-white">
    <h2 class = "text-center" > <?php _e('Our Jury', 'photography') ?></h2>
    <div class="d-flex flex-wrap justify-content-around">
        <?php foreach( $judges as $judge ): ?>
            <?php set_query_var( 'user', $judge ); ?>
            <?php set_query_var( 'background', 'bg-primary' ); ?>
            <?php get_template_part( 'template-parts/content', 'profile-card' ); ?>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>

<?php get_footer(); ?>
