<?php 
include SITE_ROOT . "/app/database/database.php";
include('../../app/helps/treatmentImage.php');


$errMsg = [];

//Константы
$ACCESS = 1; 
$NO_ACCESS = 0;
$ADMIN = 1;

$employees = getClients('employees', 'employees_address', 'employees_passport', 'authorization');


//Добавление сотрудника из админки
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['employees-create']))) {

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
	$jobTitle = $_POST['job'];
	$accessCreate = $ACCESS;
	$roleCreate = $ADMIN;


	//Проверка валидности формы
	if($lastNameCreate  === '' || $firstNameCreate  === '' || $emailCreate  === '' || $loginCreate  === '' || $passwordCreate  === '' || $emailCreate  === '' || $job === '') {
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

			//Формируем массив для таблицы паспорта
			$dataPassport = [
				'series' => $seriesCreate ,
				'number' => $numberCreate ,
				'issued_by' => $issuedByCreate ,
				'issued_when' => $issuedWhenCreate ,
				'validity' => $validityCreate 
			];

			//Формируем массив для таблицы аддресса
			$dataAddress = [
				'city' => $cityCreate ,
				'street' => $streetCreate ,
				'house' => $houseCreate ,
				'apartment' => $apartmentCreate 
			];

			//Добавляем данные
			$idPassport = insert('employees_passport', $dataPassport);
			$idAddress = insert('employees_address', $dataAddress);
			$idAuth = insert('authorization', $dataAuth);
			$id_auth = selectOne('authorization', ['id' => $idAuth]);

			//Формируем данные в таблицу сотрудников
			$dataPersonal = [
				'last_name' => $lastNameCreate ,
				'first_name' => $firstNameCreate ,
				'surname' => $surnameCreate ,
				'date_birth' => $dateBirthCreate ,
				'phone' => $phoneCreate ,
				'job' => $jobTitle,
				'img' => $_POST['img'] ,
				'id_address' => $idAddress,
				'id_auth' => $idAuth,
				'id_passport' => $idPassport
			];

			insert('employees', $dataPersonal); //Отправляем данные в таблицу сотрудников
			header('location: ' . BASE_URL . "admin/employees/index.php"); //Возвращаем на страницу сотрудников
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
	$jobTitle = '';
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

//Удаление сотрудника
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_id']))) {
	$id = $_GET['del_id'];  //Получаем айди сотрудника, которого хотим удалить
	$idClient = selectOne('employees', ['id' => $id]); 

	$idAuth = $idClient['id_auth']; //Получаем айди авторизации для данного сотрудника
	$idAddress = $idClient['id_address']; //Получаем айди адресса для данного сотрудника
	$idPas = $idClient['id_passport']; //Получаем айди паспорта для данного сотрудника


	delete('authorization', $idAuth); //Удаляем данные авторизации
	delete('employees_address', $idAddress); //Удаляем данные адресса
	delete('employees_passport', $idPas); //Удаляем  данные паспорта
	delete('employees', $id); //Удаляем сотрудника

	header('location: ' . BASE_URL . "admin/employees/index.php"); //Возвращаем на страницу сотрудников
}
?>