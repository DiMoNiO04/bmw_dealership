<?php 
  include ('../../../path.php');
  include SITE_ROOT . "/app/database/DataB.php";
  include SITE_ROOT . "/app/controllers/AutoController.php";

  $db = new DataB();
  $models = $db->selectAll('models');

  $auto = new AutoController();
  $auto->addAuto();

  if(!$_SESSION) {
    header('location: ' . BASE_URL . '/auth');
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
            <h1 class="title-pages panel__title">Добавление авто</h1>

            <div class="panel__blocks">
              <form  class="admin-form" action="<?= BASE_URL?>/admin/auto/create/" method="post" enctype="multipart/form-data">
                <p class="obligatory"><span>*</span> - обязательное поле для заполнения</p>
                <div class="admin__form-block">
                  <label for="name">Название<span>*</span></label>
                  <input value="<?= $name?>" name="name" type="text" id="name" placeholder="Название" required>
                </div>
                <div class="admin__form-block">
                  <label for="date">Год выпуска<span>*</span></label>
                  <input  value="<?= $year?>" name="year" type="number" min="2010" max="2023" name="date" placeholder="Год выпуска" required>
                </div>
                <div class="admin__form-block">
                  <label for="complexion">Комплектация<span>*</span></label>
                  <select name="complexion" id="complexion">
                    <option>Выберите комплектацию</option>
                    <option value="Базовая">Базовая</option>
                    <option value="Средняя">Средняя</option>
                    <option value="Полная">Полная</option>
                  </select>
                </div>
                <div class="admin__form-block">
                  <label for="color">Цвет<span>*</span></label>
                  <input  value="<?= $color?>" name="color" type="text" name="color" placeholder="Цвет" required>
                </div>
                <div class="admin__form-block">
                  <label for="engine">Двигатель<span>*</span></label>
                  <select name="engine">
                    <option selected>Выберите двигатель</option>
                    <option value="Бензиновый">Бензиновый</option>
                    <option value="Электрический">Электрический</option>
                  </select>
                </div>
                <div class="admin__form-block">
                  <label for="state">Состояние<span>*</span></label>
                  <select name="state" id="state">
                    <option>Выберите cостояние:</option>
                    <option value="Новое">Новое</option>
                    <option value="Бу">Бу</option>
                  </select>
                </div>
                <div class="admin__form-block">
                  <label for="price">Цена (&#36)<span>*</span></label>
                  <input  value="<?= $price?>" name="price" type="number" min="50000" step="5000" name="price" placeholder="Цена &#36" required>
                </div>
                <div class="admin__form-block">
                  <label for="file">Модель<span>*</span></label>
                  <select name="model">
                    <option>Выберите модель:</option>
                    <?php foreach ($models as $key => $model): ?>
                      <option value="<?= $model['id']?>"><?=$model['model'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="admin__form-block">
                  <label for="file">Выберите фото авто<span>*</span></label>
                  <input name="img" type="file" id="file" required>
                </div>
                <div class="admin__form-block admin__form-block-st">
                  <label for="status">Наличие:</label>
                  <input name="status" type="checkbox" name="status">
                </div>
                <button name="auto-create" type="submit" class="button">Добавить</button>
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