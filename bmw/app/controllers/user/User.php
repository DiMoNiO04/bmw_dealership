<?php 

require('UserController.php');
$userController = new UserController();


class User {
  public function authorization() {
    global $userController;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['button__auth']))) {
      $email = trim($_POST['email']);
      $userController->authorization();

      return $email;
    }
  }

  public function registration() {
    global $userController;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['button__reg']))) {

      $lastName = trim($_POST['last_name']);
      $firstName = trim($_POST['first_name']);
      $email = trim($_POST['email']);
      $login = trim($_POST['login']);

      $userController -> registration();

      $arrRes = 
      [
        $lastName, $firstName, $email, $login
      ];

      return $arrRes;
    } 
  }

  public function editPassword(): void {
    global $userController;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['password-edit']))) {
      $id = $_POST['id'];
      $userController -> editPassword($id);
    }
  }

  public function updateUser(): void {
    global $userController;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['personal-edit']))) {
      $userController -> updateUser();
    }
  }

  public function deleteUser(): void {
    global $userController;

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_id']))) {
      $id = $_GET['del_id']; 
      $userController -> deleteUser($id);
    }
  }
  
  public function addOrder(): void {
    global $userController;

    if($_SESSION['role'] == 0) {
      if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['button-order']))) {
        $userController -> addOrder();
      }
    }
  }

  public function deleteOrder(): void {
    global $userController;

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_order']))) {
      $id = $_GET['del_order']; 
      $userController -> deleteOrder($id);
    }
  }

  public function getSessionPerson(): array {
    $db = new DataB();

    $idSession = $_SESSION['id'];

    $userPerson = $db->selectOne('authorization', ['id' => $idSession]);
    if($_SESSION['role'] == 1) {
      $idUser = $db->selectOne('employees', ['id_auth' => $idSession])['id'];
      $userPerson = $db->selectOne('employeesview', ['id' => $idUser]);
    } else {
      $idUser = $db->selectOne('clients', ['id_auth' => $idSession])['id'];
      $userPerson = $db->selectOne('clientsview', ['id' => $idUser]);
    }

    $arrRes = [ $idSession, $userPerson, $idUser ];

    return $arrRes;
  }
}
?>