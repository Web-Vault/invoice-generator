<?php 

session_start();
session_destroy();
session_unset();

header("Location: ../modules/auth/login.php");
exit;

?>