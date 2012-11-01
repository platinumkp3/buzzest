<?php
include "../db/common_db.php";
$linkid=db_connect();

$uid=$_POST['uid'];

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
				$userphoto="../".$uphoto;
			}
			else 
			{
				$userphoto="../images/humanicon.jpg";
			}
			echo '<li onClick="fill(\''.$username.'\');">'.$username.'</li>';
			  if($count%4==0)
           		 echo "<ul>";
       		$count++; 
		}
		echo '</ul>';
				
		} 
	}
} 
?>