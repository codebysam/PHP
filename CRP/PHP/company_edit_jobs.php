<?php
require 'functions.php';
$edit_username = $_SESSION['username'];
$edit_j_id = $_SESSION['j_id2'];             
$edit = $db->query("SELECT * FROM jobs WHERE j_id = '$edit_j_id'");
$edit = $edit->fetch_all();
$edit_j_type1 = $edit[0][1];
$edit_j_desc1= $edit[0][8];
$edit_req_skills1= $edit[0][2];
$edit_qualifications1= $edit[0][3];
$edit_req_hsc1 = $edit[0][4];
$edit_req_isc1 = $edit[0][5];
$edit_req_cgpa1 = $edit[0][6];
$edit_hr_name1= $edit[0][10];
$edit_hr_phn1= $edit[0][11];
$edit_salary1= $edit[0][7];
$edit_ldta1= $edit[0][9];
if(isset($_POST['j_type']) && isset($_POST['req_skills']) && isset($_POST['qualification']) && isset($_POST['sal_pr_an']) && isset($_POST['j_desc']) && isset($_POST['hr_name']) && isset($_POST['hr_phone']) && isset($_POST['ldta']))
{
    if(!empty($_POST['j_type']) && !empty($_POST['req_skills']) && !empty($_POST['qualification']) && !empty($_POST['sal_pr_an']) && !empty($_POST['j_desc']) && !empty($_POST['hr_name']) && !empty($_POST['hr_phone']) && !empty($_POST['ldta']))
    {
        $edit_j_type2 = $db->real_escape_string($_POST['j_type']);
        $edit_req_skills2 = $db->real_escape_string($_POST['req_skills']);
        $edit_qual2 = $db->real_escape_string($_POST['qualification']);
        $edit_req_hsc2 = $db->real_escape_string($_POST['req_hsc']);
        $edit_req_isc2 = $db->real_escape_string($_POST['req_isc']);
        $edit_req_cgpa2 = $db->real_escape_string($_POST['req_cgpa']);
        $edit_sal2 = $db->real_escape_string($_POST['sal_pr_an']);
        $edit_j_desc2 = $db->real_escape_string($_POST['j_desc']);
        $edit_hr_name2 = $db->real_escape_string($_POST['hr_name']);
        $edit_hr_phn2 = $db->real_escape_string($_POST['hr_phone']);
        $edit_ldta2 = $db->real_escape_string($_POST['ldta']);

        if($edit_j_type1 != $edit_j_type2)
        {
            update_field('jobs','j_type',$edit_j_type2,'j_id',$edit_j_id);
        }

        if($edit_req_skills1 != $edit_req_skills2)
        {
            update_field('jobs','req_skills',$edit_req_skills2,'j_id',$edit_j_id);
        }

        if($edit_qualifications1 != $edit_qual2)
        {
            update_field('jobs','qualifications',$edit_qual2,'j_id',$edit_j_id);
        }

        if($edit_req_hsc1 != $edit_req_hsc2)
        {
            update_field('jobs','req_hsc',$edit_req_hsc2,'j_id',$edit_j_id);
        }

        if($edit_req_isc1 != $edit_req_isc2)
        {
            update_field('jobs','req_isc',$edit_req_isc2,'j_id',$edit_j_id);
        }

        if($edit_req_cgpa1 != $edit_req_cgpa2)
        {
            update_field('jobs','req_cgpa',$edit_req_cgpa2,'j_id',$edit_j_id);
        }

        if($edit_salary1 != $edit_sal2)
        {
            update_field('jobs','sal_pr_annum',$edit_sal2,'j_id',$edit_j_id);
        }

        if($edit_j_desc1 != $edit_j_desc2)
        {
            update_field('jobs','j_desc',$edit_j_desc2,'j_id',$edit_j_id);
        }

        if($edit_hr_name1 != $edit_hr_name2)
        {
            update_field('jobs','hr_name',$edit_hr_name2,'j_id',$edit_j_id);
        }

        if($edit_hr_phn1 != $edit_hr_phn2)
        {
            update_field('jobs','hr_phone',$edit_hr_phn2,'j_id',$edit_j_id);
        }

        if($edit_ldta1 != $edit_ldta2)
        {
            update_field('jobs','LDTA',$edit_ldta2,'j_id',$edit_j_id);
        }
        header('Location: ../HTML/company_view_jobs.html');
    }
}

?>
