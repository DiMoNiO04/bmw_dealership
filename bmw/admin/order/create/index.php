<?php 
  include "../../../path.php";
  include SITE_ROOT . "/app/database/DataB.php";
  include SITE_ROOT . "/app/controllers/order/Order.php";

  $db = new DataB();

  $autos = $db->selectAll('auto', ['status' => 1]);
  $clients = $db->selectAll('clients');

  $order = new Order();
  $order->addOrderEmploee();

	$errMsg = $orderController -> errMsg;
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
            <h1 class="title-pages panel__title">Добавление заказа</h1>
            <div class="panel__blocks">

            <div class="error">
              <?php include(SITE_ROOT . "/app/helps/errInfo.php")?>
            </div>

              <form class="admin-form" method="post" action="<?= ADMIN_URL ?>/order/create/">
                <p class="obligatory"><span>*</span> - обязательное поле для заполнения</p>
                <section class="form-reg__block">	

                  <div class="form-reg__item">
                    <label for="last_name">Автомобиль<span>*</span></label>
                    <select name="auto" class="search__select" required>
                      <option value="">Выберите авто:</option>
                      <?php foreach($autos as $auto): ?>
                        <option value="<?= $auto['id']?>"><?= $auto['id']?> - <?= $auto['name']?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="form-reg__item">
                    <label for="last_name">Клиент<span>*</span></label>
                    <select name="client" class="search__select" required>
                      <option value="">Выберите клиента:</option>
                      <?php foreach($clients as $client): ?>
                        <option value="<?= $client['id']?>"><?= $client['last_name']?> <?= $client['first_name']?> <?= $client['surname']?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </section>

                <button name="order-create" type="submit" class="button">Добавить</button>
              </form>

            </div>	
          </div>	
        </div>
      </div>
    </section>
  </main>

  <?php include(SITE_ROOT . '/app/includes/footer.php') ?>
	<?php include(SITE_ROOT . '/app/includes/script.php') ?>
</body>

</html>