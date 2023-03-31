<!DOCTYPE html>
<html lang="ru">

<head>
	<?php include('./front/includes/head.php') ?>
	<title>Регитрация BMW</title>
</head>

<body>

	<?php include('./front/includes/header-blue.php') ?>

	<div class="dark-wrapper"></div>
	<main>
		<div class="container">
			<form method="post" action="" class="form-reg">
				<h1 class="form-reg__title">Регистрация</h1>
				<p class="form-reg__desc">У вас уже есть аккаунт? Вы можете авторизироваться <a href="./auth.php">здесь</a></p>
				<div class="form-reg__item">
					<label for="email">Ваша почта</label>
					<input type="email" name="email" id="email" placeholder="Введите почту...">
				</div>
				<div class="form-reg__item">
					<label for="login">Ваш логин</label>
					<input type="text" name="login" id="login" placeholder="Введите логин...">
				</div>
				<div class="form-reg__item">
					<label for="password-first">Пароль</label>
					<input type="password" name="password-first" id="password-first" placeholder="Введите пароль...">
				</div>
				<div class="form-reg__item">
					<label for="password-second">Повторите пароль</label>
					<input type="password" name="password-second" id="password-second" placeholder="Введите пароль...">
				</div>
				<div class="form-reg__item form-reg__buttons">
					<button type="submit" name="button__reg">Зарегистрироваться</button>
					<a href="./auth.php">Войти</a>
				</div>
			</form>
		</div>
	</main>

	<?php include('./front/includes/footer.php') ?>

	<script src="https://kit.fontawesome.com/47a997ec54.js" crossorigin="anonymous"></script>
	<script src="./front/js/header.min.js"></script>
</body>

</html>