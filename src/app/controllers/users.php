<?php 
include("./app/database/database.php");


$errMsg = '';

//Константы
$ACCESS = 1; 
$NO_ACCESS = 0;
$CLIENT = 0;

//Создаем сессию для авторизации
function userAuth($arr) {
	$_SESSION['id'] = $arr['id'];
	$_SESSION['login'] = $arr['login'];
	$_SESSION['role'] = $arr['role'];
	$_SESSION['access'] = $arr['access'];

	if($_SESSION['admin']) {
		header('location: ' . BASE_URL . admin__panel.php);
	} else {
		header('location: ' . BASE_URL);
	}
}


//Код для формы регистрации
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['button__reg']))) {

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

			userAuth($user); //Создаем сессию для авторизации
		}
	}
} else {
	$lastName = '';
	$firstName = '';
	$email = '';
	$login = '';
}


//Код для формы авторизации
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['button__auth']))) {
	
	//Забираем данные из формы в переменные
	$email = trim($_POST['email']);
	$password = $_POST['password'];

	//Проверка валидности формы
	if($email === '' || $password === '') {
		$errMsg = "Не все поля заполнены!";
	} else {
		$existence = selectOne('authorization', ['email' => $email]);
		
		if($existence['access'] == 0) {
			$errMsg = "Данный аккаунт не имеет доступа (заблокирован)!";
		} else {
			if($existence && password_verify($password, $existence['password'])) {
				userAuth($existence); //Создаем сессию для авторизации
			} else {
				$errMsg = "Неправильный логин или пароль!";
			}
		}
	}
} else {
	$email = '';
}
?>