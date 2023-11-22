<?php 

session_start();
include '../path.php';
include(SITE_ROOT . '/app/controllers/logout/Logout.php');

$logout = new LogOut();
$logout->out();

?>