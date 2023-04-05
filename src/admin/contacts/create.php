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
						<h1 class="title-pages panel__title">Добавление контактных данных</h1>
						<div class="panel__blocks">
							<form  class="admin-form" action="">
								<div class="admin__form-block">
									<label for="name">Название:</label>
									<input type="text" id="name" placeholder="Название">
								</div>
								<div class="admin__form-block">
									<label for="phone">Телефон:</label>
									<input type="text" id="phone" name="phone" placeholder="Номер телефона">
								</div>
								<div class="admin__form-block">
									<label for="time">Время работы:</label>
									<input type="text" id="time" placeholder="Время работы">
								</div>
								<div class="admin__form-block">
									<label for="email">Email:</label>
									<input type="email" id="email" placeholder="Email">
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

</html>М