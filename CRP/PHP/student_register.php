<?php
	require 'functions.php';
	if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repassword']) && isset($_POST['fullname']) && isset($_POST['nickname']) && isset($_POST['father_name']) && isset($_POST['dob']) && isset($_POST['gender']) && isset($_POST['ph_no']) && isset($_POST['email']) && isset($_POST['area']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['country']) && isset($_POST['pin']))
	{
		$sreg_utype = 'student_user';
		$sreg_username = $db->real_escape_string($_POST['username']);
		$sreg_password = $db->real_escape_string(md5($_POST['password']));
		$sreg_repassword = $db->real_escape_string(md5($_POST['repassword']));
		$sreg_propic = $_FILES['pro_pic']['name'];
		$sreg_fullname = $db->real_escape_string($_POST['fullname']);
		$sreg_nickname = $db->real_escape_string($_POST['nickname']);
		$sreg_father_name = $db->real_escape_string($_POST['father_name']);
		$sreg_dob = $db->real_escape_string($_POST['dob']);
		$sreg_gender = $db->real_escape_string($_POST['gender']);
		$sreg_ph_no = $db->real_escape_string($_POST['ph_no']);
		$sreg_email = $db->real_escape_string($_POST['email']);
		$sreg_area = $db->real_escape_string($_POST['area']);
		$sreg_city = $db->real_escape_string($_POST['city']);
		$sreg_state = $db->real_escape_string($_POST['state']);
		$sreg_country = $db->real_escape_string($_POST['country']);
		$sreg_pin = $db->real_escape_string($_POST['pin']);
		if(!empty($sreg_username) && !empty($sreg_password) && !empty($sreg_repassword) && !empty($sreg_fullname) && !empty($sreg_nickname) && !empty($sreg_father_name) && !empty($sreg_dob) && !empty($sreg_gender) && !empty($sreg_ph_no) && !empty($sreg_email) && !empty($sreg_area) &&  !empty($sreg_city) &&  !empty($sreg_state) &&  !empty($sreg_country) &&  !empty($sreg_pin))
		{
			$sreg_num_fields = get_no_fields_for('user','username',$sreg_username,'*');
			if($sreg_num_fields == 0)
			{
				if($sreg_password == $sreg_repassword)
				{
					if(!empty($sreg_propic))
		            {
		            	$ext = end(explode(".", $sreg_propic));
		            	$sreg_propic = $sreg_username.'.'.$ext;
		            	$location_pic = '../UPLOADED_PICS/'.$sreg_propic;
		            	$sreg_temp_propic = $_FILES['pro_pic']['tmp_name'];
		            	move_uploaded_file($sreg_temp_propic, $location_pic);
		            }
		            else
		            {			    
		            	$sreg_propic = "images.png";
		            }
					$sreg_query = "INSERT INTO user VALUES('$sreg_username','$sreg_password','$sreg_propic')";
					$db->query($sreg_query);
					$sreg_query = "INSERT INTO $sreg_utype VALUES('$sreg_username','$sreg_fullname','$sreg_nickname','$sreg_father_name','$sreg_dob','$sreg_gender','$sreg_email',$sreg_ph_no,'$sreg_area','$sreg_city','$sreg_state','$sreg_country',$sreg_pin)";
					$db->query($sreg_query);
				
					$_SESSION['username'] = $sreg_username;
					$_SESSION['usertype'] = $sreg_utype;
					$_SESSION['fullname'] = $sreg_fullname;
					header('Location: ../HTML/student_home.html');

				}
				else
				{
					$_SESSION['sreg_error'] = 'Password does not match.';
					header('Location: ../HTML/student_register.html');
				}

			}else
			{
				$_SESSION['sreg_error']='Username already exist. Choose another username.';
				header('Location: ../HTML/student_register.html');
			}
		}
		else
		{
			$_SESSION['sreg_error'] = 'Please fill in all the fields.';
			header('Location: ../HTML/student_register.html');
		}
		
	}
?>
