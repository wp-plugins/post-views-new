<?php
/*
 * This is the File for options page for the Plugin Post_views.
 * It lets you view the Post-views for various posts together with the Author name and title of the Post
 * This may help you to Judge your various Authors and may also get the Idea of the tastes of their readers.
 */

?>
<?

if ( isset ( $_GET['done']) && isset( $_POST['change']) )  {

    if ( $_GET['done'] == 1 ) {

        $post_to_be_changed = $_POST['change'];

        $post_id = get_page_by_title($post_to_be_changed,OBJECT,$_GET['view'])->ID;

        update_post_meta ( $post_id, 'post_views', '1');

        ?>

        <h4 style="text-align:center">The View for "<?php echo $_POST['change']; ?>" has been reinitiated to 1.</h4>

<?php
    
    }

}

?>



<div class="wrap">

    <?php
        screen_icon();
    ?>
    <h2><strong>Posts' Views</strong> Settings</h2>

    <div id = 'help' style="width : 60%; margin-left : 20%">
        
        <h3 style="text-align : center"> Click on Below Buttons to See the Respective Stats </h3>
        
        <a href = "<?php echo SITE_URL . '/wp-admin/options-general.php?page=Post_views&view=post'; ?>" class = "button" >Post Stats</a>

        <a style = "float:right;" href = "<?php echo SITE_URL . '/wp-admin/options-general.php?page=Post_views&view=page'; ?>" class = "button" >Page Stats</a>

    </div>
<?php
global $wpdb;

$view = 'admin';

if ( isset( $_GET['view'] ) ) {
    
    if( $_GET['view'] == 'post' ) { 
        $view = $_GET['view'];

?>
    <div id = "results" style = "width : 60%; margin-left : 20%" > 
        <h3 style = "text-align:center"> Current Posts' Statistics </h3>

        <table style = "border : 1; width : 90%; margin-left: 5%; text-align:center" >
            <tr><th>Post ID</th>
                <th>Post Name</th>
                <th>Post Author</th>
                <th>Post Views</th>
            </tr>
            
<?php
        $args = array(
            'orderby'          => 'post_date',
            'order'            => 'DESC',
            'post_type'        => $view,
            'post_status'      => 'publish',
             ); 

        $posts = get_posts($args);


        foreach ($posts as $post_obj) {
        
            ?>
            <tr>
                <td><?php echo $post_obj->ID; ?></td>
                <td><?php echo $post_obj->post_title; ?></td>
            <?php

                $user = get_userdata ( $post_obj->post_author );

            ?>
                <td><?php echo $user->display_name; ?></td>
            <?php
                $post_views = get_post_meta( $post_obj->ID, 'post_views', 1);
            ?>
                <td><?php echo $post_views; ?> </td>
            </tr>
<?php

        }
?>
        
        </table>

        <br><br>
    
        <h4 style="text-align : center">Choose The Post/Page whose Views you want to Reset and Click Submit </h4>
        <form style="width : 90%, margin-left : 5%" method = "POST" action = "<?php echo SITE_URL . '/wp-admin/options-general.php?page=Post_views&view=' . $view .'&done=1'; ?>">
            <select style="margin-left : 30%; width : 40%" name="change" id = "change">
                <?php
                    foreach ($posts as $post_obj) {
        
            ?>
            
                <option><?php echo $post_obj->post_title; ?></option>
            
            <?php 

                    }

             ?>

            </select>

            <input type = "submit" value = "Submit" class="button"/>

        </form>

<?php
    }


    elseif( $_GET['view'] == 'page' ) { 
        
        $view = $_GET['view'];

?>
    <div id = "results" style = "width : 60%; margin-left : 20%" > 
        <h3 style = "text-align:center"> Current Posts' Statistics </h3>

        <table style = "border : 1; width : 90%; margin-left: 5%; text-align:center" >
            <tr><th>Post ID</th>
                <th>Post Name</th>
                <th>Post Author</th>
                <th>Post Views</th>
            </tr>
            
<?php
        $args = array(
            'orderby'          => 'post_date',
            'order'            => 'DESC',
            'post_type'        => $view,
            'post_status'      => 'publish',
             ); 

        $posts = get_posts($args);


        foreach ($posts as $post_obj) {
        
            ?>
            <tr>
                <td><?php echo $post_obj->ID; ?></td>
                <td><?php echo $post_obj->post_title; ?></td>
            <?php

                $user = get_userdata ( $post_obj->post_author );

            ?>
                <td><?php echo $user->display_name; ?></td>
            <?php
                $post_views = get_post_meta( $post_obj->ID, 'post_views', 1);
            ?>
                <td><?php echo $post_views; ?> </td>
            </tr>
<?php

        }
?>
        
        </table>
    
<br><br>
    
        <h4 style="text-align : center">Choose The Post/Page whose Views you want to Reset and Click Submit </h4>
        <form style="width : 90%, margin-left : 5%" method = "POST" action = "<?php echo SITE_URL . '/wp-admin/options-general.php?page=Post_views&view=' . $view .'&done=1'; ?>">
            <select style="margin-left : 30%; width : 40%" name="change" id = "change">
                <?php
                    foreach ($posts as $post_obj) {
        
            ?>
            
                <option><?php echo $post_obj->post_title; ?></option>
            
            <?php 

                    }

             ?>

            </select>

            <input type = "submit" value = "Submit" class="button"/>

        </form>


<?php

    }

}



?>

    </div>