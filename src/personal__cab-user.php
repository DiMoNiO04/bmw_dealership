<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="apple-touch-icon" sizes="180x180" href="./front/images/dest/favicon/android-chrome-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="./front/images/dest/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="./front/images/dest/favicon/favicon-16x16.png">
	<link rel="manifest" href="./front/images/dest/favicon/site.webmanifest">
	<link rel="mask-icon" href="./front/images/dest/favicon/safari-pinned-tab.svg" color="#5bbad5">
	<link rel="shortcut icon" href="./front/images/dest/favicon/favicon.ico">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="msapplication-config" content="./front/images/dest/favicon/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
	<title>Личный кабинет</title>
	<link rel="stylesheet" href="./front/css/style.min.css">
</head>

<body>
	<header class="header header-blue">
		<div class="container">
			<div class="header__container header-blue__container">
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
						<ul class="header__logout header-blue__logout">
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
		<section class="personal">
			<div class="container">
				<div class="personal__container">
					<h1 class="personal__title">Пользователь №<span>123</span></h1>
					<div class="personal__body">
						<div class="personal__image">
							<img src="./front/images/dest/user.png" alt="personal__foto">
						</div>
						<div class="presonal__data">
							<h2 class="personal__subtitle">Ваши персональные данные:</h2>
							<div class="personal__date">
								<h3>ФИО:</h3>
								<div class="personal__fio">
									<span name="last__name">Разумов</span>
									<span name="first__name">Дмитрий</span>
									<span name="surname">Александрович</span>
								</div>
							</div>
							<div class="personal__data">
								<h3>Дата рождения:</h3>
								<span name="date_of_birth">02.06.2004</span>
							</div>
							<div class="personal__data">
								<h3>Номер телефона:</h3>
								<span name="phone">80447104585</span>
							</div>
							<div class="personal__data">
								<h3>Дата регистрации:</h3>
								<span>05.10.2022</span>
							</div>
							<div class="personal__data">
								<h3>Гражданство:</h3>
								<span>Беларусь</span>
							</div>
							<div class="personal__data">
								<h3>Логин:</h3>
								<span>dimonio04</span>
							</div>
							<div class="personal__data">
								<h3>Почта:</h3>
								<span>dima.razumov.940@mail.ru</span>
							</div>
						</div>
					</div>
					<button class="button button__personal-data">Изменить персональные данные</button>
				</div>
			</div>
		</section>

		<section class="orders">
			<div class="container">
				<div class="orders__container">
					<h2 class="personal__subtitle orders__subtitle">Ваши заказы:</h2>
					<div class="orders__body">
						<div class="order__titles">
							<h2>Номер заказа</р>
							<h2>Модель</h2>
							<h2>Дата</h2>
							<h2>Стоимость</h2>
						</div>
						<div class="order">
							<span>111</span>
							<span>M5</span>
							<span>02.05.2021</span>
							<span>2000000</span>
						</div>
						<div class="order">
							<span>111</span>
							<span>M5</span>
							<span>02.05.2021</span>
							<span>2000000</span>
						</div>
						<div class="order">
							<span>111</span>
							<span>M5</span>
							<span>02.05.2021</span>
							<span>2000000</span>
						</div>
					</div>
					<button class="button">Оформить заказ</button>
				</div>
			</div>
		</section>

		<section class="buttons">
			<div class="container">
				<div class="buttons__container">
					<button class="button__personal">Изменить пароль</button>
					<button class="button__personal">Удалить аккаунт</button>
					<button class="button__personal">Выйти из аккаунта</button>
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