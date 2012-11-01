<?php
session_start();
include "../db/common_db.php";
$linkid=db_connect();

$uid=$_SESSION['UID'];

$data=$_POST;
$username=$data['username'];
$fullname=$data['fullname'];
$gender=$data['gender'];
$occupation=$data['occupation'];
$industry=$data['industry'];
$interests=$data['interests'];
$place=$data['place'];
$bio=$data['bio'];
$url=$data['url'];
$email=$data['email'];

if ( $username!= "")
{
	if (sizeof($variables)> 0)
	{
		$variables .=" ,UNAME='".$username."'";
	}
	else 
	{
		$variables .=" UNAME='".$username."'";
	}
	
}

if ($fullname != "")
{
	if (sizeof($variables)> 0)
	{
		$variables .=" ,UFULLNAME='".$fullname."'";
	}
	else 
	{
		$variables .=" UFULLNAME='".$fullname."'";
	}
}

if ($gender != "")
{
	if (sizeof($variables)> 0)
	{
		$variables .=" ,UGENDER='".$gender."'";
	}
	else 
	{
		$variables .="  UGENDER='".$gender."'";
	}
}

if ($occupation != "")
{
	if (sizeof($variables)> 0)
	{
		$variables .=" ,UOCCUPATION='".$occupation."'";
	}
	else 
	{
		$variables .="  UOCCUPATION='".$occupation."'";
	}
}

if ($industry != "")
{
	if (sizeof($variables)> 0)
	{
		$variables .=" ,UINDUSTRY='".$industry."'";
	}
	else 
	{
		$variables .="  UINDUSTRY='".$industry."'";
	}
}

if ($interests != "")
{
	if (sizeof($variables)> 0)
	{
		$variables .=" ,UINTEREST='".$interests."'";
	}
	else 
	{
		$variables .="  UINTEREST='".$interests."'";
	}
}

if ($place != "")
{
	if (sizeof($variables)> 0)
	{
		$variables .=" ,UPLACE='".$place."'";
	}
	else 
	{
		$variables .="  UPLACE='".$place."'";
	}
}

if ($bio != "")
{
	if (sizeof($variables)> 0)
	{
		$variables .=" ,UBIO='".$bio."'";
	}
	else 
	{
		$variables .="  UBIO='".$bio."'";
	}
}

if ($url != "")
{
	if (sizeof($variables)> 0)
	{
		$variables .=" ,UWEBSITE='".$url."'";
	}
	else 
	{
		$variables .="  UWEBSITE='".$url."'";
	}
}

if ($email != "")
{
	if (sizeof($variables)> 0)
	{
		$variables .=" ,UEMAILID='".$email."'";
	}
	else 
	{
		$variables .="  UEMAILID='".$email."'";
	}
}


$update="UPDATE users set ".$variables." where UID='".$uid."'";
$res_update=mysql_query($update,$linkid);

if ($res_update != "")
{
	//echo "Successfully updated!!!";
}
else
{
	//echo "Something went wrong please try again";
}
?>