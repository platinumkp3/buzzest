<?php
	$dbhost="localhost";
	$hostip="localhost";
	$dbusername="root";
	$dbuserpassword="";
	$default_dbname="buzzzest";
	
	function db_connect($dbname="")
	{
		global $dbhost, $dbusername, $dbuserpassword, $default_dbname;
		global $MYSQL_ERRNO, $MYSQL_ERROR;
		
		$link_id=mysql_connect($dbhost,$dbusername,$dbuserpassword);
		if(!$link_id)
		{
			$MYSQL_ERRNO=0;
			$MYSQL_ERROR='Connection failed to the host $dbhost.';
			return 0;
		}
		else if(empty($dbname) && !mysql_select_db($default_dbname))
		{
			$MYSQL_ERRNO=mysql_errno();
			$MYSQL_ERROR=mysql_errno();
			return 0;			
		}
		else if(!empty($dbname) && !mysql_select_db($dbname))
		{
			$MYSQL_ERRNO=mysql_error();
			$MYSQL_ERROR=mysql_error();
			return 0;
		}		
		else return $link_id;
	}
	
	function sql_error()
	{
		global $MYSQL_ERRNO, $MYSQL_ERROR;
		
		if(empty($MYSQL_ERROR))
		{
			$MYSQL_ERRNO=mysql_errno();
			$MYSQL_ERROR=mysql_error();
		}
		return "$MYSQL_ERRNO : $MYSQL_ERROR";
	}

?>
