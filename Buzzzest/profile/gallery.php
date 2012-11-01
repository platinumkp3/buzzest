<?php
session_start();
$uid=$_SESSION['UID'];
include "../db/common_db.php";
$linkid=db_connect();
?>

<!-- stylesheet for light box for photos in profile.page -->
<link rel="stylesheet" type="text/css" href="../css/lightbox/jquery.lightbox-0.5.css" />
<!-- end of stylesheet -->    

<!-- script for light box for photos in profile.page 
<script type="text/javascript" src="js/lightbox/jquery.js"></script>-->
<script type="text/javascript" src="../js/lightbox/jquery.lightbox-0.5.js"></script>
<!-- end of scripts -->  

<script type="text/javascript">

    $(function() {
        $('#gallery a').lightBox();
    });
</script>

<style type="text/css" >

	/* jQuery lightBox plugin - Gallery style */
	#gallery {
		width: 600px;
	}
	#gallery ul { list-style: none; }
	#gallery ul li { display: inline; }
	#gallery ul img {
		border: 5px solid #3e3e3e;
		border-width: 5px 5px 20px;
	}
	#gallery ul a:hover img {
		border: 5px solid #fff;
		border-width: 5px 5px 20px;
		color: #fff;
	}
	#gallery ul a:hover { 
		color: #fff; 
	}
	</style>
<ul>
  
   <?php  $count=1;
    foreach(glob("../uploads/".$uid."/*.{jpg,JPG,jpeg,JPEG,gif,GIF,png,PNG}", GLOB_BRACE) as $images)
    { ?>
      <li>
        <a href="<? echo $images;?>" title="">
            <img src="<? echo $images;?>" width="100" height="100" alt="" />
        </a>
     </li>
    
    <?php 
    if($count%4==0)
            echo "<ul>";
        $count++; }?>
</ul>