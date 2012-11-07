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
$usrid_val=$data['usrid_val'];
$pst_id_val=$data['pst_id_val'];
$action=$data['action'];

if ($action == "save")
{	
	$select="select * from likes_blog where BLID='".$pst_id_val."' and UID='".$usrid_val."'";
	$res_select=mysql_query($select,$linkid);
	$num_res_select=mysql_num_rows($res_select);
	if ($num_res_select == 0)
	{	
		$insert_share="insert into likes_blog(BLID,UID,BLIKDATE,BLIKTIME,BLIKSTATUS) 
		values('".$pst_id_val."','".$usrid_val."','".date('Y-m-d')."','".$curtime."','1')";
		$res_insert_share=mysql_query($insert_share,$linkid);
		echo "Successfully Liked!!!";
	}
	else 
	{
		echo "Already Liked!!!";
	}
}

if ($action == "delete")
{
	$delete_share="delete from likes_blog where BLID='".$pst_id_val."' and UID='".$usrid_val."'";
	$res_delete_share=mysql_query($delete_share,$linkid);
	echo "Successfully Unliked!!!";
}

?>