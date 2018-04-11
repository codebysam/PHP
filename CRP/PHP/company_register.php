<?php
	require 'functions.php';
	if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repassword']) && isset($_POST['fullname']) && isset($_POST['estd']) && isset($_POST['ph_no']) && isset($_POST['url']) && isset($_POST['email']) && isset($_POST['area']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['country']) && isset($_POST['pin']))
	{
		$creg_utype = 'company_user';
		$creg_username = $db->real_escape_string($_POST['username']);
		$creg_password = $db->real_escape_string(md5($_POST['password']));
		$creg_repassword = $db->real_escape_string(md5($_POST['repassword']));
		$creg_propic = $_FILES['pro_pic']['name'];
		$creg_fullname = $db->real_escape_string($_POST['fullname']);
		$creg_estd = $db->real_escape_string($_POST['estd']);
		$creg_ph_no = $db->real_escape_string($_POST['ph_no']);
		$creg_url = $db->real_escape_string($_POST['url']);
		$creg_email = $db->real_escape_string($_POST['email']);
		$creg_area = $db->real_escape_string($_POST['area']);
		$creg_city = $db->real_escape_string($_POST['city']);
		$creg_state = $db->real_escape_string($_POST['state']);
		$creg_country = $db->real_escape_string($_POST['country']);
		$creg_pin = $db->real_escape_string($_POST['pin']);
		

		if(!empty($creg_username) && !empty($creg_password) && !empty($creg_repassword) && !empty($creg_fullname) && !empty($creg_estd) && !empty($creg_url) && !empty($creg_ph_no) && !empty($creg_email) && !empty($creg_area) &&  !empty($creg_city) &&  !empty($creg_state) &&  !empty($creg_country) &&  !empty($creg_pin))
		{
			$creg_num_fields = get_no_fields_for($creg_utype,'username',$creg_username,'*');
				if($creg_num_fields != 1)
				{
					if($creg_password == $creg_repassword)
					{
						if(!empty($creg_propic))
			            {
			            	$ext = end(explode(".", $creg_propic));
		            		$creg_propic = $creg_username.'.'.$ext;
		            		$location_pic = '../UPLOADED_PICS/'.$creg_propic;
			            	$creg_temp_propic = $_FILES['pro_pic']['tmp_name'];
			            	move_uploaded_file($creg_temp_propic, $location_pic);
			            }
			            else
			            {			    
			            	$creg_propic = "images.png";
			            }
						echo $creg_query = "INSERT INTO user VALUES('$creg_username','$creg_password','$creg_propic')";
						$db->query($creg_query);
					
						echo $creg_query = "INSERT INTO $creg_utype VALUES('$creg_username','$creg_fullname','$creg_estd','$creg_email',$creg_ph_no,'$creg_url','$creg_area','$creg_city','$creg_state','$creg_country','$creg_pin')";
					 	$db->query($creg_query);
						
							$_SESSION['username'] = $creg_username;
							$_SESSION['usertype'] = $creg_utype;
							$_SESSION['fullname'] = $creg_fullname;
							echo 'Registered';
							header('Location: ../HTML/company_home.html');

					}
					else
					{
						$_SESSION['creg_error'] = 'Password does not match.';
						header('Location: ../HTML/company_register.html');
					}

				}else
				{
					$_SESSION['creg_error']='Username already exist. Choose another username.';
					header('Location: ../HTML/company_register.html');
				}
		}
		else
		{
			$_SESSION['creg_error'] = 'Please fill in all the fields.';
			header('Location: ../HTML/company_register.html');
		}
		
	}
?>
