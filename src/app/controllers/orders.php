<?php
include SITE_ROOT . "/app/database/database.php";

$errMsg = [];


class Order {
	
	public $NEW_AUTO = 19;
	public $OLD_AUTO = 20;
	public $CLIENT = 0;
	public $NEW = 'Новое';
	public $errMsg = [];

	//Добавление заказа клиентом
	public function addOrderClient() {

		$email = $_POST['email'];
		$login = $_POST['login'];
		$passF = $_POST['password-first'];
		$passS = $_POST['password-second'];

		$idAuto = $_GET['auto'];
		$auto = selectOne('auto', ['id' => $idAuto]);
		$state = $auto['state'];

		$idSession = $_SESSION['id'];
		$roleSession = $_SESSION['role'];

		$user = selectOne('authorization', ['id' => $idSession]);
		$idUser = selectOne('clients', ['id_auth' => $idSession])['id'];

		$arrEmployees = selectAll('employees', ['job' => 'Менеджер']);
		$randIndex = rand(0, count($arrEmployees) - 1);
		$idEmployee = $arrEmployees[$randIndex]['id'];

		if($login != $user['login'] || $email != $user['email'] || (!password_verify($passS, $user['password'])) || $passF != $passS) {
			array_push($this -> errMsg, "Не верно введены данные! \n Заказ не был оформлен! \n Повторите попытку!");
		} else {

			if($state == $this -> new) {
				$idContact = $this -> NEW_AUTO;
			} else {
				$idContact = $this -> OLD_AUTO;
			}

			$params = [
				'id_client' => $idUser,
				'id_auto' => $idAuto,
				'id_contact' => $idContact,
				'id_employee' => $idEmployee
			];

			insert('orders', $params); //Отправляем данные в таблицу клиентов
			header('location: ' . BASE_URL . "personal__cab-user.php"); //Возвращаем на страницу клиентов
		}
	}

	//Добавление заказа сотрудником
	public function addOrderEmploee() {
		$idClient = $_POST['client'];
		$idAuto = $_POST['auto'];

		$idSession = $_SESSION['id'];
		$idEmployee = selectOne('employees', ['id_auth' => $idSession])['id'];

		$auto = selectOne('auto', ['id' => $idAuto]);
		$state = $auto['state'];

		$CLIENTFullData = selectAll('clientsview', ['id' => $idClient])[0];

		if($state == $this -> new) {
			$idContact = $this -> NEW_AUTO;
		} else {
			$idContact = $this -> OLD_AUTO;
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

	//Удаление заказа
	public function deleteOrder($id) {
		delete('orders', $id); //Удаляем
		if($_SESSION['role'] == $CLIENT) { //Если удалял заказ клиент
			header('location: ' . BASE_URL . "personal__cab-user.php"); //Возвращаем на страницу моделей
		} else {
			header('location: ' . BASE_URL . "admin/orders/index.php"); //Возвращаем на страницу моделей
		}
	}

}


$order = new Order();

//Добавление заказа пользотвателем
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['button-order']))) {
	$order -> addOrderClient();
}

//Добавление заказа администратором
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['order-create']))) {
	$order -> addOrderEmploee();
}

//Удаление заказа(пользователем)
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_order']))) {
	$id = $_GET['del_order'];  //Получаем айди модели, которую хотим удалить
	$order -> deleteOrder($id);
}
?>