<?php 
    $params = array(
        'post_id' => get_the_id(),
        'status' => 'approve'
    );
    $comments = get_comments($params);

    foreach($comments as $comment):
?>
    <div class="col-sm-12 col-lg-3 p-2 text-center">
        
        <?php
            $user = get_user_by('email', $comment->comment_author_email);
            $imgUrl = wsl_get_user_custom_avatar(  $user->ID ); 
            $imgUrl = $imgUrl == '' ? get_avatar_url( $user->ID ) : $imgUrl;
            $rating = get_comment_meta( $comment->comment_ID, 'rating', true );
        ?>
        <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
            <img class = "img-thumbnail rounded-circle mx-auto" src="<?php echo esc_url(  $imgUrl ); ?>" width="75" height="75" />
            <?php if ( $rating ): ?>
                <br />
                <span class="badge badge-danger"><?php echo $rating ?><sup>o</sup> <?php echo __( 'Place', 'photography' ) ?></span>
            <?php endif; ?>
        </a>
    </div>
<?php endforeach; ?>
