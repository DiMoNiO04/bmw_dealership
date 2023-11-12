<?php 

session_start();
include "path.php";

//Очищаем сессию
unset($_SESSION['id']);
unset($_SESSION['login']);
unset($_SESSION['admin']);

//Возвращаем на главную страницу
header('location: ' . BASE_URL);

?>