<?php
include SITE_ROOT . "/app/database/database.php";

$errMsg = [];
$idEmployee = '';
$newAuto = 19;
$oldAuto = 20;


//Добавление заказа пользотвателем
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['button-order']))) {
	
	$email = trim($_POST['email']);
	$login = trim($_POST['login']);
	$passF = trim($_POST['password-first']);
	$passS = trim($_POST['password-second']);

	$idAuto = $_GET['auto'];
	$auto = selectOne('auto', ['id' => $idAuto]);
	$state = $auto['state'];

	$idSession = $_SESSION['id'];
	$roleSession = $_SESSION['role'];

	$user = selectOne('authorization', ['id' => $idSession]);
	$idUser = selectOne('clients', ['id_auth' => $idSession])['id'];

	$employees = selectAll('employees');
	$arrEmployees = [];
	foreach($employees as $key => $employee){ //Разбираем данные
		if($employee['job'] == 'Менеджер') {
			array_push($arrEmployees, $employee['id']);
		}
	}

	$randIndex = rand(0, count($arrEmployees) - 1);
	$idEmployee = $arrEmployees[$randIndex];

	if($login != $user['login'] || $email != $user['email'] || (!password_verify($passS, $user['password'])) || $passF != $passS) {
		array_push($errMsg, "Не верно введены данные! \n Заказ не был оформлен! \n Повторите попытку!");
	} else {

		if($roleSession == 0) {

			if($state == 'Новое') {
				$idContact = $newAuto;
			} else {
				$idContact = $oldAuto;
			}

			$params = [
				'id_client' => $idUser,
				'id_auto' => $idAuto,
				'id_contact' => $idContact,
				'id_employee' => $idEmployee
			];
		}

		insert('orders', $params); //Отправляем данные в таблицу клиентов
		header('location: ' . BASE_URL . "personal__cab-user.php"); //Возвращаем на страницу клиентов
	}
}


//Добавление заказа администратором
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['order-create']))) {
	
	$idClient = $_POST['client'];
	$idAuto = $_POST['auto'];

	$idSession = $_SESSION['id'];
	$idEmployee = selectOne('employees', ['id_auth' => $idSession])['id'];

	$auto = selectOne('auto', ['id' => $idAuto]);
	$state = $auto['state'];

	$clientFullData = selectAll('clientsview', ['id' => $idClient])[0];

	if($state == 'Новое') {
		$idContact = $newAuto;
	} else {
		$idContact = $oldAuto;
	}

	$params = [
		'id_auto' => $idAuto,
		'id_client' => $idClient,
		'id_contact' => $idContact,
		'id_employee' => $idEmployee
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