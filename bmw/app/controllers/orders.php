<?php

require('OrdersActions.php');
$ordersActions = new OrdersActions();

class Orders {

  public function addOrderClient(): void {
    global $ordersActions;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['button-order']))) {
      $ordersActions -> addOrderClient();
    }
  }

  public function addOrderEmploee(): void {
    global $ordersActions;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['order-create']))) {
      $ordersActions -> addOrderEmploee();
    }
  }

  public function deleteOrder(): void {
    global $ordersActions;

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_order']))) {
      $id = $_GET['del_order'];  //Получаем айди модели, которую хотим удалить
      $ordersActions -> deleteOrder($id);
    }
  }

}

?>