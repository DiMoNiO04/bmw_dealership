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
						<h1 class="title-pages panel__title">Добавление модели авто</h1>
						<div class="panel__blocks">
							<form  class="admin-form" action="">
								<div class="admin__form-block">
									<label for="model">Модель:</label>
									<input type="text" id="model" placeholder="Модель">
								</div>
								<div class="admin__form-block admin__form-block-st">
									<label for="status">Наличие:</label>
									<input type="checkbox" name="status">
								</div>
								<div class="admin__form-block">
									<label for="file">Выберите главное фото модели:</label>
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

</html>М