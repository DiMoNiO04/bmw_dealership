<?php 

session_start();

include('./app/controllers/logout/Logout.php');

$logout = new LogOut();
$logout->out();

?>