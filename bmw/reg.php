<?php  
      include ('path.php'); 
      include SITE_ROOT . "/app/database/database.php";
      include("./app/controllers/user.php");  

      $user = new User();
      $user->registration();

      $errMsg = $userActions -> errMsg;
?>


<!DOCTYPE html>
<html lang="ru">

<head>
  <?php include('./app/includes/head.php') ?>
  <title>Региcтрация BMW</title>
</head>

<body>

  <?php include('./app/includes/header-blue.php') ?>

  <div class="dark-wrapper"></div>
  <main>
    <div class="container">
      <form method="post" class="form-reg" method="post" action="reg.php">
        <h1 class="form-reg__title">Регистрация</h1>
        <div class="form-reg__desc">
          <p>У вас уже есть аккаунт? Вы можете авторизироваться <a href="./auth.php">здесь</a></p>
          <p><span>*</span> - обязательное поле для заполнения</p>
        </div>

        <div class="error">
          <?php include("./app/helps/errInfo.php")?>
        </div>

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
            <label for="email">Email<span>*</span></label>
            <input type="email" value="<?=$email ?>" name="email" id="email" placeholder="Введите почту..." required>
          </div>
        </section>

        <section class="form-reg__block">
          <h2>Данные для входа</h2>
          <div class="form-reg__item">
            <label for="login">Логин (более 3-х символов)<span>*</span></label>
            <input type="text" value="<?=$login ?>" name="login" id="login" placeholder="Введите логин..." required>
          </div>
          <div class="form-reg__item">
            <label for="password-first">Пароль<span>*</span></label>
            <input type="password" name="password-first" id="password-first" placeholder="Введите пароль..." required>
          </div>
          <div class="form-reg__item">
            <label for="password-second">Повторите пароль<span>*</span></label>
            <input type="password" name="password-second" id="password-second" placeholder="Введите пароль..." required>
          </div>
        </section>
        
          <div class="form-reg__item form-reg__buttons">
            <button type="submit" name="button__reg">Зарегистрироваться</button>
            <a href="./auth.php">Войти</a>
          </div>
      </form>
    </div>
  </main>

  <?php include('./app/includes/footer.php') ?>

  <script src="https://kit.fontawesome.com/47a997ec54.js" crossorigin="anonymous"></script>
  <script src="./assets/js/header.min.js"></script>
</body>

</html>