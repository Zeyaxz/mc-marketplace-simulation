<?php 

session_start();
$_SESSION = [];
session_unset();
session_destroy();
setcookie('ma', '', time() - 3600);
setcookie('ku', '', time() - 3600);

header("Location: login.php");
exit;

?>