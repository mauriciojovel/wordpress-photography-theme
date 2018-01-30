<?php
/**
 * Add extra fields to the comments forms
 */

class Rating_Comments {

    function __construct() {
        add_action( 'comment_form_logged_in_after', array( $this,'additional_fields' ) );
        add_action( 'comment_form_after_fields', array( $this,'additional_fields' ) );
        add_action( 'comment_post', array( $this, 'save_comment_meta_data' ) );
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
}
