<?php 
	session_start();
  include "./path.php";
	include SITE_ROOT . "/app/database/Database.php";
  include "./app/controllers/contacts.php";
?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<?php include('./app/includes/head.php') ?>
	<title>Контакты-BMW</title>
</head>

<body>

	<?php include('./app/includes/header-blue.php') ?>

	<div class="dark-wrapper"></div>
	<main>
		<div class="contacts">
			<div class="container">
				<div class="contacts__container">
					<h1 class="title-pages">Контакты</h1>
					<div class="contacts__images">
						<img src="./assets/images/dest/contacts-first.jpg" alt="contact__first">
						<img src="./assets/images/dest/contacts-second.jpg" alt="contact__second">
					</div>
					
					<ul class="contacts__list">
						<?php if(empty($contacts)):?>
							<p class="panel__empty">Контакты в базе данных отсутствуют. Но вы можете добавить</p>
						<?php else:?>
							<?php foreach($contacts as $key => $contact): ?>
								<li class="contacts__item">
									<h2 class="contacts__subtitle"><?= $contact['name'] ?></h2>
									<div class="contacts__phone">
										<h3>Телефон</h3>
										<p><?= $contact['phone'] ?></p>
									</div>
									<div class="contacts__time">
										<h3>Время работы</h3>
										<p><?= $contact['work_time']?></p>
									</div>
									<div class="contacts__email">
										<h3>Email</h3>
										<p><?= $contact['email'] ?></p>
									</div>
								</li>
							<?php endforeach; ?>
						<?php endif;?>
					</ul>

					<div class="contacts__address">
						<div class="address__content">
							<h2 class="address__title">Адрес автоцентра</h2>
							<p>
								ООО «АВТОИДЕЯ», УНП 190829939 МКАД, Минский район, д. Цна, ул. Юбилейная, д. 4
							</p>
							<div class="address__gps">
								<h3>Координаты GPS</h3>
								<p>Широта: 53.972245` Долгота: 27.588655`</p>
							</div>
							<div class="address__time">
								<h3>Время работы автоцентра</h3>
								<p>Пн-Вс: 8:00 - 20:00</p>
							</div>
						</div>
						<div class="contact__map" style="position:relative;overflow:hidden;border-radius: 20px;"><a
								href="https://yandex.by/maps/org/avtodom_bmw_mkad_ofitsialny_diler/1063235852/?utm_medium=mapframe&utm_source=maps"
								style="color:#eee;font-size:12px;position:absolute;top:0px;">Автодом BMW МКАД Официальный
								дилер</a><a
								href="https://yandex.by/maps/1/moscow-and-moscow-oblast/category/car_dealership/184105322/?utm_medium=mapframe&utm_source=maps"
								style="color:#eee;font-size:12px;position:absolute;top:14px;">Автосалон в Москве и Московской
								области</a><a
								href="https://yandex.by/maps/1/moscow-and-moscow-oblast/category/sale_of_used_cars/190246757599/?utm_medium=mapframe&utm_source=maps"
								style="color:#eee;font-size:12px;position:absolute;top:28px;">Продажа автомобилей с пробегом в
								Москве и Московской области</a><iframe
								src="https://yandex.by/map-widget/v1/?ll=37.412433%2C55.688127&mode=search&oid=1063235852&ol=biz&z=17.02"
								 frameborder="1" allowfullscreen="true"
								style="position:relative;"></iframe></div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<?php include('./app/includes/footer.php') ?>

	<script src="https://kit.fontawesome.com/47a997ec54.js" crossorigin="anonymous"></script>
	<script src="./assets/js/header.min.js"></script>
</body>

</html>