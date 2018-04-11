<?php
require 'functions.php';
if(isset($_SESSION['usertype']))
{
	if($_SESSION['usertype'] == 'student_user')
		header('Location: student_home.html');
	else
	if($_SESSION['usertype'] == 'company_user')
		header('Location: company_home.html');
	else
		header('Location: admin_home.html');

}
else
{
	if(isset($_POST['usertype']) && isset($_POST['username']) && isset($_POST['password']))
	{
		if(!empty($_POST['usertype']) && !empty($_POST['username']) && !empty($_POST['password']))
		{
			$home_utype = $_POST['usertype'];
			if($home_utype == 'none')
			{
				$_SESSION['home_error'] = 'Please select the usertype.';
				header('Location: ../HTML/home.html');
			}
			else
			{
				$home_username = $db->real_escape_string($_POST['username']);
				$home_password = $db->real_escape_string(md5($_POST['password']));
				$home_err_no = login_func($home_utype,$home_username,$home_password);
				if($home_err_no == 1)
				{
					$_SESSION['username'] = $home_username;
					$_SESSION['usertype'] = $home_utype;
					if($home_utype == 'student_user')
					{
						$_SESSION['fullname'] = get_field_for($home_utype,'username',$home_username,'fullname');
						header('Location: ../HTML/student_home.html');
					}
					else
					if($home_utype == 'company_user')
					{
						$_SESSION['fullname'] = get_field_for($home_utype,'username',$home_username,'fullname');
						header('Location: ../HTML/company_home.html');
					}
					else
						header('Location: ../HTML/admin_home.html');
				}
				else if($home_err_no == 0)
				{
					$_SESSION['home_error'] = 'Invalid password.';
				}
				else 
				{
					$_SESSION['home_error'] = 'Invalid username.';
				}
				header('Location: ../HTML/home.html');
			}
		}
	}
}
?>

