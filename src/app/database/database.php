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


//Запрос на получение всех данных из одной таблицы
function selectAll($table, $params = []) {
	global $pdo; //Глобальная переменная

	//Формируем sql запрос (Пример: SELECT * FROM models)
	$sql = "SELECT * FROM $table"; 

	if(!empty($params)) { //Если массив параметров не пустой, то разбираем данные
		$i = 0; //Если i=0, то where иначе and
		foreach($params as $key => $value){ //Разбираем данные
			if(!is_numeric($value)) { //Если параметр строка, то оборачиваем ее в кавычки
				$value = "'" . $value . "'";
			}
			if($i === 0) { //Если первый параметр добавляем впереди "WHERE
				$sql = $sql . " WHERE  $key = $value";
			} else { //Если параметр не первый добавляем впередм "AND
				$sql = $sql . " AND  $key = $value";
			}
			$i++;
		}
	}

	//Подготовка sql запроса для отправки на сервер
	$query = $pdo->prepare($sql);
	$query->execute();

	//Проверка запроса на ошибки
	dbCheckErr($query);

	//Возвращаем полученный результат
	return $query->fetchAll();
}


//Запрос на получение одной строки из одной выбранной таблицы
function selectOne($table, $params = []) {
	global $pdo; //Глобальная переменная

	//Формируем sql запрос (Пример: SELECT * FROM clients)
	$sql = "SELECT * FROM $table";

	if(!empty($params)) { //Если массив параметров не пустой, то разбираем данные
		$i = 0;  //Если i=0, то where иначе and
		foreach($params as $key => $value){  //Разбираем данные
			if(!is_numeric($value)) { //Если параметр строка, то оборачиваем ее в кавычки
				$value = "'" . $value . "'";
			}
			if($i === 0) { //Если первый параметр добавляем впереди "WHERE
				$sql = $sql . " WHERE  $key = $value";
			} else {  //Если параметр не первый добавляем впередм "AND
				$sql = $sql . " AND  $key = $value";
			}
			$i++;
		}
	}

	//Подготовка sql запроса для отправки на сервер
	$query = $pdo->prepare($sql);
	$query->execute();

	//Проверка запроса на ошибки
	dbCheckErr($query);

	//Возвращаем полученный результат
	return $query->fetch();
}


//Добавление записи в таблицу 
function insert($table, $params) {
	global $pdo; //Глобальная переменная

	$i = 0; //Если 0, то запятую в sql запросе не ставим
	$coll = ''; //Ключи
	$mask = ''; //Значения

	//Разбираем параметры на данные для запроса (названия столбцов и значение)
	foreach($params as $key => $value) {
		if($i === 0) {
			$coll = $coll . $key;
			$mask = $mask . "'" . $value . "'";
		} else {
			$coll = $coll . ", $key";
			$mask = $mask . ", '$value'";
		}
		$i++;
	}

	//Формируем sql запрос (Пример: INSERT INTO contacts (name, phone, work_time, email) VALUES ('Call-center', '80447104585', '8-21', 'call@autoidea.by'))
	$sql = "INSERT INTO $table ($coll) VALUES ($mask)";

	//Подготовка sql запроса для отправки на сервер
	$query = $pdo->prepare($sql);
	$query->execute($params);

	//Проверка запроса на ошибки
	dbCheckErr($query);

	//Возвращаем полученный результат
	return $pdo->lastInsertId();
}


//Обноваление данных в таблице БД
function update($table, $id, $params) {
	global $pdo; //Глобальная переменная

	$i = 0; //Если 0, то запятую в sql запросе не ставим
	$str = ''; //Ключи и параметры для обнолвения

	//Разбираем параметры на данные для запроса (названия столбцов и значение)
	foreach($params as $key => $value) { 
		if($i === 0) {
			$str = $str . $key . " = '" . $value . "'";
		} else {
			$str = $str . ", " . $key . " = '" . $value . "'";
		}
		$i++;
	}

	//Формируем sql запрос (Пример: UPDATE contacts SET name = 'Отдел продаж автомобиля', phone = '+375447104585', work_time = 'Пн-Вс: 8:00 - 20:00', email = 'info@autoidea.by' WHERE id = 4)
	$sql = "UPDATE $table SET $str WHERE id = $id";

	//Подготовка sql запроса для отправки на сервер
	$query = $pdo->prepare($sql);
	$query->execute($params);

	//Проверка запроса на ошибки
	dbCheckErr($query);
}


//Удаление данных из таблицы БД
function delete($table, $id) {
	global $pdo; //Глобальная переменная

	//Формируем sql запрос (Пример: DELETE FROM contacts WHERE id =4)
	$sql = "DELETE FROM $table WHERE id =" . $id;

	//Подготовка sql запроса для отправки на сервер
	$query = $pdo->prepare($sql);
	$query->execute();

	//Проверка запроса на ошибки
	dbCheckErr($query);
}


//Получаем записи авто , в которых имеется название модели
function getModelsName($table1, $table2) {
	global $pdo; //Глобальная переменная

	//Формируем sql Запрос
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

	//Подготовка sql запроса для отправки на сервер
	$query = $pdo->prepare($sql);
	$query->execute();

	//Проверка запроса на ошибки
	dbCheckErr($query);

	//Возвращаем полученный результат
	return $query->fetchAll();
}


function selectAutoFromAutosWithModelsOnSingle($table1, $table2, $id) {
	global $pdo;
	$sql = "SELECT t1.*, t2.model, t2.main_foto FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_model = t2.id WHERE t1.id = $id"; 
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckErr($query); //Проверка запроса на ошибки
	return $query->fetch();
}


//Получить количество авто каждой модели
function getCountModel($idModel) {
	global $pdo; //Глобальная переменная

	//Формируем sql запрос (Пример: SELECT COUNT(id_model) AS count FROM auto JOIN models ON auto.id_model = models.id WHERE id_model = 56)
	$sql = "SELECT COUNT(id_model) AS count FROM auto JOIN models ON auto.id_model = models.id WHERE id_model = $idModel";
	
	//Подготовка sql запроса для отправки на сервер
	$query = $pdo->prepare($sql);
	$query->execute();

	//Проверка запроса на ошибки
	dbCheckErr($query);

	//Возвращаем полученный результат
	return $query->fetchAll();
}


//Выборка личных данных из сессии (того кто сейчас авторизирован)
function getPersonalData($table1, $table2, $table3, $table4, $id) {
	global $pdo; //Глобальная переменная

	//Формируем sql запрос
	$sql = "SELECT 
		t1.id,
		t1.last_name,
		t1.first_name,
		t1.surname,
		t1.date_birth,
		t1.phone,
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
		t4.email,
		t4.date_regist
	FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_address = t2.id
							JOIN $table3 AS t3 ON t1.id_passport = t3.id
							JOIN $table4 AS t4 ON t1.id_auth = t4.id 
	WHERE t4.id = $id";
	
	//Подготовка sql запроса для отправки на сервер
	$query = $pdo->prepare($sql);
	$query->execute();

	//Проверка запроса на ошибки
	dbCheckErr($query);

	//Возвращаем полученный результат
	return $query->fetch();
}


//Получаем уникальные значения цветов автомобиля
function getColorsAutos() {
	global $pdo; //Глобальная переменная

	//Формируем sql запрос
	$sql = "SELECT DISTINCT color FROM `auto`";
	
	//Подготовка sql запроса для отправки на сервер
	$query = $pdo->prepare($sql);
	$query->execute();

	//Проверка запроса на ошибки
	dbCheckErr($query);

	//Возвращаем полученный результат
	return $query->fetchAll();
}


//Поиск авто по выбранным критериям
function searchAutos($params, $paramsPrice, $paramsYear) {
	global $pdo; //Глобальная переменная

	//Получаем строку для поиска цены
	$i = 0;
	$price = '';
	if($paramsPrice['price__from'] == '' && $paramsPrice['price__to'] != '') { // Если введена только сумма "до" => price < 70000
		$price = ' price' . ' < ' . $paramsPrice['price__to']; 
	} elseif($paramsPrice['price__from'] != '' && $paramsPrice['price__to'] == '') { // Если введена только сумма "от" => price > 50000
		$price = ' price' . ' > ' . $paramsPrice['price__from']; 
	} elseif($paramsPrice['price__from'] != '' && $paramsPrice['price__to'] != '') { // Если введена сумма и "от" и "до" => price BETWEEN 50000 AND 70000
		$price = 'price ' . 'BETWEEN ' . $paramsPrice['price__from'] . ' AND ' . $paramsPrice['price__to'];   
	}

	//Полуаем строку для поиска года выпуска
	$year = '';
	if($paramsYear['year__from'] == '' && $paramsYear['year__to'] != '') { // Если введен год только "до" => year < 2022
		$year = ' year' . ' < ' . $paramsYear['year__to']; 
	} elseif($paramsYear['year__from'] != '' && $paramsYear['year__to'] == '') { // Если введен год только "от" => year > 2019
		$year = ' year' . ' > ' . $paramsYear['year__from']; 
	} elseif($paramsYear['year__from'] != '' && $paramsYear['year__to'] != '') { // Если введен год и "от" и "до" => year BETWEEN 2019 AND 2022
		$year = 'year ' . 'BETWEEN ' . $paramsYear['year__from'] . ' AND ' . $paramsYear['year__to'];   
	}

	//Получаем строку для поиска остальных данных
	$str = '';
	$i = 0;
	foreach($params as $key => $value) {
		if(!empty($value) && $value != '' && $i == 0) { //Если значение первое в строке то не ставим впереди "AND"
			$str = $str . '`' . $key .  '` = ' . "'" . $value . "'" . ' ';  // `name` = '7'  AND `color` = 'Серый' 
			$i++;
		} else if(!empty($value) && $value != '' && $i != 0) {  //Если значение первое в строке то ставим впереди "AND"
			$str = $str . ' AND '  . '`' . $key .  '` = ' . "'" . $value . "'" . ' '; 
		}
	}

	//Формируем итоговую строку запроса (проверка для правильности написания "WHERE" и "AND")
	if($price != '' && $year != '' && $str != '') { //Если заполнены все поля 
		$result = 'WHERE ' . $price . ' AND ' . $year . ' AND ' . $str; //WHERE price BETWEEN 50000 AND 70000 AND year BETWEEN 2019 AND 2023 AND `name` = '7'  AND `complexion` = 'Средняя'  AND `color` = 'Серый'  AND `status` = '1'  AND `engine` = 'Бензиновый' 
	} else if($price != '' && $year != '' && $str == '') { //Если азполнены поля цены и гола, но не заполнены другие данные
		$result = 'WHERE ' . $price . ' AND ' . $year; // WHERE price BETWEEN 50000 AND 70000 AND year BETWEEN 2020 AND 2023
	} else if($price != '' && $year == '' && $str != '') { //Если заполнены поля цены и других данных, но не заполнен год
		$result = 'WHERE ' . $price . ' AND ' . $str; //WHERE price BETWEEN 55000 AND 65000 AND `name` = '7'  AND `color` = 'Синий' 
	} else if($price == '' && $year != '' && $str != '') { //Если заполнены год и другие данные, но не заполнена цена
		$result = 'WHERE ' . $year . ' AND ' . $str;	 //WHERE year BETWEEN 2019 AND 2023 AND `name` = '7'  AND `complexion` = 'Полная'  AND `color` = 'Голубой'  AND `status` = '1'  AND `engine` = 'Бензиновый' 
	} else if($price != '' && $year == '' && $str == '') { //Если заполнена только цена, а год и другие данные не заполнены
		$result = 'WHERE ' . $price; //WHERE price BETWEEN 50000 AND 65000
	} else if($price == '' && $year != '' && $str == '') {  //Если заполнены только год, а цена и другие данные не заполнены
		$result = 'WHERE ' . $year; //WHERE year BETWEEN 2020 AND 2022
	} else if($price == '' && $year == '' && $str != '') { //Если заполнены только другие данные, а цена и год не заполнены
		$result = 'WHERE ' . $str; //WHERE `complexion` = 'Полная'  AND `color` = 'Черный' 
	}

	//Формируем sql запрос
	$sql = "SELECT 
		auto.id,
	 	auto.name,
	 	auto.engine,
	 	auto.year,
	 	auto.price,
	 	auto.color,
	 	auto.complexion,
	 	auto.img,
	 	auto.status,
	 	models.model 
	 	FROM `auto` JOIN `models` ON auto.id_model = models.id $result";

	//Подготовка sql запроса для отправки на сервер
	$query = $pdo->prepare($sql);
	$query->execute();

	//Проверка запроса на ошибки
	dbCheckErr($query);

	//Возвращаем полученный результат
	return $query->fetchAll();
}

//Выборка сотрудников
function getEmployees($table1, $table2, $table3, $table4) {
	global $pdo;
	$sql = "SELECT 
		t1.id,
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

//Поиск в панели админа по почти всем данным
function searchAdmin($search, $table) {
	$search = trim(strip_tags(stripcslashes(htmlspecialchars($search)))); //Проверка вводимой строки
	global $pdo; //Глобальная переменная

	//Формируем sql запрос
	$sql = "SELECT * FROM $table WHERE 
			last_name LIKE '%$search%' OR
			first_name LIKE '%$search%'OR
		 	surname LIKE '%$search%' OR
			date_birth LIKE '%$search%' OR
			job  LIKE '%$search%' OR
			phone LIKE '%$search%' OR
			city LIKE '%$search%' OR 
			`number` LIKE '%$search%' OR
			`login` LIKE '%$search%'  OR
			email LIKE '%$search%' OR 
			series LIKE '%$search%' OR
			issued_by LIKE '%$search%' OR 
			issued_when LIKE '%$search%' OR
			validity	LIKE '%$search%'";

	//Подготовка sql запроса для отправки на сервер
	$query = $pdo->prepare($sql);
	$query->execute();

	//Проверка запроса на ошибки
	dbCheckErr($query);

	//Возвращаем полученный результат
	return $query->fetchAll();
}
?>