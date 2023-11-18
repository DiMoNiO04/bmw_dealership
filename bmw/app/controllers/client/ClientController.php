<?php 

class ClientController {

  private $ACCESS = 1;
  private $NO_ACCESS = 0;
  private $CLIENT = 0;
  public $errMsg = [];

  public function addClient(): void {

    $db = new DataB();

    //Забираем данные из формы в переменные
    $login = trim($_POST['login']);
    $password = $_POST['password'];
    $email = trim($_POST['email']);
    $access = $ACCESS;
    $role = $CLIENT;

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
        $password  = password_hash($password , PASSWORD_DEFAULT); //Хешируем пароль перед отправкой в базу данных

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
          'role' => $this -> CLIENT,
          'email' => $email 
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

        //Добавляем данные в базу данных
        $idPassport = $db->insert('clients_passport', $dataPassport);
        $idAddress = $db->insert('clients_address', $dataAddress);
        $idAuth = $db->insert('authorization', $dataAuth);
        $id_auth = $db->selectOne('authorization', ['id' => $idAuth]);

        //Формируем данные в таблицу клиентов
        $dataPersonal = [
          'last_name' => trim($_POST['last_name']),
          'first_name' => trim($_POST['first_name']),
          'surname' => trim($_POST['surname']),
          'date_birth' => trim($_POST['date_birth']),
          'phone' => trim($_POST['phone']),
          'id_address' => $idAddress,
          'id_auth' => $idAuth,
          'id_passport' => $idPassport
        ];

        $db->insert('clients', $dataPersonal); //Отправляем данные в таблицу клиентов
        header('location:index.php'); //Возвращаем на страницу клиентов
      }
    }
  }

  public function updateClient(): void {

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
      'phone' => trim($_POST['phone'])
    ];

    $id = $_POST['id']; //Получаем данные клиента из формы
    $idClient = $db->selectOne('clients', ['id' => $id]); //Получаем данные клиента, которого хотим отредактировать
    $idAuth = $idClient['id_auth']; //Получаем айди записи авторизации, которую хотим запись
    $idAddress = $idClient['id_address']; //Получаем айди записи адресса, которую хотим запись
    $idPas = $idClient['id_passport']; //Получаем айди записи паспорта, которую хотим запись

    //Обновляем данные клиента, которого отредактировали
    $db->update('clients', $id, $dataPersonal);
    $db->update('clients_passport', $idPas, $dataPassport);
    $db->update('clients_address', $idAddress, $dataAddress);
    $db->update('authorization', $idAuth, $dataAuth);

    header('location:index.php'); //Возвращаем на страницу клиентов
  }

  public function updateStatusClient($id): void {
    $db = new DataB();

    $access = $_GET['access'];
  
    $сlient = $db->selectOne('clients', ['id' => $id]); //Получаем данные клиента, которого хоти изменитьь
    $clientAuth = $db->selectOne('authorization', ['id' => $сlient['id_auth']]); //Получаем данные авторизации, которую хоти изменить
    $idAuth = $clientAuth['id'];  //Получаем айди авторизации, которую хоти изменить
  
    $db->update('authorization', $idAuth, ['access' => $access]); //Перезаписываем полученную запись
    header('location:index.php'); //Возвращаем на страницу клиентов
  }

  public function deleteClient($id): void {
    $db = new DataB();

    $db->delete('clients', $id); //Удаляем клиента
    header('location:index.php'); //Возвращаем на страницу клиентов
  }
}

?>