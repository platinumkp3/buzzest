<?php
session_start();
include "../includes/check_session.php";
require "../includes/header.php";
include "../db/common_db.php";
$linkid=db_connect();

$uname=$_SESSION['UNAME'];
$uid=$_SESSION['UID'];
?>

<script src="../js/profile.js" type="application/javascript" >
</script>


<style type="text/css">
  #uploadframe { display:none; }
</style>
<script type="text/javascript" src="../js/upload.js"></script>

   <div class="sidebar1">
   <div  >
   <table width="100%" height="100%" cellpadding="0" cellspacing="0" id="tableborder" >
	
    <tr>
    <td width="12%" valign="top"><img src="../images/female.jpg" width="100" height="100"  /></td>
    <td width="88%" colspan="2" valign="top">
    <table  width="80%" height="80%" cellpadding="0" cellspacing="0"> 
    <tr><td colspan="4" align="left"><h3><?php echo $uname; ?></h3></td></tr>
     <tr id="trbordertop"><td width="24%" id="tdborderlefttop" >Updates</td><td width="26%" id="tdbordertop" >Friends</td><td width="31%" id="tdbordertop" >Followings</td><td width="19%" id="tdborderrighttop" >Followers</td></tr>
     <tr><td id="tdborderleftbottom">&nbsp;</td><td id="tdborderbottom" >&nbsp;</td><td id="tdborderbottom" >&nbsp;</td><td id="tdborderrightbottom">&nbsp;</td></tr>
    </table>   
    </td>
    </tr>    
	</table>
   </div>
   
   <div id="content_postright">
<table width="100%" height="100%" cellpadding="0" cellspacing="0" id="tableborder" >
	<tr>
    <td width="15%">&nbsp;</td><td width="85%"><b><?php echo $uname;?></b></td><td width="2%"><img src="../images/valid.png"  /></td>
    </tr>
    <tr>
    <td valign="top"><img src="../images/bee2.gif" width="60" height="60"  /></td><td colspan="2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </td>
    </tr>
     <tr>
    <td>&nbsp;</td><td colspan="2">3 hours ago .<a href="">Like</a>.<a href="">Comment</a>.<a href="">Share</a>.
    <a href="">Delete</a> </td>
    </tr>
     
</table>
</div>
  <!-- end .sidebar1 --></div>
  
  <div class="content">
   <div id="homemenu">&nbsp;&nbsp;<a href="#" onclick="fnchangediv('content_post')"; >Updates</a>&nbsp;&nbsp;
   <a href="#" onclick="fnchangediv('info')";  >Info</a>&nbsp;&nbsp;
   <a href="#" onclick="fnchangediv('blogs')"; >Blog</a>&nbsp;&nbsp;
   <a href="#" onclick="fnchangediv('qanda')"; >Q & A</a>&nbsp;&nbsp;
   <a href="#" onclick="fnchangediv('photos')"; >Photos</a></div>
  
   <div id="content_post"> <!-- start of .content_post/update link -->
   <form name="frmuserpost" id="frmuserpost" action="" method="post" onSubmit="fnUpdatePost(); return false">
      <div id="homemenu" >
        <textarea name="txtuserpost" id="txtuserpost"  rows="2" cols="60" ></textarea>
        <input type="submit" name="Post" value="Post" />    
      </div>
   </form>
	<div id="content_userpost">
    </div>
   </div> <!-- end of .content_post /update link-->

<div id="blogs"> <!-- start of .blogs -->
Blog
</div> <!-- end of .blogs -->

<div id="photos">  <!-- start of .photos -->
<div id="upphoto">
<form id="uploadform" action="upload_image.php" method="post" enctype="multipart/form-data" target="uploadframe" onsubmit="uploadimg(this); return false">
  <input type="file" id="myfile" name="myfile" />
  <input type="submit" value="Submit" />
  <iframe id="uploadframe" name="uploadframe" src="upload_image.php" width="8" height="8" scrolling="no" frameborder="0"></iframe>
</form>
	
</div>
<br />

<div id="showimg"> </div>
<div id="gallery">
   
</div>

</div>  <!-- end of .photos -->

<div id="info">  <!-- start of .info -->
 <div style="float:right"><a href="#" onclick="fninfoenable()">Edit</a></div>
<?php  //code to fetch info details of the user
$select_info="select 
			UID,UNAME,UFULLNAME,UEMAILID,UBIO,UINDUSTRY,UOCCUPATION,UINTEREST,UGENDER,UWEBSITE,UPHOTO,
			UACCOUNT,UDOB,UPLACE,UDESCRIPTION,UTAGLINE,UTYPE,USPECIALITIES,UMISSION,UFOUNDED,UEMPCOUNT
			from users where UID='".$uid."'";
$result_info=mysql_query($select_info,$linkid);
$num_info=mysql_num_rows($result_info);
if ($num_info > 0)
{
	$data_info=mysql_fetch_array($result_info);
	$UACCOUNT=$data_info['UACCOUNT'];
	$UNAME=$data_info['UNAME'];
	$UFULLNAME=$data_info['UFULLNAME'];
	$UEMAILID=$data_info['UEMAILID'];
	$UINDUSTRY=$data_info['UINDUSTRY'];
	$UOCCUPATION=$data_info['UOCCUPATION'];	
	$UINTEREST=$data_info['UINTEREST'];
	$UGENDER=$data_info['UGENDER'];
	if ($UGENDER == 1)
	{
		$ugender_val="Male";
	}
	else if ($UGENDER == 2)
	{
		$ugender_val="Female";
	}
	$UWEBSITE=$data_info['UWEBSITE'];
	$UPHOTO=$data_info['UPHOTO'];
	if ($UPHOTO != "" && $UPHOTO != NULL)
	{
		$userphoto=$UPHOTO;
	}
	else 
	{
		if ($UGENDER == 2) {
			$userphoto="female.jpg";}
		else if ($UGENDER == 1) {
			$userphoto="male.jpg"; 
		}else {
			$userphoto="";	
		}
		
	}
	
	$UDOB=$data_info['UDOB'];
	$UPLACE=$data_info['UPLACE'];
	$UDESCRIPTION=$data_info['UDESCRIPTION'];
	$UTAGLINE=$data_info['UTAGLINE'];
	$UTYPE=$data_info['UTYPE'];
	$USPECIALITIES=$data_info['USPECIALITIES'];
	$UMISSION=$data_info['UMISSION'];
	$UFOUNDED=$data_info['UFOUNDED'];
	$UEMPCOUNT=$data_info['UEMPCOUNT'];
	$UBIO=$data_info['UBIO'];
	
	?>
  	<div id="infoeditdis">
    <!-- div to display the profile data -->
	</div>

  	<div id="infoedit">
 	<table width="90%" height="90%" cellpadding="0" cellspacing="0" align="left"  >
	</table>
	</div>
<?php
} ?>
</div>  <!-- end .info -->

<div id="qanda">
Q&A
</div>

  <!-- end .content --></div>
<?php
require "../includes/footer.php";
?>