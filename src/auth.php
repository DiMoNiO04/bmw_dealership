<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Авторизация BMW</title>
	<link rel="stylesheet" href="./front/css/normalize.min.css">
	<link rel="stylesheet" href="./front/css/style.min.css">
</head>

<body>
	<header class="header header-blue">
		<div class="container">
			<div class="header__container header-blue__container">
				<nav>
					<ul class="header__list">
						<li class="header__item"><a href="./autos.php">Автомобили</a></li>
						<li class="header__item"><a href="./about.php">О компании</a></li>
						<li class="header__item"><a href="./service.php">Услуги</a></li>
						<li class="header__item"><a href="./contacts.php">Контакты</a></li>
					</ul>
				</nav>
				<div class="header__active">
					<ul>
						<li class="header__cab">
							<a href="#"><i class="fa-solid fa-user"></i>Кабинет</a>
							<ul class="header__logout header-blue__logout">
								<li class="header__item"><a href="./auth.php">Вход</a></li>
								<li class="header__item"><a href="./reg.php">Регистрация</a></li>
								<li class="header__item"><a href="./personal__cab-user.php">Личный кабинет</a></li>
								<li class="header__item"><a href="./admin__panel.php">Админ панель</a></li>
							</ul>
						</li>
					</ul>
					<a href="index.php">
						<img src="./front/images/dest/svg/bmw_logo.svg" alt="Logo_BMW">
					</a>
				</div>
			</div>
		</div>
	</header>

	<main>
		<div class="container">
			<form method="post" action="" class="form">
				<h2 class="form__title">Авторизация</h2>
				<p class="form__desc">У вас еще нет аккаунта? Вы можете зарегистрироваться <a href="./reg.html">здесь</a></p>
				<div class="form__item">
					<label for="email" class="form__label">Ваша почта (при регистрации)</label>
					<input type="email" name="email" id="email" class="form__input" placeholder="Введите почту...">
				</div>
				<div class="form__item">
					<label for="password" class="form__label">Пароль</label>
					<input type="password" name="password" class="form__input" id="password" placeholder="Введите пароль...">
				</div>
				<div class="form__item form__buttons">
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
					<a href="./index.php" class="footer__logo-bmw">
						<img src="./front/images/dest/svg/bmw_logo.svg" alt="bmw-logo">
					</a>
					<ul class="footer__items">
						<li class="footer__item"><a href="./autos.php">Автомобили</a></li>
						<li class="footer__item"><a href="./about.php">О компании</a></li>
						<li class="footer__item"><a href="./service.php">Услуги и сервис</a></li>
						<li class="footer__item"><a href="./contacts.php">Контакты</a></li>
					</ul>
					<div class="footer__socials">
						<a href="https://vk.com/bmw" target="_blank" class="social__icon"><i class="fa-brands fa-vk"></i></a>
						<a href="https://www.youtube.com/user/BMWinRussia" target="_blank" class="social__icon"><i
								class="fa-brands fa-youtube"></i></a>
						<a href="https://t.me/bmw_russia_official" target="_blank" class="social__icon"><i
								class="fa-brands fa-telegram"></i></a>
						<a href="https://www.tiktok.com/@bmwrussia?" target="_blank" class="social__icon"><i
								class="fa-brands fa-tiktok"></i></a>
					</div>
				</div>
				<div class="footer__author">
					<p>Разработка сайта <span>© 2023</span></p>
					<a href="mailto:dima.razumov.940@mail.ru" class="author__mail">dima.razumov.940@mail.ru</a>
				</div>
			</div>
		</div>
	</footer>

	<script src="https://kit.fontawesome.com/47a997ec54.js" crossorigin="anonymous"></script>
	<script src="./front/js/index.min.js"></script>
</body>

</html>