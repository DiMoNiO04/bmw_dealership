<?php 

session_start();
require('ConnectBD.php');


class DataB {

  private function executeSql($sql): object {
    global $pdo;

    $query = $pdo->prepare($sql);
    $query->execute();

    $this->dbCheckErr($query);
    return $query;
  }

  private function dbCheckErr($query): bool {
    $errInfo = $query->errorInfo();
    if($errInfo[0] !== PDO::ERR_NONE){
      echo $errInfo[2];
      exit();
    }
    return true;
  }

  public function selectAll($table, $params = []) {

    $sql = "SELECT * FROM $table"; 

    if(!empty($params)) {
      $i = 0; 
      foreach($params as $key => $value){ 
        if(!is_numeric($value)) {
          $value = "'" . $value . "'";
        }
        if($i === 0) { 
          $sql = $sql . " WHERE  $key = $value";
        } else { 
          $sql = $sql . " AND  $key = $value";
        }
        $i++;
      }
    }

    $query = $this->executeSql($sql);

    return $query->fetchAll();
  }
 
  public function insert($table, $params) {
    global $pdo;

    $i = 0; 
    $coll = ''; 
    $mask = '';

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

    $sql = "INSERT INTO $table ($coll) VALUES ($mask)";

    $query = $pdo->prepare($sql);
    $query->execute($params);

    $this->dbCheckErr($query);
    $lastId = $pdo->lastInsertId();

    return $lastId;
  }

  public function selectOne($table, $params = []) {

    $sql = "SELECT * FROM $table";

    if(!empty($params)) {
      $i = 0; 
      foreach($params as $key => $value){ 
        if(!is_numeric($value)) {
          $value = "'" . $value . "'";
        }
        if($i === 0) { 
          $sql = $sql . " WHERE  $key = $value";
        } else { 
          $sql = $sql . " AND  $key = $value";
        }
        $i++;
      }
    }

   $query = $this->executeSql($sql);

    return $query->fetch();
  }

  public function update($table, $id, $params) {

    $i = 0;
    $str = '';

    foreach($params as $key => $value) { 
      if($i === 0) {
        $str = $str . $key . " = '" . $value . "'";
      } else {
        $str = $str . ", " . $key . " = '" . $value . "'";
      }
      $i++;
    }

    $sql = "UPDATE $table SET $str WHERE id = $id";

    $this->executeSql($sql);
  }

  public function delete($table, $id) {
    global $pdo;

    $sql = "DELETE FROM $table WHERE id =" . $id;

    $query = $this->executeSql($sql);
  }

  public function selectAutoFromAutosWithModelsOnSingle($table1, $table2, $id) {
    $sql = "SELECT t1.*, t2.model, t2.main_foto FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_model = t2.id WHERE t1.id = $id"; 
    $query = $this->executeSql($sql);
    return $query->fetch();
  }

  public function getCountModel($idModel) {

    $sql = "SELECT COUNT(id_model) AS count FROM auto JOIN models ON auto.id_model = models.id WHERE id_model = $idModel";
    
    $query = $this->executeSql($sql);

    return $query->fetchAll();
  }

  public function getPersonalData($table1, $table2, $table3, $table4, $id) {

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
      t4.login,
      t4.email,
      t4.date_regist
    FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_address = t2.id
                JOIN $table3 AS t3 ON t1.id_passport = t3.id
                JOIN $table4 AS t4 ON t1.id_auth = t4.id 
    WHERE t4.id = $id";
    
    $query = $this->executeSql($sql);

    return $query->fetch();
  }

  public function getOrders($id) {

    $sql = "SELECT
      t1.id, 
      t1.date,
      t2.last_name,
      t2.first_name,
      t2.phone,
      t5.email AS emailEmployee,
      t4.name AS nameContact,
      t4.email AS emailContact,
      t4.phone AS phoneContact,
      t4.work_time,
      t3.name,
      t6.model,
      t3.engine,
      t3.year,
      t3.price,
      t3.color,
      t3.complexion,
      t3.state
    FROM orders AS t1 JOIN employees AS t2 ON t1.id_employee = t2.id
                JOIN `auto` AS t3 ON t1.id_auto = t3.id
                JOIN contacts AS t4 ON t1.id_contact = t4.id 
                JOIN authorization AS t5 ON t2.id_auth = t5.id 
                JOIN models AS t6 ON t3.id_model = t6.id
    WHERE t1.id_client = $id";
    
    $query = $this->executeSql($sql);

    return $query->fetchAll();
  }

  public function getColorsAutos() {

    $sql = "SELECT DISTINCT color FROM `auto`";
    
    $query = $this->executeSql($sql);

    return $query->fetchAll();
  }

  public function searchAutos($params, $paramsPrice, $paramsYear) {

    $i = 0;
    $price = '';
    if($paramsPrice['price__from'] == '' && $paramsPrice['price__to'] != '') { // Если введена только сумма "до" => price < 70000
      $price = ' price' . ' < ' . $paramsPrice['price__to']; 
    } elseif($paramsPrice['price__from'] != '' && $paramsPrice['price__to'] == '') { // Если введена только сумма "от" => price > 50000
      $price = ' price' . ' > ' . $paramsPrice['price__from']; 
    } elseif($paramsPrice['price__from'] != '' && $paramsPrice['price__to'] != '') { // Если введена сумма и "от" и "до" => price BETWEEN 50000 AND 70000
      $price = 'price ' . 'BETWEEN ' . $paramsPrice['price__from'] . ' AND ' . $paramsPrice['price__to'];   
    }

    $year = '';
    if($paramsYear['year__from'] == '' && $paramsYear['year__to'] != '') { // Если введен год только "до" => year < 2022
      $year = ' year' . ' < ' . $paramsYear['year__to']; 
    } elseif($paramsYear['year__from'] != '' && $paramsYear['year__to'] == '') { // Если введен год только "от" => year > 2019
      $year = ' year' . ' > ' . $paramsYear['year__from']; 
    } elseif($paramsYear['year__from'] != '' && $paramsYear['year__to'] != '') { // Если введен год и "от" и "до" => year BETWEEN 2019 AND 2022
      $year = 'year ' . 'BETWEEN ' . $paramsYear['year__from'] . ' AND ' . $paramsYear['year__to'];   
    }

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

    $query = $this->executeSql($sql);

    return $query->fetchAll();
  }

  public function searchAdmin($search, $table) {

    $search = trim(strip_tags(stripcslashes(htmlspecialchars($search))));

    $sql = "SELECT * FROM $table WHERE 
        last_name LIKE '%$search%' OR
        first_name LIKE '%$search%'OR
        surname LIKE '%$search%' OR
        date_birth LIKE '%$search%' OR
        phone LIKE '%$search%' OR
        city LIKE '%$search%' OR 
        `number` LIKE '%$search%' OR
        `login` LIKE '%$search%'  OR
        email LIKE '%$search%' OR 
        series LIKE '%$search%' OR
        issued_by LIKE '%$search%'";

    $query = $this->executeSql($sql);

    return $query->fetchAll();
  }
}

?>