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
$errMsg = [];
$id = '';
$modelName = '';


//Код для создания модели
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['model-create']))) {

	//Работа с изображением
	treatmentImg("\assets\images\dest\models\\");

	//Забираем данные из формы в переменные
	$modelName = trim($_POST['modelName']);
	
	//Проверка на уникальность названия модели
	$existence = selectOne('models', ['model' => $modelName]);

	//Если данная модель существует
	if($existence['model'] === $modelName) {
		array_push($errMsg, 'Данная модель авто уже существует!');
	} else {
		
		//Формируем массив для отправки
		$model = [
			'model' => $modelName,
			'main_foto' => $_POST['img'],
		];

		$id = insert('models', $model); //Отправляем данные в таблицу models
		$model = selectOne('models', ['id' => $id]); //Получаем данные добавленной модели
		header('location: ' . BASE_URL . "admin/autos_models/index.php"); //Возвращаем на страницу моделей
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
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['model-edit']))) {

	//Работа с изображением 
	treatmentImg("\assets\images\dest\models\\");

	//Забираем данные из формы в переменные
	$modelName = trim($_POST['modelName']);
	$img = $_POST['img'];

	//Проверка валидности формы
	if($modelName === '') {
		array_push($errMsg, 'Заполните все обязательные поля!');
	} else {
			//Проверям на статус
			if(isset($_POST['status'])) {
				$status = 1;
			} else {
				$status = 0;
			}
			
			//Формируем массив для отправки данных
			if(empty($img)) {
				$model = [
					'model' => $modelName,
				];	
			} else {
				$model = [
					'model' => $modelName,
					'main_foto' => $_POST['img'],
				];	
			}

			//Отправляем данные в таблицу модели
			$id = $_POST['id'];
			$modelId = update('models', $id, $model); //Обновляем данные
			header('location: ' . BASE_URL . "admin/autos_models/index.php"); //Возвращаем на страницу моделей
		}
}

//Удаление модели
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_id']))) {
	$id = $_GET['del_id'];  //Получаем айди модели, которую хотим удалить
	delete('models', $id); //Удаляем
	header('location: ' . BASE_URL . "admin/autos_models/index.php"); //Возвращаем на страницу моделей
}
?>