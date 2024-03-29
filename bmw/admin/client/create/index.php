<?php 
  include "../../../path.php";
  include SITE_ROOT . "/app/database/DataB.php";
  include SITE_ROOT . "/app/controllers/ClientController.php";

  $client = new ClientController();
  [$lastName, $firstName, $surname, $dateBirth, $phone, $city, $street, $house, $apartment, $series, $number, $issuedBy, $login, $password, $email, $jobTitle] = $client->add();

  $errMsg = $clientService -> errMsg;
?>

<!DOCTYPE html>
<html lang="ru">

<head>
   <?php include(SITE_ROOT . '/app/includes/head.php') ?>
  <title>Админ панель: Клиенты</title>
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
            <h1 class="title-pages panel__title">Добавление клиента</h1>
            <div class="panel__blocks">

            <div class="error">
              <?php include(SITE_ROOT . "/app/helps/errInfo.php")?>
            </div>

              <form  class="admin-form" method="post" action="<?= ADMIN_URL ?>/client/create/" enctype="multipart/form-data">
                <p class="obligatory"><span>*</span> - обязательное поле для заполнения</p>
                <section class="form-reg__block">	
                  <h2>Личные данные</h2>
                  <div class="form-reg__item">
                    <label for="last_name">Фамилия<span>*</span></label>
                    <input type="text" value="<?=$lastName ?>" name="last_name" id="last_name" placeholder="Введите фамилию..." required>
                  </div>
                  <div class="form-reg__item">
                    <label for="first_name">Имя<span>*</span></label>
                    <input type="text" value="<?=$firstName ?>" name="first_name" id="first_name" placeholder="Введите имя..." required>
                  </div>
                  <div class="form-reg__item">
                    <label for="surname">Отчество</label>
                    <input type="text" value="<?=$surname ?>" name="surname" id="surname" placeholder="Введите имя...">
                  </div>
                  <div class="form-reg__item">
                    <label for="dateBirth">Дата рождения<span>*</span></label>
                    <input type="date" value="<?=$dateBirth ?>" name="date_birth" id="dateBirth">
                  </div>
                  <div class="form-reg__item">
                    <label for="phone">Номер телефона</label>
                    <input type="tel" value="<?=$phone ?>" name="phone" id="phone" placeholder="Введите номер телефона...">
                  </div>
                </section>

                <section class="form-reg__block">	
                  <h2>Данные по месту жительства</h2>
                  <div class="form-reg__item">
                    <label for="city">Город</label>
                    <input type="text" value="<?=$city ?>" name="city" id="city" placeholder="Введите город...">
                  </div>
                  <div class="form-reg__item">
                    <label for="street">Улица</label>
                    <input type="text" value="<?=$street ?>" name="street" id="street" placeholder="Введите улицу...">
                  </div>
                  <div class="form-reg__item">
                    <label for="house">Номер дома</label>
                    <input type="text" value="<?=$house ?>" name="house" id="house" placeholder="Введите номер дома...">
                  </div>
                  <div class="form-reg__item">
                    <label for="apartment">Номер квартиры</label>
                    <input type="number" min="1" value="<?=$apartment ?>" name="apartment" id="apartment" placeholder="Введите номер квартиры...">
                  </div>
                </section>

                <section class="form-reg__block">	
                  <h2>Паспортные данные</h2>
                  <div class="form-reg__item">
                    <label for="series">Серия</label>
                    <input type="text" value="<?=$series ?>" name="series" id="series" placeholder="Введите серию паспорта...">
                  </div>
                  <div class="form-reg__item">
                    <label for="number">Номер</label>
                    <input type="text" value="<?=$number ?>" name="number" id="number" placeholder="Введите номер паспорта...">
                  </div>
                  <div class="form-reg__item">
                    <label for="issued_by">Кем выдан</label>
                    <input type="text" value="<?=$issuedBy ?>" name="issued_by" id="issued_by" placeholder="Введите кем выдан...">
                  </div>
                </section>

                <section class="form-reg__block">	
                  <h2>Данные для входа</h2>
                  <div class="form-reg__item">
                    <label for="login">Логин<span>*</span></label>
                    <input type="text" value="<?=$login ?>" name="login" id="login" placeholder="Введите логин..." required>
                  </div>
                  <div class="form-reg__item">
                    <label for="password">Пароль<span>*</span></label>
                    <input type="password" name="password" id="password" placeholder="Введите пароль..." required>
                  </div>
                  <div class="form-reg__item">
                    <label for="email">Email<span>*</span></label>
                    <input type="email" value="<?=$email ?>" name="email" id="email" placeholder="Введите email..." required>
                  </div>
                  <div class="form-reg__item admin__form-block-st">
                    <label for="access">Доступ:</label>
                    <input value="1" name="access" type="checkbox">
                  </div>
                </section>

                <button name="client-create" type="submit" class="button">Добавить</button>
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