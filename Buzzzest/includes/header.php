<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Buzzzest</title>
<link href="../css/home.css" type="text/css" rel="stylesheet" />
<link href="../css/style.css" type="text/css" rel="stylesheet"/>
<link href="../css/content.css" type="text/css" rel="stylesheet" />
<script src="../js/jquery-1.8.2.js" type="application/javascript" >
</script>

<!-- Add jQuery library -->
<script type="text/javascript" src="../js/fancybox/jquery-1.8.2.min.js"></script>

<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="../js/fancybox/jquery.mousewheel-3.0.6.pack.js"></script>

<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="../js/fancybox/jquery.fancybox.js?v=2.1.3"></script>
<link rel="stylesheet" type="text/css" href="../css/fancybox/jquery.fancybox.css?v=2.1.2" media="screen" />
<script type="application/javascript" >
$(document).ready(function() {
	
	$('.fancybox').fancybox();
});
</script>


</head>

<body>
 
<div class="container">
  <div class="header">Buzzzest
  <input type="text" value="Search" />
	
  &nbsp;&nbsp;<a href="../home/home.php">Home</a>&nbsp;&nbsp; <a href="../profile/profile.php" >Profile</a>&nbsp;&nbsp;
  <a href="../qandans/QandAns.php" >Q & A</a>&nbsp;&nbsp;  
   <a href="../blog/blog.php" >Blog</a>&nbsp;&nbsp; <a href="../message/message.php" >Messages</a>&nbsp;&nbsp;
    <a href="../job/job.php" >Job</a> &nbsp;&nbsp;  
   <a href="../logout.php">Logout</a>  &nbsp;&nbsp;  
  
   <?php 
   include "../db/common_db.php";
   $linkid=db_connect();
   $uid_val=$_SESSION['UID'];
   $select_request="select * from friends where FRIENDID='".$uid_val."' and FSTATUS='0'";
   $res_select_request=mysql_query($select_request,$linkid);
   $num_select_request=mysql_num_rows($res_select_request);
   if ($num_select_request > 0)
   { ?>
		<a  class="fancybox fancybox.ajax" href="../home/friend_request.php?uid=<?php echo $uid_val;?>" ><strong><?php echo $num_select_request;?></strong> Friend Request(s) Pending </a>    
   <?php } ?>
        <div style="float:right;"><?php echo $_SESSION['UNAME']; ?></div>
    <!-- end .header --></div>