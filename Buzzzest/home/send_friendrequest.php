<?php
session_start();
include "../db/common_db.php";
$linkid=db_connect();
include "../includes/mail.php";

$uid=$_SESSION['UID'];
$uname=$_SESSION['UNAME'];

$data=$_POST;
$user_name=$data['user_name'];
$select="select UID,UEMAILID from users where UNAME='".$user_name."'";
$res_select=mysql_query($select,$linkid);
$data_select=mysql_fetch_array($res_select);
$frnid=$data_select['UID'];
$frnemailid=$data_select['UEMAILID'];


	//sending_email($EMAIL_FROM,$EMAIL_TO,$EMAIL_SUBJECT,$MSG_HTML,$MSG_TXT)
echo $a = sending_email("","vinaykp3@gmail.com","test","testing","testing message");
if ($a == "")
{
  echo $message_val == 1;
}
else {
   $message_val == 0;
}

$timezone = "Asia/Calcutta";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
	$curtime=date('Y-m-d H:i:s');
	
$curdate=date('Y-m-d');	
if ($message_val == 1)
{
	$insert="insert into friends(UID,FRIENDID,FSTATUS,FDATE,FTIME,MAILSTATUS) values('".$uid."','".$frnid."','0',
		'".$curdate."','".$curtime."','".$message_val."')";
		//$res_insert=mysql_query($insert,$linkid);
}
if ($message_val == 0)
{
	echo "Mail not sent plz retry again!!!";
}
?>