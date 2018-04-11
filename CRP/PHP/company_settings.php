<?php
require 'functions.php';
$spro_fullname = get_field_for('company_user','username',$_SESSION['username'],'fullname');
$username = $_SESSION['username'];
if(isset($_POST['up_personal']))
{
	if($_POST['per_attr'] != 'none')
	{
		if(isset($_POST['per_old_val']) && isset($_POST['per_new_val']))
		{
			$per_new_val = $db->real_escape_string($_POST['per_new_val']);
			$per_old_val = $db->real_escape_string($_POST['per_old_val']);
			$per_attr = $_POST['per_attr'];
			if(!empty($per_old_val) && !empty($per_new_val))
			{
				if($per_old_val == get_field_for('company_user','username',$_SESSION['username'],$per_attr))
				{
					update_field('company_user',$per_attr,$per_new_val,'username',$_SESSION['username']);
					$_SESSION['cmp_set_error'] = "Field changed successfully.";
					
					if($per_attr = "fullname")
					{
						$_SESSION['fullname'] = get_field_for('company_user','username',$_SESSION['username'],'fullname');
					}

				}
				else
				{
					$_SESSION['cmp_set_error'] = "Old value does not match";
				}
			}
		}
	}
	else
	{
		$_SESSION['cmp_set_error'] = "Choose attribute";
	}
	header('Location: ../HTML/company_settings.html');
}

if(isset($_POST['up_contact']))
{
	if($_POST['contact_attrib'] != 'none')
	{
		if(isset($_POST['old_contact']) && isset($_POST['new_contact']))
		{
			$con_new_val = $db->real_escape_string($_POST['new_contact']);
			$con_old_val = $db->real_escape_string($_POST['old_contact']);
			$con_attr = $_POST['contact_attrib'];
			if(!empty($con_old_val) && !empty($con_new_val))
			{
				if($con_old_val == get_field_for('company_user','username',$_SESSION['username'],$con_attr))
				{
					update_field('company_user',$con_attr,$con_new_val,'username',$_SESSION['username']);
					$_SESSION['cmp_set_error'] = "Field changed successfully.";
				}
				else
				{
					$_SESSION['cmp_set_error'] = "Old value does not match";
				}
			}
		}
	}
	else
	{
		$_SESSION['cmp_set_error'] = "Choose attribute";
	}
	header('Location: ../HTML/company_settings.html');
}


if (isset($_POST['chng_pass'])) 
{
	
	if(isset($_POST['old_pass']) && isset($_POST['new_pass']) && isset($_POST['new_pass_confirm']))
	{
		if(!empty($_POST['old_pass']) && !empty($_POST['new_pass']) && !empty($_POST['new_pass_confirm']))
		{
			$res_pass = get_field_for('user','username',$username,'password');
			$old_pass = $db->real_escape_string(md5($_POST['old_pass']));
			$new_pass = $db->real_escape_string($_POST['new_pass']);
			$new_pass_confirm = $db->real_escape_string($_POST['new_pass_confirm']);
			if($res_pass == $old_pass)
			{
				if($new_pass_confirm == $new_pass)
				{
					$new_pass = md5($new_pass);
					$db->query("UPDATE user SET password = '$new_pass' WHERE username = '$username'");
					$_SESSION['cmp_set_error'] = "Password changed successfully.";
				}
				else
				{
					$_SESSION['cmp_set_error'] = "Passwords does not match.";
				}

			}
			else
			{
				$_SESSION['cmp_set_error'] = "Old password does not match.";
			}
		}
		else
		{
			$_SESSION['cmp_set_error'] = "Please fill the values.";
		}
	}
	header('Location: ../HTML/company_settings.html');
		
}

if(isset($_POST['chng_propic']))
{
	$new_propic = $_FILES['new_propic']['name'];
	if(!empty($new_propic))
	{
		$ext = end(explode(".", $_FILES['new_propic']['name']));
		$new_propic = $username.'.'.$ext;
		$location = "../UPLOADED_PICS/".$new_propic;
		
		if($db->query("UPDATE user SET pro_pic = '$new_propic' WHERE username = '$username'"))
		{
			move_uploaded_file($_FILES['new_propic']['tmp_name'], $location);
			$_SESSION['cmp_set_error'] = "Profile picture changed successfully.";
		}

	}
	header('Location: ../HTML/company_settings.html');

}



?>
