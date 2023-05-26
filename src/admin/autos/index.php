<?php 
	session_start();
   include "../../path.php";
	 include SITE_ROOT . "/app/database/database.php";
   include "../../app/controllers/autos.php";
?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<?php include('../../app/includes/head.php') ?>
	<title>Админ панель: Автомобили</title>
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
						<a class="button panel__button" href="<?= BASE_URL . "admin/autos/create.php" ?>">Добавить</a>
						<h1 class="title-pages panel__title">Автомобили</h1>
					
						<?php if(empty($autoModelsName)):?>
							<p class="panel__empty">Автомобили в базе данных отсутствуют. Но вы можете добавить</p>
						<?php else:?>

							<div class="panel__blocks">
								<div class="error"></div>
								<?php foreach ($autoModelsName as $key => $auto): ?>
									<div class="panel__block model__cars-js" model="<?= $auto['model']?>">
										<h2 class="panel__subtitle"><?= $auto['model']?> серии <?= $auto['name']; ?></h2>
										
										<?php if(!empty($auto['img'])): ?>
											<img src="<?=BASE_URL . 'assets/images/dest/cars/' . $auto['img'] ?>" alt="<?= $auto['name']; ?>" class="panel__img panel__img-sm">
										<?php endif; ?>
										
										<div class="panel__item">
											<h3>Комплектация:</h3>
											<p><?= $auto['complexion'];?></p>
										</div>
										<div class="panel__item">
											<h3>Цвет:</h3>
											<p><?= $auto['color']; ?></p>
										</div>
										<div class="panel__item">
											<h3>Год выпуска:</h3>
											<p><?= $auto['year']; ?></p>
										</div>
										<div class="panel__item">
											<h3>Двигатель:</h3>
											<p><?= $auto['engine']; ?></p>
										</div>
										<div class="panel__item">
											<h3>Цена:</h3>
											<p><?= $auto['price']; ?> &#36 </p>
										</div>
										<div class="panel__item">
											<h3>Состояние:</h3>
											<p><?= $auto['state']; ?></p>
										</div>
										<?php if($auto['status'] == 0):?>
											<div class="panel__item red">
												<h3>Наличие:</h3>
												<p>Нет в наличии</p>
											</div>
										<?php else: ?>
											<div class="panel__item green">
												<h3>Наличие:</h3>
												<p>Есть в наличии</p>
											</div>
										<?php endif; ?>
										
										<div class="panel__buttons">
											<a class="button panel__button-edit" href="edit.php?id=<?=$auto['id'];?>">Редактировать</a>

											<?php if($auto['status'] == 0): ?>
												<a class="button panel__button-publish" href="edit.php?status=1&pub_id=<?=$auto['id'];?>">Опубликовать</a>
											<?php else:?>
												<a class="button panel__button-publish" href="edit.php?status=0&pub_id=<?=$auto['id'];?>">Снять с публикации</a>
											<?php endif; ?>

											<a class="button panel__button-red" href="edit.php?del_id=<?=$auto['id'];?>">Удалить</a>
										</div>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
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