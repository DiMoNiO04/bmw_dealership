<?php

require('OrderController.php');
$orderController = new OrderController();

class Order {

  public function addOrderClient(): void {
    global $orderController;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['button-order']))) {
      $orderController -> addOrderClient();
    }
  }

  public function addOrderEmploee(): void {
    global $orderController;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['order-create']))) {
      $orderController -> addOrderEmploee();
    }
  }

  public function deleteOrder(): void {
    global $orderController;

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_order']))) {
      $id = $_GET['del_order'];  //Получаем айди модели, которую хотим удалить
      $orderController -> deleteOrder($id);
    }
  }

}

?>