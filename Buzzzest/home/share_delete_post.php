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
$user_id=$data['userid_value'];
$post_id=$data['post_value'];

$delete_share="delete from share where POSTID='".$post_id."' and UID='".$user_id."'";
$res_delete_share=mysql_query($delete_share,$linkid);
echo "Successfully UnShared!!!";
?>