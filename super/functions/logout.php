<?php 

session_start();
session_destroy();
unset($_SESSION);
header("Location: ../../staff/index.php");
exit();
