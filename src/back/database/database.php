<?php 

require('connect.php');

//Тестовая функция вывода
function tt($value) {
	echo '<pre>';
	print_r($value);
	echo '</pre>';
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
?>