<?php 

require('UserActions.php');
$userActions = new UserActions();


class User {
  public function authorization() {
    global $userActions;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['button__auth']))) {
      $email = trim($_POST['email']);
      $userActions->authorization();

      return $email;
    }
  }

  public function registration() {
    global $userActions;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['button__reg']))) {

      //Забираем данные из формы в переменные
      $lastName = trim($_POST['last_name']);
      $firstName = trim($_POST['first_name']);
      $email = trim($_POST['email']);
      $login = trim($_POST['login']);

      $userActions -> registration();

      $arrRes = 
      [
        $lastName, $firstName, $email, $login
      ];

      return $arrRes;
    } 
  }

  public function editPassword(): void {
    global $userActions;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['password-edit']))) {
      $id = $_POST['id'];
      $userActions -> editPassword($id);
    }
  }

  public function updateUser(): void {
    global $userActions;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['personal-edit']))) {
      $userActions -> updateUser();
    }
  }

  public function deleteUser(): void {
    global $userActions;

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_id']))) {
      $id = $_GET['del_id'];  //Получаем айди пользователя, которого хотим удалить
      $userActions -> deleteUser($id);
    }
  }
  
  public function addOrder(): void {
    global $userActions;

    if($_SESSION['role'] == 0) {
      if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['button-order']))) {
        $userActions -> addOrder();
      }
    }
  }

  public function deleteOrder(): void {
    global $userActions;

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_order']))) {
      $id = $_GET['del_order'];  //Получаем айди модели, которую хотим удалить
      $userActions -> deleteOrder($id);
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