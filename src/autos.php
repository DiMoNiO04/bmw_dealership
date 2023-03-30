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
	<title>Автомобили-BMW</title>
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
		<section class="auto__preview">
			<div class="container">
				<div class="preview__container">
					<div class="auto__bg-fon"></div>
					<div class="preview__desc">
						<img src="./front/images/dest/bmw-logo-2.png" alt="bmw-logo" class="logo-M2">
						<h1 class="preview__title">Выберите автомобиль своей мечты</h1>
					</div>
				</div>
			</div>
		</section>

		<section class="auto">
			<div class="container">
				<div class="auto__container">
					<h2 class="title-pages">Выберите свой автомобиль</h2>
					
					<div class="auto__filtr">
						<form method="post" action="" class="form__search">
							<h2 class="search__title">Подберите авто по вашим запросам</h2>
							<ul class="search__container">

								<li class="search__block">
									<h3>Модель</h3>
									<select name="model" class="search__select">
										<option selected>Модель:</option>
										<option value="M">M</option>
										<option value="4">4</option>
										<option value="3">3</option>
									</select>
								</li>

								<li class="search__block">
									<h3>Цвет</h3>
									<select name="color" class="search__select">
										<option selected>Цвет:</option>
										<option value="red">Крансый</option>
										<option value="green">Зеленый</option>
										<option value="blue">Синия</option>
										<option value="white">Белый</option>
										<option value="black">Черный</option>
									</select>
								</li>

								<li class="search__block">
									<h3>Наличие</h3>
									<label class="custom-checkbox">
										<input name="available" type="checkbox" value="available">
										<span>Есть</span>
									</label>
									<label class="custom-checkbox">
										<input name="no_available" type="checkbox" value="no_available">
										<span>Нету</span>
									</label>
								</li>

								<li class="search__block">
									<h3>Двигатель</h3>
									<label class="custom-checkbox">
										<input name="engine" type="checkbox" value="patrol">
										<span>Бензиновый</span>
									</label>
									<label class="custom-checkbox">
										<input name="engine" type="checkbox" value="electric">
										<span>Электрический</span>
									</label>
								</li>

								<li class="search__block">
									<h3>Коробка передач</h3>
									<label class="custom-checkbox">
										<input name="automatic" type="checkbox" value="automatic">
										<span>Автоматическая</span>
									</label>
									<label class="custom-checkbox">
										<input name="manual" type="checkbox" value="manual">
										<span>Ручная</span>
									</label>
								</li>

								<li class="search__block">
									<h3>Год выпуска</h3>
									<input type="number" min="2000" max="2023" name="year__from" id="year__from" class="search__input" placeholder="От">
									<input type="number" min="2000" max="2023" name="year__to" id="year__to" class="search__input" placeholder="До">
								</li>

								<li class="search__block">
									<h3>Цена</h3>
									<input type="number" min="30000" step="5000" name="price__from" id="price__from" class="search__input" placeholder="От">
									<input type="number" min="30000" step="5000" name="price__to" id="price__to" class="search__input" placeholder="До">
								</li>
							</ul>
							<button class="button button__search" name="search__auto" type="submit" title="Найти">Найти</button>
						</form>
					</div>

					<div class="auto__sidebar">
						<ul class="sidebar__list">
							<li><a href="#" class="sidebar__item sidebar__item-active" id="0">ALL</a></li>
							<li><a href="#" class="sidebar__item" id="1">M</a></li>
							<li><a href="#" class="sidebar__item" id="2">X</a></li>
							<li><a href="#" class="sidebar__item" id="3">I</a></li>
							<li><a href="#" class="sidebar__item" id="4">8</a></li>
							<li><a href="#" class="sidebar__item" id="5">7</a></li>
							<li><a href="#" class="sidebar__item" id="6">6</a></li>
							<li><a href="#" class="sidebar__item" id="7">5</a></li>
							<li><a href="#" class="sidebar__item" id="8">4</a></li>
							<li><a href="#" class="sidebar__item" id="9">3</a></li>
							<li><a href="#" class="sidebar__item" id="10">2</a></li>
							<li><a href="#" class="sidebar__item" id="11">Z4</a></li>
							<li><a href="#" class="sidebar__item" id="12">Концепты</a></li>
						</ul>
					</div>

					<div class="auto__content">
						<div class="model__container">
							<h2 class="model__title">M</h2>
							<div class="model__cars">
								<a href="./single__auto.php" class="model__car" title="Перейти BMW iX M60">
									<img src="./front/images/dest/cars/ii7.webp" alt="BMW iX M60">
									<h3>iX M60</h3>
									<span>Электрический</span>
								</a>
								<a href="#" class="model__car" title="Перейти BMW iX M60">
								<img src="./front/images/dest/cars/ii7.webp" alt="BMW iX M60">
									<h3>iX M60</h3>
									<span>Электрический</span>
								</a>
								<a href="#" class="model__car" title="Перейти BMW iX M60">
								<img src="./front/images/dest/cars/ii7.webp" alt="BMW iX M60">
									<h3>iX M60</h3>
									<span>Электрический</span>
								</a>
								<a href="#" class="model__car" title="Перейти BMW iX M60">
								<img src="./front/images/dest/cars/ii7.webp" alt="BMW iX M60">
									<h3>iX M60</h3>
									<span>Электрический</span>
								</a>
							</div>
						</div>
						<div class="model__container">
							<h2 class="model__title">X</h2>
							<div class="model__cars">
								<a href="#" class="model__car" title="Перейти BMW iX">
									<img src="./front/images/dest/cars/iX.webp" alt="iX">
									<h3>iX M60</h3>
									<span>Электрический</span>
								</a>
								<a href="#" class="model__car" title="Перейти BMW iX">
								<img src="./front/images/dest/cars/iX.webp" alt="iX">
									<h3>iX M60</h3>
									<span>Электрический</span>
								</a>
								<a href="#" class="model__car" title="Перейти BMW iX">
								<img src="./front/images/dest/cars/iX.webp" alt="iX">
									<h3>iX M60</h3>
									<span>Электрический</span>
								</a>
								<a href="#" class="model__car" title="Перейти BMW iX">
								<img src="./front/images/dest/cars/iX.webp" alt="iX">
									<h3>iX M60</h3>
									<span>Электрический</span>
								</a>
								<a href="#" class="model__car" title="Перейти BMW iX">
								<img src="./front/images/dest/cars/iX.webp" alt="iX">
									<h3>iX M60</h3>
									<span>Электрический</span>
								</a>
								<a href="#" class="model__car" title="Перейти BMW iX">
								<img src="./front/images/dest/cars/iX.webp" alt="iX">
									<h3>iX M60</h3>
									<span>Электрический</span>
								</a>
								<a href="#" class="model__car" title="Перейти BMW iX">
								<img src="./front/images/dest/cars/iX.webp" alt="iX">
									<h3>iX M60</h3>
									<span>Электрический</span>
								</a>
							</div>
						</div>
						<div class="model__container">
							<h2 class="model__title">M</h2>
							<div class="model__cars">
								<a href="#" class="model__car" title="Перейти BMW I-7">
									<img src="./front/images/dest/cars/I-7.webp" alt="I-7">
									<h3>I7</h3>
									<span>Электрический</span>
								</a>
								<a href="#" class="model__car" title="Перейти BMW I-7">
								<img src="./front/images/dest/cars/I-7.webp" alt="I-7">
									<h3>I7</h3>
									<span>Электрический</span>
								</a>
								<a href="#" class="model__car" title="Перейти BMW I-7">
								<img src="./front/images/dest/cars/I-7.webp" alt="I-7">
									<h3>I7</h3>
									<span>Электрический</span>
								</a>
								<a href="#" class="model__car" title="Перейти BMW I-7">
								<img src="./front/images/dest/cars/I-7.webp" alt="I-7">
									<h3>I7</h3>
									<span>Электрический</span>
								</a>
							</div>
						</div>
					</div>
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