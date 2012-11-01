<?php
session_start();
$uid=$_SESSION['UID'];
include "../db/common_db.php";
$linkid=db_connect();

	if(!is_dir("../uploads/".$uid."/profile")){   //this checks to make sure the directory does not already exist
		mkdir("../uploads/".$uid."/profile", 0777, true); //if the directory doesn't exist then make it
		chmod("../uploads/".$uid."/profile", 0777);  //chmod to 777 lets us write to the directory
	} 
   // Edit upload location here
   $destination_path = '../uploads/' . $uid .'/profile/';

   $result = 0;
				
   $target_path = $destination_path . basename( $_FILES['myfile']['name']);
   
   $file=$_FILES['myfile']['name'];

   if(@move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {
		$file=$destination_path.$_FILES['myfile']['name'];
   		$update="update users set UPHOTO='".$file."' where UID='".$uid."'";
		$result_update=mysql_query($update,$linkid);
        $result = 1;
   }
?>

<script language="javascript" type="text/javascript">window.top.window.stopUpload(<?php echo $result; ?>);</script>   
