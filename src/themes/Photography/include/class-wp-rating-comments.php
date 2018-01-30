<?php
/**
 * Add extra fields to the comments forms
 */

class Rating_Comments {

    function __construct() {
        add_action( 'comment_form_logged_in_after', array( $this,'additional_fields' ) );
        add_action( 'comment_form_after_fields', array( $this,'additional_fields' ) );
        add_action( 'comment_post', array( $this, 'save_comment_meta_data' ) );
        add_action( 'add_meta_boxes_comment', array( $this, 'comment_add_meta_box' ) );
        add_action( 'edit_comment', array( $this, 'comment_edit_comment' ) );
    }

    function additional_fields () {
        // $user = wp_get_current_user();
        // if( ( in_array( 'judge', (array) $user->roles ) ) ) {
            echo '<div class="form-group">'.
            '<label for="rating">'. __('Rating', 'photography') . '</label>
            <select class="form-control" name="rating">';
                echo '<option value="">'. __('No rating', 'photography') .'</option>';
                for( $i=1; $i <= 3; $i++ ) {
                    echo '<option value="'. $i .'">'. $i .'</option>';
                }
        
            echo'</select></div>';
        // }
      
    }

    function save_comment_meta_data( $comment_id ) {
        if ( ( isset( $_POST['rating'] ) ) && ( $_POST['rating'] != '') ) {
            $rating = wp_filter_nohtml_kses($_POST['rating']);
        } else {
            $rating = '';
        }
        add_comment_meta( $comment_id, 'rating', $rating );
    }

    /**
     * Add the title to our admin area, for editing, etc
     */
    
    function comment_add_meta_box()
    {
        add_meta_box( 'pmg-comment-title', __( 'Rating', 'photography' ), array($this,'comment_meta_box_cb'), 'comment', 'normal', 'high' );
    }

    function comment_meta_box_cb( $comment )
    {
        $rating = get_comment_meta( $comment->comment_ID, 'rating', true );
        wp_nonce_field( 'comment_update', 'comment_update', false );
        ?>
        <p>
            <label for="rating"><?php _e( 'Rating', 'photography' ); ?></label>
            <select name="rating" class="widefat">
                <option value="" <?php if( $rating == '' ) { echo 'selected'; } ?> ><?php echo __('No rating', 'photography') ?></option>
                <option value="1" <?php if( $rating == '1' ) { echo 'selected'; } ?> >1</option>
                <option value="2" <?php if( $rating == '2' ) { echo 'selected'; } ?> >2</option>
                <option value="3" <?php if( $rating == '3' ) { echo 'selected'; } ?> >3</option>
            </select>
        </p>
        <?php
    }
    /**
     * Save our comment (from the admin area)
     */
    
    function comment_edit_comment( $comment_id )
    {
        if( ! isset( $_POST['comment_update'] ) || ! wp_verify_nonce( $_POST['comment_update'], 'comment_update' ) ) return;
        if( isset( $_POST['rating'] ) )
            update_comment_meta( $comment_id, 'rating', esc_attr( $_POST['rating'] ) );
    }
}
