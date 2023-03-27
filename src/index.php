<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Автосалон-BMW</title>
	<link rel="stylesheet" href="./front/css/style.min.css">
</head>

<body>
	<header class="header">
		<div class="container">
			<div class="header__container">
				<nav>
					<ul class="header__list">
						<li class="header__item"><a class="header__item-link" href="autos.php">Автомобили</a></li>
						<li class="header__item"><a class="header__item-link" href="about.php">О компании</a></li>
						<li class="header__item"><a class="header__item-link" href="service.php">Услуги</a></li>
						<li class="header__item"><a class="header__item-link" href="contacts.php">Контакты</a></li>
					</ul>
				</nav>
				<div class="header__active">
					<div class="header__cab">
						<button class="header__cab-button" href="#"><i class="fa-solid fa-user"></i>Кабинет</button>
						<ul class="header__logout">
							<li class="header__item"><a class="header__logout-link" href="auth.php">Вход</a></li>
							<li class="header__item"><a class="header__logout-link" href="reg.php">Регистрация</a></li>
							<li class="header__item"><a class="header__logout-link" href="personal__cab-user.php">Личный кабинет</a></li>
							<li class="header__item"><a class="header__logout-link" href="admin__panel.php">Админ панель</a></li>
						</ul>
					</div>
					<a href="index.php" class="logo-bmw">
						<img src="./front/images/dest/svg/bmw_logo.svg" alt="Logo_BMW">
					</a>
				</div>
			</div>
		</div>
	</header>

	<main>
		<section class="start">
			<div class="container">
				<div class="start__container">
					<div class="start__newcar">
						<div class="start__item">
							<img src="./front/images/dest/bmw-logo-2.png" alt="bmw-logo" class="logo-M2">
							<h1 class="start__title">Новый <span class="red">M</span><span class="blue">5</span> Competition
							</h1>
						</div>
						<a href="#" class="button" title="Узнать подробнее">Подробнее</a>
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
							<img src="./front/images/dest/cars/bmw4-cabrio.webp" alt="bmw4-cabrio">
							<h3 class="car__item-name">BMW 4 серии Cabrio</h3>
						</div>
						<div class="car__item">
							<img src="./front/images/dest/cars/bmw6-gt.webp" alt="bmw6-gt">
							<h3 class="car__item-name">BMW 6 серии GT</h3>
						</div>
						<div class="car__item">
							<img src="./front/images/dest/cars/m8-coupe.webp" alt="m8-coupe">
							<h3 class="car__item-name">BMW M8 Coupe</h3>
						</div>
						<div class="car__item">
							<img src="./front/images/dest/cars/x5.webp" alt="x5">
							<h3 class="car__item-name">BMW X5</h3>
						</div>
						<div class="car__item">
							<img src="./front/images/dest/cars/i7.webp" alt="i7">
							<h3 class="car__item-name">BMW i7</h3>
						</div>
						<div class="car__item">
							<img src="./front/images/dest/cars/2-coupe.webp" alt="bmw2-coupe">
							<h3 class="car__item-name">BMW 2 серии Coupe</h3>
						</div>
						<div class="car__item">
							<img src="./front/images/dest/cars/bmw-z4.webp" alt="bmw-z4">
							<h3 class="car__item-name">BMW Z4 Roodster</h3>
						</div>
						<div class="car__item">
							<img src="./front/images/dest/cars/bmw3.webp" alt="bmw3">
							<h3 class="car__item-name">BMW 3 серии</h3>
						</div>
						<div class="car__item">
							<img src="./front/images/dest/cars/bmw5.webp" alt="bmw5">
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
							<img src="./front/images/dest/bmw-logo-2.png" alt="bmw-logo" class="logo-M2">
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
							<img src="./front/images/dest/bmw-dealer.jpg" alt="bmw-dealer" class="service__item-img">
							<div class="service__desc">
								<span>Гарантия</span>
								<span>Аксуссуары</span>
								<span>Колеса и шины</span>
								<span>Запчасти</span>
							</div>
						</div>
						<div class="service__item">
							<div class="bg-fon"></div>
							<img src="./front/images/dest/bmw-service.jpg" alt="bmw-service" class="service__item-img">
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
							<img src="./front/images/dest/bmw-logo-2.png" alt="bmw-logo" class="logo-M2">
							<h2 class="contact__title">Контакты и связь</h2>
						</div>
						<a href="./contacts.php" class="button" title="Контакты">Подробнее</a>
					</div>
					<p class="contact__desc"><span>Удовольствие - </span>за рулем</p>
				</div>
			</div>
		</section>
	</main>

	<footer class="footer">
		<div class="container">
			<div class="footer__container">
				<div class="footer__content">
					<a href="index.php" class="logo-bmw">
						<img src="./front/images/dest/svg/bmw_logo.svg" alt="bmw-logo">
					</a>
					<ul class="footer__items">
						<li><a class="footer__items-link" href="./autos.php">Автомобили</a></li>
						<li><a class="footer__items-link" href="./about.php">О компании</a></li>
						<li><a class="footer__items-link" href="./service.php">Услуги и сервис</a></li>
						<li><a class="footer__items-link" href="./contacts.php">Контакты</a></li>
					</ul>
					<div class="footer__socials">
						<a href="https://vk.com/bmw" target="_blank" class="footer__socials-icon"><i class="fa-brands fa-vk"></i></a>
						<a href="https://www.youtube.com/user/BMWinRussia" target="_blank" class="footer__socials-icon"><i
								class="fa-brands fa-youtube"></i></a>
						<a href="https://t.me/bmw_russia_official" target="_blank" class="footer__socials-icon"><i
								class="fa-brands fa-telegram"></i></a>
						<a href="https://www.tiktok.com/@bmwrussia?" target="_blank" class="footer__socials-icon"><i
								class="fa-brands fa-tiktok"></i></a>
					</div>
				</div>
				<div class="footer__author">
					<p>Разработка сайта <span>© 2023</span></p>
					<a href="mailto:dima.razumov.940@mail.ru" class="footer__author-mail">dima.razumov.940@mail.ru</a>
				</div>
			</div>
		</div>
	</footer>

	<script src="https://kit.fontawesome.com/47a997ec54.js" crossorigin="anonymous"></script>
	<script src="./front/js/index.min.js"></script>
</body>

</html>