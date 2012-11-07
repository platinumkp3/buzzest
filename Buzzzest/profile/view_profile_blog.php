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
	var postblogtotal= $('#totalpostblog').val();
	var comblogtotal=  $('#totalcomblog').val();
	comblogtotal=parseInt(comblogtotal, 10) + parseInt(postblogtotal, 10);;
	var i;
	var j;
	for (i=1;i<=postblogtotal;i++)
	{		
		$('#comment_postblog'+i).css("display","none");   
		$('#likeblog'+i).css("display","none"); 	  
		$('#deleteblog'+i).css("display","none"); 	  
		$('#shareblog'+i).css("display","none"); 
	}
	
	for (j=1;j<=comblogtotal;j++)
	{		
		$('#comment_postcomblog'+j).css("display","none");   
		$('#likecomblog'+j).css("display","none"); 	  
		$('#deletecomblog'+j).css("display","none"); 	  
		$('#sharecomblog'+j).css("display","none"); 
	}	
	
});

function fnshow_hidediv(stringval)
{
	var postblogtotal= $('#totalpostblog').val();
	var i;
	for (i=1;i<=postblogtotal;i++)
	{		
		$('#comment_postblog'+i).css("display","none");   
		$('#likeblog'+i).css("display","none"); 	  
		$('#deleteblog'+i).css("display","none"); 	  
		$('#shareblog'+i).css("display","none"); 
		$('#'+stringval).css("display","block");
	}
}

function fnshow_hidedivcom(stringval)
{
	var postblogtotal= $('#totalpostblog').val();
	var comblogtotal=  $('#totalcomblog').val();
	comblogtotal=parseInt(comblogtotal,10)+parseInt(postblogtotal,10);
	var j;
	for (j=1;j<=comblogtotal;j++)
	{		
		$('#comment_postcomblog'+j).css("display","none");    
		$('#likecomblog'+j).css("display","none"); 	  
		$('#deletecomblog'+j).css("display","none"); 	  
		$('#sharecomblog'+j).css("display","none"); 
		$('#'+stringval).css("display","block");
	}
	
}

function fnsavecomments(userid,postid,txtid)
{
	var post_value=jQuery.trim($('#'+txtid).val());
	if (post_value != "" || post_value.match(/(\w+\s)*\w+[.?!']/) )
	{
		url='saveuser_blog_comments.php';
		data=new Object();
		data['txtblcompost']=$('#'+txtid).val();
		data['userid']=userid;
		data['postid']=postid;
		$.ajax({
		  type: 'POST', // type of request either Get or Post
		  url: url, // Url of the page where to post data and receive response 
		  data: data, // data to be post
		  success: function(data){ 
			 alert (data);
		 	$('#profile_blog_view').load('view_profile_blog.php');	
		  } //function to be called on successful reply from server
		});
	}
}


function fnblogdelete(user_id,post_id,string_val)
{
	if (user_id != "" && post_id !="" && string_val == "Yes")
	{
		url='delete_bloguser.php';
		data=new Object();
		data['user_id']=user_id;
		data['post_id']=post_id;
		$.ajax({
		  type: 'POST', // type of request either Get or Post
		  url: url, // Url of the page where to post data and receive response 
		  data: data, // data to be post
		  success: function(data){ 
			 alert (data);
		 	$('#profile_blog_view').load('view_profile_blog.php');		
		  } //function to be called on successful reply from server
		});
	}
	else if ( string_val == "No")
	{
		$('#profile_blog_view').load('view_profile_blog.php');	
	}
}

</script>
<div id="profile_blog_view">
<?php

$select="select BLID,BLTEXT,UID,BLDATE,BLTIME,CATID,BLTITLE,BLSUMMARY
		 from blog where UID='".$uid."' and BLSTATUS=1 order by BLID DESC";
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
		$blog=$data_select['BLTEXT'];
		$blogid=$data_select['BLID'];
		$BLDATE=$data_select['BLDATE'];
		$BLTIME=$data_select['BLTIME'];
		$CATID=$data_select['CATID'];
		$BLTITLE=$data_select['BLTITLE'];
		$BLSUMMARY=$data_select['BLSUMMARY'];
				
		$category_sel="select CATNAME from category where CATID='".$CATID."'";
		$res_category_sel=mysql_query($category_sel,$linkid);
		$num_category_sel=mysql_num_rows($res_category_sel);
		if ($num_category_sel>0)
		{
			$data_category_sel=mysql_fetch_array($res_category_sel);
			$category_val=$data_category_sel['CATNAME'];					
		}
		else
		{
			$category_val="";
		}
				
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
		
		$post_timeval =date_diffval($BLTIME, $curtime);

	?>
         <table width="100%" height="100%" cellpadding="0" cellspacing="0" id="tableborder" >
	<tr>
    <td width="15%"><input type="hidden" name="totalpostblog" id="totalpostblog" value="<?php echo $num_select; ?>" /></td><td width="85%"><b><?php echo $uname;?></b></td><td width="2%"> <a href="#" onclick="fnshoweditdiv('editcomment_postcom<?php echo $num_count; ?>','<?php echo $num_count; ?>'); return false">Edit</a></td>
    </tr>
    <tr>
    <td valign="top"><img src="<?php echo $userphoto;?>"  width="60" height="60"  /></td>
	<td colspan="2">
		<table width="90%" height="100%" cellpadding="0" cellspacing="0">
			<tr>
            	<td height="22"><strong><?php echo $BLTITLE; ?></strong></td>
          </tr>
            <tr>
            	<td><div id="userblog"><?php echo $BLSUMMARY; ?>
                <br />
                <?php echo $blog;?></div>
                </td>
            </tr>            
        </table>
	
	</td>
    </tr>
    <?php
    //code for comments
		$sel_com="Select * from blog_comments where BLID='".$blogid."' order by BLCMTID asc ";
		$res_sel_com=mysql_query($sel_com,$linkid);
		$num_rows_compost=mysql_num_rows($res_sel_com);	
		
		if($num_rows_compost > 0)
		{	
			while( $data_sel_com=mysql_fetch_array($res_sel_com))
			{
				$blcomid=$data_sel_com['BLCMTID'];
				$blcomuid=$data_sel_com['UID'];
				$blctext=$data_sel_com['BLCTEXT'];
				$blctime=$data_sel_com['BLCTIME'];
								
				$select_comuser="select UPHOTO,UNAME from users where UID='".$blcomuid."'";
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
					  <td width="13%"><input type="hidden" name="totalcomblog" id="totalcomblog" value="<?php echo $num_rows_compost; ?>" /></td><td width="70%"><b><?php echo $cuname;?></b></td>
					  <td width="17%"> <?php if ($blcomuid == $uid) { ?>
                      <a href="#" onclick="fnshoweditdivcom('editcomment_post<?php echo $num_count; ?>','<?php echo $num_count; ?>'); return false" >Edit </a>&nbsp;&nbsp;
                      <a href="#" onclick="fncomdeleteprof('<?php echo $uid; ?>','<?php echo $blcomid;?>','<?php echo $blogid;?>'); return false;" >Delete</a>
                      <?php } ?></td>
					</tr>
					<tr>
						<td valign="top"><img src="<?php echo $comuserphoto;?>"  width="40" height="40"  /></td>
						<td colspan="2"><div id="userblogcomment"><?php echo $blctext;?></div></td>
					</tr>
				</table>
				</td>
			</tr>
		<?php
			}
		?>
		<tr>
			<td>&nbsp;</td><td colspan="2"><?php echo $post_timeval; ?> . <?php echo $category_val." . ";?> 
			<!--<a href="#" 
            onclick="fnshow_hidedivcom('likecomblog<?php// echo $num_count;  ?>'); return false">like</a>.-->
			<a href="#" 
            onclick="fnshow_hidedivcom('comment_postcomblog<?php echo $num_count;  ?>'); return false">Comment</a>.
			<!--<a href="#" 
            onclick="fnshow_hidedivcom('sharecomblog<?php //echo $num_count; ?>'); return false">Share</a>-->
			<a href="#" onclick="fnshow_hidedivcom('deletecomblog<?php echo $num_count; ?>'); return false">delete</a> </td>
			</tr>
			<tr>   
			<td colspan="2"><div id="comment_postcomblog<?php echo $num_count; ?>">
			<form method="post" action="#" 
			onsubmit="fnsavecomments('<?php echo $uid; ?>','<?php echo $blogid; ?>','txtblcompost<?php echo $num_count;?>'); return false;">
				<textarea rows="2"   cols="39" autofocus="autofocus"
                 name="txtblcompost<?php echo $num_count; ?>" id="txtblcompost<?php echo $num_count; ?>" > </textarea>
				<input type="submit"   width="88" height="20"  value="post" name="Submit" />
			</form>
			</div>
			<!--<div id="likecomblog<?php //echo $num_count;  ?>">
			like blog
			</div>
			<div id="sharecom<?php //echo $num_count;  ?>">
			Share blog
			</div>-->
			<div id="deletecomblog<?php echo $num_count;  ?>">
			 <br />           
			<form name="frmprofdelete" id="frmprofdelete"  >
           	  <label>Are u sure u want to delete ?</label>
               <input type="button" name="yes" value="Yes" 
                onclick="fnblogdelete('<?php echo $uid; ?>','<?php echo $blogid; ?>','Yes'); return false " />          
            	<input type="button" name="no" value="No" 
                 onclick="fnblogdelete('<?php echo $uid; ?>','<?php echo $blogid; ?>','No'); return false " /> 
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
			<td>&nbsp;</td><td colspan="2"><?php echo $post_timeval; ?> . <?php echo $category_val." . ";?> 
			<!--<a href="#" onclick="fnshow_hidediv('likeblog<?php //echo $num_count;  ?>'); return false">like</a>.-->
			<a href="#" onclick="fnshow_hidediv('comment_postblog<?php echo $num_count;  ?>'); return false">Comment</a>.
			<!--<a href="#" onclick="fnshow_hidediv('shareblog<?php //echo $num_count;  ?>'); return false">Share</a>.-->
			<a href="#" onclick="fnshow_hidediv('deleteblog<?php echo $num_count;  ?>'); return false">delete</a> </td>
			</tr>
			<tr>   
			<td colspan="2"><div id="comment_postblog<?php echo $num_count; ?>">
			<form method="post" action="#"
			 onsubmit="fnsavecomments('<?php echo $uid; ?>','<?php echo $blogid; ?>','txtblcompost<?php echo $num_count; ?>'); return false;">
				<textarea rows="2"  cols="39" autofocus="autofocus" 
                 name="txtblcompost<?php echo $num_count; ?>" id="txtblcompost<?php echo $num_count; ?>"  > </textarea>
				<input type="submit"   width="88" height="20"  value="post" name="Submit" />
			</form>
			</div>
			<!--<div id="likeblog<?php //echo $num_count; ?>">
			like blog
			</div>
			<div id="shareblog<?php //echo $num_count; ?>">
			Share blog
			</div>-->
			<div id="deleteblog<?php echo $num_count; ?>">
			 <br />           
			<form name="frmprofdelete" id="frmprofdelete"  >
           	  <label>Are u sure u want to delete ?</label>
               <input type="button" name="yes" value="Yes" 
                onclick="fnblogdelete('<?php echo $uid; ?>','<?php echo $blogid; ?>','Yes'); return false " />         
            	<input type="button" name="no" value="No" 
                 onclick="fnblogdelete('<?php echo $uid; ?>','<?php echo $blogid; ?>','No'); return false " /> 
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
</div>