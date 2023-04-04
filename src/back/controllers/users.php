<?php 
include("./back/database/database.php");


//Регистрация
$errMsg = '';

//Константы
$ACCESS = 1; 
$NO_ACCESS = 0;
$CLIENT = 0;

if($_SERVER['REQUEST_METHOD'] === 'POST') {

	//Забираем данные из формы в переменные
	$lastName = trim($_POST['last_name']);
	$firstName = trim($_POST['first_name']);
	$email = trim($_POST['email']);
	$login = trim($_POST['login']);
	$passwordF = $_POST['password-first'];
	$passwordS = $_POST['password-second'];
	$access = $ACCESS;
	$role = $CLIENT;

	//Проверка валидности формы
	if($lastName === '' || $firstName === '' || $email === '' || $login === '' || $passwordF === '' || $passwordS === '') {
		$errMsg = 'Заполните все поля!';
	} elseif(mb_strlen($login, 'UTF8') < 3) {
		$errMsg = 'Логин должен быть более трех символов!';
	} elseif($passwordF !== $passwordS) {
		$errMsg = 'Пароли в обеих полях должны соотвествовать!';
	} else {
		//Проверка на уникальность логина и email
		$existenceLogin = selectOne('authorization', ['login' => $login]);
		$existenceEmail = selectOne('authorization', ['email' => $email]);

		if($existenceLogin['login'] === $login) {
			$errMsg = 'Пользователь с таким логином уже зарегистрирован!';
		} elseif($existenceEmail['email'] === $email) {
			$errMsg = 'Пользователь с такой почтой уже зарегистрован!';
		}else {
			$password = password_hash($passwordF, PASSWORD_DEFAULT); //Хешируем пароль перед отправкой в базу данных

			//Формируем массив для таблицы авторизации
			$dataAuth = [
				'login' => $login,
				'password' => $password,
				'access' => $access,
				'role' => $role,
				'email' => $email
			];

			//Отправляем данные в таблицу авторизации
			$id = insert('authorization', $dataAuth);
			$id_auth = selectOne('authorization', ['id' => $id]);

			//Формируем данные в таблицу клиентов
			$dataPersonal = [
				'last_name' => $lastName,
				'first_name' => $firstName,
				'id_auth' => $id,
			];

			insert('clients', $dataPersonal); //Отправляем данные в таблицу клиентов
			$user = selectOne('authorization', ['id' => $id]);

			$_SESSION['id'] = $user['id'];
			$_SESSION['login'] = $user['login'];
			$_SESSION['role'] = $user['role'];

			if($_SESSION['admin']) {
				header('location: ' . BASE_URL . admin__panel.php);
			} else {
				header('location: ' . BASE_URL);
			}
		}
	}
} else {
	$lastName = '';
	$firstName = '';
	$email = '';
	$login = '';
}
?>