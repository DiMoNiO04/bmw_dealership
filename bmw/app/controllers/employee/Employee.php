<?php 

require('EmployeeController.php');
$employeeController = new EmployeeController();

class Employee {

  public function addEmployee(): array {
    global $employeeController;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['employees-create']))) {
      //Забираем данные из формы в переменные
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

      $employeeController -> addEmployee();

      $arrRes = 
      [
        $lastName, $firstName, $surname, $dateBirth, $phone, $city, $street, $house, $apartment,
        $series, $number, $issuedBy, $login, $password, $email, $jobTitle
      ];

      return $arrRes;
    } 
  }

  public function editEmployee(): array {
    $db = new DataB();

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['edit_id']))) {

      $id = $_GET['edit_id']; //Получаем айди сотрудника, того кого хотим изменить 
      $employee = $db->selectOne('employees', ['id' => $id]); //Получаем все данные сотрудника, которого хотим изменить

      $idAuth = $employee['id_auth']; //Получаем айди данных авторизации сотрудника
      $idAddress = $employee['id_address']; //Получаем айди данных адреса сотрудника
      $idPassport = $employee['id_passport']; //Получаем айди данных паспорта сотрудника

      $employeeAuth = $db->selectOne('authorization', ['id' => $idAuth]); //Получаем данные авторизации данного сотрудника
      $employeeAddress = $db->selectOne('employees_address', ['id' => $idAddress]); //Получаем данные адресса данного сотрудника
      $employeePassport = $db->selectOne('employees_passport', ['id' => $idPassport]); //Получаем данные паспорта данного сотрудника
      
      //Получаем данные сотрудника которого хотим изменить в переменные
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

  public function updateEmployee(): void {
    global $employeeController;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['employee-edit']))) {
      $employeeController -> updateEmployee();
    } 
  }

  public function editStatus(): void {
    global $employeeController;

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['pub_id']))) {
      $id = $_GET['pub_id'];  //Получаем айди сотрудника, доступ которого хотим измнить
      $employeeController -> updateStatusEmployee($id);
    }
  }

  public function deleteEmployee(): void {
    global $employeeController;

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_id']))) {
      $id = $_GET['del_id'];  //Получаем айди сотрудника, которого хотим удалить
      $employeeController -> deleteEmployee($id);
    }
  }

  public function searchEmployee(): ?array {
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