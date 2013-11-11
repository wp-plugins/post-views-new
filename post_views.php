<?php
/*
 * Plugin Name: Post_views_plugin
 * Plugin URI: http://www.sdmusics.co.nr
 * Description: Shows the Various Posts Veiws until now.
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
        $o=explode('/', $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
        if($o[count($o)-1]=='?p='.get_the_id())//Checks if page is specifically one post. 
        {
            $a[0]=$a[0]+1;
        update_post_meta(get_the_id(),'Page_views',$a[0]);//Increases the Count of the views
        }
        if($a[0]!=1){
            echo "<a  href='http://localhost/wordpress/wp-admin/options-general.php?page=Post_views'
                class='entry-meta' style='text-align:center'>Post Views = ".($a[0]+1)."</a></br>";//    Prints the Post's Views till now 
        }
        else echo "<a  href='http://localhost/wordpress/wp-admin/options-general.php?page=Post_views'
            class='entry-meta' style='text-align:center'>Post Views = ".($a[0])."</a></br>";//Prints the Post's Views till now
        echo "</br>".$text;   //Echoes the rest of the Content of the Post
        
}

function add_options3() {
    add_options_page("Post_views", "Post_views", 1, "Post_views", "Post_views_admin");
}
function Post_Views_admin() {
    include 'post_views_admin.php';
}
add_action('the_content','Post_views');//Calls the plugin function.
add_action('admin_menu','add_options3');
//add_action('wp_meta','my_func');
?>
