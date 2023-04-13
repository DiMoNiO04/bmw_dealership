<?php 
	session_start();
   include "../../path.php";
   include "../../app/controllers/contacts.php";
?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<?php include('../../app/includes/head.php') ?>
	<title>Админ панель: Контакты</title>
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
						<a class="button panel__button" href="<?= BASE_URL . "admin/contacts/create.php" ?>">Добавить</a>
						<h1 class="title-pages panel__title">Контакты</h1>

						<div class="panel__blocks">
						<?php if(empty($contacts)):?>
							<p class="panel__empty">Контакты в базе данных отсутствуют. Но вы можете добавить</p>
						<?php else:?>
							<?php foreach($contacts as $key => $contact): ?>
								<div class="panel__block">
									<h2 class="panel__subtitle"><?=$contact['name']?></h2>
									<div class="panel__item">
										<h3>Телефон:</h3>
										<p><?= $contact['phone']?></p>
									</div>
									<div class="panel__item">
										<h3>Время работы:</h3>
										<p><?= $contact['work_time']?></p>
									</div>
									<div class="panel__item">
										<h3>Email</h3>
										<p><?= $contact['email']?></p>
									</div>
									<div class="panel__buttons">
										<a class="button panel__button-edit" href="edit.php?id=<?=$contact['id']?>">Edit</a>
										<a class="button panel__button-red" href="edit.php?del_id=<?=$contact['id']?>">Delete</a>
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