<?php
require 'functions.php';
$spro_fullname = get_field_for('student_user','username',$_SESSION['username'],'fullname');
$spro_nickname = get_field_for('student_user','username',$_SESSION['username'],'nickname');
if(isset($_FILES['cv']))
{

    if(!empty($_FILES['cv']['name']))
    {
        $ext = end(explode(".", $_FILES['cv']['name']));
        $l_ext = strtolower($ext);
    }
}
if($l_ext == 'docx' || $l_ext == 'pdf')
{
            
    if(isset($_POST['college']) && isset($_POST['reg_no'])&& isset($_POST['branch'])&& isset($_POST['session'])&& isset($_POST['HSC'])&& isset($_POST['ISC'])&& isset($_POST['CGPA'])&& isset($_POST['skills']))
    {
        if(!empty($_POST['college']) && !empty($_POST['reg_no'])&& !empty($_POST['branch'])&& !empty($_POST['session'])&& !empty($_POST['HSC'])&& !empty($_POST['ISC'])&& !empty($_POST['CGPA'])&& !empty($_POST['skills']))
        {
            $edu_college = $db->real_escape_string($_POST['college']);
            $edu_reg_no = $db->real_escape_string($_POST['reg_no']);
            $edu_branch = $db->real_escape_string($_POST['branch']);
            $edu_session = $db->real_escape_string($_POST['session']);
            $edu_HSC = $db->real_escape_string($_POST['HSC']);
            $edu_ISC = $db->real_escape_string($_POST['ISC']);
            $edu_CGPA = $db->real_escape_string($_POST['CGPA']);
            $edu_skills = $db->real_escape_string($_POST['skills']);
            $edu_cv = $_SESSION['username'].'_cv.'.$ext;
            $location = '../CV/'.$edu_cv;
            move_uploaded_file($_FILES['cv']['tmp_name'],$location);

            $edu_query = "INSERT INTO education_table VALUES('$edu_college','$edu_reg_no','$edu_branch','$edu_session','$edu_HSC','$edu_ISC','$edu_CGPA','$edu_skills','$edu_cv')";
            if($db->query($edu_query))
            {
                $edu_username = $_SESSION['username'];
                $edu_query = "INSERT INTO student_education VALUES('$edu_username','$edu_college','$edu_reg_no')";
                if($db->query($edu_query))
                {
                    header('Location: ../HTML/home.html');
                }
            }
            else
            {
                header('Location: ../HTML/student_register_education.html');
            }
        }
        else
        {
            header('Location: ../HTML/student_register_education.html');
        }
    }
    else
    {
        header('Location: ../HTML/student_register_education.html');
    }
}
else
{
    header('Location: ../HTML/student_register_education.html');
}
?>
