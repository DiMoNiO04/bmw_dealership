<!DOCTYPE html>
<html lang="ru">

<head>
	<?php include('./front/includes/head.php') ?>
	<title>BMW i7</title>
</head>

<body>

	<div class="popup popup__hidden">
		<div class="popup__content">

			<div class="order__close">
				<img src="./front/images/dest/svg/close.svg" alt="close">
			</div>
			
			<h2 class="order__title">Оформление заказа на автомобиль <span>BMW i7</span></h2>
			
			<form action="#" method="post" class="order-form">
				<div class="order__date">
					<div class="personal__date">
						<h2 class="order__subtitle">Ваши персональные данные:</h2>
						<div class="personal__block">
							<h3>ФИО:</h3>
							<div class="personal__fio">
								<p name="last__name">Разумов</p>
								<p name="first__name">Дмитрий</p>
								<p name="surname">Александрович</p>
							</div>
						</div>
						<div class="personal__block">
							<h3>Дата рождения:</h3>
							<p name="date_of_birth">02.06.2004</p>
						</div>
						<div class="personal__block">
							<h3>Номер телефона:</h3>
							<p name="phone">80447104585</p>
						</div>
					</div>
	
					<div class="auto__date">
						<h2 class="order__subtitle">Данные автомобиля:</h2>
						<div class="auto__block">
							<h3>Модель:</h3>
							<p>i7</p>
						</div>
						<div class="auto__block">
							<h3>Коробка передач:</h3>
							<p>Автоматическая</p>
						</div>
						<div class="auto__block">
							<h3>Цвет:</h3>
							<p>Серый</p>
						</div>
						<div class="auto__block">
							<h3>Год выпуска:</h3>
							<p>2022</p>
						</div>
					</div>
	
					<div class="complexion__date">
						<h2 class="order__subtitle">Выберите комплектацию:</h2>
						<select name="complexion">
							<option value="standart">Базовая</option>
							<option value="medium">Средняя</option>
							<option value="max">Максимальная</option>
						</select>
					</div>
	
					<div class="price__date">
						<h2 class="order__subtitle">Стоимость:</h2>
						<div class="price__block">
							<h3>Стоимость авто: </h3>
							<p>120000</p>
						</div>
						<div class="price__block">
							<h3>Стоимость комплектации: </h3>
							<p>20000</p>
						</div>
						<div class="price__block price__summary">
							<h3>Итого: </h3>
							<p>140000</p>
						</div>
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

	<?php include('./front/includes/header.php') ?>

	<div class="dark-wrapper"></div>
	<main>
		<section class="single-auto">
			<div class="auto__bg-fon"></div>
			<div class="container">
				<div class="single-auto__container">
					<div class="single-auto__desc">
						<div class="single-auto__logo">
							<img src="./front/images/dest/bmw-logo-2.png" alt="bmw-logo" class="logo-M2">
							<h1 class="single-auto__title">BMW i7</h1>
						</div>
						<button class="button button__order__auto">Оформить авто</button>
					</div>
					<p class="single-auto__p">С удовольствием за рулем!</p>
				</div>
			</div>
		</section>

		<section class="characteristic">
			<div class="container">
				<div class="characteristic__container">
					<h2 class="characteristic__title">BMW i7</h2>
					<ul class="characteristic__content">
						<li><strong>Модель:</strong>i7</li>
						<li><strong>Коробка передач:</strong> Автомат</li>
						<li><strong>Цвет:</strong> Серый</li>
						<li><strong>Двигатель:</strong> Электрический</li>
						<li><strong>Запас хода:</strong>до 625 км</li>
						<li><strong>Год выпуска:</strong> 2020</li>
						<li><strong>Стоимость:</strong> 210000 $</li>
						<li><strong>Наличе:</strong><span class="green">есть в наличии</span></li>
					</ul>
				</div>
				<img class="single-auto__image" src="./front/images/dest/cars/I-7.webp" alt="salon BMW i7">
			</div>
		</section>

		<section class="description">
			<div class="container">
				<div class="description__container">
					<p>Первый полностью электрический BMW i7 сочетает в себе динамику электромобиля и разнообразные
						информационно-развлекательные возможности, что позволяет получать незабываемые впечатления от поездки.
					</p>
					<p>Сценарий приветствия Great Entrance Moments.
						Фары с хрустальными элементами и решетка радиатора BMW Iconic Glow с подсветкой.
						Роскошная атмосфера салона и индивидуальные режимы My Modes.
						Как в кинотеатре: дисплей BMW Theatre Screen с диагональю 31,3" в задней части салона.
						Мощность 544 л.с.* и запас хода на электротяге до 625 км*</p>
					<p>Мощность 544 л.с.* внушает чувство уверенности на дороге. Крутящий момент до 745 Нм* обеспечивает
						максимально динамичный разгон. Разгон 0–100 км/ч всего за 4,7 с*.
						Почти в полной тишине и без вредных выбросов благодаря инновационной концепции привода eDrive</p>
					<p>Режимы My Modes позволяют Вам наслаждаться взаимодействием света, звука и микроклимата, оптимизированным
						в соответствии с Вашим настроением. BMW IconicSounds Electric генерирует характерный для каждого режима
						движения звук, записанный Хансом Циммером. Вас ждет еще очень много интересного: в новом BMW i7 каждая
						поездка превратится в восхитительное событие.</p>
					<p>Интеллектуальные и инновационные решения – сервисы BMW Connected предлагают широкий ряд полезных функций,
						что позволяет Вам с легкостью справляться в новом BMW i7 со всеми задачами повседневной жизни. Гибкие
						пакеты услуг обеспечивают идеальную связь и представляют самую актуальную информацию.</p>
					<button class="button button__order">Оформить авто</button>
				</div>
			</div>
		</section>
	</main>

	<?php include('./front/includes/footer.php') ?>

	<script src="https://kit.fontawesome.com/47a997ec54.js" crossorigin="anonymous"></script>
	<script src="./front/js/header.min.js"></script>
	<script src="./front/js/popup.min.js"></script>
</body>

</html>