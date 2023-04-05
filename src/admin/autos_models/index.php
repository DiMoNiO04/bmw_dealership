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
						<a class="button panel__button" href="<?= BASE_URL . "admin/autos_models/create.php" ?>">Добавить</a>
						<h1 class="title-pages panel__title">Модели авто</h1>

						<div class="panel__blocks">
							<div class="panel__block">
								<h2 class="panel__subtitle">I7</h2>
								<img src="../../assets/images/dest/cars/I7.jpg" alt="i-7" class="panel__img">
								<div class="panel__status green">
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
								<img src="../../assets/images/dest/about.jpg" alt="i-7" class="panel__img">
								<div class="panel__status green">
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
								<img src="../../assets/images/dest/contacts.jpg" alt="i-7" class="panel__img">
								<div class="panel__status green">
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
</body>

</html>