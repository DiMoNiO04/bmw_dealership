<?php 

class UserActions {

  public $ACCESS = 1; 
  public $NO_ACCESS = 0;
  public $CLIENT = 0;
  public $EMPLOYEE = 1;
  public $errMsg = [];

  public function userAuth($arr) : void {
    $_SESSION['id'] = $arr['id'];
    $_SESSION['login'] = $arr['login'];
    $_SESSION['role'] = $arr['role'];
    $_SESSION['access'] = $arr['access'];
  
    if($_SESSION['admin']) {
      header('location:/admin/clientss/index.php');
    } 
    header('location:/bmw/');
  }

  public function registration(): void {

    $db = new DataB();
      
    //Забираем данные из формы в переменные
    $email = trim($_POST['email']);
    $login = trim($_POST['login']);
    $passwordF = $_POST['password-first'];
    $passwordS = $_POST['password-second'];

    //Проверка валидности формы
    if(mb_strlen($login, 'UTF8') < 3) {
      array_push($this -> errMsg, 'Логин должен быть более трех символов!');
    } elseif($passwordF !== $passwordS) {
      array_push($this -> errMsg, 'Пароли в обеих полях должны соотвествовать!');
    } else {
      //Проверка на уникальность логина и email
      $existenceLogin = $db->selectOne('authorization', ['login' => $login]);
      $existenceEmail = $db->selectOne('authorization', ['email' => $email]);

      if($existenceLogin['login'] === $login) {
        array_push($this -> errMsg,  'Пользователь с таким логином уже зарегистрирован!');
      } elseif($existenceEmail['email'] === $email) {
        array_push($this -> errMsg, 'Пользователь с такой почтой уже зарегистрован!');
      }else {
        $password = password_hash($passwordF, PASSWORD_DEFAULT); //Хешируем пароль перед отправкой в базу данных

        //Формируем массив для таблицы авторизации
        $dataAuth = [
          'login' => $login,
          'password' => $password,
          'access' => $this -> ACCESS,
          'role' => $this -> CLIENT,
          'email' => $email
        ];

        //Формируем массив паспорта
        $dataPassport = [
          'series' => $series,
          'number' => $number,
          'issued_by' => $issuedBy
        ];

        //Формируем массив адресса
        $dataAddress = [
          'city' => $city,
          'street' => $street,
          'house' => $house,
          'apartment' => $apartment 
        ];

        //Добавляем данные в базу данных
        $idPassport = $db->insert('clients_passport', $dataPassport);
        $idAddress = $db->insert('clients_address', $dataAddress);
        $idAuth = $db->insert('authorization', $dataAuth);
        $id_auth = $db->selectOne('authorization', ['id' => $idAuth]);

        //Формируем данные в таблицу клиентов
        $dataPersonal = [
          'last_name' => trim($_POST['last_name']),
          'first_name' => trim($_POST['first_name']),
          'surname' => $surname,
          'phone' => $phone,
          'id_address' => $idAddress,
          'id_auth' => $idAuth,
          'id_passport' => $idPassport
        ];

        $id = $id_auth['id'];
        $db->insert('clients', $dataPersonal); //Отправляем данные в таблицу клиентов
        $user = $db->selectOne('authorization', ['id' => $id]);
        $this -> userAuth($user); //Создаем сессию для авторизации
      }
    }
  }

  public function authorization(): void {
    //Забираем данные из формы в переменные
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    //Проверка валидности формы
    $db = new DataB();
    $existence = $db->selectOne('authorization', ['email' => $email]);
      
    if($existence['access'] == $this -> NO_ACCESS) {
      array_push($this -> errMsg, "Данный аккаунт не имеет доступа (заблокирован)!");
    } else {
      if($existence && password_verify($password, $existence['password'])) {
        $this -> userAuth($existence); //Создаем сессию для авторизации
      } 
      password_verify($password, $existence['password']);
      array_push($this -> errMsg, "Неправильный логин или пароль!");
    }
  }

  public function editPassword($id): void {

    $db = new DataB();

    $passwordF = $_POST['passF'];
    $password = password_hash($passwordF, PASSWORD_DEFAULT); //Хешируем пароль перед отправкой в базу данных
  
    //Формируем массив данных, которые хотим изменит
    $data = [
      'password' => $password,
      'access' => $this -> ACCESS
    ];

    $db->update('authorization', $id, $data);//Обновляем пароль
  }

  public function updateUser(): void {

      $db = new DataB();

      //Проверка на доступ
      if(isset($_POST['access'])) {
        $access = $this -> ACCESS;
      } else if($_SESSION['access'] == $this -> ACCESS) {
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
        'phone' => trim($_POST['phone'])
      ];
  
      $id = $_POST['id']; //Получаем данные сотрудника из формы

      if($_SESSION['role'] == 1) {
        $idEmployee = $db->selectOne('employees', ['id_auth' => $id]); //Получаем данные сотрудника, которого хотим отредактировать
        $idAuth = $idEmployee['id_auth']; //Получаем айди записи авторизации, которую хотим запись
        $idAddress = $idEmployee['id_address']; //Получаем айди записи адресса, которую хотим запись
        $idPas = $idEmployee['id_passport']; //Получаем айди записи паспорта, которую хотим запись
    
        //Обновляем данные сотрудника, которого отредактировали
        $db->update('employees', $idEmployee['id'], $dataPersonal);
        $db->update('employees_passport', $idPas, $dataPassport);
        $db->update('employees_address', $idAddress, $dataAddress);
        $db->update('authorization', $idAuth, $dataAuth);
      } else {
        $idClients = $db->selectOne('clients', ['id_auth' => $id]); //Получаем данные сотрудника, которого хотим отредактировать
        $idAuth = $idClients['id_auth']; //Получаем айди записи авторизации, которую хотим запись
        $idAddress = $idClients['id_address']; //Получаем айди записи адресса, которую хотим запись
        $idPas = $idClients['id_passport']; //Получаем айди записи паспорта, которую хотим запись
  
        //Обновляем данные сотрудника, которого отредактировали
        $db->update('clients', $idClients['id'], $dataPersonal);
        $db->update('clients_passport', $idPas, $dataPassport);
        $db->update('clients_address', $idAddress, $dataAddress);
        $db->update('authorization', $idAuth, $dataAuth);
      }
  } 

  public function deleteUser($id): void {

    $db = new DataB();

    //Проверям на клиента (сотрудника)
    if($_SESSION['role'] == $this -> EMPLOYEE) { //Если сотрудник
      $idEmployee = $db->selectOne('employees', ['id_auth' => $id]); 

      $idAuth = $idEmployee['id_auth']; //Получаем айди авторизации для данного сотрудника
      $idAddress = $idEmployee['id_address']; //Получаем айди адресса для данного сотрудника
      $idPas = $idEmployee['id_passport']; //Получаем айди паспорта для данного сотрудника
    
      $db->delete('authorization', $idAuth); //Удаляем данные авторизации
      $db->delete('employees_address', $idAddress); //Удаляем данные адресса
      $db->delete('employees_passport', $idPas); //Удаляем  данные паспорта
      $db->delete('employees', $id); //Удаляем сотрудника
    } else { //Если клиент
      $idClients = $db->selectOne('clients', ['id_auth' => $id]); 

      $idAuth = $idClients['id_auth']; //Получаем айди авторизации для данного клиента
      $idAddress = $idClients['id_address']; //Получаем айди адресса для данного клиента
      $idPas = $idClients['id_passport']; //Получаем айди паспорта для данного клиента
    
      $db->delete('authorization', $idAuth); //Удаляем данные авторизации
      $db->delete('clients_address', $idAddress); //Удаляем данные адресса
      $db->delete('clients_passport', $idPas); //Удаляем  данные паспорта
      $db->delete('clients', $id); //Удаляем клиента
    }

    header('location:/bmw/logout.php'); //Возвращаем на страницу
  } 

  public function addOrder(): void {
    $db = new DataB();

    $email = trim($_POST['email']);
    $login = trim($_POST['login']);
    $passF = trim($_POST['password-first']);
    $passS = trim($_POST['password-second']);

    $idAuto = $_GET['auto'];
    $idSession = $_SESSION['id'];
    $roleSession = $_SESSION['role'];

    $user = $db->selectOne('authorization', ['id' => $idSession]);
    $idUser = $db->selectOne('clients', ['id_auth' => $idSession])['id'];

    if($login != $user['login'] || $email != $user['email'] || (!password_verify($passS, $user['password'])) || $passF != $passS) {
      array_push($this -> errMsg, "Не верно введены данные! \n Заказ не был оформлен! \n Повторите попытку!");
    } else {

      if($roleSession == $this -> CLIENT) {
        $params = [
          'id_client' => $idUser,
          'id_auto' => $idAuto
        ];
      }

      $db->insert('orders', $params); //Отправляем данные в таблицу клиентов
      header('location:personal__cab-user.php'); //Возвращаем на страницу клиентов
    }
  }

  public function deleteOrder($id): void {
    $db = new DataB();

    $db->delete('orders', $id); //Удаляем
    if($_SESSION['role'] == $this -> CLIENT) {
      header('location:personal__cab-user.php'); //Возвращаем на страницу моделей
    } 
    header('location: ' . BASE_URL . "admin/orders/index.php"); //Возвращаем на страницу моделей
  }
}
?>