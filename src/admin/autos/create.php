<?php 
	include ('../../path.php');
	include "../../app/controllers/autos.php";
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

						<div class="form-error">
							<?php include("../../app/helps/errInfo.php")?>
						</div>

						<div class="panel__blocks">
							<form  class="admin-form" action="create.php" method="post" enctype="multipart/form-data">
								<div class="admin__form-block">
									<label for="name">Название:</label>
									<input value="<?= $name?>" name="name" type="text" id="name" placeholder="Название">
								</div>
								<div class="admin__form-block">
									<label for="date">Год выпуска:</label>
									<input  value="<?= $year?>" name="year" type="number" min="2010" max="2023" name="date" placeholder="Год выпуска">
								</div>
								<div class="admin__form-block">
									<label for="complexion">Комплектация:</label>
									<select name="complexion" id="complexion">
										<option>Выберите комплектацию</option>
										<option value="Базовая">Базовая</option>
										<option value="Средняя">Средняя</option>
										<option value="Полная">Полная</option>
									</select>
								</div>
								<div class="admin__form-block">
									<label for="color">Цвет:</label>
									<input  value="<?= $color?>" name="color" type="text" name="color" placeholder="Цвет">
								</div>
								<div class="admin__form-block">
									<label for="engine">Двигатель:</label>
									<select name="engine">
										<option selected>Выберите двигатель</option>
										<option value="Бензиновый">Бензиновый</option>
										<option value="Электрический">Электрический</option>
									</select>
								</div>
								<div class="admin__form-block">
									<label for="price">Цена: &#36</label>
									<input  value="<?= $price?>" name="price" type="number" min="50000" step="5000" name="price" placeholder="Цена &#36">
								</div>
								<div class="admin__form-block">
									<label for="file">Модель</label>
									<select name="model">
										<option>Выберите модель:</option>
										<?php foreach ($models as $key => $model): ?>
											<option value="<?= $model['id']?>"><?=$model['model'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="admin__form-block">
									<label for="file">Выберите фото авто:</label>
									<input name="img" type="file" id="file">
								</div>
								<div class="admin__form-block admin__form-block-st">
									<label for="status">Наличие:</label>
									<input name="status" type="checkbox" name="status">
								</div>
								<button name="auto-create" type="submit" class="button">Добавить</button>
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