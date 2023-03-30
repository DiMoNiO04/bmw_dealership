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
	<title>Авторизация BMW</title>
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
		<div class="container">
			<form method="post" action="" class="form-auth">
				<h1 class="form-auth__title">Авторизация</h1>
				<p class="form-auth__desc">У вас еще нет аккаунта? Вы можете зарегистрироваться <a href="./reg.php">здесь</a></p>
				<div class="form-auth__item">
					<label for="email">Ваша почта (при регистрации)</label>
					<input type="email" name="email" id="email" placeholder="Введите почту...">
				</div>
				<div class="form-auth__item">
					<label for="password">Пароль</label>
					<input type="password" name="password" id="password" placeholder="Введите пароль...">
				</div>
				<div class="form-auth__item form-auth__buttons">
					<button type="submit" name="button__auth">Войти</button>
					<a href="./reg.php">Зарегистрироваться</a>
				</div>
			</form>
		</div>
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