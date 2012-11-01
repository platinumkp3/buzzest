<?php
include "../db/common_db.php";
$linkid=db_connect();

$uid=$_POST['uid'];
?>
<style type="text/css">
 ul li { display: inline; }
</style>

<?php

if(isset($_POST['queryString'])) {	
$queryString=$_POST['queryString'];	
	if(strlen($queryString) >0) 
	{
		$query = "SELECT UNAME,UPHOTO FROM users WHERE UNAME LIKE '$queryString%' and UID!='".$uid."'";
		$result_query=mysql_query($query,$linkid);
		if($result_query) {
		echo '<ul>';
		$count=1;
		while ($data_query = mysql_fetch_array($result_query))
		{
			$username=$data_query['UNAME'];
			$uphoto=$data_query['UPHOTO'];
			if ($uphoto != "")
			{
				$userphoto=$uphoto;
			}
			else 
			{
				$userphoto="../images/humanicon.jpg";
			}
			echo '<li style="list-style-type:none;" onClick="fill(\''.$username.'\');"><img src="'.$userphoto.'" width="60" height="60" /></li>';
			if ($count % 4 == 0)
			{
				echo '<ul>';
			}
		}
		echo '</ul>';
				
		} 
		else
		{
			echo 'OOPS we had a problem :(';
		}
	}
} 
	
?>