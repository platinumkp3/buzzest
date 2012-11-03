<?php
require "../includes/check_session.php";
// $_SESSION['userid'];
// $_SESSION['username'];
require "../db/db_query.php";

$uid=$_SESSION['userid'];
$username=$_SESSION['username'];

$pro_select="select * from user_deatils where UID='".$uid."'";
$num_rows_profile=numOfRecords($pro_select);	
if($num_rows_profile != 0)
{
	$result_profile=selectQuery($pro_select);
	$profile_pic_path=$result_profile[0]['PROFILEPIC'];
}

?>
<link href="../css/profile.css" rel="stylesheet" type="text/css" media="screen" />

<?php

$mysock = getimagesize($profile_pic_path);

$content="<table width='100%' height='100%'  cellpadding='0' cellspacing='0'  > "; 

 	$select_post="select PSLNO,POST,POSTUID from post_details where POSTUID in(select FRNID from friends_details where uid='".$uid."' ) or POSTUID='".$uid."' order by PSLNO desc ";
	$num_rows_post=numOfRecords($select_post);	
	if($num_rows_post > 0)
	{
		$result_post=selectQuery($select_post);
		$len= sizeof($result_post);
		$lastlen=$len-1;
		for ($i=0;$i<$len;$i++)
		{
			$post=$result_post[$i]['POST'];	
			$postid=$result_post[$i]['POSTUID'];
			$pslno=$result_post[$i]['PSLNO'];
			
			$pro_select="select * from user_deatils where UID='".$postid."'";
			$num_rows_profile=numOfRecords($pro_select);	
			if($num_rows_profile != 0)
			{
				$result_profile=selectQuery($pro_select);
				$profile_pic_path=$result_profile[0]['PROFILEPIC'];
			}
			
			$pro_user="select * from lr_users where LRUSERID='".$postid."'";
			$num_rows_user=numOfRecords($pro_user);	
			if($num_rows_user != 0)
			{
				$result_users=selectQuery($pro_user);
				$user_name=$result_users[0]['FNM'].' '.$result_users[0]['LNM'];
			}
			
			
			if ($i < $lastlen)
			{
				$classid='tdborder';
			}
			else 
			{
				$classid='';
			}
			$content.="<tr ><td id='".$classid."'>";
			 $content.="<table width='100%' height='100%' cellpadding='0' cellspacing='0''>
			 <tr>
			 	<td colspan='2'>";
				  $content .="<table  >
			<tr><td><table width='100%'  cellpadding='0' cellspacing='0' ><tr><td valign='top'>";
			$content.='&nbsp;<img src="'.$profile_pic_path.'""'.imageResize($mysock[0],$mysock[1],65).'" style="padding-top:5px;" />';
		$content.="</td><td valign='top'>";
			$content.="<strong>&nbsp;".$user_name."</strong><br />&nbsp;".$post."</td></tr></table>";

			$content.="</table>";
				 $content.="</td>
			 </tr>";	
		//code for comments
		$sel_com="Select COMMENT_POST,COMID,USERID from comment_post where POSTID='".$pslno."'  order by COMID asc ";
		$num_rows_compost=numOfRecords($sel_com);	
		if($num_rows_compost > 0)
		{	
		
			$content.=" <tr><td width='20%' align='left' valign='top' >&nbsp;";		
			$content.='<img src="'.$profile_pic_path.'""'.imageResize($mysock[0],$mysock[1],150).'" />&nbsp;';		
			$content.="</td><td  valign='top' id='comment'  >";
			
			$result_compost=selectQuery($sel_com);
			$lencom= sizeof($result_compost);
			$lastlencom=$lencom-1;
			
			for ($j=0;$j<$lencom;$j++)
			{			
				$comment=$result_compost[$j]['COMMENT_POST'];	
				$userid=$result_compost[$j]['USERID'];
				
				$pro_selectcom="select * from user_deatils where UID='".$userid."'";
				$num_rows_com=numOfRecords($pro_selectcom);	
				if($num_rows_com != 0)
				{
					$result_comment=selectQuery($pro_selectcom);
					$profile_pic_com=$result_comment[0]['PROFILEPIC'];
				}
				
				$pro_usercom="select * from lr_users where LRUSERID='".$userid."'";
				$num_rows_usercom=numOfRecords($pro_usercom);	
				if($num_rows_usercom != 0)
				{
					$result_userscom=selectQuery($pro_usercom);
					$user_namecom=$result_userscom[0]['FNM'].' '.$result_userscom[0]['LNM'];
				}
				
				$mysock_com = getimagesize($profile_pic_com);
				$content.="<table  cellpadding='0' cellspacing='0'><tr>";
					$content.="<td colspan='2'  valign='top' >";
				$content .="<table cellpadding='0' cellspacing='0'  >
					<tr><td>";
					$content.='<img src="'.$profile_pic_com.'""'.imageResize($mysock_com[0],$mysock_com[1],30).'"  />';
				$content.="</td><td  id='comment_post'>";
					$content.="<strong>&nbsp;".$user_name."</strong><br />&nbsp;".$comment."</td></tr>
						</table></td></tr>";
						
						if ($j == $lencom-1)
						{
							$content.="<tr><td><form id='commmentPost' name='commmentPost' method='post' >";
							$content.=" <textarea rows='1'  cols='39'  name='txtcompost1' id='txtcompost1'  > </textarea>";
							$content.="</form></td><td><input type='image'  width='88' height='20' src='../images/post.png'
										  value='comPost'  onClick='ajaxcomFunction_com(".$uid.",".$pslno.");return false;'  /></td></tr>";
						}
						
						
						$content.="</table>";
			}
			$content.="</td></tr>";
		}
		else
		{
		
			$content.=" <tr>
		    	<td><table >
				<tr><td><form id='commmentPost' name='commmentPost' method='post' >";
			$content.=" <textarea rows='1'  cols='39'  name='txtcompost' id='txtcompost'  > </textarea>";
			$content.="</form></td><td><input type='image'  width='88' height='20' src='../images/post.png'  value='comPost' name='Submit' 
				onClick='ajaxcomFunction(".$uid.",".$pslno.");return false;'  /></td></tr>
				</table></td>
			 </tr>";		 
		}
		
			$content.="</table>";
			 
			 
			 
			$content.="</td></tr>";
		}
		
	}
	else 
	{ 	 
		$content.="<tr><td valign='middle' align='center' > </td>
		<td valign='top' id='tdborder'>&nbsp;</td>
		</tr>";
	}	

$content.="</table>";
echo $content;
 ?>