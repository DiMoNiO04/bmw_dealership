<?php 
  include "../../../path.php";
  include SITE_ROOT . "/app/database/DataB.php";
  include SITE_ROOT . "/app/controllers/model/Model.php";

  $model = new Model();
  $model->deleteModel();
  $model->updateModel();
  $model->editModel();

  [$id, $modelName, $img] = $model->editModel();

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
            <h1 class="title-pages panel__title">Обновление модели авто</h1>
            <div class="panel__blocks">

              <form class="admin-form" method="post" action="<?= ADMIN_URL ?>/model/edit/" enctype="multipart/form-data">
                <p class="obligatory"><span>*</span> - обязательное поле для заполнения</p>
                <input name="id" type="hidden" value="<?=$id ?>">
                <div class="admin__form-block">
                  <label for="model">Модель<span>*</span></label>
                  <input value="<?=$modelName ?>" name="modelName" type="text" id="model" placeholder="Модель" required>
                </div>
                <div class="admin__form-block">
                  <label for="file">Выберите главное фото модели (выбрано по умолчанию)</label>
                  <input name="img" type="file" id="file">
                </div>
                <button name="model-edit" type="submit" class="button">Обновить</button>
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