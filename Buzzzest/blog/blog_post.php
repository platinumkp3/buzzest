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
	
	$('.fancybox').fancybox();
	
	var posttotal= $('#totalpost_blog').val();
	var comtotal=  $('#totalblg_blog').val();
	
	var commenttotal=  $('#totalblg_blog').val();
	comtotal=parseInt(comtotal, 10) + parseInt(posttotal, 10); //comtotal+posttotal
	var i;
	var j;
	var k;
	for (i=1;i<=posttotal;i++)
	{		
		$('#comment_postblog'+i).css("display","none"); 
		$('#deleteblog'+i).css("display","none"); 
	}
	
	for (j=1;j<=comtotal;j++)
	{		
		$('#comment_postblogcom'+j).css("display","none");
		for (k=1;k<=commenttotal;k++)
		{
			$('#'+j+'editcomment_post'+k).css("display","none");
		}  
		$('#deleteblogcom'+j).css("display","none"); 
	}
	
});

function fnshow_hidedivblog(stringval)
{
	var posttotal= $('#totalpost_blog').val();
	var i;
	for (i=1;i<=posttotal;i++)
	{		
		$('#comment_postblog'+i).css("display","none"); 
		$('#deleteblog'+i).css("display","none"); 
		$('#'+stringval).css("display","block");
	}
}

function fnshow_hidedivblogcom(stringval)
{
	var posttotal= $('#totalpost_blog').val();
	var comtotal=  $('#totalblg_blog').val();
	comtotal=parseInt(comtotal, 10) + parseInt(posttotal, 10); //comtotal+posttotal
	var j;
	for (j=1;j<=comtotal;j++)
	{		
		$('#comment_postblogcom'+j).css("display","none");
		$('#deleteblogcom'+j).css("display","none"); 
		$('#'+stringval).css("display","block");
	}
	
}

function fnsavecommentsblog(userid,postid,txtid)
{
	var post_value=jQuery.trim($('#'+txtid).val());
	if (post_value != "" || post_value.match(/(\w+\s)*\w+[.?!]/) )
	{
		url='save_blogcomments.php';
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
		 	 $('#content_blog').load('blog_post.php');	
		  } //function to be called on successful reply from server
		});
	}
}

function fnprofdeleteblog(user_id,post_id,string_val)
{	
	if (user_id != "" && post_id !="" && string_val == "Yes")
	{
		url='deleteblog_profuser.php';
		data=new Object();
		data['user_id']=user_id;
		data['post_id']=post_id;
		$.ajax({
		  type: 'POST', // type of request either Get or Post
		  url: url, // Url of the page where to post data and receive response 
		  data: data, // data to be post
		  success: function(data){ 
			 alert (data);
		 	 $('#content_blog').load('blog_post.php');	
		  } //function to be called on successful reply from server
		});
	}
	else if ( string_val == "No")
	{
		$('#content_blog').load('blog_post.php');	
	}
}


function fnprofshareblog(usrid,pst_id,strval,action)
{
	if (usrid != "" && pst_id !="" && strval == "Yes" && action != "")
	{
		url='share_post_blog.php';
		data=new Object();
		data['user_id']=usrid;
		data['post_id']=pst_id;		
		data['action']=action;
		
		$.ajax({
		  type: 'POST', // type of request either Get or Post
		  url: url, // Url of the page where to post data and receive response 
		  data: data, // data to be post
		  success: function(data){
			 alert (data);
		 	 $('#content_blog').load('blog_post.php');	
		  } //function to be called on successful reply from server
		});
	}
}


function fnproflikeblog(usrid_val,pst_id_val,str_value,action)
{
	if (usrid_val != "" && pst_id_val !="" && str_value == "Yes" && action != "")
	{
		url='like_post_blog.php';
		data=new Object();
		data['usrid_val']=usrid_val;
		data['pst_id_val']=pst_id_val;
		data['action']=action;
		
		$.ajax({
		  type: 'POST', // type of request either Get or Post
		  url: url, // Url of the page where to post data and receive response 
		  data: data, // data to be post
		  success: function(data){
			 alert (data);
		 	 $('#content_blog').load('blog_post.php');	
		  } //function to be called on successful reply from server
		});
	}
}

function fnupdatecommentcom(usid,comid,txtid,action,id,psid)
{
	var post_value=jQuery.trim($('#'+txtid).val());
	if ((post_value != "" || post_value.match(/(\w+\s)*\w+[.?!]/)) && action == "update" )
	{
		url='update_blgcomment.php';
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
		 	  $('#content_blog').load('blog_post.php');	
		  } //function to be called on successful reply from server
		});
	}
	if (action == "cancel")
	{
		$('#'+id+'userblogcomment'+psid).css("display","block");
		$('#'+id+'editcomment_post'+psid).css("display","none");
	}
}

function fncomdeleteprof(userid,comid,postid)
{	
	if (userid != "" && comid != ""  && postid != "")
	{
		url='delete_blgcomments.php';
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
		 	  $('#content_blog').load('blog_post.php');	
		  } //function to be called on successful reply from server
		});
	}
}

function fnshoweditdivcom(stringval,id,psid)
{
	$('#'+id+'editcomment_post'+psid).css("display","none");	
	$('#'+id+'userblogcomment'+psid).css("display","none");
	$('#'+stringval).css("display","block");
}

</script>


<?php

//$select="select BLID,BLTEXT,UID,BLDATE,BLTIME from blog where UID in(select FRIENDID from friends where
// UID='".$uid."' and FSTATUS='1' ) order by BLID desc";

$select="select BLID,BLTEXT,UID,BLDATE,BLTIME from blog where UID !='".$uid."' order by BLID desc";
$res_select=mysql_query($select,$linkid);
$num_select=mysql_num_rows($res_select);

if ($num_select > 0)
{
	$num_count=1;
	while($data_select=mysql_fetch_array($res_select))
	{
		$BLTEXT=$data_select['BLTEXT'];
		$BLID=$data_select['BLID'];
		$BLDATE=$data_select['BLDATE'];
		$BLTIME=$data_select['BLTIME'];
		$userid=$data_select['UID'];
		
		//code for shares
		$select_shared="select * from share_blog where BLID='".$BLID."'";
		$res_select_shared=mysql_query($select_shared,$linkid);
		$num_select_shared=mysql_num_rows($res_select_shared);
		if ($num_select_shared > 0)
		{
			while ($data_select_shared=mysql_fetch_array($res_select_shared))
			{
				
				$uid_share=$data_select_shared['UID'];
				if ($uid == $uid_share)
				{
					$shared=1;
				}
				else 
				{
					$shared=0;
				}
			}
		}
		else 
		{
			$shared=0;
		}
		// end of shares
		
		// code for likes
		$select_liked="select * from likes_blog where BLID='".$BLID."'";
		$res_select_liked=mysql_query($select_liked,$linkid);
		$num_select_liked=mysql_num_rows($res_select_liked);
		if ($num_select_liked > 0)
		{
			while ($data_select_liked=mysql_fetch_array($res_select_liked))
			{
				
				$uid_like=$data_select_liked['UID'];
				if ($uid == $uid_like)
				{
					$liked=1;
				}
				else 
				{
					$liked=0;
				}
			}
		}
		else 
		{
			$liked=0;
		}
		//end of likes
		
			
		$user_select="select UPHOTO,UNAME from users where UID='".$userid."'";
		$res_userselect=mysql_query($user_select,$linkid);
		$data_userselect=mysql_fetch_array($res_userselect);
		$uphoto=$data_userselect['UPHOTO'];
		$user_name=$data_userselect['UNAME'];
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
    <td width="15%"><input type="hidden" name="totalpost_blog" id="totalpost_blog" value="<?php echo $num_select; ?>" /></td><td width="85%"><b><?php echo $user_name;?></b></td><td width="2%">&nbsp;</td>
    </tr>
    <tr>
    <td valign="top"><img src="<?php echo $userphoto;?>"  width="60" height="60"  /></td><td colspan="2"><?php echo $BLTEXT;?></td>
    </tr>
    <?php
    //code for comments
		$sel_blog="Select * from blog_comments where BLID='".$BLID."' order by BLCMTID asc ";
		$res_sel_blog=mysql_query($sel_blog,$linkid);
		$num_rows_compost=mysql_num_rows($res_sel_blog);	
		
		if($num_rows_compost > 0)
		{	
			$num_com_count=1;
			while( $data_sel_blog=mysql_fetch_array($res_sel_blog))
			{
				$BLCMTID=$data_sel_blog['BLCMTID'];
				$blguid=$data_sel_blog['UID'];
				$BLCTEXT=$data_sel_blog['BLCTEXT'];
				$BLCTIME=$data_sel_blog['BLCTIME'];
				
				$select_comuser="select UPHOTO,UNAME from users where UID='".$blguid."'";
				$res_comuser=mysql_query($select_comuser,$linkid);
				$data_comuser=mysql_fetch_array($res_comuser);
				$comuphoto=$data_comuser['UPHOTO'];
				$blguname=$data_comuser['UNAME'];
				if ($comuphoto != "")
				{
					$blguserphoto=$comuphoto;
				}
				else
				{
					$blguserphoto="../images/humanicon.jpg";			
				}
		?>
			<tr>
				<td>&nbsp;</td>
				<td>
				<table width="105%" height="100%" cellpadding="0" cellspacing="0" >
					<tr>
					  <td width="12%"><input type="hidden" name="totalblg_blog" id="totalblg_blog" value="<?php echo $num_rows_compost; ?>" /></td><td width="66%"><b><?php echo $blguname;?></b></td>
					  <td width="22%"> <?php if ($blguid == $uid) { ?>
                      <a href="#" onclick="fnshoweditdivcom('<?php echo $num_count; ?>editcomment_post<?php echo $num_com_count; ?>','<?php echo $num_count; ?>','<?php echo $num_com_count; ?>'); return false" >Edit </a>&nbsp;&nbsp;
                        <a href="#" onclick="fncomdeleteprof('<?php echo $uid; ?>','<?php echo $BLCMTID;?>','<?php echo $BLID;?>'); return false;" >Delete</a>
                      <?php } ?></td>
					</tr>
					<tr>
						<td valign="top"><img src="<?php echo $blguserphoto;?>"  width="60" height="60"  /></td>
						<td colspan="2">
						<div id="<?php echo $num_count;?>userblogcomment<?php echo $num_com_count; ?>"><?php echo $BLCTEXT;?></div>
                      	  <?php if ($blguid == $uid) { ?>
                        <div id="<?php echo $num_count;?>editcomment_post<?php echo $num_com_count; ?>" >
                    <form method="post" action="#" 	>
                        <textarea rows="2"  cols="35" autofocus="autofocus"
                        name="txteditpostblog<?php echo $num_count; ?>" id="txteditpostblog<?php echo $num_count; ?>" ><?php echo $BLCTEXT; ?></textarea>
                        <input type="button" width="88" height="20"  value="Update" name="Submitcom" 
                        onclick="fnupdatecommentcom('<?php echo $uid; ?>','<?php echo $BLCMTID; ?>','txteditpostblog<?php echo $num_count;?>','update','<?php echo $num_count;?>','<?php echo $num_com_count;?>'); return false;" />
                        <input type="button" name="cancel" value="Cancel" width="88" height="20" 
                         onclick="fnupdatecommentcom('<?php echo $uid; ?>','<?php echo $BLCMTID; ?>','txteditpostblog<?php echo $num_count;?>','cancel','<?php echo $num_count;?>','<?php echo $num_com_count;?>'); return false;"  />
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
			<td>&nbsp;</td><td colspan="2"><?php echo $post_timeval; ?> 
		<?php 	if ($userid != $uid && $liked == 0 ) {	?>
        .<a href="#" onclick="fnproflikeblog('<?php echo $uid; ?>','<?php echo $BLID; ?>','Yes','save'); return false;">like</a>.
        <?php } else {?>
         <a href="#" onclick="fnproflikeblog('<?php echo $uid; ?>','<?php echo $BLID; ?>','Yes','delete'); return false;">Unlike</a>.         
       <?php  } 	   
	   if ($num_select_liked > 0) {?>
    <a href="blog_liked.php?postid=<?php echo $BLID; ?>"  class="fancybox fancybox.ajax" ><strong><?php echo $num_select_liked; ?></strong> user(s) liked</a>
        <?php }  ?>
		<a href="#" onclick="fnshow_hidedivblogcom('comment_postblogcom<?php echo $num_count;  ?>'); return false">Comment</a>.
         <?php 	if ($userid != $uid  && $shared == 0 ) {	?>
		<a href="#" onclick="fnprofshareblog('<?php echo $uid; ?>','<?php echo $BLID; ?>','Yes','save'); return false">Share</a>
        <?php } else  {?>
        <a href="#" onclick="fnprofshareblog('<?php echo $uid; ?>','<?php echo $BLID; ?>','Yes','delete'); return false ">
       Unshare</a>  
       <?php } 
	   
	   if ($num_select_shared > 0) {?>
 <a href="blog_shared.php?postid=<?php echo $BLID; ?>"  class="fancybox fancybox.ajax" ><strong><?php echo $num_select_shared; ?></strong> user(s) shared</a>
        <?php } ?>
		<!--.<a href="#" onclick="fnshow_hidedivblogcom('deleteblogcom<?php //echo $num_count; ?>'); return false">delete</a> --></td>
			</tr>
			<tr>   
			<td colspan="2"><div id="comment_postblogcom<?php echo $num_count; ?>">
			<form method="post" action="#" 
			onsubmit="fnsavecommentsblog('<?php echo $uid; ?>','<?php echo $BLID; ?>','txtcompost<?php echo $num_count;?>'); return false;">
				<textarea rows="2"   cols="39"  autofocus="autofocus"
                name="txtcompost<?php echo $num_count; ?>" id="txtcompost<?php echo $num_count; ?>" > </textarea>
				<input type="submit"   width="88" height="20"  value="post" name="Submitcom" />
			</form>
			</div>
			
			<div id="deleteblogcom<?php echo $num_count;  ?>">
              <br />           
			<form name="frmprofdeleteblog" id="frmprofdeleteblog" action="#"  method="post"  >
           	  <label>Are u sure u want to delete ?</label>
               <input type="button" name="yes" value="Yes" 
                onclick="fnprofdeleteblog('<?php echo $uid; ?>','<?php echo $BLID; ?>','Yes'); return false " />          
            	<input type="button" name="no" value="No" 
                 onclick="fnprofdeleteblog('<?php echo $uid; ?>','<?php echo $BLID; ?>','No'); return false " /> 
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
			<td>&nbsp;</td>
			<td colspan="2"><?php echo $post_timeval; ?>
			 <?php 	if ($userid != $uid && $liked == 0 ) {	?>
         .<a href="#" onclick="fnproflikeblog('<?php echo $uid; ?>','<?php echo $BLID; ?>','Yes','save'); return false ">like</a>.
       	 <?php } else {?>
          <a href="#" onclick="fnproflikeblog('<?php echo $uid; ?>','<?php echo $BLID; ?>','Yes','delete'); return false ">Unlike</a>.
         <?php }		 
		  if ($num_select_liked > 0) { ?>
                 <a href="blog_liked.php?postid=<?php echo $BLID; ?>"  class="fancybox fancybox.ajax"><strong><?php echo $num_select_liked; ?></strong> user(s) liked</a>
        <?php } ?>
			<a href="#" onclick="fnshow_hidedivblog('comment_postblog<?php echo $num_count;  ?>'); return false">Comment</a>.
            
			 <?php 	if ($userid != $uid && $shared == 0 ) {	?>
             <a href="#"
              onclick="fnprofshareblog('<?php echo $uid; ?>','<?php echo $BLID; ?>','Yes','save'); return false;" >Share</a>	   <?php } else { ?>
             
              <a href="#" 
              onclick="fnprofshareblog('<?php echo $uid; ?>','<?php echo $BLID; ?>','Yes','delete'); return false;" >
               Unshare</a>&nbsp;&nbsp;
               <?php }
			   
               if ($num_select_shared > 0) { ?>
                 <a href="blog_shared.php?postid=<?php echo $BLID; ?>"  class="fancybox fancybox.ajax"><strong><?php echo $num_select_shared; ?></strong> user(s) shared</a>
        <?php } ?>
			<!--.<a href="#" onclick="fnshow_hidedivblog('deleteblog<?php //echo $num_count;  ?>'); return false">delete</a> --></td>
			</tr>
			<tr>   
			<td colspan="2"><div id="comment_postblog<?php echo $num_count; ?>">
			<form method="post" action="#" 
			 onsubmit="fnsavecommentsblog('<?php echo $uid; ?>','<?php echo $BLID; ?>','txtcompost<?php echo $num_count; ?>'); return false">
				<textarea rows="2"   cols="39"  autofocus="autofocus"
                 name="txtcompost<?php echo $num_count; ?>" id="txtcompost<?php echo $num_count; ?>"   > </textarea>
				<input type="submit"   width="88" height="20"  value="post" name="Submit" />
			</form>
			</div>
			
			<div id="deleteblog<?php echo $num_count; ?>">
             <br />
			<form name="frmprofdeleteblog" id="frmprofdeleteblog" action="#"   method="post" >
            	<label>Are u sure u want to delete ?</label>
                <input type="button" name="yes" value="Yes" 
                onclick="fnprofdeleteblog('<?php echo $uid; ?>','<?php echo $BLID; ?>','Yes'); return false " />
                <input type="button" name="no" value="No" 
                 onclick="fnprofdeleteblog('<?php echo $uid; ?>','<?php echo $BLID; ?>','No'); return false " /> 
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