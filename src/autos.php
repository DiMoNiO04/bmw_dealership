<?php 
	include ('path.php'); 
	include ('./app/database/database.php');
?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<?php include('./app/includes/head.php') ?>
	<title>Автомобили-BMW</title>
</head>

<body>
	
	<?php include('./app/includes/header.php') ?>

	<div class="dark-wrapper"></div>
	<main>
		<section class="auto__preview">
			<div class="container">
				<div class="preview__container">
					<div class="auto__bg-fon"></div>
					<div class="preview__desc">
						<img src="./assets/images/dest/bmw-logo-2.png" alt="bmw-logo" class="logo-M2">
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

					<?php include('../../app/includes/sidebar.php') ?>

					<div class="auto__content">
						<div class="model__container">
							<h2 class="model__title">M</h2>
							<div class="model__cars">
								<a href="./single__auto.php" class="model__car" title="Перейти BMW iX M60">
									<img src="./assets/images/dest/cars/ii7.webp" alt="BMW iX M60">
									<h3>iX M60</h3>
									<span>Электрический</span>
								</a>
								<a href="#" class="model__car" title="Перейти BMW iX M60">
								<img src="./assets/images/dest/cars/ii7.webp" alt="BMW iX M60">
									<h3>iX M60</h3>
									<span>Электрический</span>
								</a>
								<a href="#" class="model__car" title="Перейти BMW iX M60">
								<img src="./assets/images/dest/cars/ii7.webp" alt="BMW iX M60">
									<h3>iX M60</h3>
									<span>Электрический</span>
								</a>
								<a href="#" class="model__car" title="Перейти BMW iX M60">
								<img src="./assets/images/dest/cars/ii7.webp" alt="BMW iX M60">
									<h3>iX M60</h3>
									<span>Электрический</span>
								</a>
							</div>
						</div>
						<div class="model__container">
							<h2 class="model__title">X</h2>
							<div class="model__cars">
								<a href="#" class="model__car" title="Перейти BMW iX">
									<img src="./assets/images/dest/cars/iX.webp" alt="iX">
									<h3>iX M60</h3>
									<span>Электрический</span>
								</a>
								<a href="#" class="model__car" title="Перейти BMW iX">
								<img src="./assets/images/dest/cars/iX.webp" alt="iX">
									<h3>iX M60</h3>
									<span>Электрический</span>
								</a>
								<a href="#" class="model__car" title="Перейти BMW iX">
								<img src="./assets/images/dest/cars/iX.webp" alt="iX">
									<h3>iX M60</h3>
									<span>Электрический</span>
								</a>
								<a href="#" class="model__car" title="Перейти BMW iX">
								<img src="./assets/images/dest/cars/iX.webp" alt="iX">
									<h3>iX M60</h3>
									<span>Электрический</span>
								</a>
								<a href="#" class="model__car" title="Перейти BMW iX">
								<img src="./assets/images/dest/cars/iX.webp" alt="iX">
									<h3>iX M60</h3>
									<span>Электрический</span>
								</a>
								<a href="#" class="model__car" title="Перейти BMW iX">
								<img src="./assets/images/dest/cars/iX.webp" alt="iX">
									<h3>iX M60</h3>
									<span>Электрический</span>
								</a>
								<a href="#" class="model__car" title="Перейти BMW iX">
								<img src="./assets/images/dest/cars/iX.webp" alt="iX">
									<h3>iX M60</h3>
									<span>Электрический</span>
								</a>
							</div>
						</div>
						<div class="model__container">
							<h2 class="model__title">M</h2>
							<div class="model__cars">
								<a href="#" class="model__car" title="Перейти BMW I-7">
									<img src="./assets/images/dest/cars/I-7.webp" alt="I-7">
									<h3>I7</h3>
									<span>Электрический</span>
								</a>
								<a href="#" class="model__car" title="Перейти BMW I-7">
								<img src="./assets/images/dest/cars/I-7.webp" alt="I-7">
									<h3>I7</h3>
									<span>Электрический</span>
								</a>
								<a href="#" class="model__car" title="Перейти BMW I-7">
								<img src="./assets/images/dest/cars/I-7.webp" alt="I-7">
									<h3>I7</h3>
									<span>Электрический</span>
								</a>
								<a href="#" class="model__car" title="Перейти BMW I-7">
								<img src="./assets/images/dest/cars/I-7.webp" alt="I-7">
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

	<?php include('./app/includes/footer.php') ?>

	<script src="https://kit.fontawesome.com/47a997ec54.js" crossorigin="anonymous"></script>
	<script src="./assets/js/header.min.js"></script>
	<script src="./assets/js/sidebar.min.js"></script>
</body>

</html>