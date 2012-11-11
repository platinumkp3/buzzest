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
	
	var posttotal= $('#totalpost_qanda').val();
	var comtotal=  $('#totalblg_qanda').val();
	var commenttotal=  $('#totalblg_qanda').val();
	comtotal=parseInt(comtotal, 10) + parseInt(posttotal, 10); //comtotal+posttotal
	var i;
	var j;
	var k;
	for (i=1;i<=posttotal;i++)
	{		
		$('#comment_postqanda'+i).css("display","none"); 
		$('#deleteqanda'+i).css("display","none"); 
	}
	
	for (j=1;j<=comtotal;j++)
	{		
		$('#comment_postqandacom'+j).css("display","none");						
		for (k=1;k<=commenttotal;k++)
		{
			$('#'+j+'editcomment_qanda'+k).css("display","none");
		}   
		$('#deleteqandacom'+j).css("display","none"); 
	}
	
});

function fnshow_hidedivqanda(stringval)
{
	var posttotal= $('#totalpost_qanda').val();
	var i;
	for (i=1;i<=posttotal;i++)
	{		
		$('#comment_postqanda'+i).css("display","none"); 
		$('#deleteqanda'+i).css("display","none"); 
		$('#'+stringval).css("display","block");
	}
}

function fnshow_hidedivqandacom(stringval)
{
	var posttotal= $('#totalpost_qanda').val();
	var comtotal=  $('#totalblg_qanda').val();
	comtotal=parseInt(comtotal, 10) + parseInt(posttotal, 10); //comtotal+posttotal
	var j;
	for (j=1;j<=comtotal;j++)
	{		
		$('#comment_postqandacom'+j).css("display","none");
		$('#deleteqandacom'+j).css("display","none"); 
		$('#'+stringval).css("display","block");
	}
	
}

function fnsavecommentsqanda(userid,postid,txtid)
{
	var post_value=jQuery.trim($('#'+txtid).val());
	if (post_value != "" || post_value.match(/(\w+\s)*\w+[.?!]/) )
	{
		url='save_qandacomments.php';
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
		 	$('#content_qanda').load("qanda_post.php");  	
		  } //function to be called on successful reply from server
		});
	}
}


/*function fnprofdeleteqanda(user_id,post_id,string_val)
{	
	if (user_id != "" && post_id !="" && string_val == "Yes")
	{
		url='deleteqanda_profuser.php';
		data=new Object();
		data['user_id']=user_id;
		data['post_id']=post_id;
		$.ajax({
		  type: 'POST', // type of request either Get or Post
		  url: url, // Url of the page where to post data and receive response 
		  data: data, // data to be post
		  success: function(data){ 
			 alert (data);
		 	$('#content_qanda').load("qanda_post.php");  
		  } //function to be called on successful reply from server
		});
	}
	else if ( string_val == "No")
	{
		$('#content_blog').load('blog_post.php');	
	}
}

function fnprofshareqanda(usrid,pst_id,strval,action)
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
		 	$('#content_qanda').load("qanda_post.php");  	
		  } //function to be called on successful reply from server
		});
	}
}


function fnproflikeqanda(usrid_val,pst_id_val,str_value,action)
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
		 	$('#content_qanda').load("qanda_post.php");  	
		  } //function to be called on successful reply from server
		});
	}
}*/


function fnshoweditdivqanda(stringval,id)
{
	$('#editcomment_qanda'+id).css("display","none");
	$('#userqandacomment'+id).css("display","none");
	$('#'+stringval).css("display","block");
}

function fncomdeleteqanda(userid,comid,postid)
{	
	if (userid != "" && comid != ""  && postid != "")
	{
		url='delete_qacomments.php';
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
		 	$('#content_qanda').load("qanda_post.php");  	
		  } //function to be called on successful reply from server
		});
	}
}

function fnupdatecommentqa(usid,comid,txtid,action,id,psid)
{
	var post_value=jQuery.trim($('#'+txtid).val());
	if ((post_value != "" || post_value.match(/(\w+\s)*\w+[.?!]/)) && action == "update" )
	{
		url='update_qacomment.php';
		data=new Object();
		data['txteditpostqanda']=post_value;
		data['usid']=usid;
		data['comid']=comid;
		$.ajax({
		  type: 'POST', // type of request either Get or Post
		  url: url, // Url of the page where to post data and receive response 
		  data: data, // data to be post
		  success: function(data){ 
			 alert (data);
		 	$('#content_qanda').load("qanda_post.php");  	
		  } //function to be called on successful reply from server
		});
	}
	if (action == "cancel")
	{
		$('#'+id+'userqandacomment'+psid).css("display","block");
		$('#'+id+'editcomment_qanda'+psid).css("display","none");
	}
}

</script>


<?php

$select="select QID,QUESTION,UID,QDATE,QTIME,CATID from querstions order by QID desc";
$res_select=mysql_query($select,$linkid);
$num_select=mysql_num_rows($res_select);

if ($num_select > 0)
{
	$num_count=1;
	while($data_select=mysql_fetch_array($res_select))
	{
		$QUESTION=$data_select['QUESTION'];
		$QID=$data_select['QID'];
		$QDATE=$data_select['QDATE'];
		$QTIME=$data_select['QTIME'];
		$userid=$data_select['UID'];		
		$CATID=$data_select['CATID'];
		
		
		
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
		//code for shares
		/*$select_shared="select * from share_blog where BLID='".$QID."'";
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
		}*/
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
		
		$post_timeval =date_diffval($QTIME, $curtime);

	?>
         <table width="100%" height="100%" cellpadding="0" cellspacing="0" id="tableborder" >
	<tr>
    <td width="15%"><input type="hidden" name="totalpost_qanda" id="totalpost_qanda" value="<?php echo $num_select; ?>" /></td><td width="85%"><b><?php echo $user_name;?></b></td><td width="2%"></td>
    </tr>
    <tr>
    <td valign="top"><img src="<?php echo $userphoto;?>"  width="60" height="60"  /></td><td colspan="2"><?php echo $QUESTION;?></td>
    </tr>
    <?php
    //code for comments
		$sel_qanda="Select * from answers where QID='".$QID."' order by ANSID asc ";
		$res_sel_qanda=mysql_query($sel_qanda,$linkid);
		$num_rows_compost=mysql_num_rows($res_sel_qanda);	
		
		if($num_rows_compost > 0)
		{
			$num_com_count=1;	
			while( $data_sel_qanda=mysql_fetch_array($res_sel_qanda))
			{
				$ANSID=$data_sel_qanda['ANSID'];
				$ans_uid=$data_sel_qanda['UID'];
				$ANSWER=$data_sel_qanda['ANSWER'];
				$ATIME=$data_sel_qanda['ATIME'];
				
				$select_comuser="select UPHOTO,UNAME from users where UID='".$ans_uid."'";
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
					  <td width="14%"><input type="hidden" name="totalblg_qanda" id="totalblg_qanda" value="<?php echo $num_rows_compost; ?>" /></td><td width="64%"><b><?php echo $blguname;?></b></td>
					  <td width="22%"> <?php if ($ans_uid == $uid) { ?>
                      <a href="#" onclick="fnshoweditdivqanda('<?php echo $num_count; ?>editcomment_qanda<?php echo $num_com_count; ?>','<?php echo $num_count; ?>','<?php echo $num_com_count; ?>'); return false" >Edit </a>&nbsp;&nbsp;
                        <a href="#" onclick="fncomdeleteqanda('<?php echo $uid; ?>','<?php echo $ANSID;?>','<?php echo $QID;?>'); return false;" >Delete</a>
                      <?php } ?></td>
					</tr>
					<tr>
						<td valign="top"><img src="<?php echo $blguserphoto;?>"  width="60" height="60"  /></td>
						<td colspan="2">
						 <div id="<?php echo $num_count;?>userqandacomment<?php echo $num_com_count; ?>"><?php echo $ANSWER;?></div>
						 <?php if ($ans_uid == $uid) { ?>
                        <div id="<?php echo $num_count;?>editcomment_qanda<?php echo $num_com_count; ?>" >
                    <form method="post" action="#" 	>
                        <textarea rows="2"  cols="35" autofocus="autofocus"
                        name="txteditpostqanda<?php echo $num_count; ?>"
						 id="txteditpostqanda<?php echo $num_count; ?>" ><?php echo $ANSWER; ?></textarea>
                        <input type="button" width="88" height="20"  value="Update" name="Submitcom" 
                        onclick="fnupdatecommentqa('<?php echo $uid; ?>','<?php echo $ANSID; ?>','txteditpostqanda<?php echo $num_count;?>','update','<?php echo $num_count;?>','<?php echo $num_com_count;?>'); return false;" />
                        <input type="button" name="cancel" value="Cancel" width="88" height="20" 
                         onclick="fnupdatecommentqa('<?php echo $uid; ?>','<?php echo $ANSID; ?>','txteditpostqanda<?php echo $num_count;?>','cancel','<?php echo $num_count;?>','<?php echo $num_com_count;?>'); return false;"  />
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
			<td>&nbsp;</td><td colspan="2"><?php echo $post_timeval; ?>  . <?php echo $category_val." . ";?> 
		
		<a href="#" onclick="fnshow_hidedivqandacom('comment_postqandacom<?php echo $num_count;  ?>'); return false">Comment</a>.
        
		<!--.<a href="#" onclick="fnshow_hidedivqandacom('deleteqandacom<?php //echo $num_count; ?>'); return false">delete</a> --></td>
			</tr>
			<tr>   
			<td colspan="2"><div id="comment_postqandacom<?php echo $num_count; ?>">
			<form method="post" action="#" 
			onsubmit="fnsavecommentsqanda('<?php echo $uid; ?>','<?php echo $QID; ?>','txtcompost<?php echo $num_count;?>'); return false;">
				<textarea rows="2"   cols="39"  autofocus="autofocus"
                name="txtcompost<?php echo $num_count; ?>" id="txtcompost<?php echo $num_count; ?>" > </textarea>
				<input type="submit"   width="88" height="20"  value="post" name="Submitcom" />
			</form>
			</div>
			
			<!-- <div id="deleteqandacom<?php //echo $num_count;  ?>">
              <br />           
			<form name="frmprofdeleteqanda" id="frmprofdeleteqanda" action="#"  method="post"  >
           	  <label>Are u sure u want to delete ?</label>
               <input type="button" name="yes" value="Yes" 
                onclick="fnprofdeleteqanda('<?php //echo $uid; ?>','<?php //echo $BLID; ?>','Yes'); return false " />          
            	<input type="button" name="no" value="No" 
                 onclick="fnprofdeleteqanda('<?php //echo $uid; ?>','<?php //echo $BLID; ?>','No'); return false " /> 
             </form>
			</div> -->
			</td> 
		</tr>
		<?php
		} 
		else 
		{
			?>
			 <tr>
			<td>&nbsp;</td>
			<td colspan="2"><?php echo $post_timeval; ?> . <?php echo $category_val." . ";?> 
			<a href="#" onclick="fnshow_hidedivqanda('comment_postqanda<?php echo $num_count;  ?>'); return false">Comment</a>.
			<!--.<a href="#" onclick="fnshow_hidedivqanda('deleteqanda<?php //echo $num_count;  ?>'); return false">delete</a> --></td>
			</tr>
			<tr>   
			<td colspan="2"><div id="comment_postqanda<?php echo $num_count; ?>">
			<form method="post" action="#" 
			 onsubmit="fnsavecommentsqanda('<?php echo $uid; ?>','<?php echo $QID; ?>','txtcompost<?php echo $num_count; ?>'); return false">
				<textarea rows="2"   cols="39"  autofocus="autofocus"
                 name="txtcompost<?php echo $num_count; ?>" id="txtcompost<?php echo $num_count; ?>"   > </textarea>
				<input type="submit"   width="88" height="20"  value="post" name="Submit" />
			</form>
			</div>
			
			<!--<div id="deleteqanda<?php echo $num_count; ?>">
             <br />
			<form name="frmprofdeleteqanda" id="frmprofdeleteqanda" action="#"   method="post" >
            	<label>Are u sure u want to delete ?</label>
                <input type="button" name="yes" value="Yes" 
                onclick="fnprofdeleteqanda('<?php echo $uid; ?>','<?php echo $BLID; ?>','Yes'); return false " />
                <input type="button" name="no" value="No" 
                 onclick="fnprofdeleteqanda('<?php echo $uid; ?>','<?php echo $BLID; ?>','No'); return false " /> 
             </form>
			</div>-->
			</td>  </tr>
			<?php 
		} ?>
</table>
		
<?php	
 $num_count++;			
	}
}
?>