<?php
session_start();
$uid=$_SESSION['UID'];
$uname=$_SESSION['UNAME'];
include "../includes/check_session.php";
include "../db/common_db.php";
$linkid=db_connect();
// Include the CKEditor class.
include_once "../ckeditor/ckeditor.php";
// Create a class instance

$CKEditor = new CKEditor();

// Replace a textarea element with an id (or name) of "editor1".
$CKEditor->replace("editor1");
?>	
<script type="text/javascript" >
$(document).ready(function() {

   $('#viewstories').hide(""); 
   $("#viewstories").css("display","none");  
 });

function fnshowstories(stringval)
{
 	$('#viewstories').hide("");   
  	$('#poststories').hide("");  
   	$("#poststories").css("display","none");   
   	$("#viewstories").css("display","none");
	if (stringval == "viewstories")
	{
		//$("#viewstories").css("display","block");
		$("#viewstories").load('view_profile_blog.php');
	}
   	$('#'+stringval).css("display","block");
}

function fnsaveblog()
{
	var post_blog=jQuery.trim($('#editor1').val());
	if (post_blog != "" || post_blog.match(/(\w+\s)*\w+[.?!]/) )
	{
		url='save_profileblog_story.php';
		data=new Object();
		data['editor1']=$('#editor1').val();
		$.ajax({
		  type: 'POST', // type of request either Get or Post
		  url: url, // Url of the page where to post data and receive response 
		  data: data, // data to be post
		  success: function(data){ 
			 alert (data);
			$('#poststories').load('profile_blog.php #poststories');
		 	// $('#content_userpost').load('save_profileblog_story.php');	
		  } //function to be called on successful reply from server
		});
	}
}

</script>

<br />
<div>
<a href="#" onClick="fnshowstories('poststories'); return false" >Add Stories</a>&nbsp;&nbsp;
<a href="#" onClick="fnshowstories('viewstories'); return false" >View Stories</a>
</div>
	
<div  id="poststories">
<form action="#" method="post" onSubmit="fnsaveblog(); return false">		
		<textarea cols="50" id="editor1" name="editor1" rows="10"></textarea>	
		<input type="submit" name="submit" value="Submit"/>
</form>
</div>

<div id="viewstories">

</div>
