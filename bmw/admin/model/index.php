<?php 
  session_start();
   include "../../path.php";
   include SITE_ROOT . "/app/database/DataB.php";
   include SITE_ROOT . "/app/controllers/model/Model.php";

   $db = new DataB();
   $models = $db->selectAll('models');

   $model = new Model();

    if(!$_SESSION) {
      header('location:' . BASE_URL . '/auth');
    }
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <?php include(SITE_ROOT . '/app/includes/head.php') ?>
  <title>Админ панель: Модели</title>
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
            <a class="button panel__button" href="<?= ADMIN_URL ?>/model/create/">Добавить</a>
            <h1 class="title-pages panel__title">Модели авто</h1>

            <div class="panel__blocks">
              
              <?php if(empty($models)):?>
                <p class="panel__empty">Модели автомобилей в базе данных отсутствуют. Но вы можете добавить</p>
              <?php else:?>
                <?php foreach($models as $key => $model): ?>
                  <div class="panel__block">
                    <h2 class="panel__subtitle"><?=$model['model']; ?></h2>
                    
                    <?php if(!empty($model['main_foto'])): ?>
                      <img src="<?=BASE_URL . '/images/dest/models/' . $model['main_foto'] ?>" alt="<?=$model['model']; ?>" class="panel__img">
                    <?php endif; ?>

                      <?php if($model['counts'] > 0): ?>
                        <div class="panel__status green">
                          <h3>Наличие:</h3>
                          <p>Есть в наличии</p>
                        </div>
                      <?php else: ?>	
                        <div class="panel__status red">
                          <h3>Наличие:</h3>
                          <p>Нет в наличии</p>
                        </div>
                      <?php endif; ?>

                      <div class="panel__buttons">
                        <a class="button panel__button-edit" href="<?= ADMIN_URL ?>/model/edit?id=<?=$model['id']?>">Редактировать</a>
                        <a class="button panel__button-red" href="<?= ADMIN_URL ?>/model/edit?del_id=<?=$model['id']?>">Удалить</a>
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