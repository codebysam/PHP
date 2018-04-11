<?php
require 'functions.php';
$spro_fullname = get_field_for('student_user','username',$_SESSION['username'],'fullname');
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
				if($per_old_val == get_field_for('student_user','username',$_SESSION['username'],$per_attr))
				{
					update_field('student_user',$per_attr,$per_new_val,'username',$_SESSION['username']);
					$_SESSION['fullname'] = get_field_for('student_user','username',$_SESSION['username'],'fullname');
					$_SESSION['stu_set_error'] = "Field changed successfully";
				}
				else
				{
					$_SESSION['stu_set_error'] = "Old value Doesnot match";
				}
			}
		}
	}
	else
	{
		$_SESSION['stu_set_error'] = "Choose attribute";
	}
	header('Location: ../HTML/student_settings.html');
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
				if($con_old_val == get_field_for('student_user','username',$_SESSION['username'],$con_attr))
				{
					update_field('student_user',$con_attr,$con_new_val,'username',$_SESSION['username']);
					$_SESSION['stu_set_error'] = "Field changed successfully";
				}
				else
				{
					$_SESSION['stu_set_error'] = "Old value Doesnot match";
				}
			}
		}
	}
	else
	{
		$_SESSION['stu_set_error'] = "Choose attribute";
	}
	header('Location: ../HTML/student_settings.html');
}

if(isset($_POST['edu_update']))
{
	if($_POST['edu_attr'] != 'none')
	{
		if(isset($_POST['edu_new_val']))
		{
			$edu_new_val = $db->real_escape_string($_POST['edu_new_val']);
			$edu_attr = $_POST['edu_attr'];
			if(!empty($edu_new_val))
			{
				
				$edu_q1 = "SELECT college,reg_no FROM student_education WHERE username = '$username'";
				$edu_q1_res = $db->query($edu_q1);
				$edu_q1_res = $edu_q1_res->fetch_assoc();
				$college_name = $edu_q1_res['college'];
				$reg_no_ = $edu_q1_res['reg_no'];
				$edu_q1 = "UPDATE education_table SET $edu_attr = $edu_new_val WHERE college = '$college_name' AND reg_no = '$reg_no_'";
				$db->query($edu_q1);
				$_SESSION['stu_set_error'] = "Field changed successfully";
			}
			else
			{
				$_SESSION['stu_set_error'] = "Please fill the fields.";
			}
		}
	}
	else
	{
		$_SESSION['stu_set_error'] = "Choose attribute";
	}
	header('Location: ../HTML/student_settings.html');
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
			$new_pass_confirm = $_POST['new_pass_confirm'];
			if($res_pass == $old_pass)
			{
				if($new_pass_confirm == $new_pass)
				{
					$new_pass = md5($new_pass);
					$db->query("UPDATE user SET password = '$new_pass' WHERE username = '$username'");
					$_SESSION['stu_set_error'] = "Password changed successfully.";
				}
				else
				{
					$_SESSION['stu_set_error'] = "Passwords does not match.";
				}

			}
			else
			{
				$_SESSION['stu_set_error'] = "Old password does not match.";
			}
		}
		else
		{
			$_SESSION['stu_set_error'] = "Please fill the values.";
		}
	}
	header('Location: ../HTML/student_settings.html');
		
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
			$_SESSION['stu_set_error'] = "Profile pic changed successfully";
		}

	}
	header('Location: ../HTML/student_settings.html');

}

if(isset($_POST['chng_cv']))
{
	$new_cv = $_FILES['new_cv']['name'];
	if(!empty($new_cv))
	{
		$ext = end(explode(".", $_FILES['new_cv']['name']));
		$l_ext = strtolower($ext);
		if($l_ext == 'docx' || $l_ext == 'pdf')
 		{
 			$new_cv = $username.'_cv.'.$ext;
			$location = "../CV/".$new_cv;
			$edu_data = $db->query("SELECT college,reg_no  FROM student_education WHERE username = '$username'");
			$edu_data = $edu_data->fetch_all();
			$cv_college = $edu_data[0][0];
			$cv_reg_no = $edu_data[0][1];
			if($db->query("UPDATE education_table SET CV = '$new_cv' WHERE college = '$cv_college' AND reg_no = '$cv_reg_no'"))
			{
				move_uploaded_file($_FILES['new_cv']['tmp_name'], $location);
				$_SESSION['stu_set_error'] = "CV updated successfully";
			}
		}
	}
	header('Location: ../HTML/student_settings.html');

}

?>
