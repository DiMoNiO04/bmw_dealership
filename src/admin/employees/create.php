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
						<h1 class="title-pages panel__title">Добавление сотрудника</h1>
						<div class="panel__blocks">
							<form  class="admin-form" action="">
								<div class="admin__form-block">
									<label for="last_name">Фамилия:</label>
									<input type="text" id="last_name" placeholder="Фамилия">
								</div>
								<div class="admin__form-block">
									<label for="first_name">Имя:</label>
									<input type="text" id="first_name" placeholder="Имя">
								</div>
								<div class="admin__form-block">
									<label for="surname">Отчество:</label>
									<input type="text" id="surname" placeholder="Отчество">
								</div>
								<div class="admin__form-block">
									<label for="date_birth">Дата рождения:</label>
									<input type="date" id="date_birth">
								</div>
								<div class="admin__form-block">
									<label for="phone">Телефон:</label>
									<input type="text" id="phone">
								</div>
								<div class="admin__form-block">
									<label for="email">Email:</label>
									<input type="email" id="email">
								</div>
								<div class="admin__form-block">
									<label for="job">Должность:</label>
									<input type="text" id="job">
								</div>
								<div class="admin__form-block">
									<label for="city">Город:</label>
									<input type="text" id="city">
								</div>
								<div class="admin__form-block">
									<label for="street">Улица:</label>
									<input type="text" id="street">
								</div>
								<div class="admin__form-block">
									<label for="house">Дом:</label>
									<input type="text" id="house">
								</div>
								<div class="admin__form-block">
									<label for="apartment">Квартира:</label>
									<input type="text" id="apartment">
								</div>
								<div class="admin__form-block">
									<label for="series">Серия паспорта:</label>
									<input type="text" id="series">
								</div>
								<div class="admin__form-block">
									<label for="number">Номер паспорта:</label>
									<input type="text" id="number">
								</div>
								<div class="admin__form-block">
									<label for="issued_when">Когда выдан:</label>
									<input type="date" id="issued_when">
								</div>
								<div class="admin__form-block">
									<label for="validity">Срок действия:</label>
									<input type="date" id="validity">
								</div>
								<div class="admin__form-block">
									<label for="issued_by">Кем выдан:</label>
									<input type="text" id="issued_by">
								</div>
								<div class="admin__form-block">
									<label for="file">Выберите фото:</label>
									<input type="file" id="file">
								</div>
								<button type="submit" class="button">Добавить</button>
							</form>
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