<?php 
   session_start();
   include "../../path.php";
   include SITE_ROOT . "/app/database/DataB.php";
   include SITE_ROOT . "/app/controllers/auto/Auto.php";

   $db = new DataB();
   $autoModelsName = $db->selectAll('autosview');

   $auto = new Auto();
   $auto->deleteAuto();

  if(!$_SESSION) {
    header('location: ' . BASE_URL . 'auth.php');
  }
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <?php include(SITE_ROOT . '/app/includes/head.php') ?>
  <title>Админ панель: Автомобили</title>
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
            <a class="button panel__button" href="<?= ADMIN_URL . "/auto/create/" ?>">Добавить</a>
            <h1 class="title-pages panel__title">Автомобили</h1>
          
            <?php if(empty($autoModelsName)):?>
              <p class="panel__empty">Автомобили в базе данных отсутствуют. Но вы можете добавить</p>
            <?php else:?>

              <div class="panel__blocks">
                <div class="error"></div>
                <?php foreach ($autoModelsName as $key => $auto): ?>
                  <div class="panel__block model__cars-js" model="<?= $auto['model']?>">
                    <h2 class="panel__subtitle"><?= $auto['model']?> серии <?= $auto['name']; ?></h2>
                    
                    <?php if(!empty($auto['img'])): ?>
                      <img src="<?=PATCH . '/images/cars/' . $auto['img'] ?>" alt="<?= $auto['name']; ?>" class="panel__img panel__img-sm">
                    <?php endif; ?>
                    
                    <div class="panel__item">
                      <h3>Комплектация:</h3>
                      <p><?= $auto['complexion'];?></p>
                    </div>
                    <div class="panel__item">
                      <h3>Цвет:</h3>
                      <p><?= $auto['color']; ?></p>
                    </div>
                    <div class="panel__item">
                      <h3>Год выпуска:</h3>
                      <p><?= $auto['year']; ?></p>
                    </div>
                    <div class="panel__item">
                      <h3>Двигатель:</h3>
                      <p><?= $auto['engine']; ?></p>
                    </div>
                    <div class="panel__item">
                      <h3>Цена:</h3>
                      <p><?= $auto['price']; ?> &#36 </p>
                    </div>
                    <div class="panel__item">
                      <h3>Состояние:</h3>
                      <p><?= $auto['state']; ?></p>
                    </div>
                    <?php if($auto['status'] == 0):?>
                      <div class="panel__item red">
                        <h3>Наличие:</h3>
                        <p>Нет в наличии</p>
                      </div>
                    <?php else: ?>
                      <div class="panel__item green">
                        <h3>Наличие:</h3>
                        <p>Есть в наличии</p>
                      </div>
                    <?php endif; ?>
                    
                    <div class="panel__buttons">
                      <a class="button panel__button-edit" href="<?= ADMIN_URL ?>/auto/edit?id=<?=$auto['id'];?>">Редактировать</a>

                      <?php if($auto['status'] == 0): ?>
                        <a class="button panel__button-publish" href="<?= ADMIN_URL ?>/auto/edit?status=1&pub_id=<?=$auto['id'];?>">Опубликовать</a>
                      <?php else:?>
                        <a class="button panel__button-publish" href="<?= ADMIN_URL ?>/auto/edit?status=0&pub_id=<?=$auto['id'];?>">Снять с публикации</a>
                      <?php endif; ?>

                      <a class="button panel__button-red" href="<?= ADMIN_URL ?>/auto/edit?del_id=<?=$auto['id'];?>">Удалить</a>
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