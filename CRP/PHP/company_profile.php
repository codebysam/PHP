<?php
require 'functions.php';
$cpro_fullname = $_SESSION['fullname'];
$cpro = get_all_fields_for('company_user','username',$_SESSION['username']);
$cpro_propic = get_field_for('user','username',$_SESSION['username'],'pro_pic');

$cpro_estd = $cpro[0][2];
$cpro_url = $cpro[0][5];
$cpro_area = $cpro[0][6];
$cpro_city = $cpro[0][7];
$cpro_state = $cpro[0][8];
$cpro_country = $cpro[0][9];
$cpro_pin = $cpro[0][10];
$cpro_ph_no = $cpro[0][4];
$cpro_email = $cpro[0][3];
?>
