<?php 
	include "../../path.php";
	include "../../app/controllers/models.php";
?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<?php include('../../app/includes/head.php') ?>
	<title>Админ панель: Модели</title>
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

						<div class="form-error">
							<?php include("../../app/helps/errInfo.php")?>
						</div>

							<form  class="admin-form" method="post" action="create.php" enctype="multipart/form-data">
								<p class="obligatory"><span>*</span> - обязательное поле для заполнения</p>
								<div class="admin__form-block">
									<label for="model">Модель<span>*</span></label>
									<input value="<?=$modelName ?>" name="modelName" type="text" id="model" placeholder="Модель" required>
								</div>
								<div class="admin__form-block">
									<label for="file">Выберите главное фото модели<span>*</span></label>
									<input name="img" type="file" id="file" required>
								</div>
								<div class="admin__form-block admin__form-block-st">
									<label for="status">Наличие</label>
									<input value="1" name="status" type="checkbox">
								</div>
								<button name="model-create" type="submit" class="button">Добавить</button>
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