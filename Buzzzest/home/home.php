<?php
session_start();
include "../includes/check_session.php";
require "../includes/header.php";

$uname=$_SESSION['UNAME'];
$uid=$_SESSION['UID'];
?>
<style type="text/css">
#result {
	font-size:16px;
	font-family:Arial, Helvetica, sans-serif;
	color:#000;
	/*
	height:20px;
	margin-bottom:10px;
	background-color:#FFFF99;*/
}
#country{
	padding:3px;
	border:1px #CCC solid;
	font-size:17px;
}
.suggestionsBox {
	position: absolute;
	margin: 5px 0px 0px 10px;
/*	top:40px;
		
	border-top: 3px solid #000;*/
	width: 100%;
	padding:0px;
	color:#000;
}
/*.suggestionList {
	margin: 0px;
	padding: 0px;
}*/
.suggestionList ul li {
	
	margin: 0px;
	padding: 6px;
	border-bottom:1px dotted #666;
	cursor: pointer;
}
.suggestionListphotos ul li:hover {
	/*background-color: #FC3;*/
	color:#000;
	list-style-type:none;
}
/*ul {
	font-family:Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#000;
	padding:0;
	margin:0;
}*/

.load{
background-image:url(../images/autosuggest/loader.gif);
background-position:right;
background-repeat:no-repeat;
}

#suggest {
	position:relative;
}

</style>
<script src="../js/home.js" type="application/javascript" >
</script>

<script>
function suggest(inputString){
	var uid=$("#user_id").val();
	if(inputString.length == 0) {
		$('#suggestions').fadeOut();
	} else {
	$('#country').addClass('load');
		$.post("autosuggest.php", {queryString: ""+inputString+"",uid: ""+uid+""}, function(data){
			if(data.length >0) {
				$('#suggestions').fadeIn();
				$('#suggestionListphotos').html(data);
				$('#country').removeClass('load');
			}
		});
		
		
	}
}

function fill(thisValue) {
	$('#country').val(thisValue);
}

</script>


  <div class="sidebar1">
    <input type="hidden" id="user_id" value="<? echo $uid; ?>"/>
    <ul class="nav">
      <li><a href="#">Link one</a></li>
      <li><a href="#">Link two</a></li>
      <li><a href="#">Link three</a></li>
      <li><a href="#">Link four</a></li>
    </ul>
    <p> The above links demonstrate a basic navigational structure using an unordered list styled with CSS. Use this as a starting point and modify the properties to produce your own unique look. If you require flyout menus, create your own using a Spry menu, a menu widget from Adobe's Exchange or a variety of other javascript or CSS solutions.</p>
    <p>If you would like the navigation along the top, simply move the ul.nav to the top of the page and recreate the styling.</p>
    <!-- end .sidebar1 --></div>
  <div class="content">
<div style="width:100%" >
Anything to share? 
<form name="frmshare" method="post" >
<textarea name="share" id="share" rows="3" cols="60"  autofocus="autofocus" ></textarea>
</form>
</div>	
<div>
<a href="#" onclick="fnchangehomediv('content_post_home')" >Updates</a>&nbsp;&nbsp;
<a href="#" onclick="fnchangehomediv('list')" >List</a>&nbsp;&nbsp;
<a href="#" onclick="fnchangehomediv('friends')" >Friends</a>&nbsp;&nbsp;
<a href="#" onclick="fnchangehomediv('following')" >Following</a>
</div>
<div id="content_post_home">

</div>

<div id="list">
list
</div>

<div id="friends">
<div id="friendslist">
 <form id="form" action="" onsubmit="fnsendFriendRequest(); return false">
    <div id="suggest">Search friends: <br />
      <input type="text" size="25" value="" id="country" onkeyup="suggest(this.value);" onblur="fill();" class="" />
      <input type="submit" name="Send Friend Request" value="Send Friend Request"  />	
      <div class="suggestionsBox" id="suggestions" style="display: none;"> 
        <!--<div class="suggestionList" id="suggestionsList"> &nbsp; </div>-->
        <br />
        <div class="suggestionListphotos" id="suggestionListphotos"> </div>
		
      </div>
   </div>
</form>
</div>
</div>

<div id="following">
following
</div>


     <!-- end .content --></div>
     
   
<?php
require "../includes/footer.php";
?>