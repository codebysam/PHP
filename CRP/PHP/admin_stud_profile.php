<?php
include 'functions.php';
$a_stu_username = $_SESSION['admin_student'];
$a_stu = get_all_fields_for('student_user','username',$a_stu_username);

$a_stu_propic = get_field_for('user','username',$a_stu_username,'pro_pic');

$a_stu_fullname = $a_stu[0][1];
$a_stu_father = $a_stu[0][3];
$a_stu_dob = $a_stu[0][4];
$a_stu_gender = $a_stu[0][5];
$a_stu_area = $a_stu[0][8];
$a_stu_city = $a_stu[0][9];
$a_stu_state = $a_stu[0][10];
$a_stu_country = $a_stu[0][11];
$a_stu_pin = $a_stu[0][12];
$a_stu_ph_no = $a_stu[0][7];
$a_stu_email = $a_stu[0][6];

$a_stu_data = $db->query("SELECT college,reg_no FROM student_education WHERE username = '$a_stu_username'");
$a_stu_data = $a_stu_data->fetch_all();
$a_stu_college = $a_stu_data[0][0];
$a_stu_reg_no = $a_stu_data[0][1];
$a_stu1 = $db->query("SELECT * FROM education_table WHERE college = '$a_stu_college' AND reg_no = '$a_stu_reg_no'");
$a_stu1 = $a_stu1->fetch_all();
$a_stu_branch = $a_stu1[0][2];
$a_stu_session = $a_stu1[0][3];
$a_stu_HSC = $a_stu1[0][4];
$a_stu_ISC = $a_stu1[0][5];
$a_stu_CGPA = $a_stu1[0][6];
$a_stu_skills = $a_stu1[0][7];
$a_stu_cv = $a_stu1[0][8];

if(isset($_POST['delete']))
{
	$_SESSION['del_check'] = 1;
	header('Location: ../HTML/admin_stud_profile.html');
}
if(isset($_POST['reject_delete']))
{
	$_SESSION['del_check'] = 0;
	header('Location: ../HTML/admin_stud_profile.html');
}

if(isset($_POST['confirm_delete']))
{
	$db->query("DELETE FROM student_education WHERE username = '$a_stu_username'");
	$db->query("DELETE FROM education_table WHERE college = '$a_stu_college' AND reg_no = '$a_stu_reg_no'");
	$db->query("DELETE FROM applied WHERE username = '$a_stu_username' ");
	$db->query("DELETE FROM student_user WHERE username = '$a_stu_username'");
	$db->query("DELETE FROM user WHERE username = '$a_stu_username'");
	header('Location: ../HTML/admin_view_students.html');
}

?>
