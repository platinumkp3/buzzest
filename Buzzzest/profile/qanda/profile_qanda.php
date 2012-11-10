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

// Replace a textarea element with an id (or name) of "editorqanda".
//$CKEditor->replace("editorqanda");
?>	
<script type="text/javascript" >
$(document).ready(function() {
	
   $('#ask').hide(""); 
   $("#ask").css("display","none");  
   $("#answers").load('./qanda/view_profile_qanda.php');
   
 });

function fnshow_divs(stringval)
{
 	$('#answers').hide("");   
  	$('#ask').hide("");  
   	$("#ask").css("display","none");   
   	$("#answers").css("display","none");
	if (stringval == "answers")
	{
		$("#answers").css("display","block");
		$("#answers").load('./qanda/view_profile_qanda.php');
	}
   	$('#'+stringval).css("display","block");
}

function fnsaveqanda()
{
	var category_val=$('#qandacategory').val();
	var post_blog=jQuery.trim($('#editorqanda').val());
	if ((post_blog != "" || post_blog.match(/(\w+\s)*\w+[.?!']/))
	 && category_val != "" )
	{
		url='./qanda/save_profileqanda.php';
		data=new Object();
		data['editorqanda']=$('#editorqanda').val();
		data['qandacategory']=$('#qandacategory').val();
		$.ajax({
		  type: 'POST', // type of request either Get or Post
		  url: url, // Url of the page where to post data and receive response 
		  data: data, // data to be post
		  success: function(data){ 
			 alert (data);
			$('#ask').load('./qanda/profile_qanda.php #ask');
		 	// $('#content_userpost').load('save_profileblog_story.php');	
		  } //function to be called on successful reply from server
		});
	}
	else 
	{
		$('#qandacategory').css("border-color","red");
		$('#qandasummary').css("border-color","red");
		$('#qandatitle').css("border-color","red");
		$('#editorqanda').css("border-color","red");
		
	}
}

</script>

<br />
<div>
<a href="#" onClick="fnshow_divs('answers'); return false" >Answer Questions</a>&nbsp;&nbsp;
<a href="#" onClick="fnshow_divs('ask'); return false" >Ask Questions</a>
</div>
	
<div  id="ask">
<form action="#" method="post" onSubmit="fnsaveqanda(); return false;">
<table width="90%" height="100%" cellpadding="0" cellspacing="0" >	
    <tr>
        <td>Category: </td>
        <td><select name="qandacategory" id="qandacategory" >
                <?php  //CATEGORYID -2 for QandA,1 for Blog 
                $select_cat="SELECT * from category where CATSTATUS='1' and CATEGORYID='2'"; 
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
    	<td>&nbsp;</td>
        <td><textarea cols="50" id="editorqanda" autofocus="autofocus"  name="editorqanda" rows="10"></textarea></td>
    </tr>
    <tr>
    	<td>&nbsp;</td>
        <td><input type="submit" name="submit" value="Submit"/></td>
    </tr>    
    </table>
</form>
</div>

<div id="answers">
</div>