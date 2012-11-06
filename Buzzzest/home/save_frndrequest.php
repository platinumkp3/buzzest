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
$frnusrid=$data['frnusrid'];
$user_id=$data['uid'];

$select="select * from friends where FRIENDID='".$user_id."' and UID='".$frnusrid."'";
$update ="update friends set FSTATUS='1' where FRIENDID='".$user_id."' and UID='".$frnusrid."'";
$result_update=mysql_query($update,$linkid);

$insert="insert into friends(UID,FRIENDID,MAILSTATUS,FTIME,FDATE,FSTATUS) 
		 values('".$user_id."','".$frnusrid."','1','".$curtime."','".date('Y-m-d')."','1')";
$res_insert=mysql_query($insert,$linkid);
	 
echo "Requeste Confirmed!!!";
?>