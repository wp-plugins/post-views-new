<?php
/*
 * This is the File for options page for the Plugin Post_views.
 * It lets you view the Post-views for various posts together with the Author name and title of the Post
 * This may help you to Judge your various Authors and may also get the Idea of the tastes of their readers.
 */
echo '<div class="wrap">'; 
screen_icon(); 
echo "<h2>Posts' Views Settings</h2>";
global $wpdb;
$n=wp_count_posts('post');
$pages=wp_count_posts('page');
$i=1;
if(isset($_GET['type'])){
	if($_GET['type']==1){
	if(isset($_GET['do_changes'])){
        $a=$_POST['option1'];	
    	$r= get_page_by_title($a,ARRAY_N,'post');
    	update_post_meta($r[0],'Page_views',1);
    	echo '<input type=hidden name="changed" value="'.$a.'">';	
	$_SESSION['done']=$a;
    	header('location:options-general.php?page=Post_views');
    }
echo '<h2></br>Current Statistics : </h2></br><h3></br>Posts Stats</h3></br>
    <div style="margin-left : 4%"><table border =1 style="margin-left : 10%;border-collapse:collapse; 
    text-align: center;font-size: 120%" class="table_admin">
    <th>S.No.</th>
    <th>Post Name</th>
    <th>Author Name</th>
    <th>Post Views</th>';
    $k=$wpdb->get_results( "SELECT id FROM wp_posts where post_status ='publish' and post_type='post'",ARRAY_N);
    for($i=0;$i<$n->publish;$i++){
    $g=$k[$i][0];
    $m=$wpdb->get_results("SELECT post_author FROM wp_posts where ID = '$g'",ARRAY_N);
    $h=$m[0][0];
    $f=$wpdb->get_results("SELECT display_name FROM wp_users where ID = '$h'",ARRAY_N);
        $l=get_post_meta($k[$i][0],'Page_views');
    echo '<tr><td>'.($i+1).'</td>
        <td>'.get_the_title($k[$i][0]).'</td>
        <td>'.$f[0][0].'</td> 
        <td>'.$l[0].'</td>
	</tr>';

}echo "</table></div>";
    echo "<h4 style='margin-left:11%'>Select a post that You want to reinitate Post views for and Press Submit : </h4>";
echo '<div style="margin-left : 22%"></br>
    <form method = "POST" action="options-general.php?page=Post_views&do_changes&type=1">
    <select name="option1">';
$t=$wpdb->get_results( "SELECT id FROM wp_posts where post_status ='publish' and post_type='post'",ARRAY_N);
for($i=0;$i<$n->publish;$i++){
    echo '<option>'.get_the_title($t[$i][0]).'</option>';
    
}
    echo '</select>';
    submit_button('Submit');
    
    echo "<h3><a href='".get_site_url()."/wp-admin/options-general.php?page=Post_views'>Click Here to go back</a></h3>";
    echo "</div>";
}
if($_GET['type']==2){
	if(isset($_GET['do_changes'])){
        $a=$_POST['option1'];
        echo $a;
    	$r= get_page_by_title($a,ARRAY_N,'page');
    	update_post_meta($r[0],'Page_views',1);
    	echo '<input type=hidden name="changed" value="'.$a.'">';	
	$_SESSION['done']=$a;
    	header('location:options-general.php?page=Post_views&dochanges&type=2');
    }
echo '<h2></br>Current Statistics : </h2></br><h3></br>Page Stats</h3></br>
    <div style="margin-left : 4%"><table border =1 style="margin-left : 10%;border-collapse:collapse; 
    text-align: center;font-size: 120%" class="table_admin">
    <th>S.No.</th>
    <th>Post Name</th>
    <th>Author Name</th>
    <th>Post Views</th>';
    $p=$wpdb->get_results( "SELECT id FROM wp_posts where post_status ='publish' and post_type='page'",ARRAY_N);
    for($i=0;$i<$pages->publish;$i++){
    $g=$p[$i][0];
    $m=$wpdb->get_results("SELECT post_author FROM wp_posts where ID = '$g'",ARRAY_N);
    $h=$m[0][0];
    $f=$wpdb->get_results("SELECT display_name FROM wp_users where ID = '$h'",ARRAY_N);
    $l=get_post_meta($p[$i][0],'Page_views');
    echo '<tr><td>'.($i+1).'</td>
        <td>'.get_the_title($p[$i][0]).'</td>
        <td>'.$f[0][0].'</td> 
        <td>'.$l[0].'</td>
	</tr>';

}echo "</table></div>";
    echo "<h4 style='margin-left:11%'>Select a post that You want to reinitate Post views for and Press Submit : </h4>";
echo '<div style="margin-left : 22%"></br>
    <form method = "POST" action="options-general.php?page=Post_views&do_changes&type=2">
    <select name="option1">';
$p=$wpdb->get_results( "SELECT id FROM wp_posts where post_status ='publish' and post_type='page'",ARRAY_N);
for($i=0;$i<$pages->publish;$i++){
    echo '<option>'.get_the_title($p[$i][0]).'</option>';
    
}
    echo '</select>';
    submit_button('Submit');
    echo "<h3><a href='".get_site_url()."/wp-admin/options-general.php?page=Post_views'>Click Here to go back</a></h3>";
    echo "</div>";
    
}
}
else {
	echo "Select an option : </br>
            <h2><a href=".get_site_url()."/wp-admin/options-general.php?page=Post_views&type=1>Post Statistics</a>
            <h2><a href=".get_site_url()."/wp-admin/options-general.php?page=Post_views&type=2>Page Statistics</a></h2>";
	
}    
if(isset($_SESSION['done']))
    {
        $a=$_SESSION['done'];
        echo "</br></br></div><p style='margin-left:10%;font-size:120%'>The Post Views of the post titled 
            '<b>".$a."</b>' have been reinitiated to 1</br></p>";
	unset($_SESSION['done']);
    }
?>