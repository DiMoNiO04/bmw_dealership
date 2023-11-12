<?php 

session_start();

include('./app/controllers/logout.php');

$logout = new LogOut();
$logout->out();

?>