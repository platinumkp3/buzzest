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



$txtpost=$data['txtuserpost'];
 $insert ="insert into post(UID,POST,POSTDATE,POSTTIME,PSTATUS) values('".$uid."','".$txtpost."','".date('Y-m-d')."',
			'".$curtime."','1')";
$result_insert=mysql_query($insert,$linkid);
echo "Successfully posted!!!";

?>