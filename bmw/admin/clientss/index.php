<?php 
  session_start();
  include "../../path.php";
  include SITE_ROOT . "/app/database/Database.php";
  include "../../app/controllers/Clients.php";

  $db = new DataB();

  $client = new Clients();
  $client->deleteClient();
  $client->editStatus();

  $clientsSearch = $client->searchClient();

  if(empty($clientsSearch)) {
    $clients = $db->selectAll('clientsview');
  } else {
    $clients = $clientsSearch;
  }

  $errMsg = $clientsActions -> errMsg;
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <?php include('../../app/includes/head.php') ?>
  <title>Админ панель: Клиенты</title>
</head>

<body>
  
  <?php include('../../app/includes/header-admin.php') ?>

  <div class="dark-wrapper"></div>
  <main>
    <section class="panel">
      <div class="container">
        <div class="panel__container">

          <?php include('../../app/includes/aside.php') ?>

          <div class="panel__body">
            <div class="panel__nav">
              <a class="button panel__button" href="<?= BASE_URL . "admin/clientss/create.php" ?>">Добавить</a>

              <form action="index.php" method="post" class="form__search">
                <input type="text" name="search-client" class="search__input" placeholder="Поиск...">
              </form>
            </div>

            <div class="error">
              <?php include("../../app/helps/errInfo.php")?>
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
                      <a class="button panel__button-edit" href="edit.php?edit_id=<?= $client['id']?>">Редактировать</a>

                      <?php if($client['access'] == 0):?>
                        <a class="button panel__button-publish" href="index.php?access=1&pub_id=<?=$client['id'];?>">Доступ</a>
                      <?php else: ?>
                        <a class="button panel__button-publish" href="index.php?access=0&pub_id=<?=$client['id'];?>">Заблокировать</a>
                      <?php endif; ?>

                      <a class="button panel__button-red" href="index.php?del_id=<?= $client['id']?>">Удалить</a>
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

  <?php include('../../app/includes/footer.php') ?>

  <script src="https://kit.fontawesome.com/47a997ec54.js" crossorigin="anonymous"></script>
  <script src="../../assets/js/header.min.js"></script>
  <script src="../../assets/js/sidebar.min.js"></script>
</body>

</html>