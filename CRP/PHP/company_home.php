<?php
require 'functions.php';
session_start();
$ph_no = get_field_for($_SESSION['usertype'],'username',$_SESSION['username'],'ph_no');
$email = get_field_for($_SESSION['usertype'],'username',$_SESSION['username'],'email');
$cpro_propic = get_field_for('user','username',$_SESSION['username'],'pro_pic');

?>
