<?php
session_start();
$uid=$_SESSION['UID'];
$uname=$_SESSION['UNAME'];
include "../includes/check_session.php";
include "../db/common_db.php";
require "../includes/phpfunctions.php";
$linkid=db_connect();


$select="select POST,UID,POSTDATE,POSTTIME from post where UID='".$uid."' and PSTATUS=1";
$res_select=mysql_query($select,$linkid);
$num_select=mysql_num_rows($res_select);

if ($num_select > 0)
{
	while($data_select=mysql_fetch_array($res_select))
	{
		$post=$data_select['POST'];
		$POSTDATE=$data_select['POSTDATE'];
		$POSTTIME=$data_select['POSTTIME'];
		$post_time=explode(" ",$POSTTIME);
		$posttimeval=$post_time[1];
		$user_select="select UPHOTO from users where UID='".$uid."'";
		$res_userselect=mysql_query($user_select,$linkid);
		$data_userselect=mysql_fetch_array($res_userselect);
		$uphoto=$data_userselect['UPHOTO'];
		if ($uphoto != "")
		{
			$userphoto=$uphoto;
		}
		else
		{
			$userphoto="../images/humanicon.jpg";			
		}
		
		$timezone = "Asia/Calcutta";
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$curtime=date('Y-m-d H:i:s');
		
		
//////////////////////////////////////////////////////// 
// Short version, compare with current time 

$post_timeval =date_diff($POSTTIME, $curtime);

	?>
         <table width="100%" height="100%" cellpadding="0" cellspacing="0" id="tableborder" >
	<tr>
    <td width="15%">&nbsp;</td><td width="85%"><b><?php echo $uname;?></b></td><td width="2%"><img src="../images/valid.png"  /></td>
    </tr>
    <tr>
    <td valign="top"><img src="<?php echo $userphoto;?>"  width="60" height="60"  /></td><td colspan="2"><?php echo $post;?></td>
    </tr>
     <tr>
    <td>&nbsp;</td><td colspan="2"><?php echo $post_timeval; ?> .<a href="">Like</a>.<a href="">Comment</a>.<a href="">Share</a>.
    <a href="">Delete</a> </td>
    </tr>     
</table>
		
<?php				
	}
}

?>

