<?php

include SITE_ROOT . "/app/database/database.php";
include SITE_ROOT . "/app/helps/treatmentImage.php";

//Если сессия закончилась, то возврат на страницу авторизации
if(!$_SESSION) {
	header('location: ' . BASE_URL . 'auth.php');
}

//Получаем все данные из таблицы models и auto
$models = selectAll('models');
$autoModelsName = getModelsName('auto', 'models');

//Переменные
$errMsg = [];
$id = '';
$modelName = '';
$name = '';
$complexion = '';
$color = '';
$year = '';
$engine = '';
$power = '';
$price = '';
$status = '';
$model = '';


//Код для создания автомобиля
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['auto-create']))) {

	//Работа с изображением
	treatmentImg();

	//Забираем данные из формы в переменные
	$name = trim($_POST['name']);
	$complexion = trim($_POST['complexion']);
	$color = trim($_POST['color']);
	$year = trim($_POST['year']);
	$engine = trim($_POST['engine']);
	$price = trim($_POST['price']);
	$status = trim($_POST['status']);
	$model = trim($_POST['model']);

	//Проверка валидность формы
	if($name === '' || $complexion === '' || $color === '' || $year === '' || $engine === '' || $price === '' || $model === '') {
		array_push($errMsg, 'Заполните все обязательные поля!');
	} else {

			//Проверяем статус: выбран или нет
			if(isset($_POST['status'])) {
				$status = 1;
			} else {
				$status = 0;
			}
			
			//Формируем массив для отправки
			$auto = [
				'name' => $name,
				'engine' => $engine,
				'year' => $year,
				'price' => $price,
				'color' => $color,
				'complexion' => $complexion,
				'img' => $_POST['img'],
				'status' => $status,
				'id_model' => $model
			];

			$auto = insert('auto', $auto); //Отправляем данные в таблицу auti
			$auto = selectOne('auto', ['id' => $id]); //Получаем данные добавленной модели
			header('location: ' . BASE_URL . "admin/autos/index.php"); //Возвращаем на страницу автомобилей
		}
} else {
	$name = '';
	$complexion = '';
	$color = '';
	$year = '';
	$engine = '';
	$price = '';
	$status = '';
	$model = '';
}


//Редактирование автомобиля
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['id']))) {
	
	$id = $_GET['id']; //Получаем айди, того кого хотим изменить 
	$auto = selectOne('auto', ['id' => $id]); //Получаем все данные можели, которую хотим изменить

	//Получаем данные авто которого хотим изменить в переменные
	$id = $auto['id'];
	$name = $auto['name'];
	$complexion = $auto['complexion'];
	$color = $auto['color'];
	$year = $auto['year'];
	$engine = $auto['engine'];
	$price = $auto['price'];
	$status = $auto['status'];
	$img = $auto['img'];
	$model = $auto['id_model'];
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['auto-edit']))) {

	//Работа с изображением 
	treatmentImg();

	$id = $_POST['id'];
	$name = $_POST['name'];
	$complexion = $_POST['complexion'];
	$color = $_POST['color'];
	$year = $_POST['year'];
	$engine = $_POST['engine'];
	$price = $_POST['price'];
	$status = $_POST['status'];
	$model = $_POST['model'];
	$img = $_POST['img'];

	//Проверка валидность формы
	if($name === '' || $complexion === '' || $color === '' || $year === '' || $engine === '' || $price === '' || $model === '') {
		array_push($errMsg, 'Заполните все обязательные поля!');
	} else {

			//Проверяем статус: выбран или нет
			if(isset($_POST['status'])) {
				$status = 1;
			} else {
				$status = 0;
			}
			
			//Формируем массив для отправки
			if(empty($img)) {
				$auto = [
					'name' => $name,
					'engine' => $engine,
					'year' => $year,
					'price' => $price,
					'color' => $color,
					'complexion' => $complexion,
					'status' => $status,
					'id_model' => $model
				];
			} else {
				$auto = [
					'name' => $name,
					'engine' => $engine,
					'year' => $year,
					'price' => $price,
					'color' => $color,
					'complexion' => $complexion,
					'img' => $_POST['img'],
					'status' => $status,
					'id_model' => $model
				];
			}

			$auto = update('auto', $id, $auto);
			header('location: ' . BASE_URL . "admin/autos/index.php"); //Возвращаем на страницу автомобилей
		}
}

//Изменение статуса авто
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['pub_id']))) {
	$id = $_GET['pub_id'];  //Получаем айди автомобиля, который хотим измнить
	$status = $_GET['status']; //Получаем статус автомобиля, который хотим измнитьб

	$autoId = update('auto', $id, ['status' => $status]); //Перезаписываем полученную запись

	header('location: ' . BASE_URL . "admin/autos/index.php"); //Возвращаем на страницу моделей
	exit();
}

//Удаление автомобиля
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_id']))) {
	$id = $_GET['del_id'];  //Получаем айди авто, которую хотим удалить
	delete('auto', $id); //Удаляем авто
	header('location: ' . BASE_URL . "admin/autos/index.php"); //Возвращаем на страницу авто
}
// ?>