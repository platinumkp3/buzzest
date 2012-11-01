<?php
session_start();
$uid=$_SESSION['UID'];
include "../db/common_db.php";
$linkid=db_connect();
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
		$userphoto="../".$UPHOTO;
	}
	else 
	{
		if ($UGENDER == 2) {
			$userphoto="../images/female.jpg";}
		else if ($UGENDER == 1) {
			$userphoto="../images/male.jpg"; 
		}else {
			$userphoto="../images/humanicon.jpg";	
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

<link href="../css/popstyle.css" rel="stylesheet" type="text/css" />
<script src="../js/jquery-1.8.2.js" type="application/javascript" >
</script>
<script src="../js/jquery.validate.js" type="application/javascript" >
</script>

<style type="text/css" >

form.cmxform label.error, label.error {
	color: red;
	
	font-style: bold
}

div.error { display: none; }

input {border: 1px solid black; }

#clicker
{
	font-size:20px;
	/*cursor:pointer;*/			
}

#popup-wrapper
{
	width:500px;
	height:300px;
	background-color:#ccc;
	padding:10px;
	display : none;
}

#close_button
{
	float:right;
	height:10%;
}

</style>

<script type="application/javascript">
$(document).ready(function() {
	
 	$("#commentForm").validate({
		rules: {	
			username:{
				required:true
			},
			fullname:{
				required: true,	
			},
			occupation:{
				required: true,	
			},
			industry:{
				required: true,	
			},
			interests:{
				required: true,	
			},
			place:{
				required: true,	
			},
			bio:{
				required: true,	
			},
			email:{
				required: true,	
				email :true
			},			
			url: {		
				required: true,			
				url : true			
				}
			},
			 success: function(label) {    	
	    		
	    }
		});
});

function fnUpdateProfile()
{
	url='update_profile.php';
	data=new Object();
	data['username']=$('#username').val();
	data['fullname']=$('#fullname').val();
	data['gender']=$('#gender').val();
	data['occupation']=$('#occupation').val();
	data['industry']=$('#industry').val();
	data['interests']=$('#interests').val();
	data['place']=$('#place').val();
	data['bio']=$('#bio').val();
	data['url']=$('#url').val();
	data['email']=$('#email').val();
	
	$.ajax({
	  type: 'POST', // type of request either Get or Post
	  url: url, // Url of the page where to post data and receive response 
	  data: data, // data to be post
	  success: function(data){ 
	  //alert(data); 
	  

	  } //function to be called on successful reply from server
	});
	
}

</script>

<div id="popup-wrapper">
		<div id="close_button"> <a href="" id="close-btn" align="right">
        <img src="../images/close1.jpg" width="30" height="30" onclick="fnprof_refresh();"> </a></div>
		<br />
	      <div id="container">
            <div id="header"><div id="header_left"></div>
            <div id="header_main">Upload Image</div><div id="header_right"></div></div>
            <div id="content">
               <form action="upload_profimage.php" method="post" enctype="multipart/form-data" 
               target="upload_target"  onsubmit="startUpload();" >
             <p id="f1_upload_process">Loading...<br/><img src="../images/loader.gif" /><br/></p>
             <p id="f1_upload_form" align="center"><br/>
                 <label>File:  
                      <input name="myfile" type="file" size="30" />
                 </label>
                 <label>
                     <input type="submit" name="submitBtn" class="sbtn" value="Upload" 
                       />
                 </label>
             </p>                     
             <iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;">
             </iframe>

             </div>
         </div>
	</div>
 	<table width="90%" height="90%" cellpadding="0" cellspacing="0" align="left" >
    <tr><td colspan="2"></td></tr>
	<tr>
    	<td width="30%" ><div id="clicker" onClick="enable_pop_up_div()"><img src="<?php echo $userphoto; ?>" width="225" height="225" /></div></td>
        <td width="70%">
        	<table width="97%" height="100%" cellpadding="0" cellspacing="0" align="left" >
            	     <tr><td width="34%">Username </td>
                   <td width="23%"><input type="text" name="username" id="username" value="<?php echo $UNAME;?>"/></td>
                    <td width="43%"><label id="eusername" /></td>
                    </tr>               
                    <tr><td>Name </td>
                    <td><input type="text"  name="fullname" id="fullname" value="<?php echo $UFULLNAME; ?> " /></td>
                    </tr>
                <?php if ($UGENDER != "") { ?>
                        <tr><td>Gender </td>
                        <td><select name="gender" id="gender" > 
                        <option value="1" <?php if ($UGENDER == 1){ ?> selected="selected" <?php }?> >Male</option>
                        <option value="2"  <?php if ($UGENDER == 2){ ?> selected="selected" <?php }?> >Female</option>
                        </select></td>
                         </tr>
                <?php } if ($UOCCUPATION != "") { ?>
                    <tr><td>Occupation </td>
                    <td><input type="text"  name="occupation" id="occupation" value="<?php echo $UOCCUPATION; ?> " />
                   </tr>
                <?php } if ($UINDUSTRY != "") { ?>
                    <tr><td>Industry </td>
                    <td><input type="text" name="industry" id="industry" value="<?php echo $UINDUSTRY; ?> " /></td>
                   </tr>
                <?php } if ($UINTEREST != "") { ?>
                    <tr><td>Interests </td>
                    <td><input type="text" name="interests" id="interests" value="<?php echo $UINTEREST; ?> " /></td>
                   </tr>
                <?php } if ($UPLACE != "") { ?>
                    <tr><td>Place </td>
                    <td><input type="text" name="place" id="place" value="<?php echo $UPLACE; ?> "/></td>
                   </tr>
                <?php } ?>
            </table>
        </td>
    </tr>
      <tr><td colspan="2">
     	<table width="100%" height="44%" cellpadding="0" cellspacing="0"> 
      	<?php if($UBIO != "" ) { ?>  
                <tr><td width="12%" valign="top">Bio</td>
                <td width="88%">
                <textarea rows="3" name="bio" id="bio" cols="50" ><?php echo $UBIO;?></textarea></td>
                </tr>
        <?php } if($UWEBSITE != "" ) { ?>
                <tr><td width="12%" height="28">Website</td>
                <td width="88%">
                <input type="url"  name="url" id="url" size="65" value="<?php echo $UWEBSITE; ?>"/></td>
              </tr>
        <?php } if($UEMAILID != "") {?>
                <tr><td width="12%" height="28">Email </td>
                <td width="88%">
                <input type="email"  name="email" id="email" size="65" value="<?php echo $UEMAILID; ?>"/></td>
               </tr>
        <?php } ?>
        
      	</table>     
     </td></tr>
     
     <tr><td colspan="2">
     <input class="submit" type="submit" value="Submit"/>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <input type="button" value="Cancel" onclick="fninfodisable();"/></td></tr>    
</table>
</form>
<? }?>