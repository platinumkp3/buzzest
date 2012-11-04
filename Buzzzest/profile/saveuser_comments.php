<?php
session_start();
$uid=$_SESSION['UID'];
$uname=$_SESSION['UNAME'];
include "../includes/check_session.php";
include "../db/common_db.php";
$linkid=db_connect();

//echo date_default_timezone_get();
$timezone = "Asia/Calcutta";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
$curtime=date('Y-m-d H:i:s');

$data=$_POST;
$userid=$data['userid'];
$postid=$data['postid'];
$txtcompost=$data['txtcompost'];

$insert ="insert into comments(UID,CDATE,CTIME,CSTATUS,CTEXT,POSTID) values('".$userid."','".date('Y-m-d')."',
 			'".$curtime."','1','".htmlspecialchars($txtcompost)."','".$postid."')";
$result_insert=mysql_query($insert,$linkid);
echo "Successfully posted!!!";

?>