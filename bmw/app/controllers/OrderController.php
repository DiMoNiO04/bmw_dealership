<?php

require(SITE_ROOT . '/app/services/OrderService.php');
$orderService = new OrderService();

class OrderController {

  public function addOrderClient(): void {
    global $orderService;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['button-order']))) {
      $orderService -> addOrderClient();
    }
  }

  public function addOrderEmploee(): void {
    global $orderService;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['order-create']))) {
      $orderService -> addOrderEmploee();
    }
  }

  public function deleteOrder(): void {
    global $orderService;

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_order']))) {
      $id = $_GET['del_order']; 
      $orderService -> deleteOrder($id);
    }
  }

}

?>