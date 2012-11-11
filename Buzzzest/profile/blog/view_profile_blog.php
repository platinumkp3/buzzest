<?php
session_start();
$uid=$_SESSION['UID'];
$uname=$_SESSION['UNAME'];
include "../../includes/check_session.php";
include "../../db/common_db.php";
require "../../includes/phpfunctions.php";
$linkid=db_connect();
?>
<script type="application/javascript">
$(document).ready(function() {
	var postblogtotal= $('#totalpostblog').val();
	var comblogtotal=  $('#totalcomblog').val();
	var commenttotal=  $('#totalcomblog').val();
	comblogtotal=parseInt(comblogtotal, 10) + parseInt(postblogtotal, 10);;
	var i;
	var j;
	var k;
	for (i=1;i<=postblogtotal;i++)
	{		
		$('#comment_postblog'+i).css("display","none"); 		  	
		$('#editcomment_blogcom'+i).css("display","none");   
		$('#likeblog'+i).css("display","none"); 	  
		$('#deleteblog'+i).css("display","none"); 	  
		$('#shareblog'+i).css("display","none"); 
	}
	
	for (j=1;j<=comblogtotal;j++)
	{		
		$('#comment_postcomblog'+j).css("display","none");			
		for (k=1;k<=commenttotal;k++)
		{
			$('#'+j+'editcomment_post'+k).css("display","none");
		}  
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
		$('#editcomment_blogcom'+i).css("display","none");   
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
		$('#editcomment_blog'+j).css("display","none");      
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
		url='./blog/saveuser_blog_comments.php';
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
		 	$('#profile_blog_view').load('./blog/view_profile_blog.php');	
		  } //function to be called on successful reply from server
		});
	}
}


function fnblogdelete(user_id,post_id,string_val)
{
	if (user_id != "" && post_id !="" && string_val == "Yes")
	{
		url='./blog/delete_bloguser.php';
		data=new Object();
		data['user_id']=user_id;
		data['post_id']=post_id;
		$.ajax({
		  type: 'POST', // type of request either Get or Post
		  url: url, // Url of the page where to post data and receive response 
		  data: data, // data to be post
		  success: function(data){ 
			 alert (data);
		 	$('#profile_blog_view').load('./blog/view_profile_blog.php');		
		  } //function to be called on successful reply from server
		});
	}
	else if ( string_val == "No")
	{
		$('#profile_blog_view').load('./blog/view_profile_blog.php');	
	}
}

function fncomdeleteprof(userid,comid,postid)
{	
	if (userid != "" && comid != ""  && postid != "")
	{
		url='./blog/delete_blogcomments.php';
		data=new Object();
		data['userid']=userid;
		data['comid']=comid;		
		data['postid']=postid;
		$.ajax({
		  type: 'POST', // type of request either Get or Post
		  url: url, // Url of the page where to post data and receive response 
		  data: data, // data to be post
		  success: function(data){ 
			 alert (data);
		 	 $('#profile_blog_view').load('./blog/view_profile_blog.php');	
		  } //function to be called on successful reply from server
		});
	}
}

function fnshoweditdiv(stringval,id)
{
	$('#editcomment_blogcom'+id).css("display","none");
	$('#userblog'+id).css("display","none");
	$('#userblogsummary'+id).css("display","none");	
	$('#userblogtitle'+id).css("display","none");
	$('#'+stringval).css("display","block");
}


function fnshoweditdivcom(stringval,id,psid)
{
	$('#'+id+'editcomment_post'+psid).css("display","none");	
	$('#'+id+'userblogcomment'+psid).css("display","none");
	$('#'+stringval).css("display","block");
}

function fnupdate_blog(userid,postid,txtid,action,id,txt_title,txt_smry)
{
	var post_value=jQuery.trim($('#'+txtid).val());
	var post_title=jQuery.trim($('#'+txt_title).val());	
	var post_sumry=jQuery.trim($('#'+txt_smry).val());
	
	
	if ( (post_value != "" || post_value.match(/(\w+\s)*\w+[.?!']/))  
	 &&  (post_title != "" || post_title.match(/(\w+\s)*\w+[.?!']/)) 
	 &&  (post_sumry != "" || post_sumry.match(/(\w+\s)*\w+[.?!']/))  && action == "update" )
	{
		url='./blog/update_userblog.php';
		data=new Object();
		data['txteditblog']=post_value;
		data['txteditblogtitle']=post_title;
		data['txteditblogsumry']=post_sumry;
		data['user_id']=userid;
		data['post_id']=postid;
		$.ajax({
		  type: 'POST', // type of request either Get or Post
		  url: url, // Url of the page where to post data and receive response 
		  data: data, // data to be post
		  success: function(data){ 
			 alert (data);
		 	 $('#profile_blog_view').load('./blog/view_profile_blog.php');	
		  } //function to be called on successful reply from server
		});
	}
	
	if (action == "cancel")
	{
		$('#userblog'+id).css("display","block");
		$('#userblogtitle'+id).css("display","block");
		$('#userblogsummary'+id).css("display","block");
		$('#editcomment_blogcom'+id).css("display","none");
	}
}

function fnupdatecommentcom(usid,comid,txtid,action,id,psid)
{
	var post_value=jQuery.trim($('#'+txtid).val());
	if ((post_value != "" || post_value.match(/(\w+\s)*\w+[.?!]/)) && action == "update" )
	{
		url='./blog/update_blogcommt.php';
		data=new Object();
		data['txteditpostblog']=post_value;
		data['usid']=usid;
		data['comid']=comid;
		$.ajax({
		  type: 'POST', // type of request either Get or Post
		  url: url, // Url of the page where to post data and receive response 
		  data: data, // data to be post
		  success: function(data){ 
			 alert (data);
		 	  $('#profile_blog_view').load('./blog/view_profile_blog.php');	
		  } //function to be called on successful reply from server
		});
	}
	if (action == "cancel")
	{
		$('#'+id+'userblogcomment'+psid).css("display","block");
		$('#'+id+'editcomment_post'+psid).css("display","none");
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
		
					//code for shares
		$select_shared="select * from share_blog where BLID='".$blogid."'";
		$res_select_shared=mysql_query($select_shared,$linkid);
		$num_select_shared=mysql_num_rows($res_select_shared);
		
		// end of shares
		
		// code for likes
		$select_liked="select * from likes_blog where BLID='".$blogid."'";
		$res_select_liked=mysql_query($select_liked,$linkid);
		$num_select_liked=mysql_num_rows($res_select_liked);
	
		//end of likes
		
		$timezone = "Asia/Calcutta";
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$curtime=date('Y-m-d H:i:s');
		
		$post_timeval =date_diffval($BLTIME, $curtime);

	?>
         <table width="100%" align="left"  height="100%" cellpadding="0" cellspacing="0" id="tableborder" >
	<tr>
    <td width="13%"><input type="hidden" name="totalpostblog" id="totalpostblog" value="<?php echo $num_select; ?>" /></td><td width="82%"><b><?php echo $uname;?></b></td><td width="5%"> <a href="#" onclick="fnshoweditdiv('editcomment_blogcom<?php echo $num_count; ?>','<?php echo $num_count; ?>'); return false">Edit</a></td>
    </tr>
    <tr>
    <td valign="top"><img src="<?php echo $userphoto;?>"  width="60" height="60"  /></td>
	<td colspan="2">
		<table width="100%" height="100%" cellpadding="0" cellspacing="0">
		 <tr>
            	<td height="22"><div id="userblogtitle<?php echo $num_count; ?>"><strong><?php echo $BLTITLE; ?></strong></div></td>
          </tr>
            <tr>
            	<td><div id="userblogsummary<?php echo $num_count; ?>"><?php echo $BLSUMMARY; ?></div>
                <div id="userblog<?php echo $num_count; ?>"><?php echo $blog;?></div>
                </td>
            </tr>
            <div>
            	<tr>
                	<td>
                    <div id="editcomment_blogcom<?php echo $num_count; ?>">
                <form method="post" action="#" >
                   Title:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text"
                    name="txteditblogtitle<?php echo $num_count; ?>" 
                    id="txteditblogtitle<?php echo $num_count; ?>"
                   value="<?php echo $BLTITLE;?>" />
                       <br />
                   Summary:&nbsp;<input type="text"
                    name="txteditblogsmry<?php echo $num_count; ?>" 
                    id="txteditblogsmry<?php echo $num_count; ?>"
                   value="<?php echo $BLSUMMARY;?>" />
                       <br />
                Content:&nbsp;&nbsp;&nbsp;<textarea rows="2"  cols="39" autofocus="autofocus"
                name="txteditcomblog<?php echo $num_count; ?>"
                 id="txteditcomblog<?php echo $num_count; ?>" ><?php echo $blog; ?></textarea>
                <br />
                    <input type="button" width="88" height="20"  value="Update" name="Submitcom" 
                    onclick="fnupdate_blog('<?php echo $uid; ?>','<?php echo $blogid; ?>',
                    'txteditcomblog<?php echo $num_count;?>','update',
                    '<?php echo $num_count;?>','txteditblogsmry<?php echo $num_count; ?>',
                    'txteditblogtitle<?php echo $num_count; ?>'); return false;" />
                    
                    <input type="button" name="cancel" value="Cancel" width="88" height="20" 
                     onclick="fnupdate_blog('<?php echo $uid; ?>','<?php echo $blogid; ?>',
                     'txteditcomblog<?php echo $num_count;?>',
                     'cancel','<?php echo $num_count;?>',
                     'txteditblogsmry<?php echo $num_count; ?>',
                    'txteditblogtitle<?php echo $num_count; ?>'); return false;"  />
                </form>
                	</div>
                    </td>                
                </tr>
            </div>
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
			$num_com_count=1;
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
					  <td width="13%"><input type="hidden" name="totalcomblog" id="totalcomblog" value="<?php echo $num_rows_compost; ?>" /></td><td width="67%"><b><?php echo $cuname;?></b></td>
					  <td width="20%"> <?php if ($blcomuid == $uid) { ?>
                      <a href="#" onclick="fnshoweditdivcom('<?php echo $num_count; ?>editcomment_post<?php echo $num_com_count; ?>','<?php echo $num_count; ?>','<?php echo $num_com_count; ?>'); return false" >Edit </a>&nbsp;&nbsp;
                        <a href="#" onclick="fncomdeleteprof('<?php echo $uid; ?>','<?php echo $blcomid;?>','<?php echo $blogid;?>'); return false;" >Delete</a>
                      <?php } ?></td>
					</tr>
					<tr>
						<td valign="top"><img src="<?php echo $comuserphoto;?>"  width="40" height="40"  /></td>
						<td colspan="2">
                        <div id="<?php echo $num_count;?>userblogcomment<?php echo $num_com_count; ?>"><?php echo $blctext;?></div>
                      	  <?php if ($blcomuid == $uid) { ?>
                        <div id="<?php echo $num_count;?>editcomment_post<?php echo $num_com_count; ?>" >
                    <form method="post" action="#" 	>
                        <textarea rows="2"  cols="35" autofocus="autofocus"
                        name="txteditpostblog<?php echo $num_count; ?>" id="txteditpostblog<?php echo $num_count; ?>" ><?php echo $blctext; ?></textarea>
                        <input type="button" width="88" height="20"  value="Update" name="Submitcom" 
                        onclick="fnupdatecommentcom('<?php echo $uid; ?>','<?php echo $blcomid; ?>','txteditpostblog<?php echo $num_count;?>','update','<?php echo $num_count;?>','<?php echo $num_com_count;?>'); return false;" />
                        <input type="button" name="cancel" value="Cancel" width="88" height="20" 
                         onclick="fnupdatecommentcom('<?php echo $uid; ?>','<?php echo $blcomid; ?>','txteditpostblog<?php echo $num_count;?>','cancel','<?php echo $num_count;?>','<?php echo $num_com_count;?>'); return false;"  />
                    </form>
                    </div>
                    <?php }?>               
                        </td>
					</tr>
				</table>
				</td>
			</tr>
		<?php
			$num_com_count++;
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
			<a href="#" onclick="fnshow_hidedivcom('deletecomblog<?php echo $num_count; ?>'); return false">Delete</a>&nbsp; <?php if ($num_select_liked > 0) { echo $num_select_liked." Likes"; }?> 
  &nbsp; <?php if ($num_select_shared > 0) { echo $num_select_shared." Shares"; }?> </td>
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
			<a href="#" onclick="fnshow_hidediv('deleteblog<?php echo $num_count;  ?>'); return false">Delete</a>&nbsp; <?php if ($num_select_liked > 0) { echo $num_select_liked." Likes"; }?> 
  &nbsp; <?php if ($num_select_shared > 0) { echo $num_select_shared." Shares"; }?> </td>
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