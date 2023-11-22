<?php 
   session_start();
   include "../path.php";
   include SITE_ROOT . "/app/database/DataB.php";
   include SITE_ROOT . "/app/controllers/auto/Auto.php";

   $db = new DataB();

  if(!$_SESSION) {
    header('location: ' . BASE_URL . '/auth');
  }
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <?php include(SITE_ROOT . '/app/includes/head.php') ?>
  <title>Админ панель</title>
</head>

<body>
  
  <?php include(SITE_ROOT . '/app/includes/header-admin.php') ?>

  <div class="dark-wrapper"></div>
  <main>
    <section class="panel">
      <div class="container">
        <div class="panel__container panel__container--admin">
            <h1 class="title-pages panel__title">Админ панель</h1>

             <?php include(SITE_ROOT . '/app/includes/aside.php') ?>
        </div>
      </div>
    </section>
  </main>

  <?php include(SITE_ROOT . '/app/includes/footer.php') ?>
  <?php include(SITE_ROOT . '/app/includes/script.php') ?>

</body>

</html>