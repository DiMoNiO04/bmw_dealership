<?php 
	session_start();
   include "../../path.php";
	 include SITE_ROOT . "/app/database/database.php";
   include "../../app/controllers/contacts.php";
?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<?php include('../../app/includes/head.php') ?>
	<title>Админ панель: Контакты</title>
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

							<form  class="admin-form" action="create.php" method="post">
								<p class="obligatory"><span>*</span> - обязательное поле для заполнения</p>
								<div class="admin__form-block">
									<label for="name">Название<span>*</span></label>
									<input name="name" value="<?php $name?>" type="text" id="name" placeholder="Название" required>
								</div>
								<div class="admin__form-block">
									<label for="phone">Телефон<span>*</span></label>
									<input type="text" value="<?php $phone?>" id="phone" name="phone" placeholder="Номер телефона" required>
								</div>
								<div class="admin__form-block">
									<label for="time">Время работы<span>*</span></label>
									<input  value="<?php $workTime?>" name="work_time" type="tel" id="time" placeholder="Время работы" required>
								</div>
								<div class="admin__form-block">
									<label for="email">Email<span>*</span></label>
									<input value="<?php $email?>" name="email" type="email" id="email" placeholder="Email" required>
								</div>
								<div class="admin__form-block">
									<label for="city">Город<span>*</span></label>
									<input value="<?php $city?>" name="city" type="text" id="city" placeholder="Город" required>
								</div>
								<div class="admin__form-block">
									<label for="street">Улица<span>*</span></label>
									<input value="<?php $street?>" name="street" type="text" id="street" placeholder="Улица" required>
								</div>
								<div class="admin__form-block">
									<label for="house">Дом<span>*</span></label>
									<input value="<?php $house?>" name="house" type="text" id="house" placeholder="Дом" required>
								</div>
								<button type="submit" name="contact-create" class="button">Добавить</button>
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