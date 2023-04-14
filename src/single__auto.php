<?php 
	include ('path.php'); 
	include ('./app/database/database.php');
	$auto = selectAutoFromAutosWithModelsOnSingle('auto', 'models', $_GET['auto']);
	$user = getPersonalData('employees', 'employees_address', 'employees_passport', 'authorization', $_SESSION['id']);
?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<?php include('./app/includes/head.php') ?>
	<title>BMW <?=$auto['model']?> серии <?=$auto['name']?></title>
</head>

<body>

	<div class="popup popup__hidden">
		<div class="popup__content">

			<div class="order__close">
				<img src="./assets/images/dest/svg/close.svg" alt="close">
			</div>
			
			<h2 class="order__title">Оформление заказа на автомобиль <span>BMW <?=$auto['model']?> серии <?=$auto['name']?></span></h2>
			
			<form action="#" method="post" class="order-form">
				<div class="order__date">
					<div class="personal__date">
						<h2 class="order__subtitle">Ваши персональные данные:</h2>
						<div class="personal__block">
							<h3>ФИО:</h3>
							<div class="personal__fio">
								<p><?= $user['last_name']?></p>
								<p><?= $user['first_name']?></p>
								<p><?= $user['surname']?></p>
							</div>
						</div>
						<div class="personal__block">
							<h3>Дата рождения:</h3>
							<p><?= $user['date_birth']?></p>
						</div>
						<div class="personal__block">
							<h3>Номер телефона:</h3>
							<p><?= $user['phone']?></p>
						</div>
						<div class="personal__block">
							<h3>Логин:</h3>
							<p><?= $user['login']?></p>
						</div>
						<div class="personal__block">
							<h3>Email:</h3>
							<p><?= $user['email']?></p>
						</div>
						<div class="personal__block">
							<h3>Место жительства:</h3>
							<p>г.<?= $user['city']?>, ул.<?= $user['streer']?>, д.<?= $user['house']?>, кв.<?= $user['apartment']?></p>
						</div>
						<div class="personal__block">
							<h3>Серия и номер паспорта:</h3>
							<p><?= $user['series']?><?= $user['number']?></p>
						</div>
						<div class="personal__block">
							<h3>Кем выдан:</h3>
							<p><?= $user['issued_by']?></p>
						</div>
						<div class="personal__block">
							<h3>Когда выдан:</h3>
							<p><?= $user['issued_when']?></p>
						</div>
						<div class="personal__block">
							<h3>Срок действия:</h3>
							<p><?= $user['validity']?></p>
						</div>
					</div>

					<div class="auto__date">
						<h2 class="order__subtitle">Данные автомобиля:</h2>
						<div class="auto__block">
							<h3>Модель:</h3>
							<p>BMW <?=$auto['model']?> серии <?=$auto['name']?></p>
						</div>
						<div class="auto__block">
							<h3>Коробка передач:</h3>
							<p><?=$auto['engine']?></p>
						</div>
						<div class="auto__block">
							<h3>Цвет:</h3>
							<p><?=$auto['color']?></p>
						</div>
						<div class="auto__block">
							<h3>Год выпуска:</h3>
							<p><?=$auto['year']?></p>
						</div>
						<div class="auto__block">
							<h3>Комплектация:</h3>
							<p><?=$auto['complexion']?></p>
						</div>
						<div class="auto__block">
							<h4>Перед оформлением заказа сверьтесь c правильностью данных или если что-то неверно, то вам следует зайти в личный кабинет и отредактировать</h4>
						</div>
					</div>
					<div class="price__block price__summary">
							<h3>Стоимость: </h3>
							<p><?=$auto['price']?></p>
					</div>
				</div>
				
				<h3 class="order__title">Оформление заказа</h3>
				<div class="order__item">
					<label for="email" class="order__label">Ваша почта</label>
					<input type="email" name="email" id="email" class="order__input" placeholder="Введите почту...">
				</div>
				<div class="order__item">
					<label for="login" class="order__label">Ваш логин</label>
					<input type="text" name="login" id="login" class="order__input" placeholder="Введите логин...">
				</div>
				<div class="order__item">
					<label for="password-first" class="order__label">Введите пароль для оформления заказа</label>
					<input type="password" name="password-first" class="order__input" id="password-first" placeholder="Введите пароль...">
				</div>
				<div class="order__item">
					<label for="password-second" class="order__label">Повторите пароль для подтверждения заказа</label>
					<input type="password" name="password-second" class="order__input" id="password-second" placeholder="Введите пароль...">
				</div>
				<button type="submit" class="button button__order-ok" name="button__order">Оформить заказ</button>
			</form>
		</div>
	</div>
	<div class="dark__container dark__container__noactive"></div>

	<?php include('./app/includes/header.php') ?>

	<div class="dark-wrapper"></div>
	<main>
		<section class="single-auto" style="background: url(<?=BASE_URL . 'assets/images/dest/models/' . $auto['main_foto']?>) no-repeat center; background-size: cover;">
			<div class="auto__bg-fon"></div>
			<div class="container">
				<div class="single-auto__container">
					<div class="single-auto__desc">
						<div class="single-auto__logo">
							<img src="./assets/images/dest/bmw-logo-2.png" alt="bmw-logo" class="logo-M2">
							<h1 class="single-auto__title">BMW <?=$auto['model']?> серии <?=$auto['name']?></h1>
						</div>

						<?php if($auto['status'] == 0):?>
							<button disabled class="button button__order__auto" title="Нету в наличии">Оформить авто</button>
						<?php else: ?>
							<button class="button button__order__auto">Оформить авто</button>
						<?php endif; ?>
						
					</div>
					<p class="single-auto__p">С удовольствием за рулем!</p>
				</div>
			</div>
		</section>

		<section class="characteristic">
			<div class="container">
				<div class="characteristic__container">
					<h2 class="characteristic__title">BMW <?=$auto['model']?> серии <?=$auto['name']?></h2>
					<ul class="characteristic__content">
						<li><strong>Модель:</strong><?=$auto['model']?></li>
						<li><strong>Цвет:</strong> <?=$auto['color']?></li>
						<li><strong>Двигатель:</strong> <?=$auto['engine']?></li>
						<li><strong>Год выпуска:</strong> <?=$auto['year']?></li>
						<li><strong>Комплектация:</strong> <?=$auto['complexion']?></li>
						<li><strong>Стоимость:</strong> <?=$auto['price']?> $</li>

						<?php if($auto['status'] == 0):?>
							<li><strong>Наличе:</strong><span class="red">нету в наличии</span></li>
						<?php else: ?>
							<li><strong>Наличе:</strong><span class="green">есть в наличии</span></li>
						<?php endif; ?>

					</ul>
				</div>
				<img class="single-auto__image" src="<?=BASE_URL . 'assets/images/dest/cars/' . $auto['img'] ?>" alt="<?=$auto['model']?><?=$auto['name']?>">
			</div>
		</section>

		<section class="description">
			<div class="container">
				<div class="description__container">

					<?php if($auto['status'] == 0):?>
							<button disabled class="button button__order" title="Нету в наличии">Оформить авто</button>
						<?php else: ?>
							<button class="button button__order">Оформить авто</button>
					<?php endif; ?>
	
				</div>
			</div>
		</section>
	</main>

	<?php include('./app/includes/footer.php') ?>

	<script src="https://kit.fontawesome.com/47a997ec54.js" crossorigin="anonymous"></script>
	<script src="./assets/js/header.min.js"></script>
	<script src="./assets/js/popup.min.js"></script>
</body>

</html>