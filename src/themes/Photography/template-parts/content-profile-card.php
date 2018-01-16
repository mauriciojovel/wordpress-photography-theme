<?php $bio = get_the_author_meta( 'description', $user->ID ); ?>
<div class = "card border-0 <?php echo $background ?> profile">
    <div class = "card-body" >
        <?php 
            $imgUrl = wsl_get_user_custom_avatar( $user->ID ); 
            $imgUrl = $imgUrl == '' ? get_avatar_url( $user->ID ) : $imgUrl;
        ?>
        
            <img class = "img-thumbnail rounded-circle mx-auto d-block" src="<?php echo esc_url(  $imgUrl ); ?>" />
        
        <h5 class = "card-title text-center py-2" > <?php echo $user->display_name; ?> </h5>
        <p class = "card-text text-center" ></p>
        <p class="card-text text-center"><small class="<?php echo ( $background != '' ? 'text-light' : 'text-muted' ) ?> d-block text-center"> <?php echo $bio; ?> </small></p>
    </div>
</div>
