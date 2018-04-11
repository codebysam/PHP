<?php
require 'functions.php';
$ph_no = get_field_for($_SESSION['usertype'],'username',$_SESSION['username'],'ph_no');
$email = get_field_for($_SESSION['usertype'],'username',$_SESSION['username'],'email');
$spro_propic = get_field_for('user','username',$_SESSION['username'],'pro_pic');

?>
