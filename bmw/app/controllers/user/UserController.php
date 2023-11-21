<?php 

class UserController {

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
 
    $email = trim($_POST['email']);
    $login = trim($_POST['login']);
    $passwordF = $_POST['password-first'];
    $passwordS = $_POST['password-second'];

    if(mb_strlen($login, 'UTF8') < 3) {
      array_push($this -> errMsg, 'Логин должен быть более трех символов!');
    } elseif($passwordF !== $passwordS) {
      array_push($this -> errMsg, 'Пароли в обеих полях должны соотвествовать!');
    } else {

      $existenceLogin = $db->selectOne('authorization', ['login' => $login]);
      $existenceEmail = $db->selectOne('authorization', ['email' => $email]);

      if($existenceLogin['login'] === $login) {
        array_push($this -> errMsg,  'Пользователь с таким логином уже зарегистрирован!');
      } elseif($existenceEmail['email'] === $email) {
        array_push($this -> errMsg, 'Пользователь с такой почтой уже зарегистрован!');
      }else {
        $password = password_hash($passwordF, PASSWORD_DEFAULT);

        $dataAuth = [
          'login' => $login,
          'password' => $password,
          'access' => $this -> ACCESS,
          'role' => $this -> CLIENT,
          'email' => $email
        ];

        $dataPassport = [
          'series' => $series,
          'number' => $number,
          'issued_by' => $issuedBy
        ];

        $dataAddress = [
          'city' => $city,
          'street' => $street,
          'house' => $house,
          'apartment' => $apartment 
        ];

        $idPassport = $db->insert('clients_passport', $dataPassport);
        $idAddress = $db->insert('clients_address', $dataAddress);
        $idAuth = $db->insert('authorization', $dataAuth);
        $id_auth = $db->selectOne('authorization', ['id' => $idAuth]);

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
        $db->insert('clients', $dataPersonal);
        $user = $db->selectOne('authorization', ['id' => $id]);
        $this -> userAuth($user); 
      }
    }
  }

  public function authorization(): void {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $db = new DataB();
    $existence = $db->selectOne('authorization', ['email' => $email]);
      
    if($existence['access'] == $this -> NO_ACCESS) {
      array_push($this -> errMsg, "Данный аккаунт не имеет доступа (заблокирован)!");
    } else {
      if($existence && password_verify($password, $existence['password'])) {
        $this -> userAuth($existence);
      } 
      password_verify($password, $existence['password']);
      array_push($this -> errMsg, "Неправильный логин или пароль!");
    }
  }

  public function editPassword($id): void {

    $db = new DataB();

    $passwordF = $_POST['passF'];
    $password = password_hash($passwordF, PASSWORD_DEFAULT);
  
    $data = [
      'password' => $password,
      'access' => $this -> ACCESS
    ];

    $db->update('authorization', $id, $data);
  }

  public function updateUser(): void {

      $db = new DataB();

      if(isset($_POST['access'])) {
        $access = $this -> ACCESS;
      } else if($_SESSION['access'] == $this -> ACCESS) {
        $access = $this -> ACCESS;
      } else {
        $access = $this -> NO_ACCESS;
      }
          
      $dataAuth = [
        'access' => $access,
      ];
  
      $dataPassport = [
        'series' => trim($_POST['series']),
        'number' => trim($_POST['number']),
        'issued_by' => trim($_POST['issued_by'])
      ];
  
      $dataAddress = [
        'city' => trim($_POST['city']),
        'street' => trim($_POST['street']),
        'house' => trim($_POST['house']),
        'apartment' => trim($_POST['apartment']) 
      ];

      $dataPersonal = [
        'last_name' => trim($_POST['last_name']),
        'first_name' => trim($_POST['first_name']),
        'surname' => trim($_POST['surname']),
        'date_birth' => $_POST['date_birth'],
        'phone' => trim($_POST['phone'])
      ];
  
      $id = $_POST['id'];

      if($_SESSION['role'] == 1) {
        $idEmployee = $db->selectOne('employees', ['id_auth' => $id]);
        $idAuth = $idEmployee['id_auth'];
        $idAddress = $idEmployee['id_address'];
        $idPas = $idEmployee['id_passport'];
    
        $db->update('employees', $idEmployee['id'], $dataPersonal);
        $db->update('employees_passport', $idPas, $dataPassport);
        $db->update('employees_address', $idAddress, $dataAddress);
        $db->update('authorization', $idAuth, $dataAuth);
      } else {
        $idClients = $db->selectOne('clients', ['id_auth' => $id]);
        $idAuth = $idClients['id_auth'];
        $idAddress = $idClients['id_address'];
        $idPas = $idClients['id_passport'];
  
        $db->update('clients', $idClients['id'], $dataPersonal);
        $db->update('clients_passport', $idPas, $dataPassport);
        $db->update('clients_address', $idAddress, $dataAddress);
        $db->update('authorization', $idAuth, $dataAuth);
      }
  } 

  public function deleteUser($id): void {

    $db = new DataB();

    if($_SESSION['role'] == $this -> EMPLOYEE) {
      $idEmployee = $db->selectOne('employees', ['id_auth' => $id]); 

      $idAuth = $idEmployee['id_auth'];
      $idAddress = $idEmployee['id_address'];
      $idPas = $idEmployee['id_passport'];
    
      $db->delete('authorization', $idAuth);
      $db->delete('employees_address', $idAddress);
      $db->delete('employees_passport', $idPas);
      $db->delete('employees', $id);
    } else { 
      $idClients = $db->selectOne('clients', ['id_auth' => $id]); 

      $idAuth = $idClients['id_auth'];
      $idAddress = $idClients['id_address'];
      $idPas = $idClients['id_passport'];
    
      $db->delete('authorization', $idAuth);
      $db->delete('clients_address', $idAddress);
      $db->delete('clients_passport', $idPas); 
      $db->delete('clients', $id);
    }

    header('location:/bmw/logout.php');
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

      $db->insert('orders', $params);
      header('location:personal__cab-user.php');
    }
  }

  public function deleteOrder($id): void {
    $db = new DataB();

    $db->delete('orders', $id);
    if($_SESSION['role'] == $this -> CLIENT) {
      header('location:personal__cab-user.php');
    } 
    header('location: ' . BASE_URL . "admin/orders/index.php");
  }
}
?>