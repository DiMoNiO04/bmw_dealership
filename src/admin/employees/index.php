<?php 
	session_start();
	include "../../path.php";
	include "../../app/controllers/employees.php";
?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<?php include('../../app/includes/head.php') ?>
	<title>Админ панель: Сотрудники</title>
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

						<?php if(empty($employees)):?>
							<p class="panel__empty">Сотрудники в базе данных отсутствуют. Но вы можете добавить</p>
						<?php else:?>
							<?php foreach($employees as $key => $employee): ?>
								<div class="panel__blocks">
									<div class="panel__block">
										<h2 class="panel__subtitle"><?= $employee['last_name']?> <?= $employee['first_name']; ?> <?= $employee['surname']; ?></h2>
										
										<?php if(!empty($employee['img'])): ?>
											<img src="<?=BASE_URL . 'assets/images/dest/employees/' . $employee['img'] ?>" alt="<?= $employee['last_name']?>" class="panel__img panel__img-user">
										<?php endif; ?>
										
										<div class="panel__item">
											<h3>Дата рождения:</h3>
											<p><?= $employee['date_birth']?></p>
										</div>
										<div class="panel__item">
											<h3>Телефон:</h3>
											<p><?= $employee['phone']?></p>
										</div>
										<div class="panel__item">
											<h3>Место жительство:</h3>
											<p>г.<?=$employee['city']?>  ул.<?= $employee['street']?> д.<?= $employee['house']?> кв.<?= $employee['apartment']?></p>
										</div>
										</br>
										<div class="panel__item">
											<h3>Серия и номер паспорта:</h3>
											<p><?= $employee['series']?><?= $employee['number']?></p>
										</div>
										<div class="panel__item">
											<h3>Кем выдан:</h3>
											<p><?= $employee['issued_by']?></p>
										</div>
										<div class="panel__item">
											<h3>Когда выдан:</h3>
											<p><?= $employee['issued_when']?></p>
										</div>
										<div class="panel__item">
											<h3>Срок действия:</h3>
											<p><?= $employee['validity']?></p>
										</div>
										</br>

										<div class="panel__item">
											<h3>Логин:</h3>
											<p><?= $employee['login']?></p>
										</div>
										<div class="panel__item">
											<h3>Email:</h3>
											<p><?= $employee['email']?></p>
										</div>
										<div class="panel__item">
											<h3>Дата регистрации:</h3>
											<p><?= $employee['date_regist']?></p>
										</div>
										<div class="panel__item">
											<h3>Должность:</h3>
											<p><?= $employee['job']?></p>
										</div>

										<?php if($employee['access'] == 0):?>
											<div class="panel__item red">
												<h3>Доступ:</h3>
												<p>Нет доступа</p>
											</div>
										<?php else:?>
											<div class="panel__item green">
												<h3>Доступ:</h3>
												<p>Есть доступ</p>
											</div>
										<?php endif; ?>

										<div class="panel__buttons">
											<a class="button panel__button-edit" href="edit.php?edit_id=<?= $employee['id']?>">Редактировать</a>

											<?php if($employee['access'] == 0):?>
												<a class="button panel__button-publish" href="index.php?access=1&pub_id=<?=$employee['id'];?>">Доступ</a>
											<?php else: ?>
												<a class="button panel__button-publish" href="index.php?access=0&pub_id=<?=$employee['id'];?>">Заблокировать</a>
											<?php endif; ?>

											<a class="button panel__button-red" href="index.php?del_id=<?= $employee['id']?>">Удалить</a>
										</div>

									</div>
								<?php endforeach; ?>
							<?php endif; ?>
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