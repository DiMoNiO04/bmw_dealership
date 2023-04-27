<?php 

include SITE_ROOT . "/app/database/database.php";
include SITE_ROOT . "/app/helps/treatmentImage.php";


$errMsg = [];

//Константы
$ACCESS = 1; 
$NO_ACCESS = 0;
$CLIENT = 0;
$EMPLOYEE = 1;


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

			//Формируем массив паспорта
			$dataPassport = [
				'series' => $series,
				'number' => $number,
				'issued_by' => $issuedBy
			];

			//Формируем массив адресса
			$dataAddress = [
				'city' => $city,
				'street' => $street,
				'house' => $house,
				'apartment' => $apartment 
			];

			//Добавляем данные в базу данных
			$idPassport = insert('clients_passport', $dataPassport);
			$idAddress = insert('clients_address', $dataAddress);
			$idAuth = insert('authorization', $dataAuth);
			$id_auth = selectOne('authorization', ['id' => $idAuth]);

				//Формируем данные в таблицу клиентов
				$dataPersonal = [
					'last_name' => $lastName,
					'first_name' => $firstName,
					'surname' => $surname,
					'phone' => $phone,
					'img' => $_POST['img'] ,
					'id_address' => $idAddress,
					'id_auth' => $idAuth,
					'id_passport' => $idPassport
				];

			$id = $id_auth['id'];
	
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
		
		if($existence['access'] == $NO_ACCESS) {
			array_push($errMsg, "Данный аккаунт не имеет доступа (заблокирован)!");
		} else {
			if($existence && password_verify($password, $existence['password'])) {
				userAuth($existence); //Создаем сессию для авторизации
			} else {
				password_verify($password, $existence['password']);
				array_push($errMsg, "Неправильный логин или пароль!");
			}
		}
	}
} else {
	$email = '';
}


//Код редактирования персональных данных клиента (сотрудника)
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['personal-data-edit']))) {
	
	//Работа с изображением (проверка на клиент или админ)
	if($_SESSION['role'] == $CLIENT) {
		treatmentImg("\assets\images\dest\clients\\");
	} else {
		treatmentImg("\assets\images\dest\\employees\\");
	}
	
	//Забираем данные из формы в переменные
	$id = $_POST['id'];
	$lastName = trim($_POST['last_name']);
	$firstName = trim($_POST['first_name']);
	$surname = trim($_POST['surname']);
	$img = $_POST['img'];
	$dateBirth = $_POST['date_birth'];
	$phone = trim($_POST['phone']);
	$city = trim($_POST['city']);
	$street = trim($_POST['street']);
	$house = trim($_POST['house']);
	$apartment = trim($_POST['apartment']);
	$series = trim($_POST['series']);
	$number = trim($_POST['number']);
	$issuedBy = trim($_POST['issued_by']);
	$issuedWhen = trim($_POST['issued_when']);
	$validity = trim($_POST['validity']);

	//Проверка валидности формы
	if($lastName  === '' || $firstName  === '') {
		array_push($errMsg, 'Заполните все обяазтельные поля!');
	} else {

		//Формируем массив паспорта
		$dataPassport = [
			'series' => $series,
			'number' => $number,
			'issued_by' => $issuedBy,
			'issued_when' => $issuedWhen,
			'validity' => $validity 
		];

		//Формируем массив адресса
		$dataAddress = [
			'city' => $city,
			'street' => $street,
			'house' => $house,
			'apartment' => $apartment 
		];

		//Формируем данные в таблицу клиентов (сотрудников)
		if(empty($img)) {
			$dataPersonal = [
				'last_name' => $lastName,
				'first_name' => $firstName,
				'surname' => $surname,
				'date_birth' => $dateBirth,
				'phone' => $phone,
			];
		} else {
			$dataPersonal = [
				'last_name' => $lastName,
				'first_name' => $firstName,
				'surname' => $surname,
				'date_birth' => $dateBirth,
				'phone' => $phone,
				'img' => $_POST['img'] ,
			];
		}	
tt($id);
		//Провека на клиента (сотрудника)
		if($_SESSION['role'] == $CLIENT) { //Если клиент
			$idClient = selectOne('clients', ['id_auth' => $id]); //Получаем данные клиента, которого хотим отредактировать
			$idAddress = $idClient['id_address']; //Получаем айди записи адресса, которую хотим запись
			$idPas = $idClient['id_passport']; //Получаем айди записи паспорта, которую хотим запись
	
			//Обновляем данные клиента, которого отредактировали
			update('clients', $idClient['id'], $dataPersonal);
			update('clients_passport', $idPas, $dataPassport);
			update('clients_address', $idAddress, $dataAddress);
		} else { //Если сотрудник
			$idEmployee = selectOne('employees', ['id_auth' => $id]); //Получаем данные сотрудника, которого хотим отредактировать
			$idAddress = $idEmployee['id_address']; //Получаем айди записи адресса, которую хотим запись
			$idPas = $idEmployee['id_passport']; //Получаем айди записи паспорта, которую хотим запись
	
			//Обновляем данные сотрудника, которого отредактировали
			update('employees', $idEmployee['id'], $dataPersonal);
			update('employees_passport', $idPas, $dataPassport);
			update('employees_address', $idAddress, $dataAddress);
		}

		header('location: ' . BASE_URL . "personal__cab-user.php"); //Возвращаем на страницу клиентов
	}
}


//Код для изменения пароля
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['password-edit']))) {
	
	//Забираем данные из формы в переменные
	$id = $_POST['id'];
	$passwordF = $_POST['passF'];
	
	//Хешируем пароль
	$password = password_hash($passwordF, PASSWORD_DEFAULT); //Хешируем пароль перед отправкой в базу данных

	//Формируем массив данных, которые хотим изменит
	$data = [
		'password' => $password
	];
	
	//Обновляем пароль
	update('authorization', $id, $data);
}


//Удаление сотрудника (клиента)
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_id']))) {
	
	$id = $_GET['del_id'];  //Получаем айди сотрудника, которого хотим удалить
	
	//Проверям на клиента (сотрудника)
	if($_SESSION['role'] == $EMPLOYEE) { //Если сотрудник
		$idEmployee = selectOne('employees', ['id_auth' => $id]); 

		$idAuth = $idEmployee['id_auth']; //Получаем айди авторизации для данного сотрудника
		$idAddress = $idEmployee['id_address']; //Получаем айди адресса для данного сотрудника
		$idPas = $idEmployee['id_passport']; //Получаем айди паспорта для данного сотрудника
	
		delete('authorization', $idAuth); //Удаляем данные авторизации
		delete('employees_address', $idAddress); //Удаляем данные адресса
		delete('employees_passport', $idPas); //Удаляем  данные паспорта
		delete('employees', $id); //Удаляем сотрудника
	} else { //Если клиент
		$idClients = selectOne('clients', ['id_auth' => $id]); 

		$idAuth = $idClients['id_auth']; //Получаем айди авторизации для данного клиента
		$idAddress = $idClients['id_address']; //Получаем айди адресса для данного клиента
		$idPas = $idClients['id_passport']; //Получаем айди паспорта для данного клиента
	
		delete('authorization', $idAuth); //Удаляем данные авторизации
		delete('clients_address', $idAddress); //Удаляем данные адресса
		delete('clients_passport', $idPas); //Удаляем  данные паспорта
		delete('clients', $id); //Удаляем клиента
	}

	header('location: ' . BASE_URL . "/logout.php"); //Возвращаем на страницу
}
?>