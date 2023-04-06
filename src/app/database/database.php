<?php 

session_start();
require('connect.php');

//Тестовая функция вывода
function tt($value) {
	echo '<pre>';
	print_r($value);
	echo '</pre>';
	exit();
}


//Проверяем выполнение запроса к БД
function dbCheckErr($query) {
	$errInfo = $query->errorInfo(); //Получаем ошибки в массив
	if($errInfo[0] !== PDO::ERR_NONE){
		echo $errInfo[2]; //Вывод ошибки
		exit(); //Завершаем функцию
	}
	return true;
}


//Запрос на получение данных из одной таблицы
function selectAll($table, $params = []) {
	global $pdo;

	$sql = "SELECT * FROM $table"; 

	if(!empty($params)) { //Если массив параметров не пустой, то разбираем данные
		$i = 0; //Если i=0, то where иначе and
		foreach($params as $key => $value){ //Разбираем данные
			if(!is_numeric($value)) { //Если параметр строка, то оборачиваем ее в кавычки
				$value = "'" . $value . "'";
			}
			if($i === 0) { //Если первый параметр
				$sql = $sql . " WHERE  $key = $value";
			} else { //Если параметр не первый
				$sql = $sql . " AND  $key = $value";
			}
			$i++;
		}
	}

	//Подготавливаем запрос
	$query = $pdo->prepare($sql);
	$query->execute();

	dbCheckErr($query); //Проверка запроса на ошибки
	return $query->fetchAll(); //Возвращаем массив полученных данные (несколько)
}


//Запрос на получение одной строки из одной выбранной таблицы
function selectOne($table, $params = []) {
	global $pdo;

	$sql = "SELECT * FROM $table";

	if(!empty($params)) { //Если массив параметров не пустой, то разбираем данные
		$i = 0;  //Если i=0, то where иначе and
		foreach($params as $key => $value){  //Разбираем данные
			if(!is_numeric($value)) { //Если параметр строка, то оборачиваем ее в кавычки
				$value = "'" . $value . "'";
			}
			if($i === 0) { //Если первый параметр
				$sql = $sql . " WHERE  $key = $value";
			} else {  //Если параметр не первый
				$sql = $sql . " AND  $key = $value";
			}
			$i++;
		}
	}

	//Подготавливаем запрос
	$query = $pdo->prepare($sql);
	$query->execute();

	dbCheckErr($query); //Проверка запроса на ошибки
	return $query->fetch();  //Возвращаем строку полученных данных (одну)
}


//Запись в таблицу БД
function insert($table, $params) {
	global $pdo;

	$i = 0; //Если 0, то запятую в sql запросе не ставим
	$coll = ''; //Ключи
	$mask = ''; //Значения

	foreach($params as $key => $value) { //Разбираем параметры на данных для запроса
		if($i === 0) {
			$coll = $coll . $key;
			$mask = $mask . "'" . $value . "'";
		} else {
			$coll = $coll . ", $key";
			$mask = $mask . ", '$value'";
		}
		$i++;
	}

	$sql = "INSERT INTO $table ($coll) VALUES ($mask)"; //SQL-запрос

	//Подготавливаем запрос
	$query = $pdo->prepare($sql);
	$query->execute($params);
	dbCheckErr($query); //Проверка запроса на ошибки
	return $pdo->lastInsertId();
}


//Обноваление данных в таблицы БД
function update($table, $id, $params) {
	global $pdo;

	$i = 0;
	$str = ''; //Ключи и параметры для обнолвения

	foreach($params as $key => $value) { //Разбираем параметры на строку запроса
		if($i === 0) {
			$str = $str . $key . " = '" . $value . "'";
		} else {
			$str = $str . ", " . $key . " = '" . $value . "'";
		}
		$i++;
	}

	$sql = "UPDATE $table SET $str WHERE id = $id"; //SQL-запрос на обновление

	//Подготавливаем запрос
	$query = $pdo->prepare($sql);
	$query->execute($params);
	dbCheckErr($query); //Проверка запроса на ошибки
}


//Удаление данных из таблицы БД
function delete($table, $id) {
	global $pdo;

	$sql = "DELETE FROM $table WHERE id =" . $id; //SQL-запрос на удаление

	//Подготавливаем запрос
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckErr($query); //Проверка запроса на ошибки
}
?>