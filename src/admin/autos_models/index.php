<?php 
	session_start();
   include "../../path.php";
   include "../../app/controllers/models.php";
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
						<a class="button panel__button" href="<?= BASE_URL . "admin/autos_models/create.php" ?>">Добавить</a>
						<h1 class="title-pages panel__title">Модели авто</h1>

						<div class="panel__blocks">
							
							<?php foreach($models as $key => $model): ?>
								<div class="panel__block">
									<h2 class="panel__subtitle"><?=$model['name']; ?></h2>
									<img src="<?=BASE_URL . 'assets/images/dest/models/' . $model['main_foto'] ?>" alt="<?=$model['name']; ?>" class="panel__img">
									
										<?php if($model['status']): ?>
											<div class="panel__status green">
												<h3>Наличие:</h3>
												<p>Есть в наличии</p>
											</div>
										<?php else: ?>	
											<div class="panel__status red">
												<h3>Наличие:</h3>
												<p>Нет в наличии</p>
											</div>
										<?php endif; ?>

										<div class="panel__buttons">
											<a class="button panel__button-edit" href="edit.php?id=<?=$model['id']?>">Edit</a>
											<a class="button panel__button-red" href="edit.php?del_id=<?=$model['id']?>">Delete</a>
										</div>
								</div>
							<?php endforeach; ?>

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