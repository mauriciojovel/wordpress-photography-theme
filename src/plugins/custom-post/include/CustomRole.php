<?php
/**
 * Created by PhpStorm.
 * User: mauriciojovel
 * Date: 1/2/18
 * Time: 11:56 PM
 */

class CustomRole
{
    /**
     * CustomRole constructor.
     */
    public function __construct()
    {
        add_action('pre_get_posts', array($this, 'query_set_only_author' ));
    }


    /**
     *=========================================================
     * Create a custom Role
     *=========================================================
     */

    static function add_roles_on_plugin_activation() {
        add_role( 'photographer', __(
            'Photographer', 'photography' ),
            array(
                'read' => true, // true allows this capability
                'edit_posts' => false, // Allows user to edit their own posts
                'edit_pages' => false, // Allows user to edit pages
                'edit_others_posts' => false, // Allows user to edit others posts not just their own
                'create_posts' => false, // Allows user to create new posts
                'manage_categories' => false, // Allows user to manage post categories
                'publish_posts' => false, // Allows the user to publish, otherwise posts stays in draft mode
                'edit_themes' => false, // false denies this capability. User can’t edit your theme
                'install_plugins' => false, // User cant add new plugins
                'update_plugin' => false, // User can’t update any plugins
                'update_core' => false, // user cant perform core updates
                'upload_files'=>true
            )
        );

        add_role( 'judge', __(
            'Judge', 'photography' ),
            array(
                'read' => true, // true allows this capability
                'edit_posts' => false, // Allows user to edit their own posts
                'edit_pages' => false, // Allows user to edit pages
                'edit_others_posts' => false, // Allows user to edit others posts not just their own
                'create_posts' => false, // Allows user to create new posts
                'manage_categories' => false, // Allows user to manage post categories
                'publish_posts' => false, // Allows the user to publish, otherwise posts stays in draft mode
                'edit_themes' => false, // false denies this capability. User can’t edit your theme
                'install_plugins' => false, // User cant add new plugins
                'update_plugin' => false, // User can’t update any plugins
                'update_core' => false, // user cant perform core updates
                'upload_files'=>false
            )
        );

        // Add the roles you'd like to administer the custom post types
        $roles = array('photographer', 'administrator');

        // Loop through each role and assign capabilities
        foreach($roles as $the_role) {
            $role = get_role($the_role);
            
            $role->add_cap( 'read_photographies');
            $role->add_cap( 'edit_photographies' );
            
            if($the_role != 'judge') {
                $role->add_cap( 'read_private_photographies' );
                $role->add_cap('delete_photographies');
                $role->add_cap('edit_photography');
                $role->add_cap('delete_photography');
                $role->add_cap('read_photography');
                $role->add_cap( 'delete_private_photographies' );
                $role->add_cap( 'publish_photographies' );
            }

            // The movie creator only can edit/delete their posts
            if($the_role != 'photographer') {
                $role->add_cap('edit_others_photographies');
                $role->add_cap( 'manage_photograhies' );
                $role->add_cap('manage_weeks');

                if($the_role != 'judge') {
                    $role->add_cap( 'delete_others_photographies' );
                    $role->add_cap( 'delete_published_photographies' );
                }
            }

            $role->add_cap( 'edit_published_photographies' );
        }
    }



    static function delete_role() {
        $roles = array('photographer', 'administrator');

        // Loop through each role and assign capabilities
        foreach($roles as $the_role) {
            $role = get_role($the_role);

            $role->remove_cap( 'read_photographies');
            $role->remove_cap( 'edit_photographies' );

            if($the_role != 'judge') {
                $role->remove_cap( 'read_private_photographies' );
                $role->remove_cap('delete_photographies');
                $role->remove_cap('edit_photography');
                $role->remove_cap('delete_photography');
                $role->remove_cap('read_photography');
                $role->remove_cap( 'delete_private_photographies' );
                $role->remove_cap( 'publish_photographies' );                
            }

            // The movie creator only can edit/delete their posts
            if($the_role != 'photographer') {
                $role->remove_cap('edit_others_photographies');
                $role->remove_cap( 'manage_photograhies' );
                $role->remove_cap('manage_weeks');
                if($the_role != 'judge') {
                    $role->remove_cap( 'delete_others_photographies' );
                    $role->remove_cap( 'delete_published_photographies' );
                }
            }

            $role->remove_cap( 'edit_published_photographies' );
        }

        remove_role('movie_creator');
    }

// Show only posts and media related to logged in author

    function query_set_only_author( $wp_query ) {
        global $current_user;
        if( is_admin() && !current_user_can('edit_others_photographies') ) {
            $wp_query->set( 'author', $current_user->ID );
            add_filter('views_edit-photographies', 'fix_post_counts');
            add_filter('views_upload', 'fix_media_counts');
        }
    }

// Fix post counts
    function fix_post_counts($views) {
        global $current_user, $wp_query;
        unset($views['mine']);
        $types = array(
            array( 'status' =>  NULL ),
            array( 'status' => 'publish' ),
            array( 'status' => 'draft' ),
            array( 'status' => 'pending' ),
            array( 'status' => 'trash' )
        );
        foreach( $types as $type ) {
            $query = array(
                'author'      => $current_user->ID,
                'post_type'   => 'photographies',
                'post_status' => $type['status']
            );
            $result = new WP_Query($query);
            if( $type['status'] == NULL ):
                $class = ($wp_query->query_vars['post_status'] == NULL) ? ' class="current"' : '';
                $views['all'] = sprintf(
                    '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
                    admin_url('edit.php?post_type=photographies'),
                    $class,
                    $result->found_posts,
                    __('All', 'photograpy')
                );
            elseif( $type['status'] == 'publish' ):
                $class = ($wp_query->query_vars['post_status'] == 'publish') ? ' class="current"' : '';
                $views['publish'] = sprintf(
                    '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
                    admin_url('edit.php?post_type=photographies&post_status='.$type['status']),
                    $class,
                    $result->found_posts,
                    __('Publish', 'photograpy')
                );
            elseif( $type['status'] == 'draft' ):
                $class = ($wp_query->query_vars['post_status'] == 'draft') ? ' class="current"' : '';
                $views['draft'] = sprintf(
                    '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
                    admin_url('edit.php?post_type=photographies&post_status='.$type['status']),
                    $class,
                    $result->found_posts,
                    __('Draft', 'photograpy')
                );
            elseif( $type['status'] == 'pending' ):
                $class = ($wp_query->query_vars['post_status'] == 'pending') ? ' class="current"' : '';
                $views['pending'] = sprintf(
                    '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
                    admin_url('edit.php?post_type=photographies&post_status='.$type['status']),
                    $class,
                    $result->found_posts,
                    __('Pending', 'photograpy')
                );
            elseif( $type['status'] == 'trash' ):
                $class = ($wp_query->query_vars['post_status'] == 'trash') ? ' class="current"' : '';
                $views['trash'] = sprintf(
                    '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
                    admin_url('edit.php?post_type=photographies&post_status='.$type['status']),
                    $class,
                    $result->found_posts,
                    __('Trash', 'photograpy')
                );
            endif;
        }
        return $views;
    }

// Fix media counts
    function fix_media_counts($views) {
        global $wpdb, $current_user, $post_mime_types, $avail_post_mime_types;
        $views = array();
        $count = $wpdb->get_results( "
        SELECT post_mime_type, COUNT( * ) AS num_posts 
        FROM $wpdb->posts 
        WHERE post_type = 'attachment' 
        AND post_author = $current_user->ID 
        AND post_status != 'trash' 
        GROUP BY post_mime_type
    ", ARRAY_A );
        foreach( $count as $row )
            $_num_posts[$row['post_mime_type']] = $row['num_posts'];
        $_total_posts = array_sum($_num_posts);
        $detached = isset( $_REQUEST['detached'] ) || isset( $_REQUEST['find_detached'] );
        if ( !isset( $total_orphans ) )
            $total_orphans = $wpdb->get_var("
            SELECT COUNT( * ) 
            FROM $wpdb->posts 
            WHERE post_type = 'attachment'
            AND post_author = $current_user->ID 
            AND post_status != 'trash' 
            AND post_parent < 1
        ");
        $matches = wp_match_mime_types(array_keys($post_mime_types), array_keys($_num_posts));
        foreach ( $matches as $type => $reals )
            foreach ( $reals as $real )
                $num_posts[$type] = ( isset( $num_posts[$type] ) ) ? $num_posts[$type] + $_num_posts[$real] : $_num_posts[$real];
        $class = ( empty($_GET['post_mime_type']) && !$detached && !isset($_GET['status']) ) ? ' class="current"' : '';
        $views['all'] = "<a href='upload.php'$class>" . sprintf( __('All <span class="count">(%s)</span>', 'uploaded files' ), number_format_i18n( $_total_posts )) . '</a>';
        foreach ( $post_mime_types as $mime_type => $label ) {
            $class = '';
            if ( !wp_match_mime_types($mime_type, $avail_post_mime_types) )
                continue;
            if ( !empty($_GET['post_mime_type']) && wp_match_mime_types($mime_type, $_GET['post_mime_type']) )
                $class = ' class="current"';
            if ( !empty( $num_posts[$mime_type] ) )
                $views[$mime_type] = "<a href='upload.php?post_mime_type=$mime_type'$class>" . sprintf( translate_nooped_plural( $label[2], $num_posts[$mime_type] ), $num_posts[$mime_type] ) . '</a>';
        }
        $views['detached'] = '<a href="upload.php?detached=1"' . ( $detached ? ' class="current"' : '' ) . '>' . sprintf( __( 'Unattached <span class="count">(%s)</span>', 'detached files' ), $total_orphans ) . '</a>';
        return $views;
    }
}