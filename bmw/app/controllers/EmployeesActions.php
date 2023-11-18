<?php

class EmployeesActions {

  public $ACCESS = 1;
  public $NO_ACCESS = 0;
  public $ADMIN = 1;
  public $errMsg = [];

  //Добавление сотрудника
  public function addEmployee(): void {
    $db = new DataB();

    //Забираем данные из формы в переменные
    $login = trim($_POST['login']);
    $password = $_POST['password'];
    $email = trim($_POST['email']);
    $jobTitle = $_POST['job'];

    //Проверка валидности формы
    if(mb_strlen($login, 'UTF8') < 3) {
      array_push($this -> errMsg, 'Логин должен быть более трех символов!');
    } else {
      //Проверка на уникальность логина и email
      $existenceLogin = $db->selectOne('authorization', ['login' => $login]);
      $existenceEmail = $db->selectOne('authorization', ['email' => $email]);

      if($existenceLogin['login'] === $login) {
        array_push($this -> errMsg,  'Пользователь с таким логином уже зарегистрирован!');
      } elseif($existenceEmail['email'] === $email) {
        array_push($this -> errMsg, 'Пользователь с такой почтой уже зарегистрован!');
      }else {
        $password = password_hash($password , PASSWORD_DEFAULT); //Хешируем пароль перед отправкой в базу данных

        //Проверка на доступ
        if(isset($_POST['access'])) {
          $access = $this -> ACCESS;
        } else {
          $access = $this -> NO_ACCESS;
        }
        
        //Формируем массив для таблицы авторизации
        $dataAuth = [
          'login' => $login,
          'password' => $password,
          'access' => $access,
          'role' => $this -> ADMIN,
          'email' => $email 
        ];

        //Формируем массив для таблицы паспорта
        $dataPassport = [
          'series' => trim($_POST['series']),
          'number' => trim($_POST['number']),
          'issued_by' => trim($_POST['issued_by'])
        ];

        //Формируем массив для таблицы аддресса
        $dataAddress = [
          'city' => trim($_POST['city']),
          'street' => trim($_POST['street']),
          'house' => trim($_POST['house']),
          'apartment' => trim($_POST['apartment']) 
        ];

        //Добавляем данные
        $idPassport = $db->insert('employees_passport', $dataPassport);
        $idAddress = $db->insert('employees_address', $dataAddress);
        $idAuth = $db->insert('authorization', $dataAuth);
        $id_auth = $db->selectOne('authorization', ['id' => $idAuth]);

        //Формируем данные в таблицу сотрудников
        $dataPersonal = [
          'last_name' => trim($_POST['last_name']),
          'first_name' => trim($_POST['first_name']),
          'surname' => trim($_POST['surname']),
          'date_birth' => trim($_POST['date_birth']),
          'phone' => trim($_POST['phone']),
          'job' => $jobTitle,
          'id_address' => $idAddress,
          'id_auth' => $idAuth,
          'id_passport' => $idPassport
        ];

        $db->insert('employees', $dataPersonal); //Отправляем данные в таблицу сотрудников
        header('location:index.php'); //Возвращаем на страницу сотрудников
      }
    } 
  }

  //Редактирование сотрудника
  public function updateEmployee(): void {
  
    $db = new DataB();

    //Проверка на доступ
    $access = $_POST['access'];
    if(isset($_POST['access'])) {
      $access = $this -> ACCESS;
    } else {
      $access = $this -> NO_ACCESS;
    }
      
    //Формируем массив для таблицы авторизации
    $dataAuth = [
      'access' => $access,
    ];
  
    //Формируем массив паспорта
    $dataPassport = [
      'series' => trim($_POST['series']),
      'number' => trim($_POST['number']),
      'issued_by' => trim($_POST['issued_by'])
    ];
  
    //Формируем массив адресса
    $dataAddress = [
      'city' => trim($_POST['city']),
      'street' => trim($_POST['street']),
      'house' => trim($_POST['house']),
      'apartment' => trim($_POST['apartment'])
    ];
  
    //Формируем данные в таблицу клиентов
    $dataPersonal = [
      'last_name' => trim($_POST['last_name']),
      'first_name' => trim($_POST['first_name']),
      'surname' => trim($_POST['surname']),
      'date_birth' => $_POST['date_birth'],
      'phone' => trim($_POST['phone']),
      'job' => $_POST['job'],
    ];

    $id = $_POST['id']; //Получаем данные сотрудника из формы
  
    $idEmployee = $db->selectOne('employees', ['id' => $id]); //Получаем данные сотрудника, которого хотим отредактировать
    $idAuth = $idEmployee['id_auth']; //Получаем айди записи авторизации, которую хотим запись
    $idAddress = $idEmployee['id_address']; //Получаем айди записи адресса, которую хотим запись
    $idPas = $idEmployee['id_passport']; //Получаем айди записи паспорта, которую хотим запись
  
    //Обновляем данные сотрудника, которого отредактировали
    $db->update('employees', $id, $dataPersonal);
    $db->update('employees_passport', $idPas, $dataPassport);
    $db->update('employees_address', $idAddress, $dataAddress);
    $db->update('authorization', $idAuth, $dataAuth);
  
    header('location:index.php'); //Возвращаем на страницу сотрудников
  }

  //Редактирование доступа сотрудника
  public function updateStatusEmployee($id): void {

    $db = new DataB();

    $access = $_GET['access'];
  
    $employee = $db->selectOne('employees', ['id' => $id]); //Получаем данные сотрудника, которого хоти изменитьь
    $employeeAuth = $db->selectOne('authorization', ['id' => $employee['id_auth']]); //Получаем данные авторизации, которую хоти изменить
    $idAuth = $employeeAuth['id'];  //Получаем айди авторизации, которую хоти изменить

    $db->update('authorization', $idAuth, ['access' => $access]); //Перезаписываем полученную запись
    header('location:index.php'); //Возвращаем на страницу сотрудников
  }

  //Удаление сотрудника
  public function deleteEmployee($id): void {
    $db = new DataB();

    $db->delete('employees', $id); //Удаляем сотрудника
    header('location:index.php'); //Возвращаем на страницу сотрудников
  }

}

?>