<?php
require 'functions.php';
$ph_no = get_field_for($_SESSION['usertype'],'username',$_SESSION['username'],'ph_no');
$email = get_field_for($_SESSION['usertype'],'username',$_SESSION['username'],'email');
$view_username = $_SESSION['username'];
$spro_data = $db->query("SELECT college,reg_no FROM student_education WHERE username = '$view_username'");
$spro_data = $spro_data->fetch_all();
$spro_college = $spro_data[0][0];
$spro_reg_no = $spro_data[0][1];
$spro1 = $db->query("SELECT * FROM education_table WHERE college = '$spro_college' AND reg_no = '$spro_reg_no'");
$spro1 = $spro1->fetch_all();
$spro_HSC = $spro1[0][4];
$spro_ISC = $spro1[0][5];
$spro_CGPA = $spro1[0][6];              
$view = $db->query("SELECT * FROM jobs ORDER BY posted_on DESC");
$view = $view->fetch_all();
$success_check = " ";
foreach($view as $check_btn)
{
    
    if(isset($_POST[$check_btn[0]]))
    {
        if(get_no_fields_for('student_education','username',$_SESSION['username'],'college') != 0)
        {
            $app_insert_query= "INSERT INTO applied (username,j_id,selected) VALUES('$view_username','$check_btn[0]',0)";
            $applied = $db->query($app_insert_query);
            if($applied)
            {
                $_SESSION['success_check']="You have successfully applied for the job!";
            }
            else
            {
                $no_of_jobs = $db->query("SELECT * FROM applied WHERE username='$view_username' AND j_id = '$check_btn[0]'");
                if($no_of_jobs->num_rows != 0)
                {
                    $_SESSION['success_check'] = "You have already applied for the job.";
                }
            }
        }
        else
        {
            $_SESSION['success_check'] = "You have not uploaded your educational details so you cannot apply for the job.";
        }
        header('Location: ../HTML/student_display_jobs.html');
    }

}


?>
