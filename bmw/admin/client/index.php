<?php 
  session_start();
  include "../../path.php";
  include SITE_ROOT . "/app/database/DataB.php";
  include SITE_ROOT . "/app/controllers/ClientController.php";

  $db = new DataB();
  $clients = $db->selectAll('clientsview');

  $client = new ClientController();

  if($client->search()) {
    $clients = $client->search();
  } 

  $errMsg = $clientService -> errMsg;
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <?php include(SITE_ROOT . '/app/includes/head.php') ?>
  <title>Админ панель: Клиенты</title>
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
            <div class="panel__nav">
              <a class="button panel__button" href="<?= ADMIN_URL ?>/client/create/">Добавить</a>

              <form action="<?= ADMIN_URL ?>/client/" method="post" class="form__search">
                <input type="text" name="search-client" class="search__input" placeholder="Поиск...">
              </form>
            </div>

            <div class="error">
              <?php include(SITE_ROOT . "/app/helps/errInfo.php")?>
            </div>

            <?php if(empty($errMsg)):?>
              <h1 class="title-pages panel__title">Клиенты</h1>
            <?php endif; ?>
            
            <?php if(empty($clients) && empty($errMsg)):?>
              <p class="panel__empty">Клиенты в базе данных отсутствуют. Но вы можете добавить</p>
            <?php else:?>
              
              <?php foreach($clients as $key => $client): ?>
                <div class="panel__blocks">
                  <div class="panel__block">
                    
                    <div class="panel__fio">
                      <?php for($i = 0; $i < $client['count_orders']; $i++): ?>
                        <div class="panel__stars">
                          <i class="fa-solid fa-star" title="У данного клиента <?= $client['count_orders']; ?> заказ (-а)"></i>
                        </div>
                      <?php endfor; ?>
                      <h2 class="panel__subtitle"><?= $client['last_name']?> <?= $client['first_name']; ?> <?= $client['surname']; ?></h2>
                    </div>
                    
                    <div class="panel__item">
                      <h3>Дата рождения:</h3>
                      <p><?= $client['date_birth']?></p>
                    </div>
                    <div class="panel__item">
                      <h3>Телефон:</h3>
                      <p><?= $client['phone']?></p>
                    </div>
                    <div class="panel__item">
                      <h3>Место жительство:</h3>
                      <p>г.<?=$client['city']?>  ул.<?= $client['street']?> д.<?= $client['house']?> кв.<?= $client['apartment']?></p>
                    </div>
                    </br>
                    <div class="panel__item">
                      <h3>Серия и номер паспорта:</h3>
                      <p><?= $client['series']?><?= $client['number']?></p>
                    </div>
                    <div class="panel__item">
                      <h3>Кем выдан:</h3>
                      <p><?= $client['issued_by']?></p>
                    </div>
                    </br>

                    <div class="panel__item">
                      <h3>Логин:</h3>
                      <p><?= $client['login']?></p>
                    </div>
                    <div class="panel__item">
                      <h3>Email:</h3>
                      <p><?= $client['email']?></p>
                    </div>
                    <div class="panel__item">
                      <h3>Дата регистрации:</h3>
                      <p><?= $client['date_regist']?></p>
                    </div>

                    <?php if($client['access'] == 0):?>
                      <div class="panel__item red">
                        <h3>Доступ:</h3>
                        <p>Нет доступа</p>
                      </div>
                    <?php else:?>
                      <div class="panel__item green">
                        <h3>Доступ:</h3>
                        <p>Есть доступ</p>
                      </div>
                    <?php endif; ?>

                    <div class="panel__buttons">
                      <a class="button panel__button-edit" href="<?= ADMIN_URL ?>/client/edit?edit_id=<?= $client['id']?>">Редактировать</a>

                      <?php if($client['access'] == 0):?>
                        <a class="button panel__button-publish" href="<?= ADMIN_URL ?>/client/edit?access=1&pub_id=<?=$client['id'];?>">Доступ</a>
                      <?php else: ?>
                        <a class="button panel__button-publish" href="<?= ADMIN_URL ?>/client/edit?access=0&pub_id=<?=$client['id'];?>">Заблокировать</a>
                      <?php endif; ?>

                      <a class="button panel__button-red" href="<?= ADMIN_URL ?>/client/edit?del_id=<?= $client['id']?>">Удалить</a>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php endif; ?>
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