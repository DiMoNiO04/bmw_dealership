<?php

class OrdersActions {
  
  public $NEW_AUTO = 19;
  public $OLD_AUTO = 20;
  public $CLIENT = 0;
  public $NEW = 'Новое';
  public $errMsg = [];

  //Добавление заказа клиентом
  public function addOrderClient(): void {
    $db = new DataB();

    $email = $_POST['email'];
    $login = $_POST['login'];
    $passF = $_POST['password-first'];
    $passS = $_POST['password-second'];

    $idAuto = $_GET['auto'];
    $auto = $db->selectOne('auto', ['id' => $idAuto]);
    $state = $auto['state'];

    $idSession = $_SESSION['id'];
    $roleSession = $_SESSION['role'];

    $user = $db->selectOne('authorization', ['id' => $idSession]);
    $idUser = $db->selectOne('clients', ['id_auth' => $idSession])['id'];

    $arrEmployees = $db->selectAll('employees', ['job' => 'Менеджер']);
    $randIndex = rand(0, count($arrEmployees) - 1);
    $idEmployee = $arrEmployees[$randIndex]['id'];

    if($login != $user['login'] || $email != $user['email'] || (!password_verify($passS, $user['password'])) || $passF != $passS) {
      array_push($this -> errMsg, "Не верно введены данные! \n Заказ не был оформлен! \n Повторите попытку!");
    } else {

      if($state == $this -> new) {
        $idContact = $this -> NEW_AUTO;
      } else {
        $idContact = $this -> OLD_AUTO;
      }

      $params = [
        'id_client' => $idUser,
        'id_auto' => $idAuto,
        'id_contact' => $idContact,
        'id_employee' => $idEmployee
      ];

      $db->insert('orders', $params); //Отправляем данные в таблицу клиентов
      header('location:personal__cab-user.php'); //Возвращаем на страницу клиентов
    }
  }

  //Добавление заказа сотрудником
  public function addOrderEmploee(): void {
    $db = new DataB();

    $idClient = $_POST['client'];
    $idAuto = $_POST['auto'];

    $idSession = $_SESSION['id'];
    $idEmployee = $db->selectOne('employees', ['id_auth' => $idSession])['id'];

    $auto = $db->selectOne('auto', ['id' => $idAuto]);
    $state = $auto['state'];

    $CLIENTFullData = $db->selectAll('clientsview', ['id' => $idClient])[0];

    if($state == $this -> new) {
      $idContact = $this -> NEW_AUTO;
    } else {
      $idContact = $this -> OLD_AUTO;
    }

    $params = [
      'id_auto' => $idAuto,
      'id_client' => $idClient,
      'id_contact' => $idContact,
      'id_employee' => $idEmployee
    ];

    print_r($params);

    $db->insert('orders', $params); //Отправляем данные в таблицу клиентов
    header('location:index.php'); //Возвращаем на страницу моделей
  }

  //Удаление заказа
  public function deleteOrder($id): void {
    $db = new DataB();

    $db->delete('orders', $id); //Удаляем
    if($_SESSION['role'] == $CLIENT) { //Если удалял заказ клиент
      header('location:personal__cab-user.php'); //Возвращаем на страницу моделей
    } else {
      header('location:index.php'); //Возвращаем на страницу моделей
    }
  }
}

?>