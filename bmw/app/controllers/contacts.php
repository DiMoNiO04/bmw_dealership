<?php

require('ContactsActions.php');
$contactsActions = new ContactsActions();

class Contacts {
  
  public function addContact(): void {
    global $contactsActions;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['contact-create']))) {
      $contactsActions -> addContact();
    } 
  }

  public function updateContact(): void {
    global $contactsActions;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['contact-edit']))) {
      $contactsActions -> updateContact();
    }
  }

  public function editContact(): array {
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['id']))) {

      $db = new DataB();

      $id = $_GET['id']; //Получаем айди контактных данных, которые хотим изменить 
      $contact = $db->selectOne('contacts', ['id' => $id]); //Получаем все данные данного контакта, которую хотим изменить

      //Получаем данные контакта которые хотим изменить в переменные
      $id = $contact['id'];
      $name = $contact['name'];
      $phone = $contact['phone'];
      $workTime = $contact['work_time'];
      $email = $contact['email'];

      //Получаем айди контактных данных
      $contactAddress = $db->selectOne('contacts_address', ['id' => $contact['id_address']]);
      $city = $contactAddress['city'];
      $street = $contactAddress['street'];
      $house = $contactAddress['house'];

      $arrRes = [$id, $name, $phone, $workTime, $email, $city, $street, $house];
      return $arrRes;
    }
  }

  public function deleteContact(): void {
    global $contactsActions;

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_id']))) {
      $id = $_GET['del_id'];  //Получаем айди контакта, который хотим удалить
      $contactsActions -> deleteContact($id);
    }
  }
}
?>