<?php
ob_start();
session_start();
require 'connect_db.php';
function get_field_for($table,$matchfield,$match,$required)
{
	global $db;
	$gf_q1= "SELECT $required FROM $table WHERE $matchfield = '$match'";
	$gf_q1_res = $db->query($gf_q1);
	if($gf_q1_res->num_rows >= 1)
	{
		$gf_res1 = $gf_q1_res->fetch_assoc();
		return $gf_res1[$required];
	}
	else
	{
		return false;
	}
}
function get_no_fields_for($table,$matchfield,$match,$required)
{
	global $db;
	$gf_q1= "SELECT $required FROM $table WHERE $matchfield = '$match'";
	$gf_q1_res = $db->query($gf_q1);
	return $gf_q1_res->num_rows;
}

function get_all_fields_for($table,$matchfield,$match)
{
	global $db;
	$gf_q1= "SELECT * FROM $table WHERE $matchfield = '$match'";
	$gf_q1_res = $db->query($gf_q1);
	return $gf_q1_res->fetch_all();
}

function login_func($utype,$username,$password)
{
	global $db;
	$n = get_no_fields_for($utype,'username',$username,'*');
	if($n == 1)
	{
		$res = get_field_for('user','username',$username,'password');
		if($res)
		{
			if($res == $password)
			{
				
				return 1;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return -1;
		}
	}
	else
		return -1;
}

function update_field($table,$chg_attrib,$new_val,$matchfield,$match)
{
	global $db;
	$up_query = "UPDATE $table SET $chg_attrib = '$new_val' WHERE $matchfield = '$match'";
	$res = $db->query($up_query);
	return $res->affected_rows;
}
?>