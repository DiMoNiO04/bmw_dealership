<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Регитрация BMW</title>
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
			<form method="post" action="" class="form-reg">
				<h1 class="form-reg__title">Регистрация</h1>
				<p class="form-reg__desc">У вас уже есть аккаунт? Вы можете авторизироваться <a href="./auth.php">здесь</a></p>
				<div class="form-reg__item">
					<label for="email">Ваша почта</label>
					<input type="email" name="email" id="email" placeholder="Введите почту...">
				</div>
				<div class="form-reg__item">
					<label for="login">Ваш логин</label>
					<input type="text" name="login" id="login" placeholder="Введите логин...">
				</div>
				<div class="form-reg__item">
					<label for="password-first">Пароль</label>
					<input type="password" name="password-first" id="password-first" placeholder="Введите пароль...">
				</div>
				<div class="form-reg__item">
					<label for="password-second">Повторите пароль</label>
					<input type="password" name="password-second" id="password-second" placeholder="Введите пароль...">
				</div>
				<div class="form-reg__item form-reg__buttons">
					<button type="submit" name="button__reg">Зарегистрироваться</button>
					<a href="./auth.php">Войти</a>
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