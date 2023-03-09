<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Автомобили-BMW</title>
	<link rel="stylesheet" href="./front/css/normalize.min.css">
	<link rel="stylesheet" href="./front/css/style.min.css">
</head>

<body>
	<header class="header">
		<div class="container">
			<div class="header__container">
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
						<li  class="header__cab">
							<a href="#"><i class="fa-solid fa-user"></i>Кабинет</a>
							<ul class="header__logout">
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
							<div class="search__container">

								<div class="search__block">
									<h3>Модель</h3>
									<select name="model" class="search__select">
										<option selected>Модель:</option>
										<option value="M">M</option>
										<option value="4">4</option>
										<option value="3">3</option>
									</select>
								</div>

								<div class="search__block">
									<h3>Цвет</h3>
									<select name="color" class="search__select">
										<option selected>Цвет:</option>
										<option value="red">Крансый</option>
										<option value="green">Зеленый</option>
										<option value="blue">Синия</option>
										<option value="white">Белый</option>
										<option value="black">Черный</option>
									</select>
								</div>

								
								<div class="search__block">
									<h3>Наличие</h3>
									<label class="custom-checkbox">
										<input name="available" type="checkbox" value="available">
										<span>Есть</span>
									</label>
									<label class="custom-checkbox">
										<input name="no_available" type="checkbox" value="no_available">
										<span>Нету</span>
									</label>
								</div>

								<div class="search__block">
									<h3>Двигатель</h3>
									<label class="custom-checkbox">
										<input name="engine" type="checkbox" value="patrol">
										<span>Бензиновый</span>
									</label>
									<label class="custom-checkbox">
										<input name="engine" type="checkbox" value="electric">
										<span>Электрический</span>
									</label>
								</div>

								<div class="search__block">
									<h3>Коробка передач</h3>
									<label class="custom-checkbox">
										<input name="automatic" type="checkbox" value="automatic">
										<span>Автоматическая</span>
									</label>
									<label class="custom-checkbox">
										<input name="manual" type="checkbox" value="manual">
										<span>Ручная</span>
									</label>
								</div>

								<div class="search__block">
									<h3>Год выпуска</h3>
									<input type="number" min="2000" max="2023" name="year__from" id="year__from" class="search__input" placeholder="От">
									<input type="number" min="2000" max="2023" name="year__to" id="year__to" class="search__input" placeholder="До">
								</div>

								<div class="search__block">
									<h3>Цена</h3>
									<input type="number" min="30000" step="5000" name="price__from" id="price__from" class="search__input" placeholder="От">
									<input type="number" min="30000" step="5000" name="price__to" id="price__to" class="search__input" placeholder="До">
								</div>
							</div>
							<button class="button button__search" name="search__auto" type="submit" title="Найти">Найти</button>
						</form>
					</div>

					<div class="auto__sidebar">
						<div class="sidebar__list">
							<a href="#" class="sidebar__item sidebar__item-active" id="0">ALL</a>
							<a href="#" class="sidebar__item" id="1">M</a>
							<a href="#" class="sidebar__item" id="2">X</a>
							<a href="#" class="sidebar__item" id="3">I</a>
							<a href="#" class="sidebar__item" id="4">8</a>
							<a href="#" class="sidebar__item" id="5">7</a>
							<a href="#" class="sidebar__item" id="6">6</a>
							<a href="#" class="sidebar__item" id="7">5</a>
							<a href="#" class="sidebar__item" id="8">4</a>
							<a href="#" class="sidebar__item" id="9">3</a>
							<a href="#" class="sidebar__item" id="10">2</a>
							<a href="#"  class="sidebar__item" id="11">Z4</a>
							<a href="#" class="sidebar__item" id="12">Концепты</a>
						</div>
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
</body>

</html>