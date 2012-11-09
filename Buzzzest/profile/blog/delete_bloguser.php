<?php
session_start();
$uid=$_SESSION['UID'];
$uname=$_SESSION['UNAME'];
include "../../includes/check_session.php";
include "../../db/common_db.php";
$linkid=db_connect();

//echo date_default_timezone_get();
$timezone = "Asia/Calcutta";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
$curtime=date('Y-m-d H:i:s');

$data=$_POST;

$user_id=$data['user_id'];
$post_id=$data['post_id'];


$sel_comments="select * from blog_comments where BLID='".$post_id."'";
$res_sel_comments=mysql_query($sel_comments,$linkid);
$num_sel_comments=mysql_num_rows($res_sel_comments);


$sel_share="select * from share_blog where BLID='".$post_id."'";
$res_sel_share=mysql_query($sel_share,$linkid);
$num_sel_share=mysql_num_rows($res_sel_share);

$sel_likes="select * from likes_blog where BLID='".$post_id."'";
$res_sel_likes=mysql_query($sel_likes,$linkid);
$num_sel_likes=mysql_num_rows($res_sel_likes);

if ($num_sel_likes > 0)
{
	while($data_sel_likes=mysql_fetch_array($res_sel_likes))
	{
		$BLIKID=$data_sel_likes['BLIKID'];
		$del_likes="delete from likes_blog where BLIKID='".$BLIKID."'";
		$res_del_likes=mysql_query($del_likes,$linkid);
	}
}

if ($num_sel_share > 0)
{
	while($data_sel_share=mysql_fetch_array($res_sel_share))
	{
		$BSHRID=$data_sel_share['BSHRID'];
		$del_share="delete from share_blog where SHRID='".$BSHRID."'";
		$res_del_share=mysql_query($del_share,$linkid);
	}
}

if ($num_sel_comments >0 )
{
	while($data_sel_comments=mysql_fetch_array($res_sel_comments))
	{
		$BLCMTID=$data_sel_comments['BLCMTID'];
		$del_comments="delete from blog_comments where BLCMTID='".$BLCMTID."'";
		$res_del_comments=mysql_query($del_comments,$linkid);
	}	
}


$del_post="delete from blog where BLID='".$post_id."'";
$res_del_post=mysql_query($del_post,$linkid);

echo "Successfully Deleted!!!";

?>