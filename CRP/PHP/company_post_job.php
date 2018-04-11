<?php
require 'functions.php';
if(isset($_POST['j_type']) && isset($_POST['req_skills']) && isset($_POST['qualification']) && isset($_POST['req_hsc']) && isset($_POST['req_isc']) && isset($_POST['req_cgpa']) && isset($_POST['sal_pr_an']) && isset($_POST['j_desc']) && isset($_POST['hr_name']) && isset($_POST['hr_phone']) && isset($_POST['ldta']))
{
    $post_j_type = $db->real_escape_string($_POST['j_type']);
    $post_req_skills = $db->real_escape_string($_POST['req_skills']);
    $post_qual = $db->real_escape_string($_POST['qualification']);
    $post_req_hsc = $db->real_escape_string($_POST['req_hsc']);
    $post_req_isc = $db->real_escape_string($_POST['req_isc']);
    $post_req_cgpa = $db->real_escape_string($_POST['req_cgpa']);
    $post_sal = $db->real_escape_string($_POST['sal_pr_an']);
    $post_j_desc = $db->real_escape_string($_POST['j_desc']);
    $post_hr_name = $db->real_escape_string($_POST['hr_name']);
    $post_hr_phn = $db->real_escape_string($_POST['hr_phone']);
    $post_ldta = $db->real_escape_string($_POST['ldta']);
    $post_username = $_SESSION['username'];
    if(!empty($_POST['j_type']) && !empty($_POST['req_skills']) && !empty($_POST['qualification']) && !empty($_POST['req_isc']) && !empty($_POST['req_hsc']) && !empty($_POST['req_cgpa']) && !empty($_POST['sal_pr_an']) && !empty($_POST['j_desc']) && !empty($_POST['hr_name']) && !empty($_POST['hr_phone']) && !empty($_POST['ldta']))
    {
        $job_query = "INSERT INTO jobs (j_type,req_skills,qualifications,req_hsc,req_isc,req_cgpa,sal_pr_annum,j_desc,LDTA,hr_name,hr_phone,username)VALUES('$post_j_type','$post_req_skills','$post_qual','$post_req_hsc','$post_req_isc','$post_req_cgpa','$post_sal','$post_j_desc','$post_ldta','$post_hr_name','$post_hr_phn','$post_username')";
        if($db->query($job_query))
        {
            header('Location: ../HTML/home.html');
            $_SESSION['posted'] = 1;
        }
    }
}

?>
