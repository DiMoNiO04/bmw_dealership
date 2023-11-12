<?php 

$employees = selectAll('employeesview');

class Employee {

	public $ACCESS = 1;
	public $NO_ACCESS = 0;
	public $ADMIN = 1;
	public $errMsg = [];

	//Добавление сотрудника
	public function addEmployee() {
	
		//Забираем данные из формы в переменные
		$login = trim($_POST['login']);
		$password = $_POST['password'];
		$email = trim($_POST['email']);
		$jobTitle = $_POST['job'];

		//Проверка валидности формы
		if(mb_strlen($login, 'UTF8') < 3) {
			array_push($this -> errMsg, 'Логин должен быть более трех символов!');
		} else {
			//Проверка на уникальность логина и email
			$existenceLogin = selectOne('authorization', ['login' => $login]);
			$existenceEmail = selectOne('authorization', ['email' => $email]);

			if($existenceLogin['login'] === $login) {
				array_push($this -> errMsg,  'Пользователь с таким логином уже зарегистрирован!');
			} elseif($existenceEmail['email'] === $email) {
				array_push($this -> errMsg, 'Пользователь с такой почтой уже зарегистрован!');
			}else {
				$password = password_hash($password , PASSWORD_DEFAULT); //Хешируем пароль перед отправкой в базу данных

				//Проверка на доступ
				if(isset($_POST['access'])) {
					$access = $this -> ACCESS;
				} else {
					$access = $this -> NO_ACCESS;
				}
				
				//Формируем массив для таблицы авторизации
				$dataAuth = [
					'login' => $login,
					'password' => $password,
					'access' => $access,
					'role' => $this -> ADMIN,
					'email' => $email 
				];

				//Формируем массив для таблицы паспорта
				$dataPassport = [
					'series' => trim($_POST['series']),
					'number' => trim($_POST['number']),
					'issued_by' => trim($_POST['issued_by'])
				];

				//Формируем массив для таблицы аддресса
				$dataAddress = [
					'city' => trim($_POST['city']),
					'street' => trim($_POST['street']),
					'house' => trim($_POST['house']),
					'apartment' => trim($_POST['apartment']) 
				];

				//Добавляем данные
				$idPassport = insert('employees_passport', $dataPassport);
				$idAddress = insert('employees_address', $dataAddress);
				$idAuth = insert('authorization', $dataAuth);
				$id_auth = selectOne('authorization', ['id' => $idAuth]);

				//Формируем данные в таблицу сотрудников
				$dataPersonal = [
					'last_name' => trim($_POST['last_name']),
					'first_name' => trim($_POST['first_name']),
					'surname' => trim($_POST['surname']),
					'date_birth' => trim($_POST['date_birth']),
					'phone' => trim($_POST['phone']),
					'job' => $jobTitle,
					'id_address' => $idAddress,
					'id_auth' => $idAuth,
					'id_passport' => $idPassport
				];

				insert('employees', $dataPersonal); //Отправляем данные в таблицу сотрудников
				header('location: ' . BASE_URL . "admin/employees/index.php"); //Возвращаем на страницу сотрудников
			}
		} 
	}

	//Редактирование сотрудника
	public function updateEmployee() {
	
		//Проверка на доступ
		$access = $_POST['access'];
		if(isset($_POST['access'])) {
			$access = $this -> ACCESS;
		} else {
			$access = $this -> NO_ACCESS;
		}
			
		//Формируем массив для таблицы авторизации
		$dataAuth = [
			'access' => $access,
		];
	
		//Формируем массив паспорта
		$dataPassport = [
			'series' => trim($_POST['series']),
			'number' => trim($_POST['number']),
			'issued_by' => trim($_POST['issued_by'])
		];
	
		//Формируем массив адресса
		$dataAddress = [
			'city' => trim($_POST['city']),
			'street' => trim($_POST['street']),
			'house' => trim($_POST['house']),
			'apartment' => trim($_POST['apartment'])
		];
	
		//Формируем данные в таблицу клиентов
		$dataPersonal = [
			'last_name' => trim($_POST['last_name']),
			'first_name' => trim($_POST['first_name']),
			'surname' => trim($_POST['surname']),
			'date_birth' => $_POST['date_birth'],
			'phone' => trim($_POST['phone']),
			'job' => $_POST['job'],
		];

		$id = $_POST['id']; //Получаем данные сотрудника из формы
	
		$idEmployee = selectOne('employees', ['id' => $id]); //Получаем данные сотрудника, которого хотим отредактировать
		$idAuth = $idEmployee['id_auth']; //Получаем айди записи авторизации, которую хотим запись
		$idAddress = $idEmployee['id_address']; //Получаем айди записи адресса, которую хотим запись
		$idPas = $idEmployee['id_passport']; //Получаем айди записи паспорта, которую хотим запись
	
		//Обновляем данные сотрудника, которого отредактировали
		update('employees', $id, $dataPersonal);
		update('employees_passport', $idPas, $dataPassport);
		update('employees_address', $idAddress, $dataAddress);
		update('authorization', $idAuth, $dataAuth);
	
		header('location: ' . BASE_URL . "admin/employees/index.php"); //Возвращаем на страницу сотрудников
	}

	//Редактирование доступа сотрудника
	public function updateStatusEmployee($id) {
		$access = $_GET['access'];
	
		$employee = selectOne('employees', ['id' => $id]); //Получаем данные сотрудника, которого хоти изменитьь
		$employeeAuth = selectOne('authorization', ['id' => $employee['id_auth']]); //Получаем данные авторизации, которую хоти изменить
		$idAuth = $employeeAuth['id'];  //Получаем айди авторизации, которую хоти изменить

		update('authorization', $idAuth, ['access' => $access]); //Перезаписываем полученную запись
		header('location: ' . BASE_URL . "admin/employees/index.php"); //Возвращаем на страницу сотрудников
	}

	//Удаление сотрудника
	public function deleteEmployee($id) {
		delete('employees', $id); //Удаляем сотрудника
		header('location: ' . BASE_URL . "admin/employees/index.php"); //Возвращаем на страницу сотрудников
	}

}


$employee = new Employee(); 

//Добавление сотрудника из админки
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['employees-create']))) {
	//Забираем данные из формы в переменные
	$lastName = trim($_POST['last_name']);
	$firstName = trim($_POST['first_name']);
	$surname = trim($_POST['surname']);
	$dateBirth = trim($_POST['date_birth']);
	$phone = trim($_POST['phone']);

	$city = trim($_POST['city']);
	$street = trim($_POST['street']);
	$house = trim($_POST['house']);
	$apartment = trim($_POST['apartment']);

	$series = trim($_POST['series']);
	$number = trim($_POST['number']);
	$issuedBy = trim($_POST['issued_by']);
	$login = trim($_POST['login']);
	$password = $_POST['password'];
	$email = trim($_POST['email']);
	$jobTitle = $_POST['job'];

	$employee -> addEmployee();
} else {
	$lastName = '';
	$firstName = '';
	$surname = '';
	$dateBirth = '';
	$phone = '';
	$city = '';
	$street = '';
	$house = '';
	$jobTitle = '';
	$apartment = '';
	$series = '';
	$number = '';
	$issuedBy = '';
	$login = '';
	$password = '';
	$email = '';
}

//Редактирование сотрудника через админку
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['edit_id']))) {

	$id = $_GET['edit_id']; //Получаем айди сотрудника, того кого хотим изменить 
	$employee = selectOne('employees', ['id' => $id]); //Получаем все данные сотрудника, которого хотим изменить

	$idAuth = $employee['id_auth']; //Получаем айди данных авторизации сотрудника
	$idAddress = $employee['id_address']; //Получаем айди данных адреса сотрудника
	$idPassport = $employee['id_passport']; //Получаем айди данных паспорта сотрудника

	$employeeAuth = selectOne('authorization', ['id' => $idAuth]); //Получаем данные авторизации данного сотрудника
	$employeeAddress = selectOne('employees_address', ['id' => $idAddress]); //Получаем данные адресса данного сотрудника
	$employeePassport = selectOne('employees_passport', ['id' => $idPassport]); //Получаем данные паспорта данного сотрудника
	
	//Получаем данные сотрудника которого хотим изменить в переменные
	$id = $employee['id'];
	$lastName = $employee['last_name'];
	$firstName = $employee['first_name'];
	$surname = $employee['surname'];
	$dateBirth = $employee['date_birth'];
	$phone = $employee['phone'];
	$job = $employee['job'];
	$city = $employeeAddress['city'];
	$street = $employeeAddress['street'];
	$house = $employeeAddress['house'];
	$apartment = $employeeAddress['apartment'];
	$series = $employeePassport['series'];
	$number = $employeePassport['number'];
	$issuedBy = $employeePassport['issued_by'];
	$login = $employeeAuth['login'];
	$email = $employeeAuth['email'];
	$access = $employeeAuth['access'];
}

//Редактирование сотрудника
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['employee-edit']))) {
	$employee -> updateEmployee();
} 

//Удаление сотрудника
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_id']))) {
	$id = $_GET['del_id'];  //Получаем айди сотрудника, которого хотим удалить
	$employee -> deleteEmployee($id);
}

//Изменение статуса входа сотрудника
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['pub_id']))) {
	$id = $_GET['pub_id'];  //Получаем айди сотрудника, доступ которого хотим измнить
	$employee -> updateStatusEmployee($id);
}
?>