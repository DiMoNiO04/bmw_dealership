<?php 
  include "../../../path.php";
  include SITE_ROOT . "/app/database/DataB.php";
  include SITE_ROOT . "/app/controllers/model/Model.php";

  $model = new Model();
  $model->addModel();

  if(!$_SESSION) {
    header('location:/bmw/auth.php');
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
            <h1 class="title-pages panel__title">Добавление модели авто</h1>
            <div class="panel__blocks">

              <form  class="admin-form" method="post" action="create.php" enctype="multipart/form-data">
                <p class="obligatory"><span>*</span> - обязательное поле для заполнения</p>
                <div class="admin__form-block">
                  <label for="model">Модель<span>*</span></label>
                  <input value="<?=$modelName ?>" name="modelName" type="text" id="model" placeholder="Модель" required>
                </div>
                <div class="admin__form-block">
                  <label for="file">Выберите главное фото модели<span>*</span></label>
                  <input name="img" type="file" id="file" required>
                </div>
                <button name="model-create" type="submit" class="button">Добавить</button>
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