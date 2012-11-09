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

$user_id=$data['user_id'];
$post_id=$data['post_id'];

$sel_comments="select * from comments where POSTID='".$post_id."'";
$res_sel_comments=mysql_query($sel_comments,$linkid);
$num_sel_comments=mysql_num_rows($res_sel_comments);


$sel_share="select * from share where POSTID='".$post_id."'";
$res_sel_share=mysql_query($sel_share,$linkid);
$num_sel_share=mysql_num_rows($res_sel_share);

$sel_likes="select * from likes where POSTID='".$post_id."'";
$res_sel_likes=mysql_query($sel_likes,$linkid);
$num_sel_likes=mysql_num_rows($res_sel_likes);

if ($num_sel_likes > 0)
{
	while($data_sel_likes=mysql_fetch_array($res_sel_likes))
	{
		$LIKID=$data_sel_likes['LIKID'];
		$del_likes="delete from likes where LIKID='".$LIKID."'";
		$res_del_likes=mysql_query($del_likes,$linkid);
	}
}

if ($num_sel_share > 0)
{
	while($data_sel_share=mysql_fetch_array($res_sel_share))
	{
		$SHRID=$data_sel_share['SHRID'];
		$del_share="delete from share where SHRID='".$SHRID."'";
		$res_del_share=mysql_query($del_share,$linkid);
	}
}

if ($num_sel_comments >0 )
{
	while($data_sel_comments=mysql_fetch_array($res_sel_comments))
	{
		$comid=$data_sel_comments['CMTID'];
		$del_comments="delete from comments where CMTID='".$comid."'";
		$res_del_comments=mysql_query($del_comments,$linkid);
	}
	
}

$del_post="delete from post where POSTID='".$post_id."'";
$res_del_post=mysql_query($del_post,$linkid);

echo "Successfully Deleted!!!";
?>