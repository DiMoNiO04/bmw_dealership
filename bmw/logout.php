<?php 

session_start();

include('./app/controllers/Logout.php');

$logout = new LogOut();
$logout->out();

?>