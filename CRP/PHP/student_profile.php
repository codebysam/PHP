<?php
require 'functions.php';
$spro_username = $_SESSION['username'];
$spro_fullname = $_SESSION['fullname'];
$spro = get_all_fields_for('student_user','username',$_SESSION['username']);

$spro_propic = get_field_for('user','username',$_SESSION['username'],'pro_pic');

$spro_nickname = $spro[0][2];
$spro_father = $spro[0][3];
$spro_dob = $spro[0][4];
$spro_gender = $spro[0][5];
$spro_area = $spro[0][8];
$spro_city = $spro[0][9];
$spro_state = $spro[0][10];
$spro_country = $spro[0][11];
$spro_pin = $spro[0][12];
$spro_ph_no = $spro[0][7];
$spro_email = $spro[0][6];

$spro_data = $db->query("SELECT college,reg_no FROM student_education WHERE username = '$spro_username'");
$spro_data = $spro_data->fetch_all();
$spro_college = $spro_data[0][0];
$spro_reg_no = $spro_data[0][1];
$spro1 = $db->query("SELECT * FROM education_table WHERE college = '$spro_college' AND reg_no = '$spro_reg_no'");
$spro1 = $spro1->fetch_all();
$spro_reg_no = $spro1[0][1];
$spro_branch = $spro1[0][2];
$spro_session = $spro1[0][3];
$spro_HSC = $spro1[0][4];
$spro_ISC = $spro1[0][5];
$spro_CGPA = $spro1[0][6];
$spro_skills = $spro1[0][7];
$spro_cv = $spro1[0][8];



?>
