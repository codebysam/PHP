<?php
require 'functions.php';
$username = $_SESSION['username'];
if(isset($_POST['old_pass']) && isset($_POST['new_pass'])&& isset($_POST['cnfrm_pass']))
{
    if(!empty($_POST['old_pass']) && !empty($_POST['new_pass']) && !empty($_POST['cnfrm_pass']))
    {
        $new_pass = $db->real_escape_string(md5($_POST['new_pass']));
        $cnfrm_pass = $db->real_escape_string(md5($_POST['cnfrm_pass']));
        $old_pass = $db->real_escape_string(md5($_POST['old_pass']));
        $pass_chk = get_field_for('user','username',$username,'password');
        if($pass_chk == $old_pass)
        {
            if($new_pass == $cnfrm_pass)
            {
                $db->query("UPDATE user SET password = '$new_pass' WHERE username = '$username'");
                $_SESSION['error_msg'] = "PASSWORD CHANGED SUCCESSFULLY";
            }
            else
            {
                $_SESSION['error_msg'] = "NEW PASSWORDS DOESN'T MATCH!";
            }
        }
        else
        {
            $_SESSION['error_msg'] = "WRONG OLD PASSWORD.";
        }
    }
    header('Location: ../HTML/admin_chng_pswd.html');
}
?>
