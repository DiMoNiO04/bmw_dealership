<!DOCTYPE html>
<html lang="ru">

<head>
	<?php include('./front/includes/head.php') ?>
	<title>Админ панель</title>
</head>

<body>
	
	<?php include('./front/includes/header-blue.php') ?>

	<div class="dark-wrapper"></div>
	<main>
		<section class="panel">
			<div class="container">
				<div class="panel__container">

					<aside class="sidebar">
						<ul class=sidebar__items>
							<li><a href="#">Автомобили</a></li>
							<li><a href="#">Заказы</a></li>
							<li><a href="#">Пользователи</a></li>
							<li><a href="#">Комплектация</a></li>
							<li><a href="#">Контакты</a></li>
						</ul>
					</aside>

					<div class="panel__body">
						<a class="button panel__button">Добавить</a>
						<h1 class="title-pages panel__title">Учетные записи</h1>
						<div class="panel__titles">
							<h2>ID</р>
							<h2>Логин</h2>
							<h2>Email</h2>
							<h2>Роль</h2>
							<h2>Управление</h2>
						</div>
						<div class="panel__block">
							<span>1</span>
							<span>222</span>
							<span>dima</span>
							<span>admin</span>
							<div class="panel__buttons">
								<a href="#" class="panel__edit">Edit</a>
								<a href="#" class="panel__del">Delete</a>
							</div>	
						</div>
						<div class="panel__block">
							<span>2</span>
							<span>12312312</span>
							<span>dimono</span>
							<span>123</span>
							<div class="panel__buttons">
								<a href="#" class="panel__edit">Edit</a>
								<a href="#" class="panel__del">Delete</a>
							</div>	
						</div>
						<div class="panel__block">
							<span>111</span>
							<span>M5</span>
							<span>02.05.2021</span>
							<span>2000000</span>
							<div class="panel__buttons">
								<a href="#" class="panel__edit">Edit</a>
								<a href="#" class="panel__del">Delete</a>
							</div>	
						</div>
						<div class="panel__block">
							<span>111</span>
							<span>M5</span>
							<span>02.05.2021</span>
							<span>2000000</span>
							<div class="panel__buttons">
								<a href="#" class="panel__edit">Edit</a>
								<a href="#" class="panel__del">Delete</a>
							</div>	
						</div>
						<div class="panel__block">
							<span>111</span>
							<span>M5</span>
							<span>02.05.2021</span>
							<span>2000000</span>
							<div class="panel__buttons">
								<a href="#" class="panel__edit">Edit</a>
								<a href="#" class="panel__del">Delete</a>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>

	<?php include('./front/includes/footer.php') ?>

	<script src="https://kit.fontawesome.com/47a997ec54.js" crossorigin="anonymous"></script>
	<script src="./front/js/index.min.js"></script>
</body>

</html>