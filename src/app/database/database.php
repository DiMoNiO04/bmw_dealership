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

//Выборка записей с названием авто
function getModelsName($table1, $table2) {
	global $pdo;
	$sql = "SELECT 
		t1.id,
		t1.name,
		t1.engine,
		t1.year,
		t1.price,
		t1.color,
		t1.complexion,
		t1.img,
		t1.status,
		t2.model 
	FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_model = t2.id"; 
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckErr($query); //Проверка запроса на ошибки
	return $query->fetchAll();
}

//Выборка клиентов 
function getClients($table1, $table2, $table3, $table4) {
	global $pdo;
	$sql = "SELECT 
		t1.id,
		t1.last_name,
		t1.first_name,
		t1.surname,
		t1.date_birth,
		t1.phone,
		t1.img,
		t2.city,
		t2.street,
		t2.house,
		t2.apartment,
		t3.series,
		t3.number,
		t3.issued_by,
		t3.issued_when,
		t3.validity,
		t4.login,
		t4.role,
		t4.email,
		t4.access,
		t4.date_regist
	FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_address = t2.id
							JOIN $table3 AS t3 ON t1.id_passport = t3.id
							JOIN $table4 AS t4 ON t1.id_auth = t4.id"; 
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckErr($query); //Проверка запроса на ошибки
	return $query->fetchAll();
}

//Выборка сотрудников
function getEmployees($table1, $table2, $table3, $table4) {
	global $pdo;
	$sql = "SELECT 
		t1.last_name,
		t1.first_name,
		t1.surname,
		t1.date_birth,
		t1.phone,
		t1.img,
		t1.job,
		t2.city,
		t2.street,
		t2.house,
		t2.apartment,
		t3.series,
		t3.number,
		t3.issued_by,
		t3.issued_when,
		t3.validity,
		t4.login,
		t4.role,
		t4.email,
		t4.access,
		t4.date_regist
	FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_address = t2.id
							JOIN $table3 AS t3 ON t1.id_passport = t3.id
							JOIN $table4 AS t4 ON t1.id_auth = t4.id"; 
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckErr($query); //Проверка запроса на ошибки
	return $query->fetchAll();
}
?>