<?php  //code to fetch info details of the user
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
		$userphoto=$UPHOTO;
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
	
	?> 	<table width="90%" height="90%" cellpadding="0" cellspacing="0" align="left"  >
    <tr><td colspan="2"></td></tr>
	<tr>
    	<td width="30%" ><img src="<?php echo $userphoto; ?>" width="225" height="225"  /></td>
        <td width="70%">
        	<table width="90%" height="100%" cellpadding="0" cellspacing="0" align="left" >
            	<tr><td width="21%">Username </td><td width="79%"><?php echo $UNAME; ?></td></tr>
                <tr><td>Name </td><td><?php echo $UFULLNAME; ?></td></tr>
                <?php if ($ugender_val != "") { ?>
                	<tr><td>Gender </td><td><?php echo $ugender_val; ?> </td></tr>
                <?php } if ($UOCCUPATION != "") {?>
                <tr><td>Occupation </td><td><?php echo $UOCCUPATION; ?></td></tr>
                <?php } if ($UINDUSTRY != "") {?>
                <tr><td>Industry </td><td><?php echo $UINDUSTRY; ?></td></tr>
                <?php } if ($UINTEREST != "") {?>
                <tr><td>Interests </td><td><?php echo $UINTEREST; ?></td></tr>
                <?php } if ($UPLACE != "") { ?>
                <tr><td>Place </td><td><?php echo $UPLACE; ?></td></tr>
                <?php } ?>
            </table>
        </td>
    </tr>
      <tr><td colspan="2">
     	<table width="100%" height="100%" cellpadding="0" cellspacing="0"> 
      	<?php if($UBIO != "" ) { ?>     
            <tr><td width="17%" valign="top">Bio</td>
            <td width="83%"><?php echo $UBIO;?></td></tr>
        <?php } if($UWEBSITE != "" ) { ?>	
			<tr><td width="17%" height="24">Website</td>
            <td width="83%"><?php echo $UWEBSITE; ?></td></tr>
        <?php } if($UEMAILID != "" ) { ?>
        <tr>
            <td width="17%" height="24">Email</td>
            <td width="83%"><?php echo $UEMAILID; ?></td></tr>
        <?php }?>	
      	</table>     
     </td></tr>	
</table>
</div>
<?php
} ?>