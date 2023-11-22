<?php 
  session_start();
  include "../../path.php";
  include SITE_ROOT . "/app/database/DataB.php";
  include SITE_ROOT . "/app/controllers/order/Order.php";

  $db = new DataB();
  $orders = $db->selectAll('ordersview');

  $order = new Order();
  $order->deleteOrder();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
 	<?php include(SITE_ROOT . '/app/includes/head.php') ?>
  <title>Админ панель: Заказы</title>
</head>

<body>
  
  <?php include(SITE_ROOT . '/app/includes/header-admin.php') ?>

  <div class="dark-wrapper"></div>
  <main>
    <section class="panel">
      <div class="container">
        <div class="panel__container">

          <?php include(SITE_ROOT . '/app/includes/aside.php') ?>

          <div class="panel__body">
          <a class="button panel__button" href="<?= ADMIN_URL . "/order/create/" ?>">Добавить</a>
            <h1 class="title-pages panel__title">Заказы</h1>

            
          <?php if(empty($orders)):?>
              <p class="panel__empty">Заказы в базе данных отсутствуют. Но вы можете добавить</p>
          <?php else:?>
            <?php foreach($orders as $order): ?>
              <div class="panel__blocks">
                <div class="panel__block">
                  <h2 class="panel__subtitle">Заказ №<?= $order['id']; ?></h2>
                  <div class="panel__item">
                    <h3>Клиент:</h3>
                    <p><?= $order['client_last_name']?> <?= $order['client_first_name']?> <?= $order['surname']?></p>
                  </div>
                  <div class="panel__item">
                    <h3>Авто:</h3>
                    <p><?= $order['model']?><?= $order['name']?></p>
                  </div>
                  <div class="panel__item">
                    <h3>Стоимость:</h3>
                    <p><?= $order['price']?></p>
                  </div>
                  <div class="panel__item">
                    <h3>Дата оформления:</h3>
                    <p><?= $order['date']?></p>
                  </div>
                  <div class="panel__item">
                    <h3>Номер телефона:</h3>
                    <p><?= $order['phone']?></p>
                  </div>
                  <div class="panel__item">
                    <h3>Email:</h3>
                    <p><?= $order['email']?></p>
                  </div>
                  <div class="panel__buttons">
                    <a class="button panel__button-red" href="<?= ADMIN_URL ?>/order/?del_order=<?=$order['id'];?>">Удалить</a>
                  </div>
                </div>					
              </div>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </section>
  </main>

  <?php include(SITE_ROOT . '/app/includes/footer.php') ?>
	<?php include(SITE_ROOT . '/app/includes/script.php') ?>
</body>

</html>