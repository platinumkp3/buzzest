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
	var posttotal= $('#totalpost').val();
	var comtotal=  $('#totalcom').val();
	comtotal=parseInt(comtotal, 10) + parseInt(posttotal, 10); //comtotal+posttotal
	var i;
	var j;
	for (i=1;i<=posttotal;i++)
	{		
		$('#comment_post'+i).css("display","none");   
		$('#like'+i).css("display","none"); 	  
		$('#delete'+i).css("display","none"); 	  
		//$('#share'+i).css("display","none"); 
	}
	
	for (j=1;j<=comtotal;j++)
	{		
		$('#comment_postcom'+j).css("display","none");   
		$('#likecom'+j).css("display","none"); 	  
		$('#deletecom'+j).css("display","none"); 	  
		//$('#sharecom'+j).css("display","none"); 
	}
	
	
});

function fnshow_hidediv(stringval)
{
	var posttotal= $('#totalpost').val();
	var i;
	for (i=1;i<=posttotal;i++)
	{		
		$('#comment_post'+i).css("display","none");   
		$('#like'+i).css("display","none"); 	  
		$('#delete'+i).css("display","none"); 	  
		//$('#share'+i).css("display","none"); 
		$('#'+stringval).css("display","block");
	}
}

function fnshow_hidedivcom(stringval)
{
	var posttotal= $('#totalpost').val();
	var comtotal=  $('#totalcom').val();
	comtotal=parseInt(comtotal, 10) + parseInt(posttotal, 10); //comtotal+posttotal
	var j;
	for (j=1;j<=comtotal;j++)
	{		
		$('#comment_postcom'+j).css("display","none");    
		$('#likecom'+j).css("display","none"); 	  
		$('#deletecom'+j).css("display","none"); 	  
		//$('#sharecom'+j).css("display","none"); 
		$('#'+stringval).css("display","block");
	}
	
}

function fnsavecomments(userid,postid,txtid)
{
	var post_value=jQuery.trim($('#'+txtid).val());
	if (post_value != "" || post_value.match(/(\w+\s)*\w+[.?!]/) )
	{
		url='saveuser_comments.php';
		data=new Object();
		data['txtcompost']=$('#'+txtid).val();
		data['userid']=userid;
		data['postid']=postid;
		$.ajax({
		  type: 'POST', // type of request either Get or Post
		  url: url, // Url of the page where to post data and receive response 
		  data: data, // data to be post
		  success: function(data){ 
			 alert (data);
		 	 $('#content_userpost').load('user_profile_post.php');	
		  } //function to be called on successful reply from server
		});
	}
}

function fnprofdelete(user_id,post_id,string_val)
{
	
	if (user_id != "" && post_id !="" && string_val == "Yes")
	{
		url='delete_profuser.php';
		data=new Object();
		data['user_id']=user_id;
		data['post_id']=post_id;
		$.ajax({
		  type: 'POST', // type of request either Get or Post
		  url: url, // Url of the page where to post data and receive response 
		  data: data, // data to be post
		  success: function(data){ 
			 alert (data);
		 	 $('#content_userpost').load('user_profile_post.php');	
		  } //function to be called on successful reply from server
		});
	}
	else if ( string_val == "No")
	{
		$('#content_userpost').load('user_profile_post.php');	
	}
}

</script>
<?php

$select="select POSTID,POST,UID,POSTDATE,POSTTIME from post where UID='".$uid."' and PSTATUS=1 order by POSTID DESC";
//code for home page
/*$select="select POSTID,POST,UID from post where UID in(select FRNID from friends 
		where UID='".$uid."' ) or UID='".$uid."' and PSTATUS=1 order by POSTID desc";*/
$res_select=mysql_query($select,$linkid);
$num_select=mysql_num_rows($res_select);

if ($num_select > 0)
{
	$num_count=1;
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
		
		$post_timeval =date_diffval($POSTTIME, $curtime);

	?>
         <table width="100%" height="100%" cellpadding="0" cellspacing="0" id="tableborder" >
	<tr>
    <td width="15%"><input type="hidden" name="totalpost" id="totalpost" value="<?php echo $num_select; ?>" /></td><td width="85%"><b><?php echo $uname;?></b></td><td width="2%"><img src="../images/valid.png"  /></td>
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
			while( $data_sel_com=mysql_fetch_array($res_sel_com))
			{
				$comid=$data_sel_com['CMTID'];
				$comuid=$data_sel_com['UID'];
				$ctext=$data_sel_com['CTEXT'];
				$ctime=$data_sel_com['CTIME'];
				
				$select_comuser="select UPHOTO,UNAME from users where UID='".$comuid."'";
				$res_comuser=mysql_query($select_comuser,$linkid);
				$data_comuser=mysql_fetch_array($res_comuser);
				$comuphoto=$data_comuser['UPHOTO'];
				$cuname=$data_comuser['UNAME'];
				if ($comuphoto != "")
				{
					$comuserphoto=$comuphoto;
				}
				else
				{
					$comuserphoto="../images/humanicon.jpg";			
				}
		?>
			<tr>
				<td>&nbsp;</td>
				<td>
				<table width="105%" height="100%" cellpadding="0" cellspacing="0" >
					<tr>
					  <td width="15%"><input type="hidden" name="totalcom" id="totalcom" value="<?php echo $num_rows_compost; ?>" /></td><td width="81%"><b><?php echo $cuname;?></b></td>
					  <td width="4%">&nbsp;</td>
					</tr>
					<tr>
						<td valign="top"><img src="<?php echo $comuserphoto;?>"  width="60" height="60"  /></td><td colspan="2"><?php echo $ctext;?></td>
					</tr>
				</table>
				</td>
			</tr>
		<?php
			}
		?>
		<tr>
			<td>&nbsp;</td><td colspan="2"><?php echo $post_timeval; ?> 
		<!--<a href="#" onclick="fnshow_hidedivcom('likecom<?php // echo $num_count;?>'); return false">Like</a>-->.
		<a href="#" onclick="fnshow_hidedivcom('comment_postcom<?php echo $num_count;  ?>'); return false">Comment</a>.
		<!--<a href="#" onclick="fnshow_hidedivcom('sharecom<?php //echo $num_count; ?>'); return false">Share</a>.-->
		<a href="#" onclick="fnshow_hidedivcom('deletecom<?php echo $num_count; ?>'); return false">Delete</a> </td>
			</tr>
			<tr>   
			<td colspan="2"><div id="comment_postcom<?php echo $num_count; ?>">
			<form method="post" action="#" 
			onsubmit="fnsavecomments('<?php echo $uid; ?>','<?php echo $postid; ?>','txtcompost<?php echo $num_count;?>'); return false;">
				<textarea rows="2"   cols="39"  autofocus="autofocus"
                name="txtcompost<?php echo $num_count; ?>" id="txtcompost<?php echo $num_count; ?>" > </textarea>
				<input type="submit"   width="88" height="20"  value="post" name="Submitcom" />
			</form>
			</div>
			<!--<div id="likecom<?php //echo $num_count;  ?>">
			Like
			</div>
			<div id="sharecom<?php //echo $num_count;  ?>">
			Share
			</div>-->
			<div id="deletecom<?php echo $num_count;  ?>">
              <br />
           
			<form name="frmprofdelete" id="frmprofdelete"  >
           	  <label>Are u sure u want to delete ?</label>
               <input type="button" name="yes" value="Yes" 
                onclick="fnprofdelete('<?php echo $uid; ?>','<?php echo $postid; ?>','Yes'); return false " />          
            	<input type="button" name="no" value="No" 
                 onclick="fnprofdelete('<?php echo $uid; ?>','<?php echo $postid; ?>','No'); return false " /> 
             </form>
			</div>
			</td> 
		</tr>
		<?php
		} 
		else 
		{
			?>
			 <tr>
			<td>&nbsp;</td><td colspan="2"><?php echo $post_timeval; ?> .
			<!--<a href="#" onclick="fnshow_hidediv('like<?php //echo $num_count;  ?>'); return false">Like</a>.-->
			<a href="#" onclick="fnshow_hidediv('comment_post<?php echo $num_count;  ?>'); return false">Comment</a>.
			<!--<a href="#" onclick="fnshow_hidediv('share<?php //echo $num_count;  ?>'); return false">Share</a>.-->
			<a href="#" onclick="fnshow_hidediv('delete<?php echo $num_count;  ?>'); return false">Delete</a> </td>
			</tr>
			<tr>   
			<td colspan="2"><div id="comment_post<?php echo $num_count; ?>">
			<form method="post" action="#"
			 onsubmit="fnsavecomments('<?php echo $uid; ?>','<?php echo $postid; ?>','txtcompost<?php echo $num_count; ?>'); return false">
				<textarea rows="2"   cols="39"  autofocus="autofocus"
                 name="txtcompost<?php echo $num_count; ?>" id="txtcompost<?php echo $num_count; ?>"   > </textarea>
				<input type="submit"   width="88" height="20"  value="post" name="Submit" />
			</form>
			</div>
			<!--<div id="like<?php //echo $num_count; ?>">
			Like
			</div>
			<div id="share<?php //echo $num_count; ?>">
			Share
			</div>-->
			<div id="delete<?php echo $num_count; ?>">
             <br />
			<form name="frmprofdelete" id="frmprofdelete"  >
            	<label>Are u sure u want to delete ?</label>
                <input type="button" name="yes" value="Yes" 
                onclick="fnprofdelete('<?php echo $uid; ?>','<?php echo $postid; ?>','Yes'); return false " />
                <input type="button" name="no" value="No" 
                 onclick="fnprofdelete('<?php echo $uid; ?>','<?php echo $postid; ?>','No'); return false " /> 
             </form>
			</div>
			</td>  </tr>
			<?php 
		} ?>
</table>
		
<?php	
 $num_count++;			
	}
}
?>