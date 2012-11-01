<?php
$_SESSION['UID'];
$_SESSION['UNAME'];
if ($_SESSION['UID'] == "" && $_SESSION['UNAME'] == "" )
{
	header("location:../index.php");
}
?>