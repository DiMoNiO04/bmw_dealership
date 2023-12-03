<?php 

session_start();
include '../path.php';
include(SITE_ROOT . '/app/services/Logout.php');

$logout = new LogOut();
$logout->out();

?>