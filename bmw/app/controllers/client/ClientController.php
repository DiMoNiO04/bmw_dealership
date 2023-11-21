<?php 

require('D:\Programs\OSPanel\domains\dealership\bmw\app\controllers\person\PersonController.php');

class ClientController extends PersonController {
	
  public function add(): void {

    $db = new DataB();

    $login = trim($_POST['login']);
    $password = $_POST['password'];
    $email = trim($_POST['email']);
    $access = $ACCESS;
    $role = $CLIENT;

    if(mb_strlen($login, 'UTF8') < 3) {
      array_push($this -> errMsg, 'Логин должен быть более трех символов!');
    } else {
      $existenceLogin = $db->selectOne('authorization', ['login' => $login]);
      $existenceEmail = $db->selectOne('authorization', ['email' => $email]);

      if($existenceLogin['login'] === $login) {
        array_push($this -> errMsg,  'Пользователь с таким логином уже зарегистрирован!');
      } elseif($existenceEmail['email'] === $email) {
        array_push($this -> errMsg, 'Пользователь с такой почтой уже зарегистрован!');
      }else {
        $password  = password_hash($password , PASSWORD_DEFAULT);

        if(isset($_POST['access'])) {
          $access = $this -> ACCESS;
        } else {
          $access = $this -> NO_ACCESS;
        }
        
        $dataAuth = [
          'login' => $login,
          'password' => $password,
          'access' => $access,
          'role' => $this -> CLIENT,
          'email' => $email 
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

        $idPassport = $db->insert('clients_passport', $dataPassport);
        $idAddress = $db->insert('clients_address', $dataAddress);
        $idAuth = $db->insert('authorization', $dataAuth);
        $id_auth = $db->selectOne('authorization', ['id' => $idAuth]);

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

        $db->insert('clients', $dataPersonal);
        header('location:index.php');
      }
    }
  }

  public function update(): void {

    $db = new DataB();
      
    $access = $_POST['access'];
    if(isset($_POST['access'])) {
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
    $idClient = $db->selectOne('clients', ['id' => $id]);
    $idAuth = $idClient['id_auth'];
    $idAddress = $idClient['id_address']; 
    $idPas = $idClient['id_passport']; 

    $db->update('clients', $id, $dataPersonal);
    $db->update('clients_passport', $idPas, $dataPassport);
    $db->update('clients_address', $idAddress, $dataAddress);
    $db->update('authorization', $idAuth, $dataAuth);

    header('location:index.php');
  }

  public function updateStatus($id): void {
    $db = new DataB();

    $access = $_GET['access'];
  
    $сlient = $db->selectOne('clients', ['id' => $id]);
    $clientAuth = $db->selectOne('authorization', ['id' => $сlient['id_auth']]);
    $idAuth = $clientAuth['id'];
  
    $db->update('authorization', $idAuth, ['access' => $access]);
    header('location:index.php');
  }

  public function delete($id): void {
    $db = new DataB();

    $db->delete('clients', $id);
    header('location:index.php');
  }
}

?>