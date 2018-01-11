<main role="main" class="container">
    <div class="row">
        <div class="col-sm-12 <?php echo ( get_field('is_portratit') == 'true' ? 'col-lg-8' : '' ) ?> text-center">
            <?php the_post_thumbnail('full', ['class' => 'img-fluid']); ?>
        </div>
        <div class="col-sm-12 <?php echo ( get_field('is_portratit') == 'true' ? 'col-lg-4' : '' ) ?>">
        <div class="row align-items-center">
            <div class="col-sm-12 <?php echo ( get_field('is_portratit') == 'true' ? '' : 'col-lg-3' ) ?> text-center p-1">
                <?php echo get_avatar( get_the_author_meta( 'ID' ), 75, '', '', array('class' => array( 'profile-img', 'img-thumbnail', 'rounded-circle' ) ) ); ?> 
            </div>
            <div class="col-sm-12 <?php echo ( get_field('is_portratit') == 'true' ? '' : 'col-lg-6' ) ?> text-center p-1">
                <?php remove_filter('the_content', 'wpautop') ?>
                <?php the_content(); ?>
            </div>
            <div class="col-sm-12 <?php echo ( get_field('is_portratit') == 'true' ? '' : 'col-lg-3' ) ?> text-center p-1">
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
</main><!-- /.container -->