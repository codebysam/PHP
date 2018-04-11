<?php
include 'functions.php';
$a_com_username=$_SESSION['admin_company'];
$a_com = get_all_fields_for('company_user','username',$a_com_username);
$a_com_propic = get_field_for('user','username',$a_com_username,'pro_pic');
$a_com_fullname = $a_com[0][1];
$a_com_estd = $a_com[0][2];
$a_com_url = $a_com[0][5];
$a_com_area = $a_com[0][6];
$a_com_city = $a_com[0][7];
$a_com_state = $a_com[0][8];
$a_com_country = $a_com[0][9];
$a_com_pin = $a_com[0][10];
$a_com_ph_no = $a_com[0][4];
$a_com_email = $a_com[0][3];
if(isset($_POST['delete']))
{
	$_SESSION['del_check'] = 1;
	header('Location: ../HTML/admin_com_profile.html');
}
if(isset($_POST['reject_delete']))
{
	$_SESSION['del_check'] = 0;
	header('Location: ../HTML/admin_com_profile.html');
}

if(isset($_POST['confirm_delete']))
{
	$a_j_ids = $db->query("SELECT j_id FROM jobs WHERE username = '$a_com_username'");
	$a_j_ids = $a_j_ids->fetch_all();
	foreach($a_j_ids as $a_j_id_key)
	{
		$db->query("DELETE FROM applied WHERE j_id = '$a_j_id_key[0]'");
	}
	$db->query("DELETE FROM jobs WHERE username = '$a_com_username'");
	$db->query("DELETE FROM company_user WHERE username = '$a_com_username'");
	$db->query("DELETE FROM user WHERE username = '$a_com_username'");
	header('Location: ../html/admin_view_company.html');
}

?>
