<?php
session_start();
$uid=$_SESSION['UID'];
$uname=$_SESSION['UNAME'];
include "../includes/check_session.php";
include "../db/common_db.php";
require "../includes/phpfunctions.php";
$linkid=db_connect();

$requested_page = $_POST['page_num'];
$set_limit = (($requested_page - 1) * 3) . ",3";
?>

 <style>
        
	    #more{
			background: none repeat scroll 0 0 #EEEEEE;
			border: 1px solid #CFCFCF;
			color: #000000;
			display: none;
			font-weight: bold;
			left: 1100px;
			padding: 5px;
			position: fixed;
			top: 100px;

	    }
	    #no-more{
			background: none repeat scroll 0 0 #EEEEEE;
			border: 1px solid #CFCFCF;
			color: #000000;
			display: none;
			font-weight: bold;
			left: 1100px;
			padding: 5px;
			position: fixed;
			top: 100px;

	    }
        </style>
<script type="application/javascript">
var page = 1;
$(document).ready(function() {
	var posttotal= $('#totalpost').val();
	var comtotal=  $('#totalcom').val();	
	
	var commenttotal=  $('#totalcom').val();
	comtotal=parseInt(comtotal, 10) + parseInt(posttotal, 10); //comtotal+posttotal
	var i;
	var j;
	var k;
	for (i=1;i<=posttotal;i++)
	{
		$('#comment_post'+i).css("display","none");	  	
		$('#editcomment_postcom'+i).css("display","none"); 
		$('#like'+i).css("display","none"); 	  
		$('#delete'+i).css("display","none"); 	  
		//$('#share'+i).css("display","none"); 
	}
	
	for (j=1;j<=comtotal;j++)
	{		
		$('#comment_postcom'+j).css("display","none");			
		for (k=1;k<=commenttotal;k++)
		{
			$('#'+j+'editcomment_post'+k).css("display","none");
		}  
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
		$('#editcomment_postcom'+i).css("display","none");    
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


function fnupdatepost(userid,postid,txtid,action,id)
{
	var post_value=jQuery.trim($('#'+txtid).val());
	if ((post_value != "" || post_value.match(/(\w+\s)*\w+[.?!]/)) && action == "update" )
	{
		url='update_userpost.php';
		data=new Object();
		data['txteditcompost']=$('#'+txtid).val();
		data['user_id']=userid;
		data['post_id']=postid;
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
	
	if (action == "cancel")
	{
		$('#userpost'+id).css("display","block");
		$('#editcomment_postcom'+id).css("display","none");
	}
}

function fnshoweditdiv(stringval,id)
{
	$('#editcomment_postcom'+id).css("display","none");
	$('#userpost'+id).css("display","none");
	$('#'+stringval).css("display","block");
}

function fncomdeleteprof(userid,comid,postid)
{	
	if (userid != "" && comid != ""  && postid != "")
	{
		url='delete_usercomments.php';
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
		 	 $('#content_userpost').load('user_profile_post.php');	
		  } //function to be called on successful reply from server
		});
	}
}


function fnshoweditdivcom(stringval,id,psid)
{
	$('#'+id+'editcomment_post'+psid).css("display","none");	
	$('#'+id+'user_comments'+psid).css("display","none");
	$('#'+stringval).css("display","block");
}

function fnupdatecommentcom(usid,comid,txtid,action,id,psid)
{
	var post_value=jQuery.trim($('#'+txtid).val());
	if ((post_value != "" || post_value.match(/(\w+\s)*\w+[.?!]/)) && action == "update" )
	{
		url='update_usercommt.php';
		data=new Object();
		data['txteditcomcomment']=$('#'+txtid).val();
		data['usid']=usid;
		data['comid']=comid;
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
	if (action == "cancel")
	{
		$('#'+id+'user_comments'+psid).css("display","block");
		$('#'+id+'editcomment_post'+psid).css("display","none");
	}
}


 </script>

<?php

echo $select="select POSTID,POST,UID,POSTDATE,POSTTIME from post where UID='".$uid."' and PSTATUS=1 order by POSTID DESC limit ".$set_limit;
//code for home page
/*$select="select POSTID,POST,UID from post where UID in(select FRNID from friends 
		where UID='".$uid."' ) or UID='".$uid."' and PSTATUS=1 order by POSTID desc";*/
$res_select=mysql_query($select,$linkid);
$num_select=mysql_num_rows($res_select);

if ($num_select > 0)
{ 
?>
	<?php
	$num_count=1;
	while($data_select=mysql_fetch_array($res_select))
	{ ?>
	
           <?php
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
		
			//code for shares
		$select_shared="select * from share where POSTID='".$postid."'";
		$res_select_shared=mysql_query($select_shared,$linkid);
		$num_select_shared=mysql_num_rows($res_select_shared);
		
		// end of shares
		
		// code for likes
		$select_liked="select * from likes where POSTID='".$postid."'";
		$res_select_liked=mysql_query($select_liked,$linkid);
		$num_select_liked=mysql_num_rows($res_select_liked);
	
		//end of likes
		
		$timezone = "Asia/Calcutta";
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$curtime=date('Y-m-d H:i:s');
		
		$post_timeval =date_diffval($POSTTIME, $curtime);

	?>
     
         <table width="100%" align="left" height="100%" cellpadding="0" cellspacing="0" id="tableborder" >
	<tr>
    <td width="15%"><input type="hidden" name="totalpost" id="totalpost" value="<?php echo $num_select; ?>" /></td><td width="85%"><b><?php echo $uname;?></b></td><td width="2%"><a href="#" onclick="fnshoweditdiv('editcomment_postcom<?php echo $num_count; ?>','<?php echo $num_count; ?>'); return false">Edit</a></td>
    </tr>
    <tr>
    <td valign="top"><img src="<?php echo $userphoto;?>"  width="60" height="60"  /></td><td colspan="2">
	<div id="userpost<?php echo $num_count;?>"><?php echo $post;?></div>
     <div id="editcomment_postcom<?php echo $num_count; ?>">
			<form method="post" action="#" 	>
				<textarea rows="2"  cols="39" autofocus="autofocus"
                name="txteditcompost<?php echo $num_count; ?>" id="txteditcompost<?php echo $num_count; ?>" ><?php echo $post; ?></textarea>
				<input type="button" width="88" height="20"  value="Update" name="Submitcom" 
                onclick="fnupdatepost('<?php echo $uid; ?>','<?php echo $postid; ?>','txteditcompost<?php echo $num_count;?>','update','<?php echo $num_count;?>'); return false;" />
                <input type="button" name="cancel" value="Cancel" width="88" height="20" 
                 onclick="fnupdatepost('<?php echo $uid; ?>','<?php echo $postid; ?>','txteditcompost<?php echo $num_count;?>','cancel','<?php echo $num_count;?>'); return false;"  />
			</form>
			</div>
    </td>
    </tr>
    <?php
    //code for comments
		$sel_com="Select * from comments where POSTID='".$postid."' order by CMTID asc ";
		$res_sel_com=mysql_query($sel_com,$linkid);
		$num_rows_compost=mysql_num_rows($res_sel_com);	
		
		if($num_rows_compost > 0)
		{	
			$num_com_count=1;
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
				<table width="100%" height="100%" cellpadding="0" cellspacing="0" >
					<tr>
					  <td width="12%"><input type="hidden" name="totalcom" id="totalcom" value="<?php echo $num_rows_compost; ?>" /></td><td width="68%"><b><?php echo $cuname;?></b></td>
					  <td width="20%">
                      <?php if ($comuid == $uid) { ?>
                      <a href="#" onclick="fnshoweditdivcom('<?php echo $num_count; ?>editcomment_post<?php echo $num_com_count; ?>','<?php echo $num_count; ?>','<?php echo $num_com_count; ?>'); return false" >Edit </a>&nbsp;&nbsp;
                      <a href="#" onclick="fncomdeleteprof('<?php echo $uid; ?>','<?php echo $comid;?>','<?php echo $postid;?>'); return false;" >Delete</a>
                      <?php } ?>
                      </td>                      
					</tr>
					<tr>
						<td valign="top"><img src="<?php echo $comuserphoto;?>"  width="40" height="40"  /></td>
                        <td colspan="2">
                        <div id="<?php echo $num_count;?>user_comments<?php echo $num_com_count; ?>"><?php echo $ctext;?></div>
                      	  <?php if ($comuid == $uid) { ?>
                        <div id="<?php echo $num_count;?>editcomment_post<?php echo $num_com_count; ?>" >
                    <form method="post" action="#" 	>
                        <textarea rows="2"  cols="35" autofocus="autofocus"
                        name="txteditpost<?php echo $num_count; ?>" id="txteditpost<?php echo $num_count; ?>" ><?php echo $ctext; ?></textarea>
                        <input type="button" width="88" height="20"  value="Update" name="Submitcom" 
                        onclick="fnupdatecommentcom('<?php echo $uid; ?>','<?php echo $comid; ?>','txteditpost<?php echo $num_count;?>','update','<?php echo $num_count;?>','<?php echo $num_com_count;?>'); return false;" />
                        <input type="button" name="cancel" value="Cancel" width="88" height="20" 
                         onclick="fnupdatecommentcom('<?php echo $uid; ?>','<?php echo $comid; ?>','txteditpost<?php echo $num_count;?>','cancel','<?php echo $num_count;?>','<?php echo $num_com_count;?>'); return false;"  />
                    </form>
                    </div>
                    <? }?>
                        
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
			<td>&nbsp;</td>
			<td colspan="2"><?php echo $post_timeval; ?> 
		<!--<a href="#" onclick="fnshow_hidedivcom('likecom<?php // echo $num_count;?>'); return false">Like</a>-->.
		<a href="#" onclick="fnshow_hidedivcom('comment_postcom<?php echo $num_count;  ?>'); return false">Comment</a>.
		<!--<a href="#" onclick="fnshow_hidedivcom('sharecom<?php //echo $num_count; ?>'); return false">Share</a>.-->
     
		<a href="#" onclick="fnshow_hidedivcom('deletecom<?php echo $num_count; ?>'); return false">Delete</a>&nbsp; <?php if ($num_select_liked > 0) { echo $num_select_liked." Likes"; }?> 
  &nbsp; <?php if ($num_select_shared > 0) { echo $num_select_shared." Shares"; }?> </td>
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
			<a href="#" onclick="fnshow_hidediv('delete<?php echo $num_count;  ?>'); return false">Delete</a> &nbsp; <?php if ($num_select_liked > 0) { echo $num_select_liked." Likes"; }?> 
  &nbsp; <?php if ($num_select_shared > 0) { echo $num_select_shared." Shares"; }?> </td>
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