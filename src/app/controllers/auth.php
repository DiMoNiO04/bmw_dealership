<?php 

include SITE_ROOT . "/app/database/database.php";
include SITE_ROOT . "/app/helps/treatmentImage.php";


$errMsg = [];

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
		header('location:/admin/clientss/index.php');
	} else {
		header('location:/index.php');
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
		array_push($errMsg, 'Заполните все поля!');
	} elseif(mb_strlen($login, 'UTF8') < 3) {
		array_push($errMsg, 'Логин должен быть более трех символов!');
	} elseif($passwordF !== $passwordS) {
		array_push($errMsg, 'Пароли в обеих полях должны соотвествовать!');
	} else {
		//Проверка на уникальность логина и email
		$existenceLogin = selectOne('authorization', ['login' => $login]);
		$existenceEmail = selectOne('authorization', ['email' => $email]);

		if($existenceLogin['login'] === $login) {
			array_push($errMsg,  'Пользователь с таким логином уже зарегистрирован!');
		} elseif($existenceEmail['email'] === $email) {
			array_push($errMsg, 'Пользователь с такой почтой уже зарегистрован!');
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
		array_push($errMsg, "Не все поля заполнены!");
	} else {
		$existence = selectOne('authorization', ['email' => $email]);
		
		if($existence['access'] == 0) {
			array_push($errMsg, "Данный аккаунт не имеет доступа (заблокирован)!");
		} else {
			if($existence && password_verify($password, $existence['password'])) {
				userAuth($existence); //Создаем сессию для авторизации
			} else {
				tt(password_verify($password, $existence['password']));
				array_push($errMsg, "Неправильный логин или пароль!");
			}
		}
	}
} else {
	$email = '';
}

//Удаление сотрудника
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_id']))) {
	
	$id = $_GET['del_id'];  //Получаем айди сотрудника, которого хотим удалить
	if($_SESSION['role'] == 1) {
		$idEmployee = selectOne('employees', ['id_auth' => $id]); 

		$idAuth = $idEmployee['id_auth']; //Получаем айди авторизации для данного сотрудника
		$idAddress = $idEmployee['id_address']; //Получаем айди адресса для данного сотрудника
		$idPas = $idEmployee['id_passport']; //Получаем айди паспорта для данного сотрудника
	
		delete('authorization', $idAuth); //Удаляем данные авторизации
		delete('employees_address', $idAddress); //Удаляем данные адресса
		delete('employees_passport', $idPas); //Удаляем  данные паспорта
		delete('employees', $id); //Удаляем сотрудника
	} else {
		$idClients = selectOne('clients', ['id_auth' => $id]); 

		$idAuth = $idClients['id_auth']; //Получаем айди авторизации для данного сотрудника
		$idAddress = $idClients['id_address']; //Получаем айди адресса для данного сотрудника
		$idPas = $idClients['id_passport']; //Получаем айди паспорта для данного сотрудника
	
		delete('authorization', $idAuth); //Удаляем данные авторизации
		delete('clients_address', $idAddress); //Удаляем данные адресса
		delete('clients_passport', $idPas); //Удаляем  данные паспорта
		delete('clients', $id); //Удаляем сотрудника
	}

	header('location: ' . BASE_URL . "/logout.php"); //Возвращаем на страницу сотрудников
}
?>