<?php
session_start();
$uid=$_SESSION['UID'];
$uname=$_SESSION['UNAME'];
include "../includes/check_session.php";
include "../db/common_db.php";
require "../includes/phpfunctions.php";
$linkid=db_connect();
?>
<script type="application/javascript">
$(document).ready(function() {
	$('#comment_post').css("display","none");   
	$('#like').css("display","none"); 	  
	$('#delete').css("display","none"); 	  
	$('#share').css("display","none"); 
});
function fnshow_hidediv(stringval)
{
	$('#comment_post').css("display","none");    
	$('#like').css("display","none"); 	  
	$('#delete').css("display","none"); 	  
	$('#share').css("display","none"); 
	$('#'+stringval).css("display","block");
}

function fnsavecomments(userid,postid)
{
	var post_value=jQuery.trim($('#txtcompost').val());
	if (post_value != "" || post_value.match(/(\w+\s)*\w+[.?!]/) )
	{
		url='saveuser_comments.php';
		data=new Object();
		data['txtcompost']=$('#txtcompost').val();
		data['userid']=userid;
		data['postid']=postid;
		$.ajax({
		  type: 'POST', // type of request either Get or Post
		  url: url, // Url of the page where to post data and receive response 
		  data: data, // data to be post
		  success: function(data){ 
			 alert (data);
		 	 //$('#content_userpost').load('user_profile_post.php');	
		  } //function to be called on successful reply from server
		});
	}
}
</script>
<?php

$select="select POSTID,POST,UID,POSTDATE,POSTTIME from post where UID='".$uid."' and PSTATUS=1";
//code for home page
/*$select="select POSTID,POST,UID from post where UID in(select FRNID from friends 
		where UID='".$uid."' ) or UID='".$uid."' and PSTATUS=1 order by POSTID desc";*/
$res_select=mysql_query($select,$linkid);
$num_select=mysql_num_rows($res_select);

if ($num_select > 0)
{
	while($data_select=mysql_fetch_array($res_select))
	{
		$post=$data_select['POST'];
		$postid=$data_select['POSTID'];
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
		
		$post_timeval =date_diff($POSTTIME, $curtime);

	?>
         <table width="100%" height="100%" cellpadding="0" cellspacing="0" id="tableborder" >
	<tr>
    <td width="15%">&nbsp;</td><td width="85%"><b><?php echo $uname;?></b></td><td width="2%"><img src="../images/valid.png"  /></td>
    </tr>
    <tr>
    <td valign="top"><img src="<?php echo $userphoto;?>"  width="60" height="60"  /></td><td colspan="2"><?php echo $post;?></td>
    </tr>
    <?php
    //code for comments
		$sel_com="Select * from comments where POSTID='".$postid."' order by CMTID asc ";
		$res_sel_com=mysql_query($sel_com,$linkid);
		$num_rows_compost=mysql_num_rows($res_sel_com);	
		if($num_rows_compost > 0)
		{	
		
		}
		else 
		{
		?>
         <tr>
        <td>&nbsp;</td><td colspan="2"><?php echo $post_timeval; ?> .
        <a href="#" onclick="fnshow_hidediv('like')">Like</a>.
        <a href="#" onclick="fnshow_hidediv('comment_post')">Comment</a>.
        <a href="#" onclick="fnshow_hidediv('share')" >Share</a>.
        <a href="#" onclick="fnshow_hidediv('delete')">Delete</a> </td>
        </tr>
        <tr>   
        <td colspan="2"><div id="comment_post">
        <form method="post" action="#" onsubmit="fnsavecomments('<?php echo $uid; ?>','<?php echo $postid; ?>'); return false">
            <textarea rows="2"   cols="39"  name="txtcompost" id="txtcompost"   > </textarea>
            <input type="submit"   width="88" height="20"  value="post" name="Submit" />
        </form>
        </div>
        <div id="like">
        Like
        </div>
        <div id="share">
        Share
        </div>
        <div id="delete">
        Delete
        </div>
        </td>  </tr>
    <?php 
		} ?>
</table>
		
<?php				
	}
}

?>

