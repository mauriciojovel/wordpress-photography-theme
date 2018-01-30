<?php $user = wp_get_current_user(); ?>
    <?php $usercomment = get_comments(array('user_id' => $user->ID, 'post_id'=>$post->ID) ); ?>
    <?php if( ( in_array( 'judge', (array) $user->roles ) || in_array( 'photographer', (array) $user->roles ) ) && count($usercomment) == 0 ) : ?>
        <?php
            $comments_arg = array(
                'form'	=> array(
                    'class' => 'form-horizontal'
                    ),
                'class_form' => 'form-horizontal pt-2',
                'title_reply' => 'Leave your comment',
                'logged_in_as' => '',
                'reply_text' => '',
                'fields' => apply_filters( 'comment_form_default_fields', array(
                        'autor' 				=> '<div class="form-group">' . '<label for="author">' . __( 'Name', 'wp_babobski' ) . '</label>' .
                                                '<input id="author" name="author" class="form-control" type="text" value="" size="30" />'.
                                                '<p id="d1" class="text-danger"></p>' . '</div>',
                        'email'					=> '<div class="form-group">' .'<label for="email">' . __( 'Email', 'wp_babobski' ) . '</label> ' .
                                                '<input id="email" name="email" class="form-control" type="text" value="" size="30" />'.
                                                '<p id="d2" class="text-danger"></p>' . '</div>',
                        'url'					=> '')),
                        'comment_field'			=> '<div class="form-group">' . '<label for="comment">' . __( 'Comment', 'wp_babobski' ) . '</label><span>*</span>' .
                                                '<textarea id="comment" class="form-control" name="comment" rows="3" aria-required="true"></textarea><p id="d3" class="text-danger"></p>' . '</div>',
                        'comment_notes_after' 	=> '',
                        'class_submit'			=> 'btn btn-default'
                    ); 
        ?>
        <?php comment_form($comments_arg); ?>
    <?php endif; ?>
    <div id="comments" class="mt-1 w-100">
    <ol class="medias py-md-5 my-md-5 px-sm-0 mx-sm-0">
    <?php 
        echo wp_list_comments( array(
            'per_page' => 10, //Allow comment pagination
            'style'         => 'ol',
            'max_depth'     => 0,
            'short_ping'    => false,
            'avatar_size'   => '50',
            'reverse_top_level' => false, //Show the oldest comments at the top of the list
            'walker'        => new Bootstrap_Comment_Walker(),
        ) );
    ?>
    </ol>
    </div>