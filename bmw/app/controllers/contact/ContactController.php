<?php

class ContactController {

  public function addContact(): void {

    $db = new DataB();
    
    $contactAddress = [
      'city' => trim($_POST['city']),
      'street' => trim($_POST['street']),
      'house' => trim($_POST['house'])
    ];
      
    $contact = [
      'name' => trim($_POST['name']),
      'phone' => trim($_POST['phone']),
      'work_time' =>  trim($_POST['work_time']),
      'email' => trim($_POST['email']),
      'id_address' => $db->insert('contacts_address', $contactAddress)
    ];

    $db->insert('contacts', $contact);
    header('location:index.php');
  }

  public function updateContact(): void {
    $db = new DataB();

    $contactAddress = [
      'city' => trim($_POST['city']),
      'street' => trim($_POST['street']),
      'house' => trim($_POST['house'])
    ];
        
    $contact = [
      'name' => trim($_POST['name']),
      'phone' => trim($_POST['phone']),
      'work_time' => trim($_POST['work_time']),
      'email' => trim($_POST['email'])
    ];
  
    $id = $_POST['id'];

    $idContact = $db->selectOne('contacts', ['id' => $id]);
    $idAddress = $idContact['id_address'];
  
    $db->update('contacts_address', $idAddress, $contactAddress);
    $db->update('contacts', $id, $contact);
    header('location:index.php');
  }

  public function deleteContact($id): void {
    $db = new DataB();
    $db->delete('contacts', $id);
    header('location:index.php'); 
  }
}

?>