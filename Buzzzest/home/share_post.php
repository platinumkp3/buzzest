<?php
session_start();
$uid=$_SESSION['UID'];
$uname=$_SESSION['UNAME'];
include "../includes/check_session.php";
include "../db/common_db.php";
$linkid=db_connect();

$timezone = "Asia/Calcutta";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
$curtime=date('Y-m-d H:i:s');

$data=$_POST;
$user_id=$data['user_id'];
$post_id=$data['post_id'];

$insert_share="insert into share(POSTID,UID,SHDATE,SHTIME,SHSTATUS) values('".$post_id."','".$user_id."',
'".date('Y-m-d')."','".$curtime."','1')";
$res_insert_share=mysql_query($insert_share,$linkid);
echo "Successfully Shared!!!";
?>