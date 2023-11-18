<?php 
  include ('path.php'); 
  include("./app/database/Database.php"); 
  include('./app/controllers/Auto.php');

  $db = new DataB();

  $auto = new Auto();
  [$arrAuto, $autos] = $auto->searchAuto();

  [
    $priceFrom, $priceTo, $yearFrom, $yearTo, $engine,
    $status, $col, $name, $complex, $state
  ] = $arrAuto;

  $modelsSearch = [];
  foreach($autos as $key => $auto) {
    if(!in_array($auto['model'], $modelsSearch)) {
      array_push($modelsSearch, $auto['model']);
    }
  }

  $complexion = ['Базовая', 'Средняя', 'Полная'];
  $colors = $db->getColorsAutos();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <?php include('./app/includes/head.php') ?>
  <title>Автомобили-BMW</title>
</head>

<body>
  
  <?php include('./app/includes/header-blue.php') ?>

  <div class="dark-wrapper"></div>
  <main>
    <section class="auto">
      <div class="container">
        <div class="auto__container">
          <h2 class="title-pages">Выберите свой автомобиль</h2>
          <div class="auto__filtr">
            <form method="post" action="search.php" class="form__search">
              <h2 class="search__title">Подберите авто по вашим запросам</h2>
              <ul class="search__container">

                <li class="search__block">
                  <h3>Название</h3>
                  <input type="text" name="name" id="name" value="<?= $name?>" class="search__input">
                </li>

                <li class="search__block">
                  <h3>Цвет</h3>
                  <select name="color" class="search__select">
                    <option selected>Цвет:</option>
                    <?php foreach($colors as $key => $color): ?>
                      <?php if($colors[$key]['color'] == $col): ?>
                        <option selected value="<?= $colors[$key]['color']?>"><?= $colors[$key]['color']?></option>
                      <?php else: ?>
                        <option value="<?= $colors[$key]['color']?>"><?= $colors[$key]['color']?></option>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </select>
                </li>

                <li class="search__block">
                  <h3>Комплектация</h3>
                  <select name="complexion" class="search__select">
                    <option>Комплектация:</option>
                    <?php foreach($complexion as $key => $comp): ?>
                      <?php if($complexion[$key] == $complex): ?>
                        <option selected value="<?= $complexion[$key]?>"><?= $complexion[$key]?></option>
                      <?php else: ?>
                        <option value="<?= $complexion[$key]?>"><?= $complexion[$key]?></option>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </select>
                </li>

                <li class="search__block">
                  <h3>Наличие</h3>
                  <?php if($status == 1): ?>
                    <label class="custom-checkbox">
                      <input checked name="status" type="checkbox" value="1">
                      <span>Есть</span>
                    </label>
                  <?php else: ?>
                    <label class="custom-checkbox">
                      <input name="status" type="checkbox" value="1">
                      <span>Есть</span>
                    </label>
                  <?php endif; ?>
                </li>

                <li class="search__block">
                  <h3>Двигатель</h3>
                  <?php if($engine == 'Бензиновый'): ?>
                    <label class="custom-checkbox">
                      <input checked name="engine" type="checkbox" value="Бензиновый">
                      <span>Бензиновый</span>
                    </label>
                    <label class="custom-checkbox">
                      <input name="engine" type="checkbox" value="Электрический">
                      <span>Электрический</span>
                    </label>
                  <?php elseif($engine == 'Электрический'): ?>
                    <label class="custom-checkbox">
                      <input name="engine" type="checkbox" value="Бензиновый">
                      <span>Бензиновый</span>
                    </label>
                    <label class="custom-checkbox">
                      <input checked name="engine" type="checkbox" value="Электрический">
                      <span>Электрический</span>
                    </label>
                  <?php else: ?>
                    <label class="custom-checkbox">
                      <input name="engine" type="checkbox" value="Бензиновый">
                      <span>Бензиновый</span>
                    </label>
                    <label class="custom-checkbox">
                      <input name="engine" type="checkbox" value="Электрический">
                      <span>Электрический</span>
                    </label>
                  <?php endif; ?>
                </li>

                <li class="search__block">
                  <h3>Состояние</h3>
                  <?php if($state == 'Новое'):?>
                    <label class="custom-checkbox">
                      <input checked name="state" type="checkbox" value="Новое">
                      <span>Новое</span>
                    </label>
                    <label class="custom-checkbox">
                      <input name="state" type="checkbox" value="Бу">
                      <span>Бу</span>
                    </label>
                  <?php elseif($state == 'Бу'): ?>
                    <label class="custom-checkbox">
                      <input name="state" type="checkbox" value="Новое">
                      <span>Новое</span>
                    </label>
                    <label class="custom-checkbox">
                      <input checked name="state" type="checkbox" value="Бу">
                      <span>Бу</span>
                    </label>
                  <?php else: ?>
                    <label class="custom-checkbox">
                      <input name="state" type="checkbox" value="Новое">
                      <span>Новое</span>
                    </label>
                    <label class="custom-checkbox">
                      <input name="state" type="checkbox" value="Бу">
                      <span>Бу</span>
                    </label>
                  <?php endif; ?>
                </li>

                <li class="search__block">
                  <h3>Год выпуска</h3>
                  <input type="number" min="2019" max="2023" name="year__from" id="year__from" value="<?= $yearFrom?>" class="search__input" placeholder="От">
                  <input type="number" min="2019" max="2023" name="year__to" id="year__to" value="<?= $yearTo?>" class="search__input" placeholder="До">
                </li>

                <li class="search__block">
                  <h3>Цена</h3>
                  <input type="number" min="50000" step="5000" name="price__from" id="price__from" value="<?= $priceFrom?>" class="search__input" placeholder="От">
                  <input type="number" min="50000" step="5000" name="price__to" id="price__to"  value="<?= $priceTo?>" class="search__input" placeholder="До">
                </li>
              </ul>
              <button class="button button__search" name="search__auto" type="submit" title="Найти">Найти</button>
            </form>
          </div>


          <?php include('./app/includes/sidebar.php') ?>

          <?php if(!empty($autos)):?>

            <div class="auto__content">
              <div class="model__container">

              <div class="error"></div>

                <?php foreach($modelsSearch as $model): ?>									
                  <h2 class="model__title" model="<?= $model ?>"><?= $model ?></h2>
                  <div class="model__cars model__cars-js" model="<?= $model ?>">

                  <?php foreach($autos as $auto): ?>
                    <?php if($auto['model'] === $model): ?>
                      <a href="<?= BASE_URL . 'single__auto.php?auto=' . $auto['id']?>" class="model__car" title="Перейти BMW <?= $auto['model'] ?> серии <?= $auto['name'] ?>">
                        <img src="<?=BASE_URL . 'assets/images/dest/cars/' . $auto['img'] ?>" alt="BMW <?= $auto['name'] ?>">
                        <h3>BMW <?= $auto['model']?> серии <?= $auto['name'] ?></h3>
                        <span><?= $auto['engine'] ?></span>
                      </a>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </div>
                <?php endforeach; ?>

              </div>
            </div>
          </div>
          <?php else: ?>
            <div class="error">
              По данному поиску ничего не найдено! Повторите поиск!
            </div>
          <?php endif; ?>
      </div>
    </section>
  </main>

  <?php include('./app/includes/footer.php') ?>

  <script src="https://kit.fontawesome.com/47a997ec54.js" crossorigin="anonymous"></script>
  <script src="./assets/js/header.min.js"></script>
  <script src="./assets/js/sidebar.min.js"></script>
</body>

</html>