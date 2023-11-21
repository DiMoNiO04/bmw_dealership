<?php 
  include ('../../path.php');
  include SITE_ROOT . "/app/database/DataB.php";
  include "../../app/controllers/auto/Auto.php";

  $db = new DataB();
  $models = $db->selectAll('models');

  $auto = new Auto();
  $auto->editAuto();
  $auto->editStatusAuto();
  $auto->deleteAuto();
  [$id, $name, $complexion, $color, $year, $engine, $price, $status, $img, $model] = 	$auto->updateAuto();

  if(!$_SESSION) {
    header('location: ' . BASE_URL . 'auth.php');
  }
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <?php include('../../app/includes/head.php') ?>
  <title>Админ панель: Автомобили</title>
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
            <h1 class="title-pages panel__title">Редактирование авто</h1>

            
            <div class="panel__blocks">

              <form  class="admin-form" action="edit.php" method="post" enctype="multipart/form-data">						
                <p class="obligatory"><span>*</span> - обязательное поле для заполнения</p>
                <input type="hidden" name="id" value="<?= $id ?>">
                <div class="admin__form-block">
                  <label for="name">Название<span>*</span></label>
                  <input value="<?= $name?>" name="name" type="text" id="name" required>
                </div>
                <div class="admin__form-block admin__form-block">
                  <label for="complexion">Комплектация<span>*</span></label>
                  <select name="complexion" id="complexion" required>
                    <option value="Базовая">Базовая</option>
                    <option value="Средняя">Средняя</option>
                    <option value="Полная">Полная</option>
                  </select>
                </div>
                <div class="admin__form-block admin__form-block">
                  <label for="color">Цвет<span>*</span></label>
                  <input  value="<?= $color?>" name="color" type="text" name="color" required>
                </div>
                
                <div class="admin__form-block admin__form-block">
                  <label for="date">Год выпуска<span>*</span></label>
                  <input  value="<?= $year?>" name="year" type="number" max="2023" name="date" required>
                </div>
                <div class="admin__form-block admin__form-block">
                  <label for="engine">Двигатель<span>*</span></label>
                  <select name="engine" required>
                    <option value="Бензиновый">Бензиновый</option>
                    <option value="Электрический">Электрический</option>
                  </select>
                </div>
                <div class="admin__form-block admin__form-block">
                  <label for="price">Цена (&#36)<span>*</span></label>
                  <input  value="<?= $price - 3000?>" name="price" type="number" name="price" required>
                </div>
                <div class="admin__form-block">
                  <label for="file">Выберите фото авто (выбрано по умолчанию)</label>
                  <input name="img" type="file" id="file">
                </div>
                <div class="admin__form-block">
                  <label for="file">Модель<span>*</span></label>
                  <select name="model" required>
                    <?php foreach ($models as $key => $model): ?>
                      <option value="<?= $model['id']?>"><?=$model['model'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="admin__form-block admin__form-block-st">
                  <label for="status">Наличие:</label>
                  <?php if($status == 0):?>
                    <input value="0" name="status" type="checkbox">
                  <?php else: ?>
                    <input value="1" name="status" type="checkbox" checked>
                  <?php endif; ?>
                </div>
                <button name="auto-edit" type="submit" class="button">Сохранить</button>
              </form>
            </div>
            
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include('../../app/includes/footer.php') ?>

  <script src="https://kit.fontawesome.com/47a997ec54.js" crossorigin="anonymous"></script>
  <script src="../../assets/js/header.min.js"></script>
</body>

</html>М