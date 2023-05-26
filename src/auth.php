<?php 
  include ('path.php'); 
	include SITE_ROOT . "/app/database/database.php";
	include("./app/controllers/user.php"); 
	$errMsg = $user -> errMsg;
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <?php include('./app/includes/head.php') ?>
  <title>Авторизация BMW</title>
</head>

<body>

  <?php include('./app/includes/header-blue.php') ?>

  <div class="dark-wrapper"></div>
  <main>
    <div class="container">
      <form method="post" action="" class="form-auth">
        <h1 class="form-auth__title">Авторизация</h1>
        <p class="form-auth__desc">У вас еще нет аккаунта? Вы можете зарегистрироваться <a href="./reg.php">здесь</a></p>
        
        <div class="error">
          <?php include("./app/helps/errInfo.php")?>
        </div>
        
        <div class="form-auth__item">
          <label for="email">Email (при регистрации)</label>
          <input type="email" value="<?=$email ?>" name="email" id="email" placeholder="Введите email..." required>
        </div>
        <div class="form-auth__item">
          <label for="password">Пароль</label>
          <input type="password" name="password" id="password" placeholder="Введите пароль..." required>
        </div>
        <div class="form-auth__item form-auth__buttons">
          <button type="submit" name="button__auth">Войти</button>
          <a href="./reg.php">Зарегистрироваться</a>
        </div>
      </form>
    </div>
  </main>

  <?php include('./app/includes/footer.php') ?>

  <script src="https://kit.fontawesome.com/47a997ec54.js" crossorigin="anonymous"></script>
  <script src="./assets/js/header.min.js"></script>
</body>

</html>