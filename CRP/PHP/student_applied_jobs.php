<?php
require 'functions.php';
$ph_no = get_field_for($_SESSION['usertype'],'username',$_SESSION['username'],'ph_no');
$email = get_field_for($_SESSION['usertype'],'username',$_SESSION['username'],'email');
$view_username = $_SESSION['username'];               
$view_q_run = $db->query("SELECT jobs.* FROM jobs,applied WHERE jobs.j_id = applied.j_id AND applied.username = '$view_username' ORDER BY applied_on DESC");
$view = $view_q_run->fetch_all();
$n = $view_q_run->num_rows;
$delete_success = 0;
foreach ($view as $key) {
    if(isset($_POST[$key[0]]))
    {
        $delete_query = "DELETE FROM applied WHERE username = '$view_username' AND j_id = '$key[0]'";
        $delete_query_chk = $db->query($delete_query);
        if($delete_query_chk)
        {
            $_SESSION['delete_success'] = 1;
        }
        header('Location: ../HTML/student_applied_jobs.html');
    }
    
}

?>
