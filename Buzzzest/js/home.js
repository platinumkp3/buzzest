// JavaScript Document
$(document).ready(function() {
   
   $('#list').hide("");
   $("#list").css("display","none");
   
   $('#friends').hide("");
   $("#friends").css("display","none");
   
   $('#following').hide("");
   $("#following").css("display","none");   
   
});
 
function fnchangehomediv(stringval) 
{
   $('#list').hide("");	
   $('#friends').hide("");	
   $('#following').hide("");
   $('#content_post').hide("");
   $("#content_post").css("display","none");
   $("#list").css("display","none");
   $("#friends").css("display","none");
   $("#following").css("display","none"); 
   $('#'+stringval).css("display","block");	
}

function fnsendFriendRequest()
{
	var post_value=jQuery.trim($('#country').val());
	if (post_value != "" )
	{
		url='send_friendrequest.php';
		data=new Object();
		data['user_name']=post_value;
		$.ajax({
		  type: 'POST', // type of request either Get or Post
		  url: url, // Url of the page where to post data and receive response 
		  data: data, // data to be post
		  success: function(data){ 
			 alert (data);
		 	 //$('#content_userpost').load('user_profile_post.php');	
		  } //function to be called on successful reply from server
		});
	}
}