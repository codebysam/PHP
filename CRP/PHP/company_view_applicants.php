<?php
include 'functions.php';
$job_id = $_SESSION['j_id1'];
$job_applicants = $db->query("SELECT username FROM applied WHERE j_id = '$job_id'");
$job_applicants = $job_applicants->fetch_all();
$n_appl =  sizeof($job_applicants);
foreach ($job_applicants as $j_apl_key)
{
    $acpt_btn_name = $j_apl_key[0].'accept';
    $rjct_btn_name = $j_apl_key[0].'reject';

    if(isset($_POST[$acpt_btn_name]))
    {
        $db->query("UPDATE applied SET selected = 1 WHERE j_id = '$job_id' AND username = '$j_apl_key[0]'");
        header('Location: ../HTML/company_view_applicants.html');

    }
    if(isset($_POST[$rjct_btn_name]))
    {
        $db->query("UPDATE applied SET selected = 0 WHERE j_id = '$job_id' AND username = '$j_apl_key[0]'");
        header('Location: ../HTML/company_view_applicants.html');
    }
}
?>
