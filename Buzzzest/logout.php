<?php
session_start();
unset($_SESSION['UID']);
unset ($_SESSION['UNAME']);
session_destroy();

require "includes/check_session.php";

?>