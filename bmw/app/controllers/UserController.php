<?php 

require(SITE_ROOT . '/app/services/UserService.php');
$userService = new UserService();


class UserController {
  public function authorization() {
    global $userService;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['button__auth']))) {
      $email = trim($_POST['email']);
      $userService->authorization();

      return $email;
    }
  }

  public function registration() {
    global $userService;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['button__reg']))) {

      $lastName = trim($_POST['last_name']);
      $firstName = trim($_POST['first_name']);
      $email = trim($_POST['email']);
      $login = trim($_POST['login']);

      $userService -> registration();

      $arrRes = 
      [
        $lastName, $firstName, $email, $login
      ];

      return $arrRes;
    } 
  }

  public function editPassword(): void {
    global $userService;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['password-edit']))) {
      $id = $_POST['id'];
      $userService -> editPassword($id);
    }
  }

  public function updateUser(): void {
    global $userService;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['personal-edit']))) {
      $userService -> updateUser();
    }
  }

  public function deleteUser(): void {
    global $userService;

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_id']))) {
      $id = $_GET['del_id']; 
      $userService -> deleteUser($id);
    }
  }
  
  public function addOrder(): void {
    global $userService;

    if($_SESSION['role'] == 0) {
      if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['button-order']))) {
        $userService -> addOrder();
      }
    }
  }

  public function deleteOrder(): void {
    global $userService;

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_order']))) {
      $id = $_GET['del_order']; 
      $userService -> deleteOrder($id);
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