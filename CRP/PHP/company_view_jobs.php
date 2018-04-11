<?php
require 'functions.php';
$username = $_SESSION['username'];
$jobs_key = $db->query("SELECT j_id FROM jobs WHERE username = '$username'");
$jobs_key = $jobs_key->fetch_all();
foreach ($jobs_key as $_j_key1)
{
    $btn_id1 = 'view_appl'.$_j_key1[0];
    if(isset($_POST[$btn_id1]))
    {
        $_SESSION['j_id1'] = $_j_key1[0];
        header('Location: ../HTML/company_view_applicants.html');
    }
}

foreach($jobs_key as $_j_key2)
{
    $btn_id2 = 'edit'.$_j_key2[0];
    if(isset($_POST[$btn_id2]))
    {
        $_SESSION['j_id2'] = $_j_key2[0];
        header('Location: ../HTML/company_edit_jobs.html');
    }
}

foreach ($jobs_key as $_j_key3)
{
    $btn_id3 = 'delete'.$_j_key3[0];
    if(isset($_POST[$btn_id3]))
    {
        $_SESSION['del_j_id'] = $_j_key3[0];
        $_SESSION['del_check'] = 1;
        header('Location: ../HTML/company_view_jobs.html');
    }
}

if(isset($_POST['confirm_delete']))
{
    $del_j_id=$_SESSION['del_j_id'];
    if($db->query("DELETE FROM applied WHERE j_id = '$del_j_id'"))
    {
        $db->query("DELETE FROM jobs WHERE j_id = '$del_j_id'");
        $_SESSION['del_check']=0;
        header('Location: ../HTML/company_view_jobs.html');
    }
}

if(isset($_POST['reject_delete']))
{
    $_SESSION['del_check']=0;
    $_SESSION['del_j_id']=0;
    header('Location: ../HTML/company_view_jobs.html');
}
?>
