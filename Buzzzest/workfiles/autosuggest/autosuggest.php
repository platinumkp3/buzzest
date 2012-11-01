<?php
session_start();
include "db/common_db.php";
$linkid=db_connect();
$uid=$_SESSION['UID'];
	
	if(isset($_POST['queryString'])) {		
		
		if(strlen($queryString) >0) {

			$query = "SELECT UNAME,UPHOTO FROM users WHERE UNAME LIKE '$queryString%'";
			$result_query=mysql_query($query,$linkid);
			if($result_query) {
			echo '<ul>';
				while ($data_query = mysql_fetch_array($result_query)) {
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
					echo '<li onClick="fill(\''.addslashes($username).'\');">'.$username.'</li>';
				}
			echo '</ul>';
				
			} else {
				echo 'OOPS we had a problem :(';
			}
		}
	} 
	
?>