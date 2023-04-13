<?php

include "../../app/database/database.php";

//Если сессия закончилась, то возврат на страницу авторизации
if(!$_SESSION) {
	header('location: ' . BASE_URL . 'auth.php');
}

//Получаем все данные из таблицы models
$contacts = selectAll('contacts');

//Переменные
$errMsg = [];
$id = '';


//Код для создания контактов
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['contact-create']))) {

	//Забираем данные из формы в переменные
	$name = trim($_POST['name']);
	$phone = trim($_POST['phone']);
	$workTime = trim($_POST['work_time']);
	$email = trim($_POST['email']);
	
	//Проверка валидность формы
	if($name === '' || $phone === '' || $workTime === '' || $email === '') {
		array_push($errMsg, 'Заполните все обязательные поля!');
	} else {
			
		//Формируем массив для отправки
		$contact = [
			'name' => $name,
			'phone' => $phone,
			'work_time' => $workTime,
			'email' => $email
		];

		insert('contacts', $contact); //Отправляем данные в таблицу contacts
		header('location: ' . BASE_URL . "admin/contacts/index.php"); //Возвращаем на страницу контактов
	}
} else {
	$name = '';
	$phone = '';
	$workTime = '';
	$email = '';
}


//Редактирование контактных данных
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['id']))) {
	
	$id = $_GET['id']; //Получаем айди контактных данных, которые хотим изменить 
	$contact = selectOne('contacts', ['id' => $id]); //Получаем все данные данного контакта, которую хотим изменить

	//Получаем данные контакта которуые хотим изменить в переменные
	$id = $contact['id'];
	$name = $contact['name'];
	$phone = $contact['phone'];
	$workTime = $contact['work_time'];
	$email = $contact['email'];
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['contact-edit']))) {

	//Забираем данные из формы в переменные
	$id = $_POST['id'];
	$name = trim($_POST['name']);
	$phone = trim($_POST['phone']);
	$workTime = trim($_POST['work_time']);
	$email = trim($_POST['email']);
	
	//Проверка валидность формы
	if($name === '' || $phone === '' || $workTime === '' || $email === '') {
		array_push($errMsg, 'Заполните все обязательные поля!');
	} else {
			
		//Формируем массив для отправки
		$contact = [
			'name' => $name,
			'phone' => $phone,
			'work_time' => $workTime,
			'email' => $email
		];

		update('contacts', $id, $contact); //Отправляем данные в таблицу contacts
		header('location: ' . BASE_URL . "admin/contacts/index.php"); //Возвращаем на страницу контактов
	}
}

//Удаление контакта
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_id']))) {
	$id = $_GET['del_id'];  //Получаем айди контакта, который хотим удалить
	delete('contacts', $id); //Удаляем
	header('location: ' . BASE_URL . "admin/contacts/index.php"); //Возвращаем на страницу контактов
}
?>