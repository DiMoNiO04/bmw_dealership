<?php 
	include ('path.php'); 
	include "./app/controllers/auth.php";

		
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['personal-edit']))) {

		//Работа с изображением 
		if($_SESSION['role'] == 1) {
			treatmentImg("\assets\images\dest\employess\\");
		} else {
			treatmentImg("\assets\images\dest\clients\\");
		}

		//Получаем данные сотрудника из формы
		$id = $_POST['id'];
		$lastName = trim($_POST['last_name']);
		$firstName = trim($_POST['first_name']);
		$surname = trim($_POST['surname']);
		$img = $_POST['img'];
		$dateBirth = $_POST['date_birth'];
		$phone = trim($_POST['phone']);
		$city = trim($_POST['city']);
		$street = trim($_POST['street']);
		$house = trim($_POST['house']);
		$apartment = trim($_POST['apartment']);
		$series = trim($_POST['series']);
		$number = trim($_POST['number']);
		$issuedBy = trim($_POST['issued_by']);


		//Проверка валидности формы
		if($lastName  === '' || $firstName  === '') {
			array_push($errMsg, 'Заполните все обяазтельные поля!');
		} else {

			//Проверка на доступ
			if(isset($_POST['access'])) {
				$access = $ACCESS;
			} else {
				$access = $NO_ACCESS;
			}
				
			//Формируем массив для таблицы авторизации
			$dataAuth = [
				'access' => $access,
			];

			//Формируем массив паспорта
			$dataPassport = [
				'series' => $series,
				'number' => $number,
				'issued_by' => $issuedBy
			];

			//Формируем массив адресса
			$dataAddress = [
				'city' => $city,
				'street' => $street,
				'house' => $house,
				'apartment' => $apartment 
			];

			//Формируем данные в таблицу клиентов
			if(empty($img)) {
				$dataPersonal = [
					'last_name' => $lastName,
					'first_name' => $firstName,
					'surname' => $surname,
					'date_birth' => $dateBirth,
					'phone' => $phone,
				];
			} else {
				$dataPersonal = [
					'last_name' => $lastName,
					'first_name' => $firstName,
					'surname' => $surname,
					'date_birth' => $dateBirth,
					'phone' => $phone,
					'img' => $_POST['img'] ,
				];
			}

			if($_SESSION['role'] == 1) {
				$idEmployee = selectOne('employees', ['id_auth' => $id]); //Получаем данные сотрудника, которого хотим отредактировать
				$idAuth = $idEmployee['id_auth']; //Получаем айди записи авторизации, которую хотим запись
				$idAddress = $idEmployee['id_address']; //Получаем айди записи адресса, которую хотим запись
				$idPas = $idEmployee['id_passport']; //Получаем айди записи паспорта, которую хотим запись
	
				//Обновляем данные сотрудника, которого отредактировали
				update('employees', $idEmployee['id'], $dataPersonal);
				update('employees_passport', $idPas, $dataPassport);
				update('employees_address', $idAddress, $dataAddress);
				update('authorization', $idAuth, $dataAuth);
			} else {
				$idClients = selectOne('clients', ['id_auth' => $id]); //Получаем данные сотрудника, которого хотим отредактировать
				$idAuth = $idClients['id_auth']; //Получаем айди записи авторизации, которую хотим запись
				$idAddress = $idClients['id_address']; //Получаем айди записи адресса, которую хотим запись
				$idPas = $idClients['id_passport']; //Получаем айди записи паспорта, которую хотим запись
	
				//Обновляем данные сотрудника, которого отредактировали
				update('clients', $idClients['id'], $dataPersonal);
				update('clients_passport', $idPas, $dataPassport);
				update('clients_address', $idAddress, $dataAddress);
				update('authorization', $idAuth, $dataAuth);
			}
		}
	} 


	if($_SESSION['role'] == 0) {
		//Добавление заказа пользотвателем
		if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['button-order']))) {
			
			$email = trim($_POST['email']);
			$login = trim($_POST['login']);
			$passF = trim($_POST['password-first']);
			$passS = trim($_POST['password-second']);

			$idAuto = $_GET['auto'];
			$idSession = $_SESSION['id'];
			$roleSession = $_SESSION['role'];

			$user = selectOne('authorization', ['id' => $idSession]);
			$idUser = selectOne('clients', ['id_auth' => $idSession])['id'];

			if($login != $user['login'] || $email != $user['email'] || (!password_verify($passS, $user['password'])) || $passF != $passS) {
				array_push($errMsg, "Не верно введены данные! \n Заказ не был оформлен! \n Повторите попытку!");
			} else {

				if($roleSession == 0) {
					$params = [
						'id_client' => $idUser,
						'id_auto' => $idAuto
					];
				}

				insert('orders', $params); //Отправляем данные в таблицу клиентов
				header('location: ' . BASE_URL . "personal__cab-user.php"); //Возвращаем на страницу клиентов
			}
		}

			//Удаление заказа(пользователем)
		if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_order']))) {
			$id = $_GET['del_order'];  //Получаем айди модели, которую хотим удалить
			delete('orders', $id); //Удаляем
			if($_SESSION['role'] == 0) {
				header('location: ' . BASE_URL . "personal__cab-user.php"); //Возвращаем на страницу моделей
			} else {
				header('location: ' . BASE_URL . "admin/orders/index.php"); //Возвращаем на страницу моделей
			}
		}
	}

	$idSession = $_SESSION['id'];
	$user = selectOne('authorization', ['id' => $idSession]);
	if($_SESSION['role'] == 1) {
		$idUser = selectOne('employees', ['id_auth' => $idSession])['id'];
		$user = selectOne('employeesview', ['id' => $idUser]);
	} else {
		$idUser = selectOne('clients', ['id_auth' => $idSession])['id'];
		$user = selectOne('clientsview', ['id' => $idUser]);
	}

	$orders = getOrders($idUser);
?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<?php include('./app/includes/head.php') ?>
	<title>Личный кабинет</title>
</head>

<body>

	<?php include('./app/includes/header-blue.php') ?>

	<div class="popup popup__hidden popup__password">
		<div class="popup__content">

			<div class="popup__close popup__close-password">
				<img src="./assets/images/dest/svg/close.svg" alt="close">
			</div>

			<h2 class="popup__title">Изменение пароля</h2>
			
			<div class="error">
				<?php include("./app/helps/errInfo.php")?>
			</div>

			<p class="obligatory"><span>*</span> - обязательное поле для заполнения</p>

			<form action="personal__cab-user.php" method="post" class="popup-form password-form">
				<div class="popup__date">
					<div class="personal__date">
						<input type="hidden" name="id" value="<?= $_SESSION['id'] ?>">
						<div class="popup__item">
							<label for="passF">Введите пароль<span>*</span></label>
							<input name="passF" type="password" id="passF" placeholder="Введите пароль..." required>
						</div>
						<div class="popup__item">
							<label for="passS">Повторите пароль<span>*</span></label>
							<input name="passS" type="password" id="passS" placeholder="Повторите пароль..." required>
						</div>
					</div>
				</div>
				<button type="submit" class="button button__popup-ok" name="password-edit">Изменить пароль</button>
			</form>
		</div>
	</div>

	<div class="popup popup__hidden popup__personal-data">
		<div class="popup__content">

			<div class="popup__close popup__close-personal">
				<img src="./assets/images/dest/svg/close.svg" alt="close">
			</div>

			<h2 class="popup__title">Редактирование профиля</h2>
			
			<div class="error">
				<?php include("./app/helps/errInfo.php")?>
			</div>

			<p class="obligatory"><span>*</span> - обязательное поле для заполнения</p>

			<form action="personal__cab-user.php" method="post" class="popup-form password-form" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?= $_SESSION['id'] ?>">
				<div class="popup__date">
					<div class="personal__date">
						<p>Для того чтобы оформить заказ на авто, у вас должны быть заполнены все поля!</p>
						<section class="form-reg__block">	
							<h2>Личные данные</h2>
							<div class="form-reg__item">
								<label for="last_name">Фамилия<span>*</span></label>
								<input type="text" value="<?=$user['last_name'] ?>" name="last_name" id="last_name" placeholder="Введите фамилию..." required>
							</div>
							<div class="form-reg__item">
								<label for="first_name">Имя<span>*</span></label>
								<input type="text" value="<?=$user['first_name'] ?>" name="first_name" id="first_name" placeholder="Введите имя..." required>
							</div>
							<div class="form-reg__item">
								<label for="surname">Отчество</label>
								<input type="text" value="<?=$user['surname'] ?>" name="surname" id="surname" placeholder="Введите имя...">
							</div>
							<div class="form-reg__item">
								<label for="dateBirth">Дата рождения</label>
								<input type="date" value="<?=$user['date_birth'] ?>" name="date_birth" id="dateBirth">
							</div>
							<div class="form-reg__item">
								<label for="phone">Номер телефона</label>
								<input type="tel" value="<?=$user['phone'] ?>" name="phone" id="phone" placeholder="Введите номер телефона...">
							</div>
							<div class="form-reg__item">
								<label for="img">Фото (выбрано по умолчанию)</label>
								<input type="file" name="img" id="img">
							</div>
						</section>

						<section class="form-reg__block">	
							<h2>Данные по месту жительства</h2>
							<div class="form-reg__item">
								<label for="city">Город</label>
								<input type="text" value="<?=$user['city'] ?>" name="city" id="city" placeholder="Введите город...">
							</div>
							<div class="form-reg__item">
								<label for="street">Улица</label>
								<input type="text" value="<?=$user['street'] ?>" name="street" id="street" placeholder="Введите улицу...">
							</div>
							<div class="form-reg__item">
								<label for="house">Номер дома</label>
								<input type="text" value="<?=$user['house'] ?>" name="house" id="house" placeholder="Введите номер дома...">
							</div>
							<div class="form-reg__item">
								<label for="apartment">Номер квартиры</label>
								<input type="number" min="1" value="<?=$user['apartment'] ?>" name="apartment" id="apartment" placeholder="Введите номер квартиры...">
							</div>
						</section>

						<section class="form-reg__block">	
							<h2>Паспортные данные</h2>
							<div class="form-reg__item">
								<label for="series">Серия</label>
								<input type="text" value="<?=$user['series'] ?>" name="series" id="series" placeholder="Введите серию паспорта...">
							</div>
							<div class="form-reg__item">
								<label for="number">Номер</label>
								<input type="text" value="<?=$user['number'] ?>" name="number" id="number" placeholder="Введите номер паспорта...">
							</div>
							<div class="form-reg__item">
								<label for="issued_by">Кем выдан</label>
								<input type="text" value="<?=$user['issued_by'] ?>" name="issued_by" id="issued_by" placeholder="Введите кем выдан...">
							</div>
						</section>
					</div>
				</div>
				<button type="submit" class="button button__popup-ok" name="personal-edit">Сохранить</button>
			</form>

		</div>
	</div>

	<div class="dark__container dark__container__noactive"></div>

	<main>
		<section class="personal">
			<div class="container">
				<div class="personal__container">

					<h1 class="personal__title">
						<?php if($_SESSION['role'] == 0): ?>
							Клиент №<span><?= $user['id']?></span>
						<?php else: ?>
							Сотрудник №<span><?= $user['id']?></span>
						<?php endif; ?>
					</h1>

					<div class="personal__body">
						<div class="personal__image">
							<img src="./assets/images/dest/user.png" alt="personal__foto">
						</div>
						<div class="presonal__data">
							<h2 class="personal__subtitle">Ваши персональные данные:</h2>
							<div class="personal__data">
								<h3>ФИО:</h3>
								<div class="personal__fio">
									<span name="last__name"><?= $user['last_name']?></span>
									<span name="first__name"><?= $user['first_name']?></span>
									<span name="surname"><?= $user['surname']?></span>
								</div>
							</div>
							<div class="personal__data">
								<h3>Дата рождения:</h3>
								<span name="date_of_birth"><?= $user['date_birth']?></span>
							</div>
							<div class="personal__data">
								<h3>Номер телефона:</h3>
								<span name="phone"><?= $user['phone']?></span>
							</div>
							<div class="personal__data">
								<h3>Дата регистрации:</h3>
								<span><?= $user['date_regist']?></span>
							</div>
							<div class="personal__data">
								<h3>Место жительство:</h3>
								<span>г.<?= $user['city']?>, ул.<?= $user['street']?>, д.<?= $user['house']?>, кв.<?= $user['apartment']?></span>
							</div>
							<div class="personal__data">
								<h3>Серия и номер паспорта:</h3>
								<span><?= $user['series']?><?= $user['number']?></span>
							</div>
							<div class="personal__data">
								<h3>Кем выдан:</h3>
								<span><?= $user['issued_by']?></span>
							</div>
							<div class="personal__data">
								<h3>Логин:</h3>
								<span><?= $user['login']?></span>
							</div>
							<div class="personal__data">
								<h3>Email:</h3>
								<span><?= $user['email']?></span>
							</div>

							<?php if(isset($user['job'])):?>
								<div class="personal__data">
									<h3>Должность:</h3>
									<span><?= $user['job']?></span>
								</div>
							<?php endif; ?>

						</div>
					</div>
					<button class="button button__personal-data">Изменить персональные данные</button>
				</div>
			</div>
		</section>

		<?php if($_SESSION['role'] == 0): ?>
				<section class="orders">
					<div class="container">
						<div class="orders__container">
						<?php if(!empty($orders)): ?>
							<h2 class="personal__subtitle orders__subtitle">Ваши заказы:</h2>
							<div class="orders__body">
								<?php foreach($orders as $order): ?>
								<div class="panel__blocks">
								<div class="panel__block">
									<h2 class="panel__subtitle">Заказ №<?= $order['id']; ?></h2>
									<div class="panel__item">
										<h3>Авто:</h3>
										<p><?= $order['model']?> <?= $order['name']?></p>
									</div>
									<div class="panel__item">
										<h3>Двигатель:</h3>
										<p><?= $order['engine']?></p>
									</div>
									<div class="panel__item">
										<h3>Год выпуска:</h3>
										<p><?= $order['date']?></p>
									</div>
									<div class="panel__item">
										<h3>Стоимость:</h3>
										<p><?= $order['price']?></p>
									</div>
									<div class="panel__item">
										<h3>Комплектация:</h3>
										<p><?= $order['complexion']?></p>
									</div>
									<div class="panel__item">
										<h3>Цвет:</h3>
										<p><?= $order['color']?></p>
									</div>
									<div class="panel__item">
										<h3>Состояние:</h3>
										<p><?= $order['state']?></p>
									</div>
									<div class="panel__item">
										<h3>Дата оформления:</h3>
										<p><?= $order['date']?></p>
									</div>
									<br>
									<div class="panel__item">
										<h3>Менеджер:</h3>
										<p><?= $order['last_name']?> <?= $order['first_name']?></p>
									</div>
									<div class="panel__item">
										<h3>Номер телефона:</h3>
										<p><?= $order['phone']?></p>
									</div>
									<div class="panel__item">
										<h3>Email:</h3>
										<p><?= $order['emailEmployee']?></p>
									</div>
									<br>
									<div class="panel__item">
										<h3>Контакты:</h3>
										<p><?= $order['nameContact']?></p>
									</div>
									<div class="panel__item">
										<h3>Email:</h3>
										<p><?= $order['emailContact']?></p>
									</div>
									<div class="panel__item">
										<h3>Номер телефона:</h3>
										<p><?= $order['phoneContact']?></p>
									</div>
									<div class="panel__item">
										<h3>Время работы:</h3>
										<p><?= $order['work_time']?></p>
									</div>
									<a class="button__personal button__order-delete" href="personal__cab-user.php?del_order=<?= $order['id']?>">Отменить</a>
								</div>					
							</div>
								<?php endforeach; ?>
							<a href="./autos.php" class="button">Добавить заказ</a>
						</div>
						
						<?php else: ?>
							<p class="panel__empty">У вас еще нет заказов, но вы можете его сделать!</p>
						<?php endif;?>
					</div>
				</section>
		<?php endif; ?>

		<section class="buttons">
			<div class="container">
				<div class="buttons__container">
					<a class="button__personal personal-password__edit">Изменить пароль</a>
					<a class="button__personal" href="personal__cab-user.php?del_id=<?= $_SESSION['id']?>">Удалить аккаунт</a>
					<a href="../../logout.php" class="button__personal">Выйти из аккаунта</a>
				</div>
			</div>
		</section>
	</main>

	<?php include('./app/includes/footer.php') ?>

	<script src="https://kit.fontawesome.com/47a997ec54.js" crossorigin="anonymous"></script>
	<script src="./assets/js/header.min.js"></script>
	<script src="./assets/js/popup-personal-edit.min.js"></script>
	<script src="./assets/js/validatePassword.min.js"></script>
</body>

</html>