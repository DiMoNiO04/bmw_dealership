<?php 

require('ClientsActions.php');
$clientsActions = new ClientsActions();


class Clients {

  public function addClient() {
    global $clientsActions;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['client-create']))) {
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

      $clientsActions -> addClient();

      $arrRes = 
      [
        $lastName, $firstName, $surname, $dateBirth, $phone, $city, $street,
        $house, $apartment, $series, $number, $issuedBy, $login, $password, $email, $jobTitle
      ];

      return $arrRes;
    } 
  }

  public function editClient(): array {
    $db = new DataB();

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['edit_id']))) {
  
      $id = $_GET['edit_id']; //Получаем айди клиента, того кого хотим изменить 
      $client = $db->selectOne('clients', ['id' => $id]); //Получаем все данные клиента, которого хотим изменить
      
      $idAuth = $client['id_auth']; //Получаем айди данных авторизации клиента
      $idAddress = $client['id_address']; //Получаем айди данных адреса клиента
      $idPassport = $client['id_passport']; //Получаем айди данных паспорта клиента

      $clientAuth = $db->selectOne('authorization', ['id' => $idAuth]); //Получаем данные авторизации данного клиента
      $clientAddress = $db->selectOne('clients_address', ['id' => $idAddress]); //Получаем данные адресса данного клиента
      $clientPassport = $db->selectOne('clients_passport', ['id' => $idPassport]); //Получаем данные паспорта данного клиента
      
      //Получаем данные клиента которого хотим изменить в переменные
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

  public function updateClient(): void {
    global $clientsActions;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['client-edit']))) {
      $clientsActions -> updateClient();
    } 
  }

  public function editStatus(): void {
    global $clientsActions;

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['pub_id']))) {
      $id = $_GET['pub_id'];  //Получаем айди клиента, доступ которого хотим измнить
      $clientsActions -> updateStatusClient($id);
    }
  }

  public function deleteClient(): void {
    global $clientsActions;

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_id']))) {
      $id = $_GET['del_id'];  //Получаем айди авто, которую хотим удалить
      $clientsActions -> deleteClient($id);
    }
  }

  public function searchClient(): ?array {
    $db = new DataB();

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search-client'])) {
      $clients = $db->searchAdmin($_POST['search-client'], 'clientsView');

      if(empty($clients)) {
        array_push($errMsg,  'По данному поиску ничего не найдено! Повторите поиск!');
      }
    }

    return $clients;
  }
}

?>