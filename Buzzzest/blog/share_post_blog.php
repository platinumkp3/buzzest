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
$user_id=$data['user_id'];
$post_id=$data['post_id'];
$action=$data['action'];

if ($action == "save")
{
	$select="select * from share_blog where BLID='".$post_id."' and UID='".$user_id."'";
	$res_select=mysql_query($select,$linkid);
	$num_res_select=mysql_num_rows($res_select);
	if ($num_res_select == 0)
	{
		$insert_share="insert into share_blog(BLID,UID,BSHDATE,BSHTIME,BSHSTATUS) values('".$post_id."','".$user_id."',
		'".date('Y-m-d')."','".$curtime."','1')";
		$res_insert_share=mysql_query($insert_share,$linkid);
		echo "Successfully Shared!!!";
	}
	else 
	{
		echo "Already Shared!!!";
	}
}

if ($action == "delete")
{
	$delete_share="delete from share_blog where BLID='".$post_id."' and UID='".$user_id."'";
	$res_delete_share=mysql_query($delete_share,$linkid);
	echo "Successfully UnShared!!!";
}
?>