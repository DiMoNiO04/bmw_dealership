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
						<h1 class="title-pages panel__title">Заказы</h1>

						<div class="panel__blocks">
							<div class="panel__block">
								<h2 class="panel__subtitle">Заказ №1</h2>

								<div class="panel__item">
									<h3>Клиент:</h3>
									<p>Разумов Дмитрий Александрович</p>
								</div>
								<div class="panel__item">
									<h3>Сотрудник</h3>
									<p>Артюшевская Ангелина Юрьевна</p>
								</div>
								<div class="panel__item">
									<h3>Авто:</h3>
									<p>i7</p>
								</div>
								<div class="panel__item">
									<h3>Дата оформления</h3>
									<p>22.03.2022</p>
								</div>
								<div class="panel__buttons">
									<button class="button panel__button-red">Delete</button>
								</div>
							</div>

							<div class="panel__block">
								<h2 class="panel__subtitle">Заказ №1</h2>
								<div class="panel__item">
									<h3>Клиент:</h3>
									<p>Разумов Дмитрий Александрович</p>
								</div>
								<div class="panel__item">
									<h3>Сотрудник</h3>
									<p>Артюшевская Ангелина Юрьевна</p>
								</div>
								<div class="panel__item">
									<h3>Авто:</h3>
									<p>i7</p>
								</div>
								<div class="panel__item">
									<h3>Дата оформления</h3>
									<p>22.03.2022</p>
								</div>
								<div class="panel__buttons">
									<button class="button panel__button-red">Delete</button>
								</div>
							</div>

							<div class="panel__block">
								<h2 class="panel__subtitle">Заказ №1</h2>
								<div class="panel__item">
									<h3>Клиент:</h3>
									<p>Разумов Дмитрий Александрович</p>
								</div>
								<div class="panel__item">
									<h3>Сотрудник</h3>
									<p>Артюшевская Ангелина Юрьевна</p>
								</div>
								<div class="panel__item">
									<h3>Авто:</h3>
									<p>i7</p>
								</div>
								<div class="panel__item">
									<h3>Дата оформления</h3>
									<p>22.03.2022</p>
								</div>
								<div class="panel__buttons">
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