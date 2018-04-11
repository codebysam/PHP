<?php
require 'functions.php';
$com_users = $db->query("SELECT * FROM company_user");
$com_users = $com_users->fetch_all();

foreach ($com_users as $com_key)
{
    if(isset($_POST[$com_key[0]]))
    {
        echo $_SESSION['admin_company'] = $com_key[0];
        header('Location: ../HTML/admin_com_profile.html');
    }
}

?>
