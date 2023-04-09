<?php

include "../../app/database/database.php";
include('../../app/helps/treatmentImage.php');

//Если сессия закончилась, то возврат на страницу авторизации
if(!$_SESSION) {
	header('location: ' . BASE_URL . 'auth.php');
}

//Получаем все данные из таблицы models
$models = selectAll('models');

//Переменные
$errMsg = '';
$id = '';
$modelName = '';


//Код для создания модели
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['model-create']))) {

	//Работа с изображением
	treatmentImg();

	//Забираем данные из формы в переменные
	$modelName = trim($_POST['modelName']);
	$status = trim($_POST['status']);
	//Проверка валидность формы
	if($modelName === '') {
		$errMsg = 'Заполните все поля!';
	} else {
		//Проверка на уникальность названия модели
		$existence = selectOne('models', ['model' => $modelName]);

		//Если данная модель существует
		if($existence['model'] === $modelName) {
			$errMsg = 'Данная модель авто уже существует!';
		} else {

			//Проверяем статус: выбран или нет
			if(isset($_POST['status'])) {
				$status = 1;
			} else {
				$status = 0;
			}
			
			//Формируем массив для отправки
			$model = [
				'model' => $modelName,
				'status' => $status,
				'main_foto' => $_POST['img'],
			];

			$id = insert('models', $model); //Отправляем данные в таблицу models
			$model = selectOne('models', ['id' => $id]); //Получаем данные добавленной модели
			header('location: ' . BASE_URL . "admin/autos_models/index.php"); //Возвращаем на страницу моделей
		}
	}
} else {
	$modelName = '';
}


//Редактирование модели
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['id']))) {
	
	$id = $_GET['id']; //Получаем айди, того кого хотим изменить 
	$model = selectOne('models', ['id' => $id]); //Получаем все данные можели, которую хотим изменить

	//Получаем данные модели которую хотим изменить в переменные
	$id = $model['id'];
	$modelName = $model['model'];
	$img = $model['main_foto'];
	$status = $model['status'];
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['model-edit']))) {

	//Работа с изображением 
	treatmentImg();

	//Забираем данные из формы в переменные
	$modelName = trim($_POST['modelName']);
	$status = trim($_POST['status']);

	//Проверка валидности формы
	if($modelName === '') {
		$errMsg = 'Заполните все поля!';
	} else {
			//Проверям на статус
			if(isset($_POST['status'])) {
				$status = 1;
			} else {
				$status = 0;
			}
			
			//Формируем массив для отправки данных
			$model = [
				'model' => $modelName,
				'status' => $status,
				'main_foto' => $_POST['img'],
			];

			//Отправляем данные в таблицу модели
			$id = $_POST['id'];
			$modelId = update('models', $id, $model); //Обновляем данные
			header('location: ' . BASE_URL . "admin/autos_models/index.php"); //Возвращаем на страницу моделей
		}
}


//Изменение статуса модели
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['pub_id']))) {
	$id = $_GET['pub_id'];  //Получаем айди модели, статус которой хотим изменить
	$status = $_GET['status']; //Получаем статус данной модели

	$modelId = update('models', $id, ['status' => $status]); //Перезаписываем изменения

	header('location: ' . BASE_URL . "admin/autos_models/index.php"); //Возвращаем на страницу моделей
	exit();
}

//Удаление модели
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_id']))) {
	$id = $_GET['del_id'];  //Получаем айди модели, которую хотим удалить
	delete('models', $id); //Удаляем
	header('location: ' . BASE_URL . "admin/autos_models/index.php"); //Возвращаем на страницу моделей
}
?>