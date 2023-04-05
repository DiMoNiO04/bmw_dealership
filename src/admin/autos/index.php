<?php 
	include ('../../path.php');
	include ('../../app/database/database.php');
?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<?php include('../../app/includes/head.php') ?>
	<title>Админ панель</title>
</head>

<body>
	
	<?php include('../../app/includes/header-admin.php') ?>

	<div class="dark-wrapper"></div>
	<main>
		<section class="panel">
			<div class="container">
				<div class="panel__container">

					<?php include('../../app/includes/aside.php') ?>

					<div class="panel__body">
						<a class="button panel__button" href="<?= BASE_URL . "admin/autos/create.php" ?>">Добавить</a>
						<h1 class="title-pages panel__title">Автомобили</h1>
					
						<?php include('../../app/includes/sidebar.php') ?>

						<div class="panel__blocks">
							<div class="panel__block">
								<h2 class="panel__subtitle">I7</h2>
								<img src="../../assets/images/dest/cars/I-7.webp" alt="i-7" class="panel__img panel__img-sm">
								<div class="panel__item">
									<h3>Комплектация:</h3>
									<p>базовая</p>
								</div>
								<div class="panel__item">
									<h3>Цвет:</h3>
									<p>серый</p>
								</div>
								<div class="panel__item">
									<h3>Год выпуска:</h3>
									<p>2020</p>
								</div>
								<div class="panel__item">
									<h3>Двигатель:</h3>
									<p>электрический</p>
								</div>
								<div class="panel__item">
									<h3>Запас хода:</h3>
									<p>765км</p>
								</div>
								<div class="panel__item">
									<h3>Цена:</h3>
									<p>210000$</p>
								</div>
								<div class="panel__item green">
									<h3>Наличие:</h3>
									<p>Есть в наличии</p>
								</div>
								<div class="panel__buttons">
									<button class="button panel__button-edit">Edit</button>
									<button class="button panel__button-red">Delete</button>
								</div>
							</div>

							<div class="panel__block">
								<h2 class="panel__subtitle">I7</h2>
								<img src="../../assets/images/dest/cars/I-7.webp" alt="i-7" class="panel__img panel__img-sm">
								<div class="panel__item">
									<h3>Комплектация:</h3>
									<p>базовая</p>
								</div>
								<div class="panel__item">
									<h3>Цвет:</h3>
									<p>серый</p>
								</div>
								<div class="panel__item">
									<h3>Год выпуска:</h3>
									<p>2020</p>
								</div>
								<div class="panel__item">
									<h3>Двигатель:</h3>
									<p>электрический</p>
								</div>
								<div class="panel__item">
									<h3>Запас хода:</h3>
									<p>765км</p>
								</div>
								<div class="panel__item">
									<h3>Цена:</h3>
									<p>210000$</p>
								</div>
								<div class="panel__item green">
									<h3>Наличие:</h3>
									<p>Есть в наличии</p>
								</div>
								<div class="panel__buttons">
									<button class="button panel__button-edit">Edit</button>
									<button class="button panel__button-red">Delete</button>
								</div>
							</div>

							<div class="panel__block">
								<h2 class="panel__subtitle">I7</h2>
								<img src="../../assets/images/dest/cars/I-7.webp" alt="i-7" class="panel__img panel__img-sm">
								<div class="panel__item">
									<h3>Комплектация:</h3>
									<p>базовая</p>
								</div>
								<div class="panel__item">
									<h3>Цвет:</h3>
									<p>серый</p>
								</div>
								<div class="panel__item">
									<h3>Год выпуска:</h3>
									<p>2020</p>
								</div>
								<div class="panel__item">
									<h3>Двигатель:</h3>
									<p>электрический</p>
								</div>
								<div class="panel__item">
									<h3>Запас хода:</h3>
									<p>765км</p>
								</div>
								<div class="panel__item">
									<h3>Цена:</h3>
									<p>210000$</p>
								</div>
								<div class="panel__item green">
									<h3>Наличие:</h3>
									<p>Есть в наличии</p>
								</div>
								<div class="panel__buttons">
									<button class="button panel__button-edit">Edit</button>
									<button class="button panel__button-red">Delete</button>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</section>
	</main>

	<?php include('../../app/includes/footer.php') ?>

	<script src="https://kit.fontawesome.com/47a997ec54.js" crossorigin="anonymous"></script>
	<script src="../../assets/js/header.min.js"></script>
	<script src="../../assets/js/sidebar.min.js"></script>
</body>

</html>