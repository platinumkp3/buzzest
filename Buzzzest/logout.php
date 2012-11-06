<?php
session_start();
unset($_SESSION['UID']);
unset ($_SESSION['UNAME']);
session_destroy();

$_SESSION['UID'];
$_SESSION['UNAME'];
if ($_SESSION['UID'] == "" && $_SESSION['UNAME'] == "" )
{
	header("location:index.php");
}

?>