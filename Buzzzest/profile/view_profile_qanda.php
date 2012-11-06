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
	var postqatotal= $('#totalpostqanda').val();
	var comqatotal=  $('#totalcomqanda').val();
	comqatotal=parseInt(comqatotal, 10) + parseInt(postqatotal, 10);;
	var i;
	var j;
	for (i=1;i<=postqatotal;i++)
	{		
		$('#comment_postqanda'+i).css("display","none");   
		$('#likeqanda'+i).css("display","none"); 	  
		$('#deleteqanda'+i).css("display","none"); 	  
		$('#shareqanda'+i).css("display","none"); 
	}
	
	for (j=1;j<=comqatotal;j++)
	{		
		$('#comment_postcomqanda'+j).css("display","none");   
		$('#likecomqanda'+j).css("display","none"); 	  
		$('#deletecomqanda'+j).css("display","none"); 	  
		$('#shareqandablog'+j).css("display","none"); 
	}	
	
});

function fnshow_qahidediv(stringval)
{
	var postqatotal= $('#totalpostqanda').val();
	var i;
	for (i=1;i<=postqatotal;i++)
	{		
		$('#comment_postqanda'+i).css("display","none");   
		$('#likeqanda'+i).css("display","none"); 	  
		$('#deleteqanda'+i).css("display","none"); 	  
		$('#shareqanda'+i).css("display","none"); 
		$('#'+stringval).css("display","block");
	}
}

function fnshow_qahidedivcom(stringval)
{
	var postqatotal= $('#totalpostqanda').val();
	var comqatotal=  $('#totalcomqanda').val();
	comqatotal=parseInt(comqatotal,10)+parseInt(postqatotal,10);
	var j;
	for (j=1;j<=comqatotal;j++)
	{		
		$('#comment_postcomqanda'+j).css("display","none");    
		$('#likecomqanda'+j).css("display","none"); 	  
		$('#deletecomqanda'+j).css("display","none"); 	  
		$('#shareqandablog'+j).css("display","none"); 
		$('#'+stringval).css("display","block");
	}
	
}

function fnsavecommentsqa(userid,postid,txtid)
{
	var post_value=jQuery.trim($('#'+txtid).val());
	if (post_value != "" || post_value.match(/(\w+\s)*\w+[.?!']/) )
	{
		url='saveuser_qanswers.php';
		data=new Object();
		data['txtqacompost']=$('#'+txtid).val();
		data['userid']=userid;
		data['postid']=postid;
		$.ajax({
		  type: 'POST', // type of request either Get or Post
		  url: url, // Url of the page where to post data and receive response 
		  data: data, // data to be post
		  success: function(data){ 
			 alert (data);
		 	$('#profile_blog_view').load('view_profile_qanda.php');	
		  } //function to be called on successful reply from server
		});
	}
}


function fnqandadelete(user_id,post_id,string_val)
{
	
	if (user_id != "" && post_id !="" && string_val == "Yes")
	{
		url='delete_qandauser.php';
		data=new Object();
		data['user_id']=user_id;
		data['post_id']=post_id;
		$.ajax({
		  type: 'POST', // type of request either Get or Post
		  url: url, // Url of the page where to post data and receive response 
		  data: data, // data to be post
		  success: function(data){ 
			 alert (data);
		 	$('#profile_blog_view').load('view_profile_qanda.php');	
		  } //function to be called on successful reply from server
		});
	}
	else if ( string_val == "No")
	{
		$('#profile_blog_view').load('view_profile_qanda.php');	
	}
}

</script>
<div id="profile_blog_view">
<?php

$select="select QID,QDATE,QTIME,QUESTION,CATID from querstions where UID='".$uid."' and QSTATUS=1 order by QID DESC";
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
		$QUESTION=$data_select['QUESTION'];
		$QID=$data_select['QID'];
		$QDATE=$data_select['QDATE'];
		$QTIME=$data_select['QTIME'];
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
		
		$post_timeval =date_diffval($QTIME, $curtime);

	?>
         <table width="100%" height="100%" cellpadding="0" cellspacing="0" id="tableborder" >
	<tr>
    <td width="15%"><input type="hidden" name="totalpostqanda" id="totalpostqanda" value="<?php echo $num_select; ?>" /></td><td width="85%"><b><?php echo $uname;?></b></td><td width="2%"><img src="../images/valid.png"  /></td>
    </tr>
    <tr>
    <td valign="top"><img src="<?php echo $userphoto;?>"  width="60" height="60"  /></td>
	<td colspan="2"><?php echo $QUESTION;?></td>
    </tr>
    <?php
    //code for comments
		$sel_com="Select * from answers where QID='".$QID."' order by ANSID asc ";
		$res_sel_com=mysql_query($sel_com,$linkid);
		$num_rows_compost=mysql_num_rows($res_sel_com);	
		
		if($num_rows_compost > 0)
		{	
			while( $data_sel_com=mysql_fetch_array($res_sel_com))
			{
				$ANSID=$data_sel_com['ANSID'];
				$ansuid=$data_sel_com['UID'];
				$ANSWER=$data_sel_com['ANSWER'];
				$ATIME=$data_sel_com['ATIME'];
								
				$select_comuser="select UPHOTO,UNAME from users where UID='".$ansuid."'";
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
					  <td width="15%"><input type="hidden" name="totalcomqanda" id="totalcomqanda" value="<?php echo $num_rows_compost; ?>" /></td><td width="81%"><b><?php echo $cuname;?></b></td>
					  <td width="4%">&nbsp;</td>
					</tr>
					<tr>
						<td valign="top"><img src="<?php echo $comuserphoto;?>"  width="60" height="60"  /></td>
						<td colspan="2"><?php echo $ANSWER;?></td>
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
            onclick="fnshow_qahidedivcom('likecomqanda<?php //echo $num_count;  ?>'); return false">like</a>.-->
			<a href="#" 
            onclick="fnshow_qahidedivcom('comment_postcomqanda<?php echo $num_count;  ?>'); return false">Comment</a>.
			<!--<a href="#" onclick="fnshow_qahidedivcom('shareqandablog<?php //echo $num_count; ?>'); return false">Share</a>-->
			<a href="#" onclick="fnshow_qahidedivcom('deletecomqanda<?php echo $num_count; ?>'); return false">delete</a> </td>
			</tr>
			<tr>   
			<td colspan="2"><div id="comment_postcomqanda<?php echo $QID; ?>">
			<form method="post" action="#" 
			onsubmit="fnsavecommentsqa('<?php echo $uid; ?>','<?php echo $QID; ?>','txtqacompost<?php echo $num_count;?>'); return false;">
				<textarea rows="2"   cols="39" autofocus="autofocus" name="txtqacompost<?php echo $num_count; ?>" id="txtqacompost<?php echo $num_count; ?>" > </textarea>
				<input type="submit"   width="88" height="20"  value="post" name="Submit" />
			</form>
			</div>
			<!--<div id="likecomqanda<?php //echo $num_count;  ?>">
			like qanda
			</div>
			<div id="shareqanda<?php // echo $num_count;  ?>">
			Share qanda
			</div>-->
			<div id="deletecomqanda<?php echo $num_count;  ?>">
			  <br />
           
			<form name="frmprofdelete" id="frmprofdelete"  >
           	  <label>Are u sure u want to delete ?</label>
               <input type="button" name="yes" value="Yes" 
                onclick="fnqandadelete('<?php echo $uid; ?>','<?php echo $QID; ?>','Yes'); return false " />          
            	<input type="button" name="no" value="No" 
                 onclick="fnqandadelete('<?php echo $uid; ?>','<?php echo $QID; ?>','No'); return false " /> 
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
			<!--<a href="#" 
            onclick="fnshow_qahidediv('likeqanda<?php //echo $num_count;  ?>'); return false">like</a>.-->
			<a href="#" onclick="fnshow_qahidediv('comment_postqanda<?php echo $num_count; ?>'); return false">Comment</a>.
			<!--<a href="#" 
            onclick="fnshow_qahidediv('shareqanda<?php //echo $num_count;  ?>'); return false">Share</a>.-->
			<a href="#" onclick="fnshow_qahidediv('deleteqanda<?php echo $num_count;  ?>'); return false">delete</a> </td>
			</tr>
			<tr>   
			<td colspan="2"><div id="comment_postqanda<?php echo $num_count; ?>">
			<form method="post" action="#"
			 onsubmit="fnsavecommentsqa('<?php echo $uid; ?>','<?php echo $QID; ?>','txtqacompost<?php echo $num_count; ?>'); return false;">
				<textarea rows="2"  cols="39" autofocus="autofocus"  name="txtqacompost<?php echo $num_count; ?>" id="txtqacompost<?php echo $num_count; ?>"  > </textarea>
				<input type="submit"   width="88" height="20"  value="post" name="Submit" />
			</form>
			</div>
			<!--<div id="likeqanda<?php //echo $num_count; ?>">
			like qanda
			</div>
			<div id="shareqanda<?php //echo $num_count; ?>">
			Share qanda
			</div>-->
			<div id="deleteqanda<?php echo $num_count; ?>">
			  <br />
           
			<form name="frmprofdelete" id="frmprofdelete"  >
           	  <label>Are u sure u want to delete ?</label>
               <input type="button" name="yes" value="Yes" 
                onclick="fnqandadelete('<?php echo $uid; ?>','<?php echo $QID; ?>','Yes'); return false " />          
            	<input type="button" name="no" value="No" 
                 onclick="fnqandadelete('<?php echo $uid; ?>','<?php echo $QID; ?>','No'); return false " /> 
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