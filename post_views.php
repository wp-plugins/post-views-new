<?php
/*
Plugin Name: Post_views_plugin
Plugin URI: http://www.wordpress.org/plugins/post-views-new
Description: Shows the Various Posts Veiws until now.
Version: 1.0
Author: Deven Bansod
Author URI: http://www.facebook.com/bansoddeven
License: GPL2
*/
function Post_views($text) {
        $pv=get_post_meta(get_the_id(),'Page_views');//Gets the Meta Data for the Post.
        if($pv==NULL) {
            add_post_meta(get_the_id(),'Page_views',1,TRUE);//Checks if there exists Some data for the post and adds if not.
            $pv=get_post_meta(get_the_id(),'Page_views');//Gets the newly added Meta data for the post.
        }
        if(is_singular()){
            $pv[0]=$pv[0]+1;
            update_post_meta(get_the_id(),'Page_views',$pv[0]);//Increases the Count of the views
	    
        }//Checks if page is specifically one post . If Yes, Updates the new Post Views and The new Last views
      	
	echo "<a  href='".get_site_url()."/wp-admin/options-general.php?page=Post_views'
            class='entry-meta' style='text-align:center'><b>Post Views</a></b> = ".($pv[0]);
        echo "</br>".$text;   //Echoes the rest of the Content of the Post
}
function add_options3() {
	    add_options_page("Post_views", "Post_views", 1, "Post_views", "Post_views_admin");
	}
function Post_Views_admin() {
    include 'post_views_admin.php';
	}
add_action('the_content','Post_views');//Calls the plugin function.
add_action('admin_menu','add_options3');//Adds options page	
?>
