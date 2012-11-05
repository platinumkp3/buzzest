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
$userstory=$data['editorqanda'];
$category=$data['qandacategory'];
$insert_qanda="insert into querstions(UID,QDATE,QTIME,QSTATUS,QUESTION,CATID)
 values('".$uid."','".date('Y-m-d')."','".$curtime."','1','".htmlspecialchars($userstory)."','".$category."')";
$res_insert_story=mysql_query($insert_qanda,$linkid);

echo "Successfully posted!!!";
?>