<?php 
	session_start();
	include "../../path.php";
	include "../../app/controllers/orders.php";

	$orders = selectAll('ordersview');
?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<?php include('../../app/includes/head.php') ?>
	<title>Админ панель: Заказы</title>
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
					<a class="button panel__button" href="<?= BASE_URL . "admin/orders/create.php" ?>">Добавить</a>
						<h1 class="title-pages panel__title">Заказы</h1>

						
					<?php if(empty($orders)):?>
							<p class="panel__empty">Заказы в базе данных отсутствуют. Но вы можете добавить</p>
					<?php else:?>
						<?php foreach($orders as $order): ?>
							<div class="panel__blocks">
								<div class="panel__block">
									<h2 class="panel__subtitle">Заказ №<?= $order['id']; ?></h2>
									<div class="panel__item">
										<h3>Клиент:</h3>
										<p><?= $order['client_last_name']?> <?= $order['client_first_name']?> <?= $order['surname']?></p>
									</div>
									<div class="panel__item">
										<h3>Авто:</h3>
										<p><?= $order['model']?><?= $order['name']?></p>
									</div>
									<div class="panel__item">
										<h3>Стоимость:</h3>
										<p><?= $order['price']?></p>
									</div>
									<div class="panel__item">
										<h3>Дата оформления:</h3>
										<p><?= $order['date']?></p>
									</div>
									<div class="panel__item">
										<h3>Номер телефона:</h3>
										<p><?= $order['phone']?></p>
									</div>
									<div class="panel__item">
										<h3>Email:</h3>
										<p><?= $order['email']?></p>
									</div>
									<div class="panel__buttons">
										<a class="button panel__button-red" href="index.php?del_order=<?=$order['id'];?>">Удалить</a>
									</div>
								</div>					
							</div>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>
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