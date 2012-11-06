<?php
session_start();
$uid=$_SESSION['UID'];
$uname=$_SESSION['UNAME'];
include "../includes/check_session.php";
include "../db/common_db.php";
require "../includes/phpfunctions.php";
$linkid=db_connect();

$select_request="select * from friends where FRIENDID='".$uid."' and FSTATUS='0'";
$res_select_request=mysql_query($select_request,$linkid);
$num_select_request=mysql_num_rows($res_select_request);
?>
<script type="application/javascript" >
function fnconfirmrequest(frnusrid,uid)
{
	
	if (frnusrid != "" && uid != "" )
	{
		url='save_frndrequest.php';
		data=new Object();
		data['frnusrid']=frnusrid;
		data['uid']=uid;
		$.ajax({
		  type: 'POST', // type of request either Get or Post
		  url: url, // Url of the page where to post data and receive response 
		  data: data, // data to be post
		  success: function(data){ 
			 alert (data);
		 	 $('#friend_req').load('friend_request.php');	
		  } //function to be called on successful reply from server
		});
	}
}
</script>
<div id="friend_req">
<table width="100%" height="100%" cellpadding="0" cellspacing="0" align="center"  >
<?php

if ($num_select_request > 0)
{
	while( $data_select_request= mysql_fetch_array($res_select_request))
	{
		$usrid=$data_select_request['UID'];
		
		$select_user="select UPHOTO,UNAME from users where UID='".$usrid."'";
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
		}
		?>
		<tr style="border-bottom:1px solid #999">
        	<td width="20%" height="91" align="center" valign="top">
            <img src="<?php echo $userphoto; ?>" width="60" height="60"  /></td>
            <td width="80%" valign="top">&nbsp;<?php echo $username; ?>
            <br />
            <form name="frm_frndreq" id="frm_frndreq" action="#"  method="post">
            <input type="button" name="Confirm" value="Confirm" 
            onClick="fnconfirmrequest('<?php echo $usrid;?> ','<?php echo $uid;?> '); return false" />&nbsp;&nbsp;&nbsp;
           <!-- <input type="button" name="Ignore" value="Ignore" />-->
            </form>
            
            </td>
           
        </tr>		
<?php
	}
}
?> 
</table>
</div>