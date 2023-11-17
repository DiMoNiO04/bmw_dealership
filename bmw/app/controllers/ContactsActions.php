<?php

class ContactsActions {

  //Добавление контакта
  public function addContact(): void {

    $db = new DataB();
    
    //Формируем объект адрессных данных
    $contactAddress = [
      'city' => trim($_POST['city']),
      'street' => trim($_POST['street']),
      'house' => trim($_POST['house'])
    ];
      
    //Формируем массив для отправки
    $contact = [
      'name' => trim($_POST['name']),
      'phone' => trim($_POST['phone']),
      'work_time' =>  trim($_POST['work_time']),
      'email' => trim($_POST['email']),
      'id_address' => $db->insert('contacts_address', $contactAddress)
    ];

    $db->insert('contacts', $contact); //Отправляем данные в таблицу contacts
    header('location:index.php'); //Возвращаем на страницу контактов
  }

  //Редактирование контакта
  public function updateContact(): void {
    $db = new DataB();

    //Формируем массив адрессных данных
    $contactAddress = [
      'city' => trim($_POST['city']),
      'street' => trim($_POST['street']),
      'house' => trim($_POST['house'])
    ];
        
    //Формируем массив для отправки
    $contact = [
      'name' => trim($_POST['name']),
      'phone' => trim($_POST['phone']),
      'work_time' => trim($_POST['work_time']),
      'email' => trim($_POST['email'])
    ];
  
    $id = $_POST['id']; //Получаем id контактных данных, которые хотим редактировать

    //Получаем id адрессных данных, данного контакта
    $idContact = $db->selectOne('contacts', ['id' => $id]);
    $idAddress = $idContact['id_address'];
  
    $db->update('contacts_address', $idAddress, $contactAddress); //Отправляем данные в таблицу адреса контаков
    $db->update('contacts', $id, $contact); //Отправляем данные в таблицу contacts
    header('location:index.php'); //Возвращаем на страницу контактов
  }

  //Удаление контакта
  public function deleteContact($id): void {
    $db = new DataB();
    $db->delete('contacts', $id); //Удаляем
    header('location:index.php'); //Возвращаем на страницу контактов
  }
}

?>