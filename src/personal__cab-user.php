<?php 
	include ('path.php'); 
	include "./app/controllers/auth.php";
	if($_SESSION['role'] == 1) {
		$user = getPersonalData('employees', 'employees_address', 'employees_passport', 'authorization', $_SESSION['id']);
	} else {
		$user = getPersonalData('clients', 'clients_address', 'clients_passport', 'authorization', $_SESSION['id']);
	}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<?php include('./app/includes/head.php') ?>
	<title>Личный кабинет</title>
</head>

<body>

	<?php include('./app/includes/header-blue.php') ?>

	<div class="dark-wrapper"></div>
	<main>
		<section class="personal">
			<div class="container">
				<div class="personal__container">

					<h1 class="personal__title">
						<?php if($_SESSION['role'] == 0): ?>
							Клиент №<span><?= $user['id']?></span>
						<?php else: ?>
							Сотрудник №<span><?= $user['id']?></span>
						<?php endif; ?>
					</h1>

					<div class="personal__body">
						<div class="personal__image">
							<img src="./assets/images/dest/user.png" alt="personal__foto">
						</div>
						<div class="presonal__data">
							<h2 class="personal__subtitle">Ваши персональные данные:</h2>
							<div class="personal__data">
								<h3>ФИО:</h3>
								<div class="personal__fio">
									<span name="last__name"><?= $user['last_name']?></span>
									<span name="first__name"><?= $user['first_name']?></span>
									<span name="surname"><?= $user['surname']?></span>
								</div>
							</div>
							<div class="personal__data">
								<h3>Дата рождения:</h3>
								<span name="date_of_birth"><?= $user['date_birth']?></span>
							</div>
							<div class="personal__data">
								<h3>Номер телефона:</h3>
								<span name="phone"><?= $user['phone']?></span>
							</div>
							<div class="personal__data">
								<h3>Дата регистрации:</h3>
								<span><?= $user['date_regist']?></span>
							</div>
							<div class="personal__data">
								<h3>Место жительство:</h3>
								<span>г.<?= $user['city']?>, ул.<?= $user['streer']?>, д.<?= $user['house']?>, кв.<?= $user['apartment']?></span>
							</div>
							<div class="personal__data">
								<h3>Серия и номер паспорта:</h3>
								<span><?= $user['series']?><?= $user['number']?></span>
							</div>
							<div class="personal__data">
								<h3>Кем выдан:</h3>
								<span><?= $user['issued_by']?></span>
							</div>
							<div class="personal__data">
								<h3>Когда выдан:</h3>
								<span><?= $user['issued_when']?></span>
							</div>
							<div class="personal__data">
								<h3>Срок действия:</h3>
								<span><?= $user['validity']?></span>
							</div>
							<div class="personal__data">
								<h3>Логин:</h3>
								<span><?= $user['email']?></span>
							</div>
							<div class="personal__data">
								<h3>Email:</h3>
								<span><?= $user['email']?></span>
							</div>
						</div>
					</div>
					<button class="button button__personal-data">Изменить персональные данные</button>
				</div>
			</div>
		</section>

		<?php if($_SESSION['role'] == 0): ?>
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
		<?php endif; ?>

		<section class="buttons">
			<div class="container">
				<div class="buttons__container">
					<a class="button__personal">Изменить пароль</a>
					<a class="button__personal" href="personal__cab-user.php?del_id=<?= $_SESSION['id']?>">Удалить аккаунт</a>
					<a href="../../logout.php" class="button__personal">Выйти из аккаунта</a>
				</div>
			</div>
		</section>
	</main>

	<?php include('./app/includes/footer.php') ?>

	<script src="https://kit.fontawesome.com/47a997ec54.js" crossorigin="anonymous"></script>
	<script src="./assets/js/header.min.js"></script>
</body>

</html>