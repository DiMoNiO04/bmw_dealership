<?php 

require(SITE_ROOT . '/app/controllers/person/Person.php');
require('EmployeeController.php');
$employeeController = new EmployeeController();

class Employee extends Person {

  public function add() {
    global $employeeController;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['employees-create']))) {
 
      $lastName = trim($_POST['last_name']);
      $firstName = trim($_POST['first_name']);
      $surname = trim($_POST['surname']);
      $dateBirth = trim($_POST['date_birth']);
      $phone = trim($_POST['phone']);

      $city = trim($_POST['city']);
      $street = trim($_POST['street']);
      $house = trim($_POST['house']);
      $apartment = trim($_POST['apartment']);

      $series = trim($_POST['series']);
      $number = trim($_POST['number']);
      $issuedBy = trim($_POST['issued_by']);
      $login = trim($_POST['login']);
      $password = $_POST['password'];
      $email = trim($_POST['email']);
      $jobTitle = $_POST['job'];

      $employeeController -> add();

      $arrRes = 
      [
        $lastName, $firstName, $surname, $dateBirth, $phone, $city, $street, $house, $apartment,
        $series, $number, $issuedBy, $login, $password, $email, $jobTitle
      ];

      return $arrRes;
    } 
  }

  public function edit(): array {
    $db = new DataB();

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['edit_id']))) {

      $id = $_GET['edit_id']; 
      $employee = $db->selectOne('employees', ['id' => $id]);

      $idAuth = $employee['id_auth'];
      $idAddress = $employee['id_address'];
      $idPassport = $employee['id_passport'];

      $employeeAuth = $db->selectOne('authorization', ['id' => $idAuth]);
      $employeeAddress = $db->selectOne('employees_address', ['id' => $idAddress]);
      $employeePassport = $db->selectOne('employees_passport', ['id' => $idPassport]);
      
      $id = $employee['id'];
      $lastName = $employee['last_name'];
      $firstName = $employee['first_name'];
      $surname = $employee['surname'];
      $dateBirth = $employee['date_birth'];
      $phone = $employee['phone'];
      $job = $employee['job'];
      $city = $employeeAddress['city'];
      $street = $employeeAddress['street'];
      $house = $employeeAddress['house'];
      $apartment = $employeeAddress['apartment'];
      $series = $employeePassport['series'];
      $number = $employeePassport['number'];
      $issuedBy = $employeePassport['issued_by'];
      $login = $employeeAuth['login'];
      $email = $employeeAuth['email'];
      $access = $employeeAuth['access'];

      $arrRes = 
      [
        $lastName, $firstName, $surname, $dateBirth, $phone, $city, $street, $house, $apartment,
        $series, $number, $issuedBy, $login, $password, $email, $jobTitle
      ];

      return $arrRes;
    }
  }

  public function update(): void {
    global $employeeController;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['employee-edit']))) {
      $employeeController -> update();
    } 
  }

  public function editStatus(): void {
    global $employeeController;

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['pub_id']))) {
      $id = $_GET['pub_id']; 
      $employeeController -> updateStatus($id);
    }
  }

  public function delete(): void {
    global $employeeController;

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_id']))) {
      $id = $_GET['del_id'];
      $employeeController -> delete($id);
    }
  }

  public function search(): ?array {
    global $employeeController;
    $db = new DataB();

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search-employee'])) {
      $employees = $db->searchAdmin($_POST['search-employee'], 'employeesView');

      if(empty($employees)) {
        array_push($employeeController -> errMsg,  'По данному поиску ничего не найдено! Повторите поиск!');
      }
    }

    return $employees;
  }
}

?>