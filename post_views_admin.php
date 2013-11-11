<div class="wrap">
<?php screen_icon(); ?>
<h2>Posts' Views Settings</h2   >
<?php
/*
 * This is the File for options page for the Plugin Post_views.
 * It lets you view the Post-views for various posts together with the Author name and title of the Post
 * This may help you to Judge your various Authors and may also get the Idea of the tastes of their readers.
 */
global $wpdb;
//echo "<h1>Posts' Views Settings</h1>";
$n=wp_count_posts('post');
//echo $n->publish;
$i=1;
echo '<h2></br>Current Statistics : </h2></br>
    <div style="margin-left : 5%"><table border =1 style="margin-left : 10%;border-collapse:collapse; 
    text-align: center;font-size: 120%" class="table_admin">
    <th>S.No.</th>
    <th>Post Name</th>
    <th>Author Name</th>
    <th>Post Views</th>';
$k=$wpdb->get_results( "SELECT id FROM wp_posts where post_status ='publish'",ARRAY_N);
for($i=1;$i<=$n->publish;$i++){
    $g=$k[$i][0];
    $m=$wpdb->get_results("SELECT post_author FROM wp_posts where ID = '$g'",ARRAY_N);
    $h=$m[0][0];
    $f=$wpdb->get_results("SELECT display_name FROM wp_users where ID = '$h'",ARRAY_N);
    $l=get_post_meta($k[$i][0],'Page_views');
    echo '<tr><td>'.$i.'</td>
        <td>'.get_the_title($k[$i][0]).'</td>
        <td>'.$f[0][0].'</td> 
        <td>'.$l[0].'</td></tr>';
}
echo '</table></div>';
    echo "<h4 style='margin-left:17%'>Select a post that You want to reinitate Post views for and Press Submit : </h4>";
echo '<div style="margin-left : 20%"></br>
    <form method = "POST" action="options-general.php?page=Post_views&do_changes">
    <select name="option1">';
$t=$wpdb->get_results( "SELECT id FROM wp_posts where post_status ='publish'",ARRAY_N);
for($i=1;$i<=$n->publish;$i++){
    $l=get_post_meta($t[$i][0],'Page_views');
    echo '<option>'.get_the_title($t[$i][0]).'</option>';
    
}
    echo '</select>';
    //echo '<input type="submit" value="Submit"></div></form>';
    //echo "</br>";
    submit_button('Submit');
    if(isset($_GET['do_changes']))
    {
        $a=$_POST['option1'];
    //echo $a."</br>";
    $r= get_page_by_title($a,ARRAY_N,'post');
    //echo $r[0]."</br>";
    update_post_meta($r[0],'Page_views',1);
    
    echo '<input type=hidden name="changed" value="'.$a.'">';
    header('location:options-general.php?page=Post_views&done_changes');
    
    }
    if(isset($_GET['done_changes'])&&isset($_POST))
    {
        $a=$_POST['changed'];
        echo "</br></br><p style='margin-left:15%'>The Post Views of the post titled 
            ".$a." have been reinitiated to 1</br></p>";
    }

        
?>
