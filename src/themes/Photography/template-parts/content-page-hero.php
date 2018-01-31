
<div class="carousel-item <?php echo $active ?> <?php echo ( get_field('is_portratit') == 'true' ? 'portrait' : '' ) ?>" style="background-image: url('<?php echo get_the_post_thumbnail_url(null, 'full'); ?>')">
    <div class="carousel-caption hero">
        <div class="container pb-4 pb-lg-3">
            <div class="row align-items-center">
                <div class="col-sm-12 col-lg-3 text-center p-1">
                <?php 
                    $imgUrl = wsl_get_user_custom_avatar( get_the_author_meta( 'ID' ) ); 
                    $imgUrl = $imgUrl == '' ? get_avatar_url( get_the_author_meta( 'ID' ) ) : $imgUrl;
                ?>
                <a href="<?php echo get_permalink(); ?>">
                    <img class = "img-thumbnail rounded-circle mx-auto" src="<?php echo esc_url(  $imgUrl ); ?>" width="75" height="75" />
                </a>
                </div>
                <div class="col-sm-12 col-lg-6 photo-text p-1 d-none d-lg-block">
                    <?php the_content(); ?>
                </div>
                <div class="col-sm-12 col-lg-2 photo-text p-1">
                    <?php $imageLocation =  get_attached_file( get_field('_thumbnail_id') ); ?>
                    <?php $exif = exif_read_data( $imageLocation, 'EXIF' ); ?>
                        <b><?php echo $exif['Model'] ?></b>
                        <br />
                        f/<?php echo  eval('return '.$exif['FNumber'].';') ?>
                        <?php $time = eval( 'return '. $exif['ExposureTime'] . ';'); ?>
                        <?php echo ( $time < 1 ? $exif['ExposureTime'] : $time ) ?>''
                        <?php echo eval('return '.$exif['FocalLength'].';') ?>mm
                        ISO <?php echo $exif['ISOSpeedRatings'] ?>
                </div>
                <div class="col-sm-12 col-lg-1 photo-text p-1 text-center">
                    <?php echo get_simple_likes_button( get_the_ID() ); ?>
                </div>
            </div>
        </div>
    </div>
</div>
