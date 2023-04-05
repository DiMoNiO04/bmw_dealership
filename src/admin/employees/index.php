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
						<a class="button panel__button" href="<?= BASE_URL . "admin/employees/create.php" ?>">Добавить</a>
						<h1 class="title-pages panel__title">Сотрудники</h1>

						<div class="panel__blocks">
							<div class="panel__block">
								<h2 class="panel__subtitle">Разумов Дмитрий Александрович</h2>
								<img src="../../assets/images/dest/user.png" alt="user" class="panel__img panel__img-user">
								<div class="panel__item">
									<h3>Логин:</h3>
									<p>dimonio</p>
								</div>
								<div class="panel__item">
									<h3>Дата рождения:</h3>
									<p>02.06.2004</p>
								</div>
								<div class="panel__item">
									<h3>Дата регистрации:</h3>
									<p>22.03.2023</p>
								</div>
								<div class="panel__item">
									<h3>Телефон:</h3>
									<p>80447104585</p>
								</div>
								<div class="panel__item">
									<h3>Email:</h3>
									<p>dima.razumov.04@mail.ru</p>
								</div>
								<div class="panel__item">
									<h3>Должность:</h3>
									<p>Менеджер</p>
								</div>
								<div class="panel__item">
									<h3>Место жительство:</h3>
									<p>г.Минск, ул.Волоха, д.27, кв.21</p>
								</div>
								<div class="panel__item">
									<h3>Серия и номер паспорта:</h3>
									<p>МС3045686</p>
								</div>
								<div class="panel__item">
									<h3>Когда выдан:</h3>
									<p>12.02.2008</p>
								</div>
								<div class="panel__item">
									<h3>Срок действия:</h3>
									<p>12.02.2018</p>
								</div>
								<div class="panel__item">
									<h3>Кем выдан:</h3>
									<p>Солигорским РОВД</p>
								</div>
								<div class="panel__buttons">
									<button class="button panel__button-edit">Edit</button>
									<button class="button panel__button-red">Delete</button>
								</div>
							</div>

							
							<div class="panel__block">
								<h2 class="panel__subtitle">Разумов Дмитрий Александрович</h2>
								<img src="../../assets/images/dest/user.png" alt="user" class="panel__img panel__img-user">
								<div class="panel__item">
									<h3>Логин:</h3>
									<p>dimonio</p>
								</div>
								<div class="panel__item">
									<h3>Дата рождения:</h3>
									<p>02.06.2004</p>
								</div>
								<div class="panel__item">
									<h3>Дата регистрации:</h3>
									<p>22.03.2023</p>
								</div>
								<div class="panel__item">
									<h3>Телефон:</h3>
									<p>80447104585</p>
								</div>
								<div class="panel__item">
									<h3>Email:</h3>
									<p>dima.razumov.04@mail.ru</p>
								</div>
								<div class="panel__item">
									<h3>Должность:</h3>
									<p>Менеджер</p>
								</div>
								<div class="panel__item">
									<h3>Место жительство:</h3>
									<p>г.Минск, ул.Волоха, д.27, кв.21</p>
								</div>
								<div class="panel__item">
									<h3>Серия и номер паспорта:</h3>
									<p>МС3045686</p>
								</div>
								<div class="panel__item">
									<h3>Когда выдан:</h3>
									<p>12.02.2008</p>
								</div>
								<div class="panel__item">
									<h3>Срок действия:</h3>
									<p>12.02.2018</p>
								</div>
								<div class="panel__item">
									<h3>Кем выдан:</h3>
									<p>Солигорским РОВД</p>
								</div>
								<div class="panel__buttons">
									<button class="button panel__button-edit">Edit</button>
									<button class="button panel__button-red">Delete</button>
								</div>
							</div>

							<div class="panel__block">
								<h2 class="panel__subtitle">Разумов Дмитрий Александрович</h2>
								<img src="../../assets/images/dest/user.png" alt="user" class="panel__img panel__img-user">
								<div class="panel__item">
									<h3>Логин:</h3>
									<p>dimonio</p>
								</div>
								<div class="panel__item">
									<h3>Дата рождения:</h3>
									<p>02.06.2004</p>
								</div>
								<div class="panel__item">
									<h3>Дата регистрации:</h3>
									<p>22.03.2023</p>
								</div>
								<div class="panel__item">
									<h3>Телефон:</h3>
									<p>80447104585</p>
								</div>
								<div class="panel__item">
									<h3>Email:</h3>
									<p>dima.razumov.04@mail.ru</p>
								</div>
								<div class="panel__item">
									<h3>Должность:</h3>
									<p>Менеджер</p>
								</div>
								<div class="panel__item">
									<h3>Место жительство:</h3>
									<p>г.Минск, ул.Волоха, д.27, кв.21</p>
								</div>
								<div class="panel__item">
									<h3>Серия и номер паспорта:</h3>
									<p>МС3045686</p>
								</div>
								<div class="panel__item">
									<h3>Когда выдан:</h3>
									<p>12.02.2008</p>
								</div>
								<div class="panel__item">
									<h3>Срок действия:</h3>
									<p>12.02.2018</p>
								</div>
								<div class="panel__item">
									<h3>Кем выдан:</h3>
									<p>Солигорским РОВД</p>
								</div>
								<div class="panel__buttons">
									<button class="button panel__button-edit">Edit</button>
									<button class="button panel__button-red">Delete</button>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</section>
	</main>

	<?php include('../../app/includes/footer.php') ?>

	<script src="https://kit.fontawesome.com/47a997ec54.js" crossorigin="anonymous"></script>
	<script src="../../assets/js/header.min.js"></script>
	<script src="../../assets/js/sidebar.min.js"></script>
</body>

</html>