<?php

include SITE_ROOT . "/app/database/database.php";
include SITE_ROOT . "/app/helps/treatmentImage.php";

//Если сессия закончилась, то возврат на страницу авторизации
if(!$_SESSION) {
	header('location: ' . BASE_URL . 'auth.php');
}

//Получаем все данные из таблицы models и auto
$models = selectAll('models');
$autoModelsName = selectAll('autosview');


class Auto {

	public $AVAILABLE = 1;
	public $NO_AVAILABLE = 0;

	public function addAuto() {

		//Работа с изображением
		treatmentImg("\assets\images\dest\cars\\");

		//Проверяем статус: выбран или нет
		$status = trim($_POST['status']);
		if(isset($_POST['status'])) {
			$status = $this -> AVAILABLE;
		} else {
			$status = $this -> $NO_AVAILABLE;
		}
			
		//Формируем массив для отправки
		$auto = [
			'name' => trim($_POST['name']),
			'engine' => trim($_POST['engine']),
			'year' => trim($_POST['year']),
			'price' => trim($_POST['price']),
			'color' =>  trim($_POST['color']),
			'complexion' => trim($_POST['complexion']),
			'img' => $_POST['img'],
			'status' => $status,
			'state' => trim($_POST['state']),
			'id_model' => trim($_POST['model'])
		];

		$auto = insert('auto', $auto); //Отправляем данные в таблицу auti
		$auto = selectOne('auto', ['id' => $id]); //Получаем данные добавленной модели
		header('location: ' . BASE_URL . "admin/autos/index.php"); //Возвращаем на страницу автомобилей
	}

	public function updateAuto() {
		//Работа с изображением 
		treatmentImg("\assets\images\dest\cars\\");

		//Проверяем статус: выбран или нет
		$status = trim($_POST['status']);
		if(isset($_POST['status'])) {
			$status = $this -> AVAILABLE;
		} else {
			$status = $this -> $NO_AVAILABLE;
		}
		
		//Формируем массив для отправки
		if(empty($img)) {
			$auto = [
				'name' => trim($_POST['name']),
				'engine' => trim($_POST['engine']),
				'year' => trim($_POST['year']),
				'price' => trim($_POST['price']),
				'color' => trim($_POST['color']),
				'complexion' => trim($_POST['complexion']),
				'status' => $status,
				'id_model' => trim($_POST['model'])
			];
		} else {
			$auto = [
				'name' => trim($_POST['name']),
				'engine' => trim($_POST['engine']),
				'year' => trim($_POST['year']),
				'price' => trim($_POST['price']),
				'color' => trim($_POST['color']),
				'complexion' => trim($_POST['complexion']),
				'img' => $_POST['img'],
				'status' => $status,
				'id_model' => trim($_POST['model'])
			];
		}

		$id = $_POST['id']; //Получаем айди автомобиля, который хотим изменить
		$auto = update('auto', $id, $auto); //Обновляем данные автомобиля
		header('location: ' . BASE_URL . "admin/autos/index.php"); //Возвращаем на страницу автомобилей
	}

	public function updateStatusAuto($id) {
		$status = $_GET['status']; //Получаем статус автомобиля, который хотим измнитьб
		$autoId = update('auto', $id, ['status' => $status]); //Перезаписываем полученную запись
		header('location: ' . BASE_URL . "admin/autos/index.php"); //Возвращаем на страницу моделей
	}

	public function deleteAuto($id) {
		delete('auto', $id); //Удаляем авто
		header('location: ' . BASE_URL . "admin/autos/index.php"); //Возвращаем на страницу авто
	}

}


$auto = new Auto();

//Код для создания автомобиля
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['auto-create']))) {
	$auto -> addAuto();
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

//Код редактирования данных автомобиля
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['auto-edit']))) {
	$auto -> updateAuto();
}

//Изменение статуса авто
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['pub_id']))) {
	$id = $_GET['pub_id'];  //Получаем айди автомобиля, который хотим измнить
	$auto -> updateStatusAuto($id);
}

//Удаление автомобиля
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_id']))) {
	$id = $_GET['del_id'];  //Получаем айди авто, которую хотим удалить
	$auto -> deleteAuto($id);
}
// ?>