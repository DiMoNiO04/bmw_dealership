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
						<a class="button panel__button" href="<?= BASE_URL . "admin/contacts/create.php" ?>">Добавить</a>
						<h1 class="title-pages panel__title">Контакты</h1>

						<div class="panel__blocks">
							<div class="panel__block">
								<h2 class="panel__subtitle">Отдел продаж автомобиля</h2>
								<div class="panel__item">
									<h3>Телефон:</h3>
									<p>+375447104585</p>
								</div>
								<div class="panel__item">
									<h3>Время работы:</h3>
									<p>Пн-Вс: 8:00 - 20:00</p>
								</div>
								<div class="panel__item">
									<h3>Email</h3>
									<p>info@autoidea.by</p>
								</div>
								<div class="panel__buttons">
									<button class="button panel__button-edit">Edit</button>
									<button class="button panel__button-red">Delete</button>
								</div>
							</div>

							
							<div class="panel__block">
								<h2 class="panel__subtitle">Отдел продаж автомобиля</h2>
								<div class="panel__item">
									<h3>Телефон:</h3>
									<p>+375447104585</p>
								</div>
								<div class="panel__item">
									<h3>Время работы:</h3>
									<p>Пн-Вс: 8:00 - 20:00</p>
								</div>
								<div class="panel__item">
									<h3>Email</h3>
									<p>info@autoidea.by</p>
								</div>
								<div class="panel__buttons">
									<button class="button panel__button-edit">Edit</button>
									<button class="button panel__button-red">Delete</button>
								</div>
							</div>

							<div class="panel__block">
								<h2 class="panel__subtitle">Отдел продаж автомобиля</h2>
								<div class="panel__item">
									<h3>Телефон:</h3>
									<p>+375447104585</p>
								</div>
								<div class="panel__item">
									<h3>Время работы:</h3>
									<p>Пн-Вс: 8:00 - 20:00</p>
								</div>
								<div class="panel__item">
									<h3>Email</h3>
									<p>info@autoidea.by</p>
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