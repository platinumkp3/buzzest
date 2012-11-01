<?php
session_start();
include "db/common_db.php";
include "includes/encryt_decrypt.php";
$linkid=db_connect();

$account=$_POST['account'];
if ($account == 1)
{	// Individual
	$username=$_POST['username'];
	$fullname=$_POST['fullname'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$encpassword=encrypt_val($password);
	
	$gender=$_POST['gender'];
	$bird=$_POST['bird'];
	$birm=$_POST['birm'];
	$biry=$_POST['biry'];
	$place=$_POST['place'];
	$interests=$_POST['interests'];
	$occupation=$_POST['occupation'];
	$industry=$_POST['industry'];
	$bio=$_POST['bio'];
	$url=$_POST['url'];
	$dob=$biry."-".$birm."-".$bird;
	
	$select_user="select * from users where UNAME='".$username."' and UEMAILID='".$email."'";
	$result_sel= mysql_query($select_user,$linkid);
	$num_sel= mysql_num_rows($result_sel);
	
	if ($num_sel == 0)
	{
		$insert="insert into users(UNAME,UPASSWORD,USTATUS,UFULLNAME,UEMAILID,UBIO,
		UINDUSTRY,UOCCUPATION,UINTEREST,UGENDER,UWEBSITE,UACCOUNT,UDOB,UPLACE)
		 values('".htmlspecialchars($username)."','".$encpassword."','1','".htmlspecialchars($fullname)."','".$email."',
		 '".$bio."','".$industry."','".$occupation."','".$interests."','".$gender."','".$url."','".$account."','".$dob."','".$place."')";
		$res_insert=mysql_query($insert,$linkid);
		echo "<h2>Successfully Done</h2><a href='index.php' >HOME</a> ";
	}
	else 
	{
		echo "account with the same username or email address exsists plz check again <a href='index.php'>BACK</a>";
	}
}

if ($account == 2)// Organization
{	
	$username=$_POST['usrname'];
	$fullname=$_POST['fullnme'];
	$email=$_POST['email1'];
	$password=$_POST['passwrd'];
	$encpassword=encrypt_val($password);
	$description=$_POST['description'];
	$url=$_POST['url1'];	
	
	$select_user="select * from users where UNAME='".$username."' and UEMAILID='".$email."'";
	$result_sel= mysql_query($select_user,$linkid);
	$num_sel= mysql_num_rows($result_sel);
	
	if ($num_sel == 0)
	{
		$insert="insert into users(UNAME,UPASSWORD,USTATUS,UFULLNAME,UEMAILID,UWEBSITE,UACCOUNT,UDESCRIPTION)
		 values('".htmlspecialchars($username)."','".$encpassword."','1',
		 '".htmlspecialchars($fullname)."','".$email."',
		 '".$url."','".$account."','".$description."')";
		$res_insert=mysql_query($insert,$linkid);
		echo "<h2>Successfully Done</h2><a href='index.php' >HOME</a> ";
	}
	else 
	{
		echo "account with the same username or email address exsists plz check again <a href='index.php'>BACK</a>";
	}
}

if ($account == 3)// Groups
{	
	$username=$_POST['uname'];
	$fullname=$_POST['name'];
	$email=$_POST['email2'];
	$password=$_POST['pssword'];	
	$encpassword=encrypt_val($password);
	$founded=$_POST['founded'];
	$tagline=$_POST['tagline'];
	$type=$_POST['type'];
	$mission=$_POST['mission'];
	$industry=$_POST['indtry'];
	$specialities=$_POST['specialities'];
	$url=$_POST['url2'];
	$empcount=$_POST['empcount'];
	$location=$_POST['location'];
	
	$select_user="select * from users where UNAME='".$username."' and UEMAILID='".$email."'";
	$result_sel= mysql_query($select_user,$linkid);
	$num_sel= mysql_num_rows($result_sel);
	
	if ($num_sel == 0)
	{
		$insert="insert into users(UNAME,UPASSWORD,USTATUS,UFULLNAME,UEMAILID,UINDUSTRY,UWEBSITE,UACCOUNT,
		UMISSION,UTYPE,UFOUNDED,USPECIALITIES,UEMPCOUNT,UPLACE,UTAGLINE)
		 values('".htmlspecialchars($username)."','".$encpassword."','1',
		 '".htmlspecialchars($fullname)."','".$email."',
		'".$industry."','".$url."','".$account."','".$mission."','".$type."','".$founded."','".$specialities."',
		'".$empcount."','".$location."','".$tagline."')";
		$res_insert=mysql_query($insert,$linkid);
		echo "<h2>Successfully Done</h2><a href='index.php' >HOME</a> ";
	}
	else 
	{
		echo "account with the same username or email address exsists plz check again <a href='index.php'>BACK</a>";
	}
}
?>