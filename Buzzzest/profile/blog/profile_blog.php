<?php
session_start();
$uid=$_SESSION['UID'];
$uname=$_SESSION['UNAME'];
include "../../includes/check_session.php";
include "../../db/common_db.php";
$linkid=db_connect();
// Include the CKEditor class.
//include_once "../../ckeditor/ckeditor.php";
// Create a class instance

//$CKEditor = new CKEditor();

// Replace a textarea element with an id (or name) of "editor1".
//$CKEditor->replace("editor1");
?>	
<script type="text/javascript" >
$(document).ready(function() {
	
   $('#poststories').hide(""); 
   $("#poststories").css("display","none");  
   $("#viewstories").load('./blog/view_profile_blog.php');
   
 });

function fnshowstories(stringval)
{
 	$('#viewstories').hide("");   
  	$('#poststories').hide("");  
   	$("#poststories").css("display","none");   
   	$("#viewstories").css("display","none");
	if (stringval == "viewstories")
	{
		$("#viewstories").css("display","block");
		$("#viewstories").load('./blog/view_profile_blog.php');
	}
   	$('#'+stringval).css("display","block");
}

function fnsaveblog()
{
	var category_val=$('#blogcategory').val();
	var blogtitle=$('#blogtitle').val();
	var blogsummary=$('#blogsummary').val();
	var post_blog=jQuery.trim($('#editor1').val());
	if ((post_blog != "" || post_blog.match(/(\w+\s)*\w+[.?!']/))
	 && category_val != ""  && (blogtitle != "" || blogtitle.match(/(\w+\s)*\w+[.?!']/))
	 && ( blogsummary != "" || blogsummary.match(/(\w+\s)*\w+[.?!']/) ) )
	{
		url='./blog/save_profileblog_story.php';
		data=new Object();
		data['editor1']=$('#editor1').val();
		data['blogcategory']=$('#blogcategory').val();
		data['blogtitle']=$('#blogtitle').val();
		data['blogsummary']=$('#blogsummary').val();
		$.ajax({
		  type: 'POST', // type of request either Get or Post
		  url: url, // Url of the page where to post data and receive response 
		  data: data, // data to be post
		  success: function(data){ 
			 alert (data);
			$('#poststories').load('./blog/profile_blog.php #poststories');
		 	// $('#content_userpost').load('save_profileblog_story.php');	
		  } //function to be called on successful reply from server
		});
	}
	else 
	{
		$('#blogcategory').css("border-color","red");
		$('#blogsummary').css("border-color","red");
		$('#blogtitle').css("border-color","red");
		$('#editor1').css("border-color","red");
		
	}
}

</script>

<br />
<div>
<a href="#" onClick="fnshowstories('viewstories'); return false" >View Blogs</a>&nbsp;&nbsp;
<a href="#" onClick="fnshowstories('poststories'); return false" >Post Blogs</a>
</div>
	
<div  id="poststories">
<form action="#" method="post" onSubmit="fnsaveblog(); return false;">
<table width="90%" height="100%" cellpadding="0" cellspacing="0" >	
    <tr>
        <td>Category: </td>
        <td><select name="blogcategory" id="blogcategory" >
                <?php  //CATEGORYID -2 for QandA,1 for Blog 
                $select_cat="SELECT * from category where CATSTATUS='1' and CATEGORYID='1'";
                $res_select_cat=mysql_query($select_cat,$linkid);
                ?>
                <option value="">Select</option>
                <?
                while ($data_select_cat=mysql_fetch_array($res_select_cat))
                {
                    $CATID=$data_select_cat['CATID'];
                    $CATNAME=$data_select_cat['CATNAME'];				
                    ?>				
                    <option value="<?php echo $CATID; ?>"><?php echo $CATNAME; ?></option>
                    <?php
                }?>
              </select>	
    	 </td>
    </tr>
    <tr>
    	<td>Title: </td>
        <td><input type="text" name="blogtitle" id="blogtitle" size="59" /></td>
    </tr>
    <tr>
    	<td>Summary : </td>
        <td><textarea cols="30" id="blogsummary" autofocus="autofocus"  name="blogsummary" rows="5"></textarea></td>
    </tr>
    <tr>
    	<td>&nbsp;</td>
        <td><textarea cols="50" id="editor1" autofocus="autofocus"  name="editor1" rows="10"></textarea>	</td>
    </tr>
    <tr>
    	<td>&nbsp;</td>
        <td><input type="submit" name="submit" value="Submit"/></td>
    </tr>    
    </table>
</form>
</div>

<div id="viewstories">

</div>
