<?php 
  session_start();
  include "../../path.php";
  include SITE_ROOT . "/app/database/DataB.php";
  include SITE_ROOT . "/app/controllers/contact/Contact.php";

  $db = new DataB();
  $contacts = $db->selectAll('contactsview');

  $contact = new Contact();
  $contact->deleteContact();

  if(!$_SESSION) {
    header('location: ' . BASE_URL . 'auth.php');
  }
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <?php include(SITE_ROOT . '/app/includes/head.php') ?>
  <title>Админ панель: Контакты</title>
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
            <a class="button panel__button" href="<?= BASE_URL . "admin/contacts/create.php" ?>">Добавить</a>
            <h1 class="title-pages panel__title">Контакты</h1>

            <div class="panel__blocks">
            <?php if(empty($contacts)):?>
              <p class="panel__empty">Контакты в базе данных отсутствуют. Но вы можете добавить</p>
            <?php else:?>
              <?php foreach($contacts as $key => $contact): ?>
                <div class="panel__block">
                  <h2 class="panel__subtitle"><?=$contact['name']?></h2>
                  <div class="panel__item">
                    <h3>Телефон:</h3>
                    <p><?= $contact['phone']?></p>
                  </div>
                  <div class="panel__item">
                    <h3>Время работы:</h3>
                    <p><?= $contact['work_time']?></p>
                  </div>
                  <div class="panel__item">
                    <h3>Email</h3>
                    <p><?= $contact['email']?></p>
                  </div>
                  <div class="panel__item">
                    <h3>Адресс</h3>
                    <p>г.<?= $contact['city']?> ул.<?= $contact['street']?> д.<?= $contact['house']?></p>
                  </div>
                  <div class="panel__buttons">
                    <a class="button panel__button-edit" href="edit.php?id=<?=$contact['id']?>">Редактировать</a>
                    <a class="button panel__button-red" href="edit.php?del_id=<?=$contact['id']?>">Удалить</a>
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