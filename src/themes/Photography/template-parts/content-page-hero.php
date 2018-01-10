
<div class="carousel-item <?php echo $active ?> <?php echo ( get_field('is_portratit') == 'true' ? 'portrait' : '' ) ?>" style="background-image: url('<?php echo get_the_post_thumbnail_url(null, 'full'); ?>')">
    <div class="carousel-caption hero">
        <div class="container pb-4 pb-lg-3">
            <div class="row align-items-center">
                <div class="col-sm-12 col-lg-3 text-center p-1">
                    <?php echo get_avatar( get_the_author_meta( 'ID' ), 75, '', false, array('class' => array( 'profile-img', 'img-thumbnail', 'rounded-circle' ) ) ); ?>
                </div>
                <div class="col-sm-12 col-lg-6 photo-text p-1 d-none d-lg-block">
                    <?php the_content(); ?>
                </div>
                <div class="col-sm-12 col-lg-3 photo-text p-1">
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
            </div>
        </div>
    </div>
</div>
