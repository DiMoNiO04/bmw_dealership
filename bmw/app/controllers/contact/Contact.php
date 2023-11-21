<?php

require('ContactController.php');
$contactController = new ContactController();

class Contact {
  
  public function addContact(): void {
    global $contactController;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['contact-create']))) {
      $contactController -> addContact();
    } 
  }

  public function updateContact(): void {
    global $contactController;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['contact-edit']))) {
      $contactController -> updateContact();
    }
  }

  public function editContact(): array {
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['id']))) {

      $db = new DataB();

      $id = $_GET['id'];  
      $contact = $db->selectOne('contacts', ['id' => $id]);

      $id = $contact['id'];
      $name = $contact['name'];
      $phone = $contact['phone'];
      $workTime = $contact['work_time'];
      $email = $contact['email'];

      $contactAddress = $db->selectOne('contacts_address', ['id' => $contact['id_address']]);
      $city = $contactAddress['city'];
      $street = $contactAddress['street'];
      $house = $contactAddress['house'];

      $arrRes = [$id, $name, $phone, $workTime, $email, $city, $street, $house];
      return $arrRes;
    }
  }

  public function deleteContact(): void {
    global $contactController;

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_id']))) {
      $id = $_GET['del_id'];
      $contactController -> deleteContact($id);
    }
  }
}
?>