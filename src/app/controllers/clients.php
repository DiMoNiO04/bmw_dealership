<?php 

$clients = selectAll('clientsview');

class Client {

	public $ACCESS = 1;
	public $NO_ACCESS = 0;
	public $CLIENT = 0;
	public $errMsg = [];

	//Добавление клиента
	public function addClient() {

		//Забираем данные из формы в переменные
		$login = trim($_POST['login']);
		$password = $_POST['password'];
		$email = trim($_POST['email']);
		$access = $ACCESS;
		$role = $CLIENT;

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
				$password  = password_hash($password , PASSWORD_DEFAULT); //Хешируем пароль перед отправкой в базу данных

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
					'role' => $this -> CLIENT,
					'email' => $email 
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

				//Добавляем данные в базу данных
				$idPassport = insert('clients_passport', $dataPassport);
				$idAddress = insert('clients_address', $dataAddress);
				$idAuth = insert('authorization', $dataAuth);
				$id_auth = selectOne('authorization', ['id' => $idAuth]);

				//Формируем данные в таблицу клиентов
				$dataPersonal = [
					'last_name' => trim($_POST['last_name']),
					'first_name' => trim($_POST['first_name']),
					'surname' => trim($_POST['surname']),
					'date_birth' => trim($_POST['date_birth']),
					'phone' => trim($_POST['phone']),
					'id_address' => $idAddress,
					'id_auth' => $idAuth,
					'id_passport' => $idPassport
				];

				insert('clients', $dataPersonal); //Отправляем данные в таблицу клиентов
				header('location: ' . BASE_URL . "admin/clientss/index.php"); //Возвращаем на страницу клиентов
			}
		}
	}

	//Редактирование клиента
	public function updateClient() {
			
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
			'phone' => trim($_POST['phone'])
		];

		$id = $_POST['id']; //Получаем данные клиента из формы
		$idClient = selectOne('clients', ['id' => $id]); //Получаем данные клиента, которого хотим отредактировать
		$idAuth = $idClient['id_auth']; //Получаем айди записи авторизации, которую хотим запись
		$idAddress = $idClient['id_address']; //Получаем айди записи адресса, которую хотим запись
		$idPas = $idClient['id_passport']; //Получаем айди записи паспорта, которую хотим запись

		//Обновляем данные клиента, которого отредактировали
		update('clients', $id, $dataPersonal);
		update('clients_passport', $idPas, $dataPassport);
		update('clients_address', $idAddress, $dataAddress);
		update('authorization', $idAuth, $dataAuth);

		header('location: ' . BASE_URL . "admin/clientss/index.php"); //Возвращаем на страницу клиентов
	}

	//Редактирование доступа клиента
	public function updateStatusClient($id) {
		$access = $_GET['access'];
	
		$сlient = selectOne('clients', ['id' => $id]); //Получаем данные клиента, которого хоти изменитьь
		$clientAuth = selectOne('authorization', ['id' => $сlient['id_auth']]); //Получаем данные авторизации, которую хоти изменить
		$idAuth = $clientAuth['id'];  //Получаем айди авторизации, которую хоти изменить
	
		update('authorization', $idAuth, ['access' => $access]); //Перезаписываем полученную запись
		header('location: ' . BASE_URL . "admin/clientss/index.php"); //Возвращаем на страницу клиентов
	}

	//Удаление клиента
	public function deleteClient($id) {
		delete('clients', $id); //Удаляем клиента
		header('location: ' . BASE_URL . "admin/clientss/index.php"); //Возвращаем на страницу клиентов
	}

}


$client = new Client();

//Добавление клиента из админки
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['client-create']))) {
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

	$client -> addClient();
} else {
	$lastName = '';
	$firstName = '';
	$surname = '';
	$dateBirth = '';
	$phone = '';
	$city = '';
	$street = '';
	$house = '';
	$apartment = '';
	$series = '';
	$number = '';
	$issuedBy = '';
	$login = '';
	$password = '';
	$email = '';
}

//Редактирование клиента через админку
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['edit_id']))) {
	
	$id = $_GET['edit_id']; //Получаем айди клиента, того кого хотим изменить 
	$client = selectOne('clients', ['id' => $id]); //Получаем все данные клиента, которого хотим изменить
	
	$idAuth = $client['id_auth']; //Получаем айди данных авторизации клиента
	$idAddress = $client['id_address']; //Получаем айди данных адреса клиента
	$idPassport = $client['id_passport']; //Получаем айди данных паспорта клиента

	$clientAuth = selectOne('authorization', ['id' => $idAuth]); //Получаем данные авторизации данного клиента
	$clientAddress = selectOne('clients_address', ['id' => $idAddress]); //Получаем данные адресса данного клиента
	$clientPassport = selectOne('clients_passport', ['id' => $idPassport]); //Получаем данные паспорта данного клиента
	
	//Получаем данные клиента которого хотим изменить в переменные
	$id = $client['id'];
	$lastName = $client['last_name'];
	$firstName = $client['first_name'];
	$surname = $client['surname'];
	$dateBirth = $client['date_birth'];
	$phone = $client['phone'];
	$city = $clientAddress['city'];
	$street = $clientAddress['street'];
	$house = $clientAddress['house'];
	$apartment = $clientAddress['apartment'];
	$series = $clientPassport['series'];
	$number = $clientPassport['number'];
	$issuedBy = $clientPassport['issued_by'];
	$login = $clientAuth['login'];
	$email = $clientAuth['email'];
	$access = $clientAuth['access'];
}

//Редактиование клиента
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['client-edit']))) {
	$client -> updateClient();
} 

//Изменение статуса входа клиента
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['pub_id']))) {
	$id = $_GET['pub_id'];  //Получаем айди клиента, доступ которого хотим измнить
	$client -> updateStatusClient($id);
}

//Удаление автомобиля
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_id']))) {
	$id = $_GET['del_id'];  //Получаем айди авто, которую хотим удалить
	$client -> deleteClient($id);
}
?>