<?php 


require(SITE_ROOT . '/app/controllers/PersonController.php');
require(SITE_ROOT . '/app/services/ClientService.php');
$clientService = new ClientService();


class ClientController extends PersonController {

  public function add() {
    global $clientService;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['client-create']))) {
      
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

      $clientService-> add();

      $arrRes = 
      [
        $lastName, $firstName, $surname, $dateBirth, $phone, $city, $street,
        $house, $apartment, $series, $number, $issuedBy, $login, $password, $email, $jobTitle
      ];

      return $arrRes;
    } 
  }

  public function edit() {
    $db = new DataB();

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['edit_id']))) {
  
      $id = $_GET['edit_id']; 
      $client = $db->selectOne('clients', ['id' => $id]);
      
      $idAuth = $client['id_auth'];
      $idAddress = $client['id_address'];
      $idPassport = $client['id_passport'];

      $clientAuth = $db->selectOne('authorization', ['id' => $idAuth]);
      $clientAddress = $db->selectOne('clients_address', ['id' => $idAddress]);
      $clientPassport = $db->selectOne('clients_passport', ['id' => $idPassport]);
      
      $id = $client['id'];
      $lastName = $client['last_name'];
      $firstName = $client['first_name'];
      $surname = $client['surname'];
      $dateBirth = $client['date_birth'];
      $phone = $client['phone'];
      $city = $clientAddress['city'];
      $street = $clientAddress['street'];
      $house = $clientAddress['house'];
      $apartment = $clientAddress['apartment'];
      $series = $clientPassport['series'];
      $number = $clientPassport['number'];
      $issuedBy = $clientPassport['issued_by'];
      $login = $clientAuth['login'];
      $email = $clientAuth['email'];
      $access = $clientAuth['access'];

      $arrRes = 
      [
        $id, $lastName, $firstName, $surname, $dateBirth, $phone, $city, $street, $house,
        $apartment, $series, $number, $issuedBy, $login, $email, $access
      ];

      return $arrRes;
    }
  }

  public function update(): void {
    global $clientService;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['client-edit']))) {
      $clientService-> update();
    } 
  }

  public function editStatus(): void {
    global $clientService;

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['pub_id']))) {
      $id = $_GET['pub_id'];
      $clientService-> updateStatus($id);
    }
  }

  public function delete(): void {
    global $clientService;

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_id']))) {
      $id = $_GET['del_id'];
      $clientService-> delete($id);
    }
  }

  public function search(): ?array {
    global $clientService;
    $db = new DataB();

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search-client'])) {
      $clients = $db->searchAdmin($_POST['search-client'], 'clientsView');

      if(empty($clients)) {
        array_push($clientService -> errMsg,  'По данному поиску ничего не найдено! Повторите поиск!');
      }
    }

    return $clients;
  }
}

?>