<?php
session_start();
$uid=$_SESSION['UID'];
$uname=$_SESSION['UNAME'];
include "../includes/check_session.php";
include "../db/common_db.php";
$linkid=db_connect();

$postid=$_REQUEST['postid'];
$select_shared="select * from share_blog where BLID='".$postid."'";
$res_select_shared=mysql_query($select_shared,$linkid);
$num_select_shared=mysql_num_rows($res_select_shared);
?>

<table width="100%" height="100%" cellpadding="0" cellspacing="0" align="center"  >

<?php
if ($num_select_shared > 0)
{
	while ($data_select_shared=mysql_fetch_array($res_select_shared))
	{
		$uid_share=$data_select_shared['UID'];
		$select_user="select UPHOTO,UNAME from users where UID='".$uid_share."'";
		$res_select_user=mysql_query($select_user,$linkid);
		$data_select_user=mysql_fetch_array($res_select_user);
		$user_photo=$data_select_user['UPHOTO'];
		$username=$data_select_user['UNAME'];
		if ($user_photo != "")
		{
			$userphoto=$user_photo;
		}
		else
		{
			$userphoto="../images/humanicon.jpg";			
		} ?>
		<tr style="border-bottom:1px solid #999">
        	<td width="20%" height="91" align="center" valign="top">
            <img src="<?php echo $userphoto; ?>" width="60" height="60"  /></td>
            <td width="80%" valign="top">&nbsp;<?php echo $username; ?></td>
        </tr>		
<?php }
}

?>
</table>