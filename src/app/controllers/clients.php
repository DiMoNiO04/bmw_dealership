<?php 
include SITE_ROOT . "/app/database/database.php";
include('../../app/helps/treatmentImage.php');


$errMsg = [];

//Константы
$ACCESS = 1; 
$NO_ACCESS = 0;
$CLIENT = 0;


$clients = getClients('clients', 'clients_address', 'clients_passport', 'authorization');


//Добавление клиента из админки
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['client-create']))) {

	//Работа с изображением
	treatmentImg();

	//Забираем данные из формы в переменные
	$lastNameCreate  = trim($_POST['last_name']);
	$firstNameCreate  = trim($_POST['first_name']);
	$surnameCreate  = trim($_POST['surname']);
	$dateBirthCreate  = trim($_POST['date_birth']);
	$phoneCreate  = trim($_POST['phone']);

	$cityCreate  = trim($_POST['city']);
	$streetCreate  = trim($_POST['street']);
	$houseCreate  = trim($_POST['house']);
	$apartmentCreate  = trim($_POST['apartment']);

	$seriesCreate  = trim($_POST['series']);
	$numberCreate  = trim($_POST['number']);
	$issuedByCreate  = trim($_POST['issued_by']);
	$issuedWhenCreate  = trim($_POST['issued_when']);
	$validityCreate  = trim($_POST['validity']);

	$loginCreate = trim($_POST['login']);
	$passwordCreate = $_POST['password'];
	$emailCreate = trim($_POST['email']);
	$accessCreate = $ACCESS;
	$roleCreate = $CLIENT;

	//Проверка валидности формы
	if($lastNameCreate  === '' || $firstNameCreate  === '' || $emailCreate  === '' || $loginCreate  === '' || $passwordCreate  === '' || $emailCreate  === '') {
		array_push($errMsg, 'Заполните все обяазтельные поля!');
	} elseif(mb_strlen($loginCreate, 'UTF8') < 3) {
		array_push($errMsg, 'Логин должен быть более трех символов!');
	} else {
		//Проверка на уникальность логина и email
		$existenceLogin = selectOne('authorization', ['login' => $loginCreate ]);
		$existenceEmail = selectOne('authorization', ['email' => $emailCreate ]);

		if($existenceLogin['login'] === $loginCreate) {
			array_push($errMsg,  'Пользователь с таким логином уже зарегистрирован!');
		} elseif($existenceEmail['email'] === $emailCreate) {
			array_push($errMsg, 'Пользователь с такой почтой уже зарегистрован!');
		}else {
			$passwordCreate  = password_hash($passwordCreate , PASSWORD_DEFAULT); //Хешируем пароль перед отправкой в базу данных

			//Проверка на доступ
			if(isset($_POST['access'])) {
				$accessCreate  = 1;
			} else {
				$accessCreate  = 0;
			}
			
			//Формируем массив для таблицы авторизации
			$dataAuth = [
				'login' => $loginCreate ,
				'password' => $passwordCreate ,
				'access' => $accessCreate ,
				'role' => $roleCreate ,
				'email' => $emailCreate 
			];

			//Формируем массив паспорта
			$dataPassport = [
				'series' => $seriesCreate ,
				'number' => $numberCreate ,
				'issued_by' => $issuedByCreate ,
				'issued_when' => $issuedWhenCreate ,
				'validity' => $validityCreate 
			];

			//Формируем массив адресса
			$dataAddress = [
				'city' => $cityCreate ,
				'street' => $streetCreate ,
				'house' => $houseCreate ,
				'apartment' => $apartmentCreate 
			];

			//Добавляем данные в базу данных
			$idPassport = insert('clients_passport', $dataPassport);
			$idAddress = insert('clients_address', $dataAddress);
			$idAuth = insert('authorization', $dataAuth);
			$id_auth = selectOne('authorization', ['id' => $idAuth]);

			//Формируем данные в таблицу клиентов
			$dataPersonal = [
				'last_name' => $lastNameCreate ,
				'first_name' => $firstNameCreate ,
				'surname' => $surnameCreate ,
				'date_birth' => $dateBirthCreate ,
				'phone' => $phoneCreate ,
				'img' => $_POST['img'] ,
				'id_address' => $idAddress,
				'id_auth' => $idAuth,
				'id_passport' => $idPassport
			];

			insert('clients', $dataPersonal); //Отправляем данные в таблицу клиентов
			header('location: ' . BASE_URL . "admin/clientss/index.php"); //Возвращаем на страницу клиентов
		}
	}
} else {
	$lastNameCreate  = '';
	$firstNameCreate  = '';
	$surnameCreate  = '';
	$dateBirth = '';
	$phoneCreate  = '';
	$cityCreate  = '';
	$streetCreate  = '';
	$houseCreate  = '';
	$apartmentCreate  = '';
	$seriesCreate  = '';
	$numberCreate  = '';
	$issuedByCreate  = '';
	$issuedWhenCreate  = '';
	$validityCreate  = '';
	$loginCreate  = '';
	$passwordCreate  = '';
	$emailCreate  = '';
}


//Удаление автомобиля
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_id']))) {
	$id = $_GET['del_id'];  //Получаем айди авто, которую хотим удалить
	$idClient = selectOne('clients', ['id' => $id]);

	$idAuth = $idClient['id_auth']; //Получаем айди записи авторизации, которую хотим запись
	$idAddress = $idClient['id_address']; //Получаем айди записи адресса, которую хотим запись
	$idPas = $idClient['id_passport']; //Получаем айди записи паспорта, которую хотим запись

	delete('authorization', $idAuth); //Удаляем авторизацию
	delete('clients_address', $idAddress); //Удаляем адресс
	delete('clients_passport', $idPas); //Удаляем паспорт
	delete('clients', $id); //Удаляем клиента

	header('location: ' . BASE_URL . "admin/clientss/index.php"); //Возвращаем на страницу клиентов
}

?>