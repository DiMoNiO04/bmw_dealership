<?php 
  session_start();
  include ('./path.php'); 
  include ('./app/database/Database.php');
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <?php include('./app/includes/head.php') ?>
  <title>Автосалон-BMW</title>
</head>

<body>

  <?php include('./app/includes/header.php') ?>

  <div class="dark-wrapper"></div>
  <main>
    <section class="start">
      <div class="container">
        <div class="start__container">
          <div class="start__newcar">
            <div class="start__item">
              <img src="./assets/images/dest/bmw-logo-2.png" alt="bmw-logo" class="logo-M2">
              <h1 class="start__title">Новый <span class="red">M</span><span class="blue">5</span> Competition
              </h1>
            </div>
            <a href="./autos.php" class="button" title="Узнать подробнее">Подробнее</a>
          </div>
          <p class="start__desc"><span>BMW</span>- движение с комфортом</p>
        </div>
      </div>
    </section>

    <section class="cars">
      <div class="container">
        <div class="cars__container">
          <h2 class="cars__title">Автомобили</h2>
          <div class="cars__items">
            <div class="car__item">
              <img src="./assets/images/dest/cars/bmw4-cabrio.webp" alt="bmw4-cabrio">
              <h3 class="car__item-name">BMW 4 серии Cabrio</h3>
            </div>
            <div class="car__item">
              <img src="./assets/images/dest/cars/bmw6-gt.webp" alt="bmw6-gt">
              <h3 class="car__item-name">BMW 6 серии GT</h3>
            </div>
            <div class="car__item">
              <img src="./assets/images/dest/cars/m8-coupe.webp" alt="m8-coupe">
              <h3 class="car__item-name">BMW M8 Coupe</h3>
            </div>
            <div class="car__item">
              <img src="./assets/images/dest/cars/x5.webp" alt="x5">
              <h3 class="car__item-name">BMW X5</h3>
            </div>
            <div class="car__item">
              <img src="./assets/images/dest/cars/i7.webp" alt="i7">
              <h3 class="car__item-name">BMW i7</h3>
            </div>
            <div class="car__item">
              <img src="./assets/images/dest/cars/2-coupe.webp" alt="bmw2-coupe">
              <h3 class="car__item-name">BMW 2 серии Coupe</h3>
            </div>
            <div class="car__item">
              <img src="./assets/images/dest/cars/bmw-z4.webp" alt="bmw-z4">
              <h3 class="car__item-name">BMW Z4 Roodster</h3>
            </div>
            <div class="car__item">
              <img src="./assets/images/dest/cars/bmw3.webp" alt="bmw3">
              <h3 class="car__item-name">BMW 3 серии</h3>
            </div>
            <div class="car__item">
              <img src="./assets/images/dest/cars/bmw5.webp" alt="bmw5">
              <h3 class="car__item-name">BMW 5 серии</h3>
            </div>
          </div>
          <a href="./autos.php" class="button cars__button" title="Узнать подробнее">Подробнее</a>
        </div>
      </div>
    </section>

    <section class="about">
      <div class="container">
        <div class="about__container">
          <div class="about__newcar">
            <div class="about__item">
              <img src="./assets/images/dest/bmw-logo-2.png" alt="bmw-logo" class="logo-M2">
              <h2 class="about__title">Подробнее о компании</h2>
            </div>
            <a href="./about.php" class="button" title="О нас">Подробнее</a>
          </div>
          <p class="about__desc"><span>Движение - </span>с комфортом</p>
        </div>
      </div>
    </section>

    <section class="service">
      <div class="container">
        <div class="service__container">
          <h2 class="service__title">Услуги и сервис</h2>
          <div class="service__items">
            <div class="service__item">
              <div class="bg-fon"></div>
              <img src="./assets/images/dest/bmw-dealer.jpg" alt="bmw-dealer" class="service__item-img">
              <div class="service__desc">
                <span>Гарантия</span>
                <span>Аксуссуары</span>
                <span>Колеса и шины</span>
                <span>Запчасти</span>
              </div>
            </div>
            <div class="service__item">
              <div class="bg-fon"></div>
              <img src="./assets/images/dest/bmw-service.jpg" alt="bmw-service" class="service__item-img">
              <div class="service__desc">
                <span>Осмотр</span>
                <span>Утилизация</span>
                <span>Кузовные и лакокрасочные</span>
                <span>Ремонт механизмом</span>
              </div>
            </div>
          </div>
          <a href="./service.php" class="button service__button" title="Услуги и сервис">Подробнее</a>
        </div>
      </div>
    </section>

    <section class="contact">
      <div class="container">
        <div class="contact__container">
          <div class="contact__content">
            <div class="contact__item">
              <img src="./assets/images/dest/bmw-logo-2.png" alt="bmw-logo" class="logo-M2">
              <h2 class="contact__title">Контакты и связь</h2>
            </div>
            <a href="./contacts.php" class="button" title="Контакты">Подробнее</a>
          </div>
          <p class="contact__desc"><span>Удовольствие - </span>за рулем</p>
        </div>
      </div>
    </section>
  </main>

  <?php include('./app/includes/footer.php') ?>

  <script src="https://kit.fontawesome.com/47a997ec54.js" crossorigin="anonymous"></script>
  <script src="./assets/js/header.min.js"></script>
</body>

</html>