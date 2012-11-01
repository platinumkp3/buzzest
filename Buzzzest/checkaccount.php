<?php
session_start();
include "db/common_db.php";
include "includes/encryt_decrypt.php";
$linkid=db_connect();

$username=$_POST['username'];
$password=$_POST['passwrd'];
$encpassword=encrypt_val($password);

$select="Select * from users where UNAME='".$username."' and UPASSWORD='".$encpassword."' and USTATUS='1'";
$result=mysql_query($select,$linkid);
$num=mysql_num_rows($result);
if ($num > 0)
{
	 $data=mysql_fetch_array($result);
	 $uid=$data['UID'];
	 $username=$data['UNAME'];
	 $_SESSION['UID']=$uid;
	 $_SESSION['UNAME']=$username;

	header("location:home/home.php");
}
else 
{
	header("location:index.php");
}
?>