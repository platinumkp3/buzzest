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
$userstory=$data['editor1'];
$insert_story="insert into blog(UID,BLDATE,BLTIME,BLSTATUS,BLTEXT)
 values('".$uid."','".date('Y-m-d')."','".$curtime."','1','".htmlspecialchars($userstory)."')";
$res_insert_story=mysql_query($insert_story,$linkid);

echo "Successfully posted!!!";
?>