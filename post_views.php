<?php
/*
Plugin Name: Post_views_plugin
Plugin URI: http://www.wordpress.org/plugins/post-views-new
Description: Shows the Various Posts Veiws until now.
Version: 3.0
Author: Deven Bansod
Author URI: http://www.facebook.com/bansoddeven
License: GPL2
*/
define( POST_VIEWS_PLUGIN_URL ,  plugin_dir_url( __FILE__ ) );
define( SITE_URL , get_site_url() );


/**
 *
 * Function Post Views Handles the Value from the Post Meta Data and Outputs it out just before the Post Content
 *
 */


function Post_views( $post_content ) {
        
        $post_id = get_the_id();

        //Gets the Meta Data for the Post.
        $post_views=get_post_meta( $post_id , 'post_views' );
        
        if( $post_views == NULL ) {
            
            //Checks if there exists Some data for the post and adds if not.
            add_post_meta( $post_id , 'post_views' , 1 , TRUE );
            
            //Gets the newly added Meta data for the post.
            $post_views = get_post_meta( $post_id , 'post_views' );
        }
        
        //Checks if page is specifically one post . If Yes, Updates the new Post Views and The new Last views
        if( is_singular() ) {
            
            $post_views[0] = $post_views[0] + 1;
            
            update_post_meta( $post_id , 'post_views' , $post_views[0] );//Increases the Count of the views
        
        }
        
        $post_views_output = "<a  href='" . SITE_URL . "/wp-admin/options-general.php?page=Post_views' class='entry-meta' style='text-align:center'><b>Post Views</a></b> = " . $post_views[0];
        
        $final_output = $post_views_output . "<br/>" . $text;   

        //Echoes the rest of the Content of the Post
        return $final_output;

}

function add_options_post_views() {
        
        add_options_page( "Post Views" , "Post Views" , 1 , "Post_views" , "Post_views_admin" );
    
}

function Post_Views_admin() {
    
        include 'post_views_admin.php';
    
}


add_action( 'the_content' , 'Post_views' );//Calls the plugin function.

add_action( 'admin_menu' , 'add_options_post_views');//Adds options page    

?>
