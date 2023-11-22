<?php 
  include "../../path.php";
  include SITE_ROOT . "/app/database/DataB.php";
  include SITE_ROOT . "/app/controllers/employee/Employee.php";

  $db = new DataB();

  $employee = new Employee();
  $employee->update();

  [
    $lastName, $firstName, $surname, $dateBirth, $phone, $city, $street, $house, $apartment,
    $series, $number, $issuedBy, $login, $password, $email, $jobTitle
  ] = $employee->edit();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
 	<?php include(SITE_ROOT . '/app/includes/head.php') ?>
  <title>Админ панель: Сотрудники</title>
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
            <div class="panel__titles">
              <h1 class="title-pages panel__title">Редактирование сотрудника</h1>
              <p><?= $lastName?> <?= $firstName?> <?= $surname?></p>
            </div>

              <form  class="admin-form" method="post" action="edit.php" enctype="multipart/form-data">
                <p class="obligatory"><span>*</span> - обязательное поле для заполнения</p>
                <input name="id" type="hidden" value="<?=$id ?>">
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
                  <div class="admin__form-block">
                    <label for="job">Должность:</label>
                    <select name="job" id="job">
                      <option value="Менеджер">Менеджер</option>
                      <option value="Админ">Админ</option>
                    </select>
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
                    <label for="login">Логин (данное поле нельзя отредактировать)</label>
                    <input readonly type="text" value="<?=$login ?>" id="login">
                  </div>
                  <div class="form-reg__item">
                    <label for="email">Email (данное поле нельзя отредактировать)</label>
                    <input readonly type="email" value="<?=$email ?>" id="email">
                  </div>
                  <div class="form-reg__item admin__form-block-st">
                    <label for="access">Доступ:</label>
                    <?php if($access == 0):?>
                      <input value="0" name="access" type="checkbox">
                    <?php else: ?>
                      <input value="1" name="access" type="checkbox" checked>
                    <?php endif; ?>
                  </div>
                </section>

                <button name="employee-edit" type="submit" class="button">Сохранить</button>
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