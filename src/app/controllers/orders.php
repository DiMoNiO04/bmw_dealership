<?php
include SITE_ROOT . "/app/database/database.php";

$errMsg = [];
$idEmployee = '';


//Добавление заказа пользотвателем
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['button-order']))) {
	
	$email = trim($_POST['email']);
	$login = trim($_POST['login']);
	$passF = trim($_POST['password-first']);
	$passS = trim($_POST['password-second']);

	$idAuto = $_GET['auto'];
	$idSession = $_SESSION['id'];
	$roleSession = $_SESSION['role'];

	$user = selectOne('authorization', ['id' => $idSession]);
	$idUser = selectOne('clients', ['id_auth' => $idSession])['id'];

	if($login != $user['login'] || $email != $user['email'] || (!password_verify($passS, $user['password'])) || $passF != $passS) {
		array_push($errMsg, "Не верно введены данные! \n Заказ не был оформлен! \n Повторите попытку!");
	} else {

		if($roleSession == 0) {
			$params = [
				'id_client' => $idUser,
				'id_auto' => $idAuto
			];
		}

		insert('orders', $params); //Отправляем данные в таблицу клиентов
		header('location: ' . BASE_URL . "personal__cab-user.php"); //Возвращаем на страницу клиентов
	}
}


//Добавление заказа администратором
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['order-create']))) {
	
	$client = $_POST['client'];
	$auto = $_POST['auto'];

	$clientFullData = selectAll('clientsview', ['id' => $client])[0];

	$params = [
		'id_auto' => $auto,
		'id_client' => $client
	];

	insert('orders', $params); //Отправляем данные в таблицу клиентов
	header('location: ' . BASE_URL . "admin/orders/index.php"); //Возвращаем на страницу моделей
}


//Удаление заказа(пользователем)
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_order']))) {
	$id = $_GET['del_order'];  //Получаем айди модели, которую хотим удалить
	delete('orders', $id); //Удаляем
	if($_SESSION['role'] == 0) {
		header('location: ' . BASE_URL . "personal__cab-user.php"); //Возвращаем на страницу моделей
	} else {
		header('location: ' . BASE_URL . "admin/orders/index.php"); //Возвращаем на страницу моделей
	}
}
?>