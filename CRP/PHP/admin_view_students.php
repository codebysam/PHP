<?php
require 'functions.php';
$stu_users = $db->query("SELECT * FROM student_user");
$stu_users = $stu_users->fetch_all();
foreach ($stu_users as $stu_key)
{
    if(isset($_POST[$stu_key[0]]))
    {
        $_SESSION['admin_student'] = $stu_key[0];
        header('Location: ../HTML/admin_stud_profile.html');
    }
}
?>
