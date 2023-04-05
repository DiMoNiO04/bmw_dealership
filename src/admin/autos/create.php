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
						<h1 class="title-pages panel__title">Добавление авто</h1>

						<div class="panel__blocks">
							<form  class="admin-form" action="">
								<div class="admin__form-block">
									<label for="name">Название:</label>
									<input type="text" id="name" placeholder="Название">
								</div>
								<div class="admin__form-block admin__form-block">
									<label for="complexion">Комплектация:</label>
									<input type="text" name="complexion">
								</div>
								<div class="admin__form-block admin__form-block">
									<label for="color">Цвет:</label>
									<input type="text" name="color">
								</div>
								<div class="admin__form-block admin__form-block">
									<label for="date">Год выпуска:</label>
									<input type="text" name="date">
								</div>
								<div class="admin__form-block admin__form-block">
									<label for="engine">Двигатель:</label>
									<select name="" id="">
										<option value="">Бензиновый</option>
										<option value="">Электрический</option>
									</select>
								</div>
								<div class="admin__form-block admin__form-block">
									<label for="power">Запас хода:</label>
									<input type="number" name="power"><span>км</span>
								</div>
								<div class="admin__form-block admin__form-block">
									<label for="price">Цена:</label>
									<input type="number" name="price">
								</div>
								<div class="admin__form-block admin__form-block-st">
									<label for="status">Наличие:</label>
									<input type="checkbox" name="status">
								</div>
								<div class="admin__form-block">
									<label for="file">Выберите фото авто:</label>
									<input type="file" id="file">
								</div>
								<div class="admin__form-block">
									<label for="file">Модель</label>
									<select name="" id="">
										<option value="">I</option>
										<option value="">I</option>
										<option value="">I</option>
										<option value="">I</option>
									</select>
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