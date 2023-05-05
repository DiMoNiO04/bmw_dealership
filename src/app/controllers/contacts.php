<?php

include SITE_ROOT . "/app/database/database.php";

//Если сессия закончилась, то возврат на страницу авторизации
if(!$_SESSION) {
	header('location: ' . BASE_URL . 'auth.php');
}


$contacts = selectAll('contactsview');  //Получаем все данные из таблицы контактов


class Contact {

	public function addContact() {
		
		//Формируем объект адрессных данных
		$contactAddress = [
			'city' => trim($_POST['city']),
			'street' => trim($_POST['street']),
			'house' => trim($_POST['house'])
		];
			
		//Формируем массив для отправки
		$contact = [
			'name' => trim($_POST['name']),
			'phone' => trim($_POST['phone']),
			'work_time' =>  trim($_POST['work_time']),
			'email' => trim($_POST['email']),
			'id_address' => insert('contacts_address', $contactAddress)
		];

		insert('contacts', $contact); //Отправляем данные в таблицу contacts
		header('location: ' . BASE_URL . "admin/contacts/index.php"); //Возвращаем на страницу контактов
	}

	public function updateContact() {

		//Формируем массив адрессных данных
		$contactAddress = [
			'city' => trim($_POST['city']),
			'street' => trim($_POST['street']),
			'house' => trim($_POST['house'])
		];
				
		//Формируем массив для отправки
		$contact = [
			'name' => trim($_POST['name']),
			'phone' => trim($_POST['phone']),
			'work_time' => trim($_POST['work_time']),
			'email' => trim($_POST['email'])
		];
	
		$id = $_POST['id']; //Получаем id контактных данных, которые хотим редактировать

		//Получаем id адрессных данных, данного контакта
		$idContact = selectOne('contacts', ['id' => $id]);
		$idAddress = $idContact['id_address'];
	
		update('contacts_address', $idAddress, $contactAddress); //Отправляем данные в таблицу адреса контаков
		update('contacts', $id, $contact); //Отправляем данные в таблицу contacts
		header('location: ' . BASE_URL . "admin/contacts/index.php"); //Возвращаем на страницу контактов
	}

	public function deleteContact($id) {
		delete('contacts', $id); //Удаляем
		header('location: ' . BASE_URL . "admin/contacts/index.php"); //Возвращаем на страницу контактов
	}

}


$contact = new Contact();

//Добавление новых контактов
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['contact-create']))) {
	$contact -> addContact();
} 

//Редактирование контактных данных
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['id']))) {
	$id = $_GET['id']; //Получаем айди контактных данных, которые хотим изменить 
	$contact = selectOne('contacts', ['id' => $id]); //Получаем все данные данного контакта, которую хотим изменить

	//Получаем данные контакта которые хотим изменить в переменные
	$id = $contact['id'];
	$name = $contact['name'];
	$phone = $contact['phone'];
	$workTime = $contact['work_time'];
	$email = $contact['email'];

	//Получаем айди контактных данных
	$contactAddress = selectOne('contacts_address', ['id' => $contact['id_address']]);
	$city = $contactAddress['city'];
	$street = $contactAddress['street'];
	$house = $contactAddress['house'];
}

//Редактирование контактных данных
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['contact-edit']))) {
	$contact -> updateContact();
}

//Удаление контактных данных
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_id']))) {
	$id = $_GET['del_id'];  //Получаем айди контакта, который хотим удалить
	$contact -> deleteContact($id);
}
?>