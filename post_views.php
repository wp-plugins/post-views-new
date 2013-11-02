<?php
/*
 * Plugin Name: Post_views
 * Plugin URI: http://www.sdmusics.co.nr
 * Description: Wordpress Plugin for viewing Number of views for the Post.This simple Plugin Helps the Admins to get the Info about the Views till date of various posts on the Blog.This may help them to Judge their various Authors and may also get the Idea of the tastes of their readers.
 * Version: 1.0
 * Author: Deven Bansod
 * Author URI: http://www.facebook.com/bansoddeven
 * License: GPL2
 */
function Post_views($text) {
        $a=get_post_meta(get_the_id(),'Page_views');//Gets the Meta Data for the Post.
        if($a==NULL)
        {
            add_post_meta(get_the_id(),'Page_views',1,TRUE);//Checks if there exists Some data for the post and adds if not.
            $a=get_post_meta(get_the_id(),'Page_views');//Gets the newly added Meta data for the post.
            
        }
        if($a[0]!=1){
            echo "<a  class='entry-meta' style='text-align:center'>Post Views = ".($a[0]+1)."</a></br>";//Prints the Post's Views till now 
        }
        else echo "<a  class='entry-meta' style='text-align:center'>Post Views = ".($a[0])."</a></br>";//Prints the Post's Views till now
        if(isset($_GET['p']))//Checks if page is specifically one post. 
        {
            $a[0]=$a[0]+1;
        update_post_meta(get_the_id(),'Page_views',$a[0]);//Increases the Count of the views
        }    
        
        echo "</br>".$text;   //Echoes the rest of the Content of the Post
}
function add_options3() {
    add_options_page("Post_views", "Post_views", 1, "Post_views", "Post_views_admin");//for Adding the Options page.
}
function Post_Views_admin() {
    include 'post_views_admin.php';
}
add_action('the_content','Post_views');//Calls the plugin function.
add_action('admin_menu','add_options3');//Adds the Options page Under Settings in the Dashboard
?>
