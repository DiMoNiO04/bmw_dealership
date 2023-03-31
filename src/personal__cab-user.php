<!DOCTYPE html>
<html lang="ru">

<head>
	<?php include('./front/includes/head.php') ?>
	<title>Личный кабинет</title>
</head>

<body>

	<?php include('./front/includes/header-blue.php') ?>

	<div class="dark-wrapper"></div>
	<main>
		<section class="personal">
			<div class="container">
				<div class="personal__container">
					<h1 class="personal__title">Пользователь №<span>123</span></h1>
					<div class="personal__body">
						<div class="personal__image">
							<img src="./front/images/dest/user.png" alt="personal__foto">
						</div>
						<div class="presonal__data">
							<h2 class="personal__subtitle">Ваши персональные данные:</h2>
							<div class="personal__date">
								<h3>ФИО:</h3>
								<div class="personal__fio">
									<span name="last__name">Разумов</span>
									<span name="first__name">Дмитрий</span>
									<span name="surname">Александрович</span>
								</div>
							</div>
							<div class="personal__data">
								<h3>Дата рождения:</h3>
								<span name="date_of_birth">02.06.2004</span>
							</div>
							<div class="personal__data">
								<h3>Номер телефона:</h3>
								<span name="phone">80447104585</span>
							</div>
							<div class="personal__data">
								<h3>Дата регистрации:</h3>
								<span>05.10.2022</span>
							</div>
							<div class="personal__data">
								<h3>Гражданство:</h3>
								<span>Беларусь</span>
							</div>
							<div class="personal__data">
								<h3>Логин:</h3>
								<span>dimonio04</span>
							</div>
							<div class="personal__data">
								<h3>Почта:</h3>
								<span>dima.razumov.940@mail.ru</span>
							</div>
						</div>
					</div>
					<button class="button button__personal-data">Изменить персональные данные</button>
				</div>
			</div>
		</section>

		<section class="orders">
			<div class="container">
				<div class="orders__container">
					<h2 class="personal__subtitle orders__subtitle">Ваши заказы:</h2>
					<div class="orders__body">
						<div class="order__titles">
							<h2>Номер заказа</р>
							<h2>Модель</h2>
							<h2>Дата</h2>
							<h2>Стоимость</h2>
						</div>
						<div class="order">
							<span>111</span>
							<span>M5</span>
							<span>02.05.2021</span>
							<span>2000000</span>
						</div>
						<div class="order">
							<span>111</span>
							<span>M5</span>
							<span>02.05.2021</span>
							<span>2000000</span>
						</div>
						<div class="order">
							<span>111</span>
							<span>M5</span>
							<span>02.05.2021</span>
							<span>2000000</span>
						</div>
					</div>
					<button class="button">Оформить заказ</button>
				</div>
			</div>
		</section>

		<section class="buttons">
			<div class="container">
				<div class="buttons__container">
					<button class="button__personal">Изменить пароль</button>
					<button class="button__personal">Удалить аккаунт</button>
					<button class="button__personal">Выйти из аккаунта</button>
				</div>
			</div>
		</section>
	</main>

	<?php include('./front/includes/footer.php') ?>

	<script src="https://kit.fontawesome.com/47a997ec54.js" crossorigin="anonymous"></script>
	<script src="./front/js/index.min.js"></script>
</body>

</html>