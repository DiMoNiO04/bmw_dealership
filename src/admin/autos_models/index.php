<?php 
	session_start();
   include "../../path.php";
   include "../../app/controllers/models.php";
?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<?php include('../../app/includes/head.php') ?>
	<title>Админ панель: Модели</title>
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
							
							<?php if(empty($models)):?>
								<p class="panel__empty">Модели автомобилей в базе данных отсутствуют. Но вы можете добавить</p>
							<?php else:?>
								<?php foreach($models as $key => $model): ?>
									<div class="panel__block">
										<h2 class="panel__subtitle"><?=$model['model']; ?></h2>
										
										<?php if(!empty($model['main_foto'])): ?>
											<img src="<?=BASE_URL . 'assets/images/dest/models/' . $model['main_foto'] ?>" alt="<?=$model['model']; ?>" class="panel__img">
										<?php endif; ?>

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

												<?php if($model['status'] == 0): ?>
													<a class="button panel__button-publish" href="edit.php?status=1&pub_id=<?=$model['id'];?>">Publish</a>
												<?php else:?>
													<a class="button panel__button-publish" href="edit.php?status=0&pub_id=<?=$model['id'];?>">Unpublish</a>
												<?php endif; ?>

												<a class="button panel__button-red" href="edit.php?del_id=<?=$model['id']?>">Delete</a>
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
</body>

</html>