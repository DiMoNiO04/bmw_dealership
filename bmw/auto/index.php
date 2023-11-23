<?php 
  include ('../path.php'); 
  include SITE_ROOT . "/app/database/DataB.php";
  include SITE_ROOT . '/app/controllers/order/Order.php';

  $db = new DataB();

  $auto = $db->selectAutoFromAutosWithModelsOnSingle('auto', 'models', $_GET['auto']);
  if($_SESSION['role'] == 1 && isset($_SESSION['id'])) {
    $user = $db->getPersonalData('employees', 'employees_address', 'employees_passport', 'authorization', $_SESSION['id']);		
    $isDataComplete = true;
    foreach($user as $key => $data) {
      if($data == '') {
        $isDataComplete = false;
      }
    }
  } else if($_SESSION['role'] == 0 && isset($_SESSION['id'])){
    $user = $db->getPersonalData('clients', 'clients_address', 'clients_passport', 'authorization', $_SESSION['id']);		
    $isDataComplete = true;
    foreach($user as $key => $data) {
      if($data == '') {
        $isDataComplete = false;
      }
    }
  }
  $errMsg = $orderController -> errMsg;

  $idAuto = $_GET['auto'];
?>

<!DOCTYPE html>
<html lang="ru">

<head>
 	<?php include(SITE_ROOT . '/app/includes/head.php') ?>
  <title>BMW <?=$auto['model']?> серии <?=$auto['name']?></title>
</head>

<body>

  <div class="popup popup__hidden">
    <div class="popup__content">

      <div class="popup__close">
        <img src="<?= PATCH ?>/images/svg/close.svg" alt="close">
      </div>
      
      <h2 class="popup__title">Оформление заказа на автомобиль <span>BMW <?=$auto['model']?> серии <?=$auto['name']?></span></h2>

      <form action="<?= BASE_URL ?>/auto?auto=<?= $idAuto?>" method="POST" class="popup-form">
        <div class="popup__date">
          <?php if(!empty($user)): ?>
            <div class="personal__date">
              <h2 class="popup__subtitle">Ваши персональные данные:</h2>
              <div class="personal__block">
                <h3>ФИО:</h3>
                <div class="personal__fio">
                  <p><?= $user['last_name']?></p>
                  <p><?= $user['first_name']?></p>
                  <p><?= $user['surname']?></p>
                </div>
              </div>
              <div class="personal__block">
                <h3>Дата рождения:</h3>
                <p><?= $user['date_birth']?></p>
              </div>
              <div class="personal__block">
                <h3>Номер телефона:</h3>
                <p><?= $user['phone']?></p>
              </div>
              <div class="personal__block">
                <h3>Логин:</h3>
                <p><?= $user['login']?></p>
              </div>
              <div class="personal__block">
                <h3>Email:</h3>
                <p><?= $user['email']?></p>
              </div>
              <div class="personal__block">
                <h3>Место жительства:</h3>
                <p>г.<?= $user['city']?>, ул.<?= $user['streer']?>, д.<?= $user['house']?>, кв.<?= $user['apartment']?></p>
              </div>
              <div class="personal__block">
                <h3>Серия и номер паспорта:</h3>
                <p><?= $user['series']?><?= $user['number']?></p>
              </div>
              <div class="personal__block">
                <h3>Кем выдан:</h3>
                <p><?= $user['issued_by']?></p>
              </div>
            </div>
          <?php else:?>
            <p class="panel__empty">Для того чтобы совершить заказ, Вам необходимо войти в личный кабинет или зарегистрироваться</p>
          <?php endif; ?>

            <div class="auto__date">
              <h2 class="popup__subtitle">Данные автомобиля:</h2>
              <div class="auto__block">
                <h3>Модель:</h3>
                <p>BMW <?=$auto['model']?> серии <?=$auto['name']?></p>
              </div>
              <div class="auto__block">
                <h3>Коробка передач:</h3>
                <p><?=$auto['engine']?></p>
              </div>
              <div class="auto__block">
                <h3>Цвет:</h3>
                <p><?=$auto['color']?></p>
              </div>
              <div class="auto__block">
                <h3>Год выпуска:</h3>
                <p><?=$auto['year']?></p>
              </div>
              <div class="auto__block">
                <h3>Состояние:</h3>
                <p><?=$auto['state']?></p>
              </div>
              <div class="auto__block">
                <h3>Комплектация:</h3>
                <p><?=$auto['complexion']?></p>
              </div>
            </div>
            <div class="price__block price__summary">
                <h3>Стоимость: </h3>
                <p><?=$auto['price']?></p>
            </div>
          </div>

          
            <?php if($isDataComplete == true): ?>
              <h3 class="popup__title">Оформление заказа</h3>
              <div class="popup__item">
                <label for="email" class="order__label">Ваша почта</label>
                <input type="email" name="email" id="email" class="order__input" placeholder="Введите почту...">
              </div>
              <div class="popup__item">
                <label for="login" class="order__label">Ваш логин</label>
                <input type="text" name="login" id="login" class="order__input" placeholder="Введите логин...">
              </div>
              <div class="popup__item">
                <label for="password-first" class="order__label">Введите пароль для оформления заказа</label>
                <input type="password" name="password-first" class="order__input" id="password-first" placeholder="Введите пароль...">
              </div>
              <div class="popup__item">
                <label for="password-second" class="order__label">Повторите пароль для подтверждения заказа</label>
                <input type="password" name="password-second" class="order__input" id="password-second" placeholder="Введите пароль...">
              </div>
              <button type="submit" class="button button__popup-ok" name="button-order">Оформить заказ</button>
            <?php else: ?>
              <p class="panel__empty">Вы не можете оформить заказ, так как у вас введены не все личные данные. Перейдите в личный кабинет и отредактируйте персональные данные</p>
            <?php endif; ?>
        </form>
      </div>
  </div>
  <div class="dark__container dark__container__noactive"></div>

  <?php include(SITE_ROOT . '/app/includes/header.php') ?>

  <div class="dark-wrapper"></div>
  <main>

    <section class="single-auto" style="background: url(<?=BASE_URL . 'assets/images/models/' . $auto['main_foto']?>) no-repeat center; background-size: cover;">
      <div class="auto__bg-fon"></div>
      <div class="container">
        <div class="single-auto__container">
          <div class="single-auto__desc">
          <div class="error">
            <?php include(SITE_ROOT . "/app/helps/errInfo.php")?>
          </div>
            <div class="single-auto__logo">
              <img src="<?= PATCH ?>/images/bmw-logo-2.png" alt="bmw-logo" class="logo-M2">
              <h1 class="single-auto__title">BMW <?=$auto['model']?> серии <?=$auto['name']?></h1>
            </div>

            <?php if($auto['status'] == 0):?>
              <button disabled class="button button__order__auto" title="Нету в наличии">Оформить авто</button>
            <?php else: ?>
              <button class="button button__order__auto">Оформить авто</button>
            <?php endif; ?>
            
          </div>
          <p class="single-auto__p">С удовольствием за рулем!</p>
        </div>
      </div>
    </section>

    <section class="characteristic">
      <div class="container">		
        <div class="characteristic__container">
        
          <h2 class="characteristic__title">BMW <?=$auto['model']?> серии <?=$auto['name']?></h2>
          <ul class="characteristic__content">
            <li><strong>Модель:</strong><?=$auto['model']?></li>
            <li><strong>Цвет:</strong> <?=$auto['color']?></li>
            <li><strong>Двигатель:</strong> <?=$auto['engine']?></li>
            <li><strong>Год выпуска:</strong> <?=$auto['year']?></li>
            <li><strong>Комплектация:</strong> <?=$auto['complexion']?></li>
            <li><strong>Состояние:</strong> <?=$auto['state']?></li>
            <li><strong>Стоимость:</strong> <?=$auto['price']?> $</li>

            <?php if($auto['status'] == 0):?>
              <li><strong>Наличе:</strong><span class="red">нету в наличии</span></li>
            <?php else: ?>
              <li><strong>Наличе:</strong><span class="green">есть в наличии</span></li>
            <?php endif; ?>

          </ul>
        </div>
        <img class="single-auto__image" src="<?=BASE_URL . '/images/cars/' . $auto['img'] ?>" alt="<?=$auto['model']?><?=$auto['name']?>">
      </div>
    </section>

    <section class="description">
      <div class="container">
        <div class="description__container">

          <?php if($auto['status'] == 0):?>
              <button disabled class="button button__order" title="Нету в наличии">Оформить авто</button>
            <?php else: ?>
              <button class="button button__order">Оформить авто</button>
          <?php endif; ?>
  
        </div>
      </div>
    </section>
  </main>

  <?php include(SITE_ROOT . '/app/includes/footer.php') ?>
	<?php include(SITE_ROOT . '/app/includes/script.php') ?>
</body>

</html>